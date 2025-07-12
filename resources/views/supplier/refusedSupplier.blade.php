@php
    use Carbon\Carbon;
@endphp

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SupplierOrder</title>
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

<style>
     @media (max-width: 768px) {
        .btn-group {
            display: flex;
            flex-direction: column;
        
        }

        .btn-group .btn {
            margin-bottom: 5px;
        }
    }
</style>

<body class="hold-transition skin-blue sidebar-mini">

    <div class="row">
        <div class="col-md-6">
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>All SupplierOrder</span>
          </strong>
                 </div>
                <div class="panel-body">
                    <div class="table-responsive">

                    <table class="table table-bordered table-striped">
                        <thead class=" " style="">
                            <tr>
                                <th class="text-center" style="width: 5%;">#</th>
                                <th class="text-center" style="width: 10%;"> name </th>
                                <th class="text-center" style="width: 15%;"> email </th>
                                <th class="text-center" style="width: 10%;"> Product name </th>
                                <th class="text-center" style="width: 5%;"> Quantity</th>
                                <th class="text-center" style="width: 10%;">phone </th>
                                <th class="text-center" style="width: 10%;">total Amount</th>
                                <th class="text-center" style="width: 15%;">Address</th>
                                <th class="text-center" style="width: 15%;">date</th>
                                 <th class="text-center" style="width: 10%;"> status</th> 
                             </tr>
                        </thead>
                        <tbody>

                            @foreach ($SupplierOrders as $SupplierOrder)
                                
                            @if ( $SupplierOrder->status == "refused")
                            @if ($SupplierOrder->user_id == auth()->id())

                                 

                            <tr>
                                <td class="text-center">
                                    {{$SupplierOrder->id}}
                                </td>
                                <td class="text-center">
                                    {{$SupplierOrder->supplier_name}}                              
                               </td>
                                <td class="text-center">
                                    {{$SupplierOrder->email}}
                                </td>
                                <td class="text-center">
                                    {{$SupplierOrder->Product_name}}
                                </td>

                                <td class="text-center">
                                    {{$SupplierOrder->quantity}}
                                  </td>

                                <td class="text-center">
                                    {{$SupplierOrder->phone}}
                                
                                </td>

                                <td class="text-center">
                                    {{$SupplierOrder->TotalAmount}}EGP
                                
                                </td>
                  

                                <td class="text-center">
                                    {{$SupplierOrder->order->Address}}
                                
                                </td>

                                <td class="text-center">
                                    <label style="display: block">
                                        <svg style="color: blue" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-check-fill" viewBox="0 0 16 16">
                                            <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2m-5.146-5.146-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708.708"/>
                                          </svg>
                                   
                                          {{$SupplierOrder->date}}

                                    </label> 
                                    <label >
                                        <svg style="color: blue" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-alarm-fill" viewBox="0 0 16 16">
                                            <path d="M6 .5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1H9v1.07a7.001 7.001 0 0 1 3.274 12.474l.601.602a.5.5 0 0 1-.707.708l-.746-.746A6.97 6.97 0 0 1 8 16a6.97 6.97 0 0 1-3.422-.892l-.746.746a.5.5 0 0 1-.707-.708l.602-.602A7.001 7.001 0 0 1 7 2.07V1h-.5A.5.5 0 0 1 6 .5m2.5 5a.5.5 0 0 0-1 0v3.362l-1.429 2.38a.5.5 0 1 0 .858.515l1.5-2.5A.5.5 0 0 0 8.5 9zM.86 5.387A2.5 2.5 0 1 1 4.387 1.86 8.04 8.04 0 0 0 .86 5.387M11.613 1.86a2.5 2.5 0 1 1 3.527 3.527 8.04 8.04 0 0 0-3.527-3.527"/>
                                          </svg>
                                          {{ Carbon::parse($SupplierOrder->time)->format('h:i A') }}
                                        </label> 
                                   </td>

                                <td class="text-center">

                                    <span class="label label-danger " style="font-size: 13px;">  {{$SupplierOrder->status}} </span>

                                </td>


                            
                            </tr> 
                            
                            @endif
                            @endif

                             @endforeach

                            </tbody> 
                    </table>
                </div>

                </div>
            </div>
        </div>
    </div> 