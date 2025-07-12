from flask import Flask, jsonify 
from flask_cors import CORS
import pandas as pd
import requests
import numpy as np
from sklearn.linear_model import LinearRegression
import warnings


warnings.filterwarnings("ignore") 
app = Flask(__name__)
CORS(app)

@app.route('/api/forecast_by_product', methods=['GET'])
def forecast_by_product():
    try:
        response = requests.get("https://ecommers.shop/api/CustomerOrder")
        response.raise_for_status()
        data = response.json()

        if isinstance(data, dict):
            for key, value in data.items():
                if isinstance(value, list):
                    data = value
                    break
        elif not isinstance(data, list):
            return jsonify({'error': 'Invalid API response format'}), 500

        df = pd.DataFrame(data)
        df['created_at'] = pd.to_datetime(df['created_at'], errors='coerce')
        df = df.dropna(subset=['created_at', 'quantity', 'product_id', 'product_name', 'order_status'])
 
        df = df[df['order_status'] == 'completed']

        df['quantity'] = pd.to_numeric(df['quantity'], errors='coerce').fillna(0)
        df['YearMonth'] = df['created_at'].dt.to_period('M')

        product_forecasts = {}

        for product_id, group in df.groupby('product_id'):
            product_name = group['product_name'].iloc[0]
            monthly = group.groupby('YearMonth')['quantity'].sum().reset_index()
            monthly['YearMonth'] = monthly['YearMonth'].dt.to_timestamp()
            demand_series = monthly.set_index('YearMonth')['quantity']

            forecast_entry = {
                'product_id': product_id,
                'product_name': product_name,
            }

            if len(demand_series) < 4:
                forecast_entry['error'] = 'Insufficient data for forecasting'
                forecast_entry['forecast'] = []
                forecast_entry['metrics'] = {}
                product_forecasts[product_id] = forecast_entry
                continue

            try:
                df_model = demand_series.reset_index()
                df_model['time'] = np.arange(len(df_model))
                X = df_model[['time']].values
                y = df_model['quantity'].values

                # Train/test split
                train_size = int(len(X) * 0.8)
                X_train, X_test = X[:train_size], X[train_size:]
                y_train, y_test = y[:train_size], y[train_size:]

                # ✅ Linear Regression فقط
                model = LinearRegression()
                model.fit(X_train, y_train)

                y_pred = model.predict(X_test)
                mae = mean_absolute_error(y_test, y_pred)
                rmse = np.sqrt(mean_squared_error(y_test, y_pred))

                non_zero_mask = y_test != 0
                if non_zero_mask.sum() == 0:
                    mape = None
                    accuracy = None
                else:
                    mape = np.mean(np.abs((y_test[non_zero_mask] - y_pred[non_zero_mask]) / y_test[non_zero_mask])) * 100
                    accuracy = 100 - mape

                model.fit(X, y)
                future_time = np.arange(len(X), len(X) + 12).reshape(-1, 1)
                forecast_values = model.predict(future_time)
                forecast_values = np.maximum(forecast_values, 0).astype(int)

                forecast_dates = pd.date_range(start=demand_series.index[-1] + pd.offsets.MonthBegin(1), periods=12, freq='MS')
                forecast_list = [
                    {'date': str(date.date()), 'value': int(value)}
                    for date, value in zip(forecast_dates, forecast_values)
                ]

                forecast_entry['forecast'] = forecast_list
                forecast_entry['metrics'] = {
                    'MAE': round(mae, 2),
                    'RMSE': round(rmse, 2),
                    'MAPE': round(mape, 2) if mape is not None else None,
                    'Accuracy': round(accuracy, 2) if accuracy is not None else None
                }

            except Exception as model_err:
                forecast_entry['error'] = f'Model error: {str(model_err)}'
                forecast_entry['forecast'] = []
                forecast_entry['metrics'] = {}

            product_forecasts[product_id] = forecast_entry

        return jsonify({'products': list(product_forecasts.values())})

    except Exception as e:
        import traceback
        traceback.print_exc()
        return jsonify({'error': 'Unexpected error', 'details': str(e)}), 500

if __name__ == '__main__':
    app.run(debug=True, port=5001)