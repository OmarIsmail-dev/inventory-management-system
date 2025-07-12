<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>update user</title>
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>
 <body>
                      
                  <div class="m-auto w-50 mt-4 ">
                    <h2>update user</h2>
                 <form enctype="multipart/form-data" action="{{ route("updateuser",$user->id) }}" method="POST">
                    @csrf
                    @method("put")

                    <div class="form-group">
                        <label for="exampleInputname">name address</label>
                        <input type="text" class="form-control" id="exampleInputname"  name="name" placeholder="Enter name" value="{{$user->name}}">
                       </div>
                       
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$user->email}}" name="email" placeholder="Enter email">
                     </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password" value="">
                    </div>
                    <div class="form-group mb-2">
                        <label for="level">User Role</label>
                        
                        <select id="user_role" class="form-control" name="role">
                        <option value="worker" {{ $user->role == 'worker' ? 'selected' : '' }}>Worker</option>
                        <option value="Manager" {{ $user->role == 'Manager' ? 'selected' : '' }}>Manager</option>
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="supplier" {{ $user->role == 'supplier' ? 'selected' : '' }}>supplier</option>
                            
                      
                      </select>
                           
                        </div>

                              @if ($user->role == "supplier")
                                  
 
                                  <div id="supplierTypeDiv"  style="margin-top: 10px; margin-bottom: 7px;"> 
                                  <label for="supplierType">Supplier Type</label>
                                <select id="supplierType"     name="supplierType" class="form-control">
                                   <option>Select the Supplier type</option>                             
                                  <option value="electronics" {{ $user->supplierType    == 'electronics' ? 'selected' : '' }}>Electronics</option>
                                    <option value="shoes" {{ $user->supplierType    == 'shoes' ? 'selected' : '' }}>Shoes</option>
                                    <option value="clothing" {{ $user->supplierType    == 'clothing' ? 'selected' : '' }}>Clothing</option>
                                    </select>
                                </div>
                                             
                                @else
                                <div id="supplierTypeDiv"  style="display: none ; margin-top: 10px; margin-bottom: 7px;"> 
                                  <label for="supplierType">Supplier Type</label>
                                <select id="supplierType"     name="supplierType" class="form-control">
                                   <option>Select the Supplier type</option>                             
                                  <option value="electronics" {{ $user->supplierType    == 'electronics' ? 'selected' : '' }}>Electronics</option>
                                    <option value="shoes" {{ $user->supplierType    == 'shoes' ? 'selected' : '' }}>Shoes</option>
                                    <option value="clothing" {{ $user->supplierType    == 'clothing' ? 'selected' : '' }}>Clothing</option>
                                    </select>
                                </div>
                   
                                @endif
                   
                        <div class="form-group mb-2  ">
                          <div class="input-group">
                              <span class="input-group-btn">
              <input type="file" name="image"   class="btn btn-primary btn-file "/>
           </span>

                              <button type="submit" name="submit" class="btn btn-default bg-dark text-white ms-2 ">Upload</button>
                          </div>
                            
                          <img src="{{asset("$user->image")}}" class="img-thumbnail" width="70px" alt="...">

                      </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
                </div>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

</body>


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