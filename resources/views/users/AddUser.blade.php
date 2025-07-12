<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Add user</title>
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

<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>Add New User</span>
       </strong>
        </div>
        <div class="panel-body">
            <div class="col-md-6">
                <form method="post" enctype="multipart/form-data" action="{{route("CreateUsers")}}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Full Name">
                        @error('name')
                        <span class="invalid-feedback text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    </div>
                    <div class="form-group">
                        <label for="email">email</label>
                        <input type="email" class="form-control" name="email" placeholder="email">
                        @error('email')
                        <span class="invalid-feedback text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        @error('password')
                        <span class="invalid-feedback text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="level">User Role</label>
                        <select id="user_role" class="form-control" name="role">
                             <option value="worker"> worker  </option>
                             <option value="Manager"> Manager </option> 
                             <option value="admin"> admin  </option>
                             <option value="supplier"> supplier  </option>
                            </select>
                            
                            @error('role')
                            <span class="invalid-feedback text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div id="supplierTypeDiv" style="display: none; margin-top: 10px; margin-bottom: 7px;">
                            <label for="supplierType">Supplier Type</label>
                            <select id="supplierType" name="supplierType" class="form-control">
                                <option >Select the Supplier type</option>
                                <option value="electronics">Electronics</option>
                              <option value="shoes">Shoes</option>
                              <option value="clothing">Clothing</option>
                              </select>
                          </div>

                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-btn">
                <input type="file" name="image" multiple="multiple" class="btn btn-primary btn-file"/>
             </span>

                                <button type="submit" name="submit" class="btn btn-default">Upload</button>
                            </div>
                        </div>

                    <div class="form-group clearfix">
                        <button type="submit"   class="btn btn-primary">Add User</button>
                    </div>
                </form>
            </div>

        </div>

    </div>
</div>

<script> 
  document.getElementById('user_role').addEventListener('change', function () {
  const role = this.value;
  const supplierTypeDiv = document.getElementById('supplierTypeDiv');

  if (role === 'supplier') {
    supplierTypeDiv.style.display = 'block';
  }
   else {
    supplierTypeDiv.style.display = 'none';
  }

}); 

</script>