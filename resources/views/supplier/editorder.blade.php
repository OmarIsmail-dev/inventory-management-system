<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retail Store Supplier Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="d-flex justify-content-center align-items-center mt-5 " style="background-color: #f2f4f6;">
    <div class="container bg-white p-4 rounded shadow-sm" style="max-width: 500px;">
        <h2 class="mb-3 text-center">inventory Supplier Form</h2>
        <form method="POST" action="{{ route("updateRequests",$supplierOrder->id) }}">
            @csrf
@method("put")

            <div class="mb-3">
                <label for="supplier" class="form-label">Supplier Name:</label>
                <input type="text" name="supplier_name" id="supplier" class="form-control"
                    value="{{ $supplierOrder->supplier_name }}" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address:</label>
                <input type="email" name="email" id="email" class="form-control"
                    value="{{ $supplierOrder->email }}" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">phone:</label>
                <input type="phone" id="phone" name="phone" class="form-control"
                    value="{{ $supplierOrder->phone }}" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">price:</label>
                <input type="number" id="price" name="price" class="form-control"
                    value="{{ $supplierOrder->price }}" required>
            </div>
            <div class="mb-3">
                <label for="TotalAmount" class="form-label">TotalAmount:</label>
                <input type="number" id="TotalAmount" value="{{ $supplierOrder->TotalAmount }}" name="TotalAmount" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="products" class="form-label">Products needed:</label>
                <select id="products" name="Product_name" class="form-select" required>
                    <option value="">Please select</option>
                    @foreach ($orders as $order)
                    @if ( $order->status != "completed") 
                    {{-- @if ($order->product_id == $order->product->id) --}}
                        
                    <option value="{{$order->id}}"  >
                      {{$order->product->title}} 
                    </option> 

                     @endif  
                    @endforeach

                </select>
            </div>


            {{-- <div class="mb-3">
                <label for="quantity" class="form-label">Address:</label>
                <input type="text" name="Address" id="Address" class="form-control"
                    value="{{ $supplierOrder->Address }}" required>
            </div> --}}

            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity of Product:</label>
                <input type="number" name="quantity" id="quantity" class="form-control"
                    value="{{ $supplierOrder->quantity }}" required>
            </div>

            <div class="mb-3">
                Delivery time
            </div>
            <div class="mb-3">
                <label for="delivery" class="form-label">Delivery date:</label>
                <input type="date" name="date" id="delivery" class="form-control"
                    value="{{ $supplierOrder->date }}" required>
                <input type="time" name="time" id="delivery" class="form-control"
                    value="{{ $supplierOrder->time }}" required>

            </div>
            <button type="submit" class="btn btn-danger w-100">Submit Form</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
