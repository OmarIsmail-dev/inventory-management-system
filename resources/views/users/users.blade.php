{{-- <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>users</title>
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

</head> --}}


@extends('layouts.app')

 
@section('content')

<style>
    .label {
    display: inline-block;
    padding: 0.5em 0.7em;
    font-size: 12px;
    font-weight: 600;
    line-height: 1;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: 0.25em;
}

.label-success {
    background-color: #28a745; /* أخضر */
}

.label-default {
    background-color: #6c757d; /* رمادي */
}

</style>

<main style="">
        <nav class="navbar navbar-top navbar-expand navbar-dashboard navbar-dark ps-0 pe-2 pb-0">
            <div class="container-fluid px-0">
                <div class="d-flex justify-content-between w-100" id="navbarSupportedContent">
                    <div class="d-flex align-items-center">
                        <button id="sidebar-toggle"
                            class="  me-3 btn btn-icon-only d-none d-lg-inline-block align-items-center justify-content-center">
                            <svg class="toggle-icon" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>

                    </div>

                </div>
            </div>
        </nav>
    </main>  


    
             <div class="panel-heading clearfix" style="direction: rtl">
                <strong>
           <span class="glyphicon glyphicon-th"></span>
         </strong>
                <a href="{{route("AddUsers")}}" class="btn btn-info pull-right">Add New User</a>
            </div>



            <div class="table-responsive">
                <table class="table mt-3 table-striped ">
                    <thead class="table-dark"> 
                        <tr>
                            <th class="text-center" style="width: 50px;">#</th>
                            <th>Name </th>
                            <th>Username</th>
                            <th class="text-center" style="width: 15%;">User Role</th>
                            <th class="text-center" style="width: 10%;">Status</th>
                            <th style="width: 20%;">Last Login</th>
                            <th class="text-center" style="width: 100px;">Actions</th>
                        </tr>

                    </thead>
                    <tbody>
                        @foreach ($users as $user)                             

                        <tr>
                            <td class="text-center"> {{$user->id}} </td>
                            <td>{{$user->name}} </td>
                            <td> {{$user->email}} </td>
                            <td class="text-center">{{$user->role}}</td>
                            <td class="text-center">

                                 
                                @if($user->status == 'Active')
                                <span class="label label-success"> {{ $user->status }}  </span>
                            @else
                            <span class="label label-default "> {{ $user->status }}  </span>

                            @endif
                                
                                
                            </td>
                          

 
                          
                          @if(auth()->user()->last_login) 

                                
                            <td>                                   

                                {{ optional($user->last_login)->diffForHumans() ?? "He hasn't logged in yet" }}
                                 

                                </td>

 
                              @else      
                              
                               <td>                                   
                                  not logged in yet                               
                               </td>

 
                            @endif
                            
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{route("EditUser",$user->id)}}" class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                            <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001"/>
                                          </svg>
                                         </a>
                                    <a href="javascript:void(0);"  
                                    onclick="confirmDelete('{{ route('DeleteUser', $user->id) }}', '{{ addslashes($user->name) }}')"
                                    class="btn btn-xs btn-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                                      </svg>                                                                        </a>
                             </a>
                                                                                                     
                                </div>
                            </td>
                        </tr>
                        @endforeach 
                    </tbody>
                </table>
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
 

@endsection