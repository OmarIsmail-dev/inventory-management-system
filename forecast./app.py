
from flask import Flask, jsonify
from flask_cors import CORS
from prophet import Prophet
import pandas as pd
import numpy as np
import requests
import warnings

warnings.filterwarnings("ignore")

app = Flask(__name__)
CORS(app)

@app.route('/api/forecast', methods=['GET'])
def forecast_demand():
    try:
 
        response = requests.get("https://ecommers.shop/api/CustomerOrder")
        raw_json = response.json()

        
        if 'data' not in raw_json or not isinstance(raw_json['data'], list):
            return jsonify({'error': 'Missing or invalid "data" in response.'}), 400

        df = pd.DataFrame(raw_json['data'])

        
        if 'created_at' not in df.columns or 'quantity' not in df.columns:
            return jsonify({
                'error': 'Missing required fields in data.',
                'columns': df.columns.tolist()
            }), 400

      
        df['created_at'] = pd.to_datetime(df['created_at'], errors='coerce')
        df = df.dropna(subset=['created_at', 'quantity'])
        df['quantity'] = pd.to_numeric(df['quantity'], errors='coerce').fillna(0)

        
        df['YearMonth'] = df['created_at'].dt.to_period('M')
        monthly = df.groupby('YearMonth')['quantity'].sum().reset_index()
        monthly['YearMonth'] = monthly['YearMonth'].dt.to_timestamp()

        
        prophet_df = monthly.rename(columns={'YearMonth': 'ds', 'quantity': 'y'})

      
        train_size = int(len(prophet_df) * 0.8)
        train_df = prophet_df[:train_size]
        test_df = prophet_df[train_size:]

        
        model_eval = Prophet()
        model_eval.fit(train_df)
        future_eval = model_eval.make_future_dataframe(periods=len(test_df), freq='MS')
        forecast_eval = model_eval.predict(future_eval)

        pred_mean = forecast_eval.set_index('ds').loc[test_df['ds'], 'yhat']
        test_y = test_df.set_index('ds')['y']
        mape = np.mean(np.abs((test_y - pred_mean) / test_y)) * 100
        accuracy = 100 - mape

        model = Prophet()
        model.fit(prophet_df)
        future_forecast = model.make_future_dataframe(periods=18, freq='MS')
        forecast_result = model.predict(future_forecast)
        forecast_tail = forecast_result[['ds', 'yhat']].tail(18)

        forecast_list = [
            {
                "date": row['ds'].strftime('%Y-%m-%d'),
                "value": round(row['yhat'], 2)
            }
            for _, row in forecast_tail.iterrows()
        ]

        return jsonify({
            "metrics": {
                "Accuracy": round(accuracy, 2),
                "MAPE": round(mape, 2)
            },
            "products": [
                {
                    "forecast": forecast_list
                }
            ]
        })

    except Exception as e:
        return jsonify({"error": str(e)}), 500

if __name__ == '__main__':
    app.run(debug=True)
