<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- Primary Meta Tags -->
    <title>inventory system </title>
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <meta name="title" content="Volt - Premium Bootstrap 5 Dashboard">

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="120x120" href="image/10951884.png">
    <link rel="icon" type="image/png" sizes="32x32" href="image/10951884.png">
    <link rel="icon" type="image/png" sizes="16x16" href="image/10951884.png">

    <link rel="mask-icon" href="image/safari-pinned-tab.svg" color="#ffffff">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <!-- Sweet Alert -->
    <link type="text/css" href="assets/css/sweetalert2.min.css" rel="stylesheet">
    <!-- Notyf -->
    <link type="text/css" href="assets/css/notyf.min.css" rel="stylesheet">
    <!-- Full Calendar  -->
    <link type="text/css" href="assets/css/main.min.css" rel="stylesheet">
    <!-- Apex Charts -->
    <link type="text/css" href="assets/css/apexcharts.css" rel="stylesheet">
    <!-- Dropzone -->
    <link type="text/css" href="assets/css/dropzone.min.css" rel="stylesheet">
    <!-- Choices  -->
    <link type="text/css" href="assets/css/choices.min.css" rel="stylesheet">
    <!-- Leaflet JS -->
    <link type="text/css" href="assets/css/leaflet.css" rel="stylesheet">
    <!-- Volt CSS -->
    <link type="text/css" href="assets/css/inventory.css" rel="stylesheet">
</head>

<body>

<main class="content m-auto ">

    <a href="{{route("CustomerOrder")}}" class="btn btn-primary mt-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
          </svg>
        All CustomerOrder
    </a>

    
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div class="d-block mb-4 mb-md-0">

            
            <h2 class="h4">Customer order</h2>
            <p class="mb-0"> Customer order.</p>
        </div>

         
    </div>
    <div class="table-settings mb-4">
        <div class="row justify-content-between align-items-center">
            <div class="col-6 col-lg-6 d-md-flex">
                <div class="input-group me-2 me-lg-3 fmxw-300">
      
            <form method="GET" action="{{ route('search') }}">
                <input type="text" name="search" class="form-control mb-2 " placeholder="id or name or product or Status.">
                <button type="submit" class="btn btn-primary">search</button>
            </form>

                </div>
              </div>
 
        </div>
    </div>
    <div class="card card-body shadow border-0 table-wrapper table-responsive">
         
        <table class="table user-table table-hover align-items-center">
            <thead>
                <tr>
                
                    <th class="border-bottom">id</th>
                    <th class="border-bottom">image</th>
                    <th class="border-bottom">user_name</th>
                    <th class="border-bottom">product_name</th>
                    <th class="border-bottom">price</th>
                    <th class="border-bottom">quantity</th> 
                    <th class="border-bottom">Status</th>
                    <th class="border-bottom">Date Created</th>

                </tr>
            </thead>
            <tbody id="ordersTableBody">

             
                     
                @foreach ($orders as $order)
                    
                @if(count($order) > 0)
    
                    <tr>
                        <td>
                            <a href="#" class="d-flex align-items-center"> 
                                <div class="d-block">
                                    <span class="fw-bold"> {{$order['id']}}</span>
                              
                                </div>
                            </a>
                        </td>
                        <td>
                            <a href="#" class="d-flex align-items-center"> 
                                <div class="d-block">
                                <img width="50px" src=" {{url( $order['image'] ) }}" alt="">                       
                                </div>
                            </a>
                        </td>    
                        <td>
                            <div  class="d-flex align-items-center"> 
                                <div class="d-block">
                                    <span class="fw-bold"> {{$order['user_name']}}</span>
                                    
                                </div>
                            </div >
                        </td>
                        <td>
                            <a href="#" class="d-flex align-items-center"> 
                                <div class="d-block">
                                    <span class="fw-bold"> {{$order['product_name']}}</span>
                                 </div>
                            </a>
                        </td>
                        <td>
                            <a href="#" class="d-flex align-items-center"> 
                                <div class="d-block">
                                    <span class="fw-bold"> {{$order['price']}}</span>
                                 </div>
                            </a>
                        </td>
    
                        <td>
                            <a href="#" class="d-flex align-items-center"> 
                                <div class="d-block">
                                    <span class="fw-bold"> {{$order['quantity']}}</span>
                                 </div>
                            </a>
                        </td>
                     
                        @if($order['order_status']== "completed")
        
                        <td>
                            <span class="fw-normal text-success">{{$order['order_status']}}</span>
                        </td>
    
    
                        @elseif($order['order_status']== "refused") 
    
                        <td>
                            <span class="fw-normal text-danger">{{$order['order_status']}}</span>
                        </td>
    
                        @else
    
                        <td>
                            <span class="fw-normal text-warning  ">{{$order['order_status']}}</span>
                        </td>
    
                        @endif
    
    
                        <td>
                            <span class="fw-normal">{{$order['created_at']}}</span>
                        </td>
                        @endif
                        @endforeach
       
            </tbody>
        </table>
   
    </div>

 
</main>
 

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if(session('error'))
        Swal.fire({
            title: 'error!',
            html: "<span style='font-size: 20px;'>{{ session('error') }}</span>",
            icon: 'error',
            confirmButtonText: 'ok',
            width: '600px',  
        padding: '2em',  

        });
    @endif 

</script>
 
<script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Vendor JS -->
    <script src="assets/js/on-screen.umd.min.js"></script>
    <!-- Slider -->
    <script src="assets/js/nouislider.min.js"></script>
    <!-- Smooth scroll -->
    <script src="assets/js/smooth-scroll.polyfills.min.js"></script>
    <!-- Count up -->
    <script src="assets/js/countUp.umd.js"></script>
    <!-- Apex Charts -->
    <script src="assets/js/apexcharts.min.js"></script>
    <!-- Datepicker -->
    <script src="assets/js/datepicker.min.js"></script>
    <!-- DataTables -->
    <script src="assets/js/simple-datatables.js"></script>
    <!-- Sweet Alerts 2 -->
    <script src="assets/js/sweetalert2.min.js"></script>
    <!-- Moment JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>
    <!-- Vanilla JS Datepicker -->
    <script src="assets/js/datepicker.min.js"></script>
    <!-- Full Calendar -->
    <script src="assets/js/main.min.js"></script>
    <!-- Dropzone -->
    <script src="assets/js/dropzone.min.js"></script>
    <!-- Choices.js -->
    <script src="assets/js/choices.min.js"></script>
    <!-- Notyf -->
    <script src="assets/js/notyf.min.js"></script>
    <!-- Mapbox & Leaflet.js -->
    <script src="assets/js/leaflet.js"></script>
    <!-- SVG Map -->
    <script src="assets/js/svg-pan-zoom.min.js"></script>
    <script src="assets/js/svgMap.min.js"></script>
    <!-- Simplebar -->
    <script src="assets/js/simplebar.min.js"></script>
    <!-- Sortable Js -->
    <script src="assets/js/Sortable.min.js"></script>
    <!-- Github buttons -->
    <script async defer="defer" src="https://buttons.github.io/buttons.js"></script>
    <!-- Volt JS -->
    <script src="assets/js/volt.js"></script>

</body>

</html>
