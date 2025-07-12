@extends("layouts.app")


<head> 
    <title>category</title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>





 
    @section("content")
    <main  style="margin-top: -20px; margin-bottom: 20px;">
        <nav class="navbar navbar-top navbar-expand navbar-dashboard navbar-dark ps-0 pe-2 pb-0">
            <div class="container-fluid px-0">
                <div class="d-flex justify-content-between w-100" id="navbarSupportedContent">
                    <div class="d-flex align-items-center">
                        <button id="sidebar-toggle" class="  me-3 btn btn-icon-only d-none d-lg-inline-block align-items-center justify-content-center">
                <svg class="toggle-icon" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                </svg>
              </button>
    
                    </div>
    
                </div>
            </div>
        </nav>
    </main>


         <style>
            body {
                font-family: Arial, sans-serif;
                margin: 20px;
                background-color: #f9f9f9;
            }
            .container {
                display: flex;
                gap: 20px;
                justify-content: space-between;
            }
            .panel {
                background: #fff;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                flex: 1;
            }
            .panel-heading {
                font-size: 20px;
                font-weight: bold;
                margin-bottom: 20px;
            }
            .form-group {
                margin-bottom: 15px;
            }
            .form-group label {
                display: block;
                margin-bottom: 5px;
            }
            .form-control, select {
                width: 100%;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 5px;
            }
            .btn {
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                transition: background 0.3s;
            }
            .btn-primary {
                background-color: #007bff;
                color: white;
            }
            .btn-primary:hover {
                background-color: #0056b3;
            }
            .btn-warning {
                background-color: #ffc107;
                color: #333;
            }
            .btn-warning:hover {
                background-color: #e0a800;
            }
            .btn-danger {
                background-color: #dc3545;
                color: white;
            }
            .btn-danger:hover {
                background-color: #c82333;
            }
            .table {
                width: 100%;
                border-collapse: collapse;
                background: #fff;
                border-radius: 8px;
                overflow: hidden;
            }
            .table th, .table td {
                padding: 10px;
                border: 1px solid #ddd;
                text-align: center;
            }
            .table th {
                background-color: #007bff;
                color: #fff;
            }
            .btn-group a {
                text-decoration: none;
                margin: 0 5px;
            }

            button:focus{
    outline: none !important;
    box-shadow: none !important;
}

</style>
    
        <div class="container">
            <div class="panel">
                <div class="panel-heading"><i class="fas fa-plus-circle"></i> Add New Category</div>
                <div class="panel-body">
                    <form method="post" action="{{route('CreateCategory')}}">
                        @csrf
                        <div class="form-group">
                            <label for="name"><i class="fas fa-tag"></i> Name category</label>
                            <select name="name" class="form-control">
                                <option value="">Select the category</option>
                                <option value="electronics">Electronics</option>
                              <option value="shoes">Shoes</option>
                              <option value="clothing">Clothing</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Add category</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="panel">
                <div class="panel-heading"><i class="fas fa-list"></i> All Categories</div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Categories</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Categories as $Category)
                            <tr>
                                <td>{{ $Category->id }}</td>
                                <td>{{ $Category->name }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{route('editcategory', $Category->id)}}" class="btn btn-warning"><i class="fas fa-edit"></i> Edit</a>
                                        <a href="{{route('DeleteCategory', $Category->id)}}" onclick="return confirm('Are you sure you want to delete {{$Category->name}} ?')" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Delete</a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
         
 
    @endsection


    @if(session('success'))
    <script>
        alert("{{ session('success') }}");
    </script>
@endif


