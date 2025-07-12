<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Add order</title>
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
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>

<body class="hold-transition skin-blue sidebar-mini">

    <div class="row">
        <div class="col-md-6">
        </div>
    </div>
    <div class="row">

        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading clearfix">
                    <strong>
                        <span class="glyphicon glyphicon-th"></span>
                        <span>Add order</span>
                    </strong>
                    <div class="pull-right">
                        <a href="{{ route("Order") }}" class="btn btn-primary">Show all order</a>
                    </div>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <thead>
                            <th> Product title </th>
                            <th> Email </th>
                            <th> Qty</th>
                            <th> Description</th>  
                            <th> color</th>   
                            <th id="size_shoes_Th" style="display: none"> size_shoes</th> 
                            <th id="size_clothing_Th" style="display: none"> size_clothes</th> 
                            <th> brand</th> 
                            <th> Address</th>  
                            <th> phone</th>
                            <th> image</th>
                            <th> action</th>

                        </thead>
                        <tbody id="product_info">
                            <tr>
                                <form method="post" enctype="multipart/form-data" action="{{route("CreateOrder")}}" >
                                    @csrf 

                                    <input  type="hidden" class="form-control" name="user_id" value="{{auth()->id()}}"> 
 
                                    <td id="s_name">

                                        <select class="form-control" id="product_id" name="product_id">
                                             @foreach($products as $product) 
                        
                                             @if ( $product->count() == 1)
                        
                                             <option> select product</option> 
                         
                                             @endif
                                                                      <option data-name="{{ strtolower($product->category->name) }}" value="{{ $product->id}} " > 
                                                {{ $product->title}} 
                                            </option> 
                                                @endforeach
                                            </select>

                                            @foreach($products as $product) 
                                        @if($product->category->id  == $product->category_id)                                          
                                        <input  type="hidden" class="form-control" name="category_id" value="{{$product->category->id}}"> 
                                        @endif 
                                        @endforeach
 
                                        <div id="result" class="list-group"></div>
                                    </td>
                                    <td id="Email">
                                        <input type="text" class="form-control" name="email" value="">
                                    </td>

                                    <td id="s_qty">
                                        <input type="number" class="form-control" name="quantity" value=" ">
                                    </td>

                                    <td id="desc">
                                        <input type="text" class="form-control" name="description" value="">
                                    </td>

                                    <td id="color">
                                        <input type="text" class="form-control" name="color" >
                                    </td>
                                    <td style="display:none" id="size_shoes_Td" >
                                        <input type="text" class="form-control" name="size_shoes">
                                    </td>
                                    <td style="display:none" id="size_clothing_Td">
                                        <input type="text" class="form-control" name="size_clothes">
                                    </td> 

                                    <td id="brand">
                                        <input type="text" class="form-control" name="brand" value="">
                                    </td>

                                    <td id="Address">
                                        <input type="text" class="form-control" name="Address"  >
                                    </td>

                                    <td id="phone">
                                        <input type="number" class="form-control" name="phone" value=" ">
                                    </td>
                                    <td id="image">
                                        <input type="file" name="image" class="btn btn-primary btn-file" />
                                    </td>
                                    <td>
                                        <button type="submit" name="update_sale" class="btn btn-primary">place
                                            order</button>
                                    </td>
                                </form>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </div>

    <script>
        document.getElementById('product_id').addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            const categoryName = selectedOption.getAttribute('data-name');
            const sizeTh = document.getElementById('size_shoes_Th');
            const sizeTd = document.getElementById('size_shoes_Td');
    
            if (categoryName === 'shoes') { 

                sizeTh.style.display = 'block';
                sizeTd.style.display = 'block';

            } else {

                 sizeTd.style.display = 'none';
                sizeTh.style.display = 'none';

            }
        });
      

        document.getElementById('product_id').addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            const categoryName = selectedOption.getAttribute('data-name');
            const sizeTh = document.getElementById('size_clothing_Th');
            const sizeTd = document.getElementById('size_clothing_Td');
    
            if (categoryName === 'clothing') {
                sizeTh.style.display = 'block';
                sizeTd.style.display = 'block';

            } else {

                 sizeTd.style.display = 'none';
                sizeTh.style.display = 'none';

            }
        });


</script>