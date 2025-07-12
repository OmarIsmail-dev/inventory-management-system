<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Add product</title>
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

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>

<body class="hold-transition skin-blue sidebar-mini ">
    <div class="row ">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Add New Product</span>
         </strong>
                </div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <form method="post" enctype="multipart/form-data" action="{{route("CreateProduct")}}" class="clearfix">
                            @csrf
                            <div class="form-group">
                                <div class="input-group" style="width: 250px">
                                    <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                                    <input type="text" class="form-control" name="title" placeholder="Product Title">
                                
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="input-group" style="width: 250px">
                                    <span class="input-group-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-award" viewBox="0 0 16 16">
                                            <path d="M9.669.864 8 0 6.331.864l-1.858.282-.842 1.68-1.337 1.32L2.6 6l-.306 1.854 1.337 1.32.842 1.68 1.858.282L8 12l1.669-.864 1.858-.282.842-1.68 1.337-1.32L13.4 6l.306-1.854-1.337-1.32-.842-1.68zm1.196 1.193.684 1.365 1.086 1.072L12.387 6l.248 1.506-1.086 1.072-.684 1.365-1.51.229L8 10.874l-1.355-.702-1.51-.229-.684-1.365-1.086-1.072L3.614 6l-.25-1.506 1.087-1.072.684-1.365 1.51-.229L8 1.126l1.356.702z"/>
                                            <path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1z"/>
                                          </svg>
                  </span>
                                    <input type="text" class="form-control" name="brand" placeholder="Product brand">
                                
                                </div>

                            </div>
                            <div id="size_shoes" class="form-group" style="display: none">
                                <div  class="input-group" style="width: 250px">
                                    <span class="input-group-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-boxes" viewBox="0 0 16 16">
                                            <path d="M7.752.066a.5.5 0 0 1 .496 0l3.75 2.143a.5.5 0 0 1 .252.434v3.995l3.498 2A.5.5 0 0 1 16 9.07v4.286a.5.5 0 0 1-.252.434l-3.75 2.143a.5.5 0 0 1-.496 0l-3.502-2-3.502 2.001a.5.5 0 0 1-.496 0l-3.75-2.143A.5.5 0 0 1 0 13.357V9.071a.5.5 0 0 1 .252-.434L3.75 6.638V2.643a.5.5 0 0 1 .252-.434zM4.25 7.504 1.508 9.071l2.742 1.567 2.742-1.567zM7.5 9.933l-2.75 1.571v3.134l2.75-1.571zm1 3.134 2.75 1.571v-3.134L8.5 9.933zm.508-3.996 2.742 1.567 2.742-1.567-2.742-1.567zm2.242-2.433V3.504L8.5 5.076V8.21zM7.5 8.21V5.076L4.75 3.504v3.134zM5.258 2.643 8 4.21l2.742-1.567L8 1.076zM15 9.933l-2.75 1.571v3.134L15 13.067zM3.75 14.638v-3.134L1 9.933v3.134z"/>
                                          </svg>
                  </span>
                                    <input type="text" class="form-control" name="size_shoes" placeholder="40,41,42,43">
                                
                                </div>

                            </div>
       
                            <div id="size_clothes" class="form-group" style="display: none">
                                <div  class="input-group" style="width: 250px">
                                    <span class="input-group-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-boxes" viewBox="0 0 16 16">
                                            <path d="M7.752.066a.5.5 0 0 1 .496 0l3.75 2.143a.5.5 0 0 1 .252.434v3.995l3.498 2A.5.5 0 0 1 16 9.07v4.286a.5.5 0 0 1-.252.434l-3.75 2.143a.5.5 0 0 1-.496 0l-3.502-2-3.502 2.001a.5.5 0 0 1-.496 0l-3.75-2.143A.5.5 0 0 1 0 13.357V9.071a.5.5 0 0 1 .252-.434L3.75 6.638V2.643a.5.5 0 0 1 .252-.434zM4.25 7.504 1.508 9.071l2.742 1.567 2.742-1.567zM7.5 9.933l-2.75 1.571v3.134l2.75-1.571zm1 3.134 2.75 1.571v-3.134L8.5 9.933zm.508-3.996 2.742 1.567 2.742-1.567-2.742-1.567zm2.242-2.433V3.504L8.5 5.076V8.21zM7.5 8.21V5.076L4.75 3.504v3.134zM5.258 2.643 8 4.21l2.742-1.567L8 1.076zM15 9.933l-2.75 1.571v3.134L15 13.067zM3.75 14.638v-3.134L1 9.933v3.134z"/>
                                          </svg>
                  </span>
                                    <input type="text" class="form-control" name="size_clothes" placeholder="medium,l,xl,2xl" >
                                
                                </div>

                            </div>
  
                             
                            <div class="form-group">
                                <div class="input-group" style="width: 250px">
                                    <span class="input-group-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-brush" viewBox="0 0 16 16">
                                            <path d="M15.825.12a.5.5 0 0 1 .132.584c-1.53 3.43-4.743 8.17-7.095 10.64a6.1 6.1 0 0 1-2.373 1.534c-.018.227-.06.538-.16.868-.201.659-.667 1.479-1.708 1.74a8.1 8.1 0 0 1-3.078.132 4 4 0 0 1-.562-.135 1.4 1.4 0 0 1-.466-.247.7.7 0 0 1-.204-.288.62.62 0 0 1 .004-.443c.095-.245.316-.38.461-.452.394-.197.625-.453.867-.826.095-.144.184-.297.287-.472l.117-.198c.151-.255.326-.54.546-.848.528-.739 1.201-.925 1.746-.896q.19.012.348.048c.062-.172.142-.38.238-.608.261-.619.658-1.419 1.187-2.069 2.176-2.67 6.18-6.206 9.117-8.104a.5.5 0 0 1 .596.04M4.705 11.912a1.2 1.2 0 0 0-.419-.1c-.246-.013-.573.05-.879.479-.197.275-.355.532-.5.777l-.105.177c-.106.181-.213.362-.32.528a3.4 3.4 0 0 1-.76.861c.69.112 1.736.111 2.657-.12.559-.139.843-.569.993-1.06a3 3 0 0 0 .126-.75zm1.44.026c.12-.04.277-.1.458-.183a5.1 5.1 0 0 0 1.535-1.1c1.9-1.996 4.412-5.57 6.052-8.631-2.59 1.927-5.566 4.66-7.302 6.792-.442.543-.795 1.243-1.042 1.826-.121.288-.214.54-.275.72v.001l.575.575zm-4.973 3.04.007-.005zm3.582-3.043.002.001h-.002z"/>
                                          </svg>

                </span>
                                    <input type="text" class="form-control" name="color" placeholder="Product color"> 

                                </div>

                            </div>
       
                            <div class="form-group">
                                <div class="input-group" style="width: 290px">
                                    <span class="input-group-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                                            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/>
                                            <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0M7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0"/>
                                          </svg>
                                    </span>
                                    <input type="text" class="form-control" id="product_attribute_value" name="product_attribute_value"
                                        placeholder="product_attribute_value">  
                                        <span id="attribute_hint" class="text-muted d-block mt-1" style="font-size: 14px;"></span>

                                </div>

                            </div>
          
                            <div class="form-group">
                                <div class="input-group" style="width: 400px ;" >
                                    <span class="input-group-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-text" viewBox="0 0 16 16">
                                            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/>
                                            <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8m0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5"/>
                                          </svg>
                  </span>
                                    <input type="text" style=" padding: 31px 5px " class="form-control" name="description" placeholder="Product description">
                                
                                </div>

                            </div>
                            
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <select id="category_id" class="form-control" name="category_id">
                                            <option value="">Select Product Category</option>
                                            @foreach($categories as $category)
                                                <option data-name="{{ strtolower($category->name) }}" value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>

                                                @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                   
                   
                                    </div>
                                </div>
                            </div>


                            

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                      <i class="glyphicon glyphicon-shopping-cart"></i>
                     </span>
                                            <input type="number" class="form-control" name="in_stock" placeholder="Product Quantity">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                       <i class="glyphicon glyphicon-usd"></i>
                     </span>
                                            <input type="number" class="form-control" name="BuyingPrice" placeholder="Buying Price">
                                            <span class="input-group-addon">.00</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                        <i class="glyphicon glyphicon-usd"></i>
                      </span>
                                            <input type="number" class="form-control" name="SellingPrice" placeholder="Selling Price">
                                            <span class="input-group-addon">.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group " style="width: 20px">
                         
                                <div class="input-group">
                                    <span class="input-group-btn">
                    <input type="file" name="image"   class="btn btn-primary btn-file"/>
                 </span>
    
                                    <button type="submit" name="submit" class="btn btn-default">Upload</button>
                                </div>
                            </div>

                            <button type="submit"  class="btn btn-danger">Add product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

 

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
    
            if (categoryName === 'shoes') {
                sizeDiv.style.display = 'block';
            } else {
                sizeDiv.style.display = 'none';
            }
        });
      

        document.getElementById('category_id').addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            const categoryName = selectedOption.getAttribute('data-name');
            const sizeDiv = document.getElementById('size_clothes');
    
            if (categoryName === 'clothing') {
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