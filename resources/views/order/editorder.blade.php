<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>update order</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 --> 
     <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/bower_components/font-awesome/css/font-awesome.min.css ">
    <!-- Ionicons -->
    <link rel="stylesheet" href="assets/bower_components/Ionicons/css/ionicons.min.css ">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css ">
    <!-- iCheck -->
    <link rel="stylesheet" href="assets/plugins/iCheck/square/blue.css ">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>

<style>
 
 body {
    font-family: 'Source Sans Pro', sans-serif;
    background: #f4f6f9;
    margin: 0;
    padding: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

.m-auto {
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    width: 60%;
}

h2 {
    text-align: center;
    color: #007bff;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 20px;
}

label {
    font-weight: bold;
    color: #333;
}

.form-control {
    border: 1px solid #ced4da;
    border-radius: 5px;
    padding: 10px;
    width: 100%;
}

.input-group-addon {
    background: #007bff;
    color: #fff;
    padding: 10px;
    border-radius: 5px 0 0 5px;
}

.btn-primary, .btn-default {
    padding: 10px 5px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

.btn-primary {
    background: #007bff;
    border: none;
}

.btn-primary:hover {
    background: #0056b3;
}

.btn-default {
    background: #28a745;
    color: #fff;
    border: none;
}

.btn-default:hover {
    background: #218838;
}

.img-thumbnail {
    display: block;
    margin-top: 5px;
     width: 100px;
    height: 100px;
}

button[type="submit"] {
    width: 100px;
    padding: 12px;
    font-size: 18px;
}

@media (max-width: 768px) {
    .m-auto {
        width: 90%;
        padding: 15px;
    }
} 

</style>

<body class="hold-transition skin-blue sidebar-mini">

    <div class="m-auto w-50 mt-4 ">
        <h2>update order</h2> 
        <form method="post" enctype="multipart/form-data" action="{{ route("UpdateOrder", $order->id) }}"
            class="clearfix">
            @csrf
            @method('put')

            <div class="form-group mb-2">
                <select class="form-control" id="product_id" name="product_id">  
                    @php
                    $currentCategory = strtolower(optional($order->product->category)->name);
                    $matchedProducts = [];
                    $otherProducts = [];
                
                    foreach ($products as $product) {
                        if (strtolower($product->category->name) === $currentCategory) {
                            $matchedProducts[] = $product;
                        } else {
                            $otherProducts[] = $product;
                        }
                    }
                
                    $sortedProducts = array_merge($matchedProducts, $otherProducts);
                @endphp
                
                    @foreach($sortedProducts as $product) 
                    @if ( $product->count() == 1)  
                    <option> select product</option>  
                    @endif 
                    <option data-name="{{ strtolower($product->category->name) }}" value="{{ $product->id}} " > 
                        
                        @if ($product->category->id == $product->category_id) 

                        {{ $product->title}} 
                     
                        @endif 
                    </option> 
                       @endforeach
                   </select>

                                      
             
            </div>

            <div class="form-group">
                <span class="input-group-addon">
                    <i class="glyphicon glyphicon-th-large"></i>
                </span>
                <input type="text" class="form-control" value="{{$order->email}}" name="email"  >
            </div>

            <div class="form-group">
                <span class="input-group-addon">
                    <i class="glyphicon glyphicon-th-large"></i>
                </span>
                <input type="text" class="form-control" value="{{$order->brand}}" name="brand"  >
            </div>

            <div class="form-group">
                <span class="input-group-addon">
                    <i class="glyphicon glyphicon-th-large"></i>
                </span>
                <input type="text" class="form-control" value="{{$order->description}}" name="description"  >
            </div>



            <div class="form-group">
                <span class="input-group-addon">
                    <i class="glyphicon glyphicon-th-large"></i>
                </span>
                <input type="text" class="form-control" value="{{$order->color}}" name="color"  >
            </div>

             
            @if ($order->product->category->name == "shoes")  

            <div class="form-group"   id="size_shoes">
                <span class="input-group-addon">
                    <i class="glyphicon glyphicon-th-large"></i>
                </span>
                <input type="text"  class="form-control"  value="{{$order->size_shoes}}" name="size_shoes"  >
            </div>

            @else

            <div class="form-group" style="display: none"  id="size_shoes">
                <span class="input-group-addon">
                    <i class="glyphicon glyphicon-th-large"></i>
                </span>
                <input type="text"  class="form-control"  value="{{$order->size_shoes}}" name="size_shoes"  >
            </div>

            @endif

                       
            @if ($order->product->category->name == "clothing")  

            <div class="form-group"    id="size_clothes">
                <span class="input-group-addon">
                    <i class="glyphicon glyphicon-th-large"></i>
                </span>
                <input type="text"  class="form-control"  value="{{$order->size_clothes}}" name="size_clothes"  >
            </div>

            @else

            <div class="form-group" style="display: none"  id="size_clothes">
                <span class="input-group-addon">
                    <i class="glyphicon glyphicon-th-large"></i>
                </span>
                <input type="text"  class="form-control"  value="{{$order->size_clothes}}" name="size_clothes"  >
            </div>

            @endif 


            <div class="form-group">
                <span class="input-group-addon">
                    <i class="glyphicon glyphicon-th-large"></i>
                </span>
                     <input type="text" class="form-control" name="Address" placeholder="Address" value="{{$order->Address}}">
       </div>

            <div class="form-group mb-2 ">
                <span class="input-group-addon">
                    <i class="glyphicon glyphicon-shopping-cart"></i>
                </span>
                <input type="number" value="{{$order->quantity}}" class="form-control" name="quantity" placeholder="Product Quantity">
            </div>
            <div class="form-group mb-2">
                <span class="input-group-addon">
                    <i class="glyphicon glyphicon-usd"></i>
                </span>
                <input type="number" class="form-control" value="{{$order->phone}}" name="phone" placeholder="Buying Price">
            </div>
  

            <div class="form-group mb-2  ">
                <div class="input-group">
                    <span class="input-group-btn">
                    
                        <input type="file" name="image" class="btn btn-primary btn-file " value="{{$order->image}}" />
                    
                    </span>
                 </div>

                <img src="{{asset( $order->image ) }}" class="img-thumbnail" width="70px" alt="...">

            </div>

            <button type="submit" class="btn btn-primary">update</button>
        </form>

    </div>

<script>

            document.getElementById('product_id').addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            const categoryName = selectedOption.getAttribute('data-name');
            const sizeDiv = document.getElementById('size_shoes');
    
            if (categoryName === 'shoes') {
                sizeDiv.style.display = 'block';
            } else {
                sizeDiv.style.display = 'none';
            }
            });
      

            document.getElementById('product_id').addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            const categoryName = selectedOption.getAttribute('data-name');
            const sizeDiv = document.getElementById('size_clothes');
    
            if (categoryName === 'clothing') {
                sizeDiv.style.display = 'block';
            } else {
                sizeDiv.style.display = 'none';
            }
            });


</script>

</body>