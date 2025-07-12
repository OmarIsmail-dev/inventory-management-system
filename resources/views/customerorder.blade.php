
@extends('layouts.app')





@section('content')

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



 
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center py-4">
        <div class="d-block mb-4 mb-md-0">
          
            <h2 class="h4">CustomerOrder</h2>
            <p class="mb-0">ALL CustomerOrder.</p>
        </div>
         
    </div>

    <div class="table-settings mb-4">
        <div class="row justify-content-between align-items-center">
            <div class="col-9 col-lg-8 d-md-flex">
                <div class="input-group me-2 me-lg-3 fmxw-300">
                    

            <form method="GET" action="{{ route('search') }}">
                <input type="text" name="search" class="form-control mb-2" placeholder="id or name or product or Status.">
                <button type="submit" class="btn btn-primary">search</button>
            </form>
    
                </div>
             </div>
 
        </div>
    </div>
    
    
    <div class="table-responsive">
        <table class="table mt-3 table-striped">
            <thead class="table-dark">
                <tr>
                
                    <th class="border-bottom">id</th>
                    <th class="border-bottom">image</th>

                    @if ( auth()->user()->role == "worker") 
                    <th class="border-bottom">order_message</th>  
                    @elseif ( auth()->user()->role == "Manager") 
                    <th class="border-bottom">user_name</th>
                    @endif
 
                    <th class="border-bottom">product_name</th>
                    <th class="border-bottom">price</th>
                    <th class="border-bottom">quantity</th> 
                    <th class="border-bottom">Status</th>
                    <th class="border-bottom">Date Created</th>

                </tr>
            </thead>

            <tbody>

             
                @foreach ($orders as $order)
                    
            
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
                
                <td >
                    @if ( auth()->user()->role == "Manager")
                    <div  class="d-flex align-items-center"> 
                        <div class="d-block">
                            <span class="fw-bold"> {{$order['user_name']}}</span>    
                        </div>
                    </div>
                    @elseif(auth()->user()->role == "worker" )                  
                   
                    @if ($order['order_status'] == "pending") 
                    <div  class="d-flex align-items-center"> 
                        <div class="d-block ">
                            <span class="fw-bold fs-6">
                             prepare your order now 😟
                            </span>                                     
                        </div>
                    </div> 
                    @elseif($order['order_status'] == "refused") 
                    <div  class="d-flex align-items-center"> 
                        <div class="d-block  ">

                            <span class="fw-bold fs-6"> Unfortunately, this request has not been completed 😔 </span>                                      
                        </div>
                    </div>  
                    @else 
                    <div  class="d-flex align-items-center "> 
                        <div class="d-block">
                            <span class="fw-bold fs-6">   This request is completed 😊 </span>                                                                          
                        </div>
                    </div> 
                    @endif  

                    @endif

                </td>
                
                       

                        <td>
                            <a href="#" class="d-flex align-items-center "> 
                                <div class="d-block ">
                                    <span class="fw-bold "> {{$order['product_name']}}</span>
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
     
                        @endforeach 
                </tr>
             </tbody>
        </table>
   
    </div>

 
 
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


    @endsection