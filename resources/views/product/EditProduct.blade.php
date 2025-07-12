<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>update product</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->


    <link rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css ">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/bower_components/font-awesome/css/font-awesome.min.css ">
    <!-- Ionicons -->
    <link rel="stylesheet" href="assets/bower_components/Ionicons/css/ionicons.min.css ">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css ">
    <!-- iCheck -->
    <link rel="stylesheet" href="assets/plugins/iCheck/square/blue.css ">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


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

<body>

    <div class="m-auto w-50 mt-4 ">
        <h2>update user</h2>

        <form method="post" enctype="multipart/form-data" action="{{ route("UpdateProduct", $product->id) }}" class="clearfix">
            
            @csrf
            @method('put')

            <div class="form-group">
                <span class="input-group-addon">
                    <i class="glyphicon glyphicon-th-large"></i>
                </span>
                <input type="text" class="form-control" value="{{$product->title}}" name="title" placeholder="Product Title">
            </div>

            <div class="form-group mb-2 ">
                <span class="input-group-addon">
                    <i class="glyphicon glyphicon-shopping-cart"></i>
                </span>
                <input type="number" value="{{$product->in_stock}}" class="form-control" name="in_stock" placeholder="Product Quantity">
            </div>
            <div class="form-group mb-2">
                <span class="input-group-addon">
                    <i class="glyphicon glyphicon-usd"></i>
                </span>
                <input type="number" class="form-control" value="{{$product->BuyingPrice}}" name="BuyingPrice" placeholder="Buying Price">
            </div>
            <div class="form-group mb-2">
                <span class="input-group-addon">
                    <i class="glyphicon glyphicon-usd"></i>
                </span>
                <input type="number" class="form-control" value="{{$product->SellingPrice}}" name="SellingPrice" placeholder="Selling Price">
            </div>
           
            <div class="form-group mt-2">
                <div class="input-group" >
                    <span class="input-group-addon">
                          </span>
                    <input type="text" class="form-control" name="brand"  value="{{$product->brand}}">
                
                </div>

            </div>

  
      
            <div class="form-group mt-2">
                <div class="input-group"  >
                    <span class="input-group-addon">
                         

</span>
                    <input type="text" class="form-control" name="color"  value="{{$product->color}}"> 

                </div>

            </div>

                      
            <div class="form-group mt-2">
                <div class="input-group"  >
                    <span class="input-group-addon">
                         
  </span>
   <input type="text" class="form-control" id="product_attribute_value" name="product_attribute_value"
   placeholder="product_attribute_value" value="{{$product->product_attribute_value}}">  
  <span id="attribute_hint" class="text-muted d-block mt-1" style="font-size: 14px;"></span>
      
                </div>

            </div>

            <div class="form-group mt-2">
                <div class="input-group"  >
                    <span class="input-group-addon">
                         
  </span>
                    <input type="text" style=" padding: 31px 5px " class="form-control" name="description"  value="{{$product->description}}"  >
                
                </div>

            </div>
            
            @if ($product->category->name == "shoes") 
            <div id="size_shoes" class=" mt-2 form-group" >
                <div  class="input-group"  >
                    <span class="input-group-addon">
             </span>
                    <input type="text" class="form-control" name="size_shoes" value="{{$product->size_shoes}}" >                 
                </div>

            </div>
  
    
@else

<div id="size_shoes" class=" mt-2 form-group"style="display: none" >
    <div  class="input-group"  >
        <span class="input-group-addon">
 </span>
        <input type="text" class="form-control" name="size_shoes" value="{{$product->size_shoes}}" >                 
    </div>

</div>

@endif


            @if ($product->category->name == "clothing")  
            <div id="size_clothes" class="mt-2 form-group">
                <div  class="input-group"  >
                    <span class="input-group-addon">
              </span>
                    <input type="text" class="form-control" name="size_clothes"  value="{{$product->size_clothes}}" >
                
                </div>

            </div>

            @else

            <div id="size_clothes" class=" mt-2 form-group"style="display: none" >
                <div  class="input-group"  >
                    <span class="input-group-addon">
             </span>
                    <input type="text" class="form-control" name="size_clothes" value="{{$product->size_clothes}}" >                 
                </div>
            
            </div>
            
            @endif
            
            <div class="form-group mb-2">
                <label for="level">Product Category</label>
                <select id="category_id" class="form-control" name="category_id">
                    <option value="">Select Product Category</option>
                    @foreach ($categories as $category) 

                        <option value="{{ $category->id }}"   data-name="{{ strtolower($category->name) }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    
                        @endforeach
                </select>
            </div>

            <div class="form-group mb-2  ">
                <div class="input-group">
                    <span class="input-group-btn"> 
                        <input type="file" name="image" class="btn btn-primary btn-file " value="{{$product->image}}" />   
                    </span> 
                    <button type="submit" name="submit"
                        class="btn btn-default bg-dark text-white ms-2 ">Upload</button>
                </div> 
                <img src="{{ asset("$product->image") }}" class="img-thumbnail" width="70px" alt="..."> 
            </div> 
            <button type="submit" class="btn btn-primary">update</button>
        </form>  
    </div> 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>




<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<script>

function confirmDelete(deleteUrl, userName) {
    Swal.fire({
        title: "Are you sure?",
        html: "<span style='font-size: 20px;'>Do you want to delete the user: <b>" + userName + "</b>?</span>",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete!", 
        cancelButtonText: "Cancel",
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        width: '600px',  
        padding: '2em',  

    }).then((result) => {
        if (result.isConfirmed) {
            // Redirect to the delete URL after confirmation
            window.location.href = deleteUrl;
        } 

        
        else {
            Swal.fire("Cancelled", "The user is safe!😇", "error");
        }

    });




}


 


 
 
 
</script>



<script>

    <script>
@if(session('success'))
    window.onload = function() {
        Swal.fire({
            title: 'Success!🥳',
             html: "<span style='font-size: 20px;'>{{ session('success') }}</span>",

            icon: 'success',

            confirmButtonText: 'OK',
            width: '600px',  
        padding: '2em',  

        });
    }

 
@endif

</script>

</script>

<script>
    @if(session('success'))
        Swal.fire({
            title: 'success!🥳',
            html: "<span style='font-size: 20px;'>{{ session('success') }}</span>",
            icon: 'success',
            confirmButtonText: 'ok',
            width: '600px',  
        padding: '2em',  

        });
    @endif 

</script>




</script>


<style> 

button.swal2-confirm.btn.btn-success {
    margin-left: 7px;
  }

  button.swal2-confirm.swal2-styled.swal2-default-outline {
    padding: 9px 16px;
    font-size: 13px;
}

button.swal2-cancel.swal2-styled.swal2-default-outline
{

    padding: 9px 16px;
    font-size: 13px;
}

div#swal2-html-container {
    font-size: 17px;
}
</style>



<script>
@if(session('error'))
    window.onload = function() {
        Swal.fire({
            icon: "error",
            title: "Oops...🤨",
            html: "<span style='font-size: 20px;'>{{ session('error') }}</span>",
            width: '600px',  
            padding: '2em',
            confirmButtonText: 'OK'
        });
    }
@endif
</script>
 

<script>
    document.getElementById('category_id').addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        const categoryName = selectedOption.getAttribute('data-name');
        const sizeDiv = document.getElementById('size_shoes');

        if (categoryName == 'shoes') {
            sizeDiv.style.display = 'block';
        } else {
            sizeDiv.style.display = 'none';
        }
    });
  

    document.getElementById('category_id').addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        const categoryName = selectedOption.getAttribute('data-name');
        const sizeDiv = document.getElementById('size_clothes');

        if (categoryName == 'clothing') {
            sizeDiv.style.display = 'block';
        } else {
            sizeDiv.style.display = 'none';
        }
    });

    document.getElementById('category_id').addEventListener('change', function () {
        const categoryText = this.options[this.selectedIndex].text.toLowerCase();
        const input = document.getElementById('product_attribute_value');
        const hint = document.getElementById('attribute_hint');

        if (categoryText.includes('clothing') || categoryText.includes('shoes')) {
            input.placeholder = 'Enter season (Summer or Winter)';
            hint.textContent = 'Example: Summer or Winter';
        } else if (categoryText.includes('electronics') || categoryText.includes('mobiles') || categoryText.includes('devices')) {
            input.placeholder = 'Enter production year (e.g. 2023)';
            hint.textContent = 'Example: 2023 or 2024';
        } else {
            input.placeholder = 'Enter custom value';
            hint.textContent = '';
        }
    });


</script>


</body>
