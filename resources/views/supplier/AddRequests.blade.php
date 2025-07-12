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
        <form method="POST" action="{{ route('CreateRequests') }}">
            @csrf

            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">



            <div class="mb-3">
                <label for="supplier" class="form-label">Supplier Name:</label>
                <input type="text" name="supplier_name" id="supplier" class="form-control"
                    value="{{ auth()->user()->name }}" required>
            </div>


            <div class="mb-3">
                <label for="email" class="form-label">Email address:</label>
                <input type="email" name="email" id="email" class="form-control"
                    value="{{ auth()->user()->email }}" required>
            </div>

            <div class="mb-3">
                <label for="supplier" class="form-label">brand:</label>
                <input type="text" name="brand" id="supplier" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label for="supplier" class="form-label">color:</label>
                <input type="text" name="color" id="supplier" class="form-control" value="" required>
            </div>

            <div class="mb-3">
                <label for="supplier" class="form-label">description:</label>
                <input type="text" name="description" id="supplier" class="form-control" value="" style="padding: 20px 5px" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">phone:</label>
                <input type="phone" id="phone" name="phone" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">price:</label>
                <input type="number" id="price" name="price" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="TotalAmount" class="form-label">TotalAmount:</label>
                <input type="number" id="TotalAmount" name="TotalAmount" class="form-control" required>
            </div>
            <div class="mb-3" id="size_shoes_Td" style="display: none">
                <label for="supplier" class="form-label">Size:</label>
                <input type="text" name="size_shoes" id="size_shoes_Td" class="form-control" >
            </div>
            <div class="mb-3" style="display: none;"  id="size_clothing_Td" >
                <label for="supplier" class="form-label">Size:</label>
                <input type="text" name="size_clothes" class="form-control" >
            </div>

            <div class="mb-3">
                <label for="products" class="form-label">Products needed:</label>
                <select id="products" name="order_id"   class="form-select" required>
                    <option value="">Please select</option>
                    @foreach ($orders as $order )
                        <option data-name="{{ strtolower($order->product->category->name) }}"

                            value="{{ $order->id }}"> 
                            {{ $order->product->title }} 
                        </option>
                    @endforeach
 
                </select>
            </div>


            {{-- <div class="mb-3">
                <label for="quantity" class="form-label">Address:</label>
                <input type="text" name="Address" id="Address" class="form-control" required>
            </div>  --}}

            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity of Product:</label>
                <input type="number" name="quantity" id="quantity" class="form-control" required>
            </div>

            <div class="mb-3">
                Delivery time
            </div>
            <div class="mb-3">
                <label for="delivery" class="form-label">Delivery date:</label>
                <input type="date" name="date" id="delivery" class="form-control" required>
                <input type="time" name="time" id="delivery" class="form-control" required>

            </div>
            <button type="submit" class="btn btn-danger w-100">Submit Form</button>
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <script>
        document.getElementById('products').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const categoryName = selectedOption.getAttribute('data-name');
            const sizeTd = document.getElementById('size_shoes_Td');

            if (categoryName === 'shoes') {

                sizeTd.style.display = 'block';

            } else {

                sizeTh.style.display = 'none';

            }
        });


        document.getElementById('products').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const categoryName = selectedOption.getAttribute('data-name');
            const sizeTd = document.getElementById('size_clothing_Td');

            if (categoryName === 'clothing') {

                sizeTd.style.display = 'block';

            } else {

                sizeTh.style.display = 'none';

            }
        });
    </script>
</body>

</html>
