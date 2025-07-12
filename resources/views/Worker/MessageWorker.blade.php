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
    <div class="row   m-auto" style=" width: 85%;">
        <div class="col-md-12 m-auto mt-4">
            <div class="panel">
                <div class="panel-body">
                    <table class="table table-bordered">
                        <thead>
                            <th> title </th>
                            <th> description </th>
                            <th> type </th>
                            <th> AssignedTo</th>

                        </thead>
                        <tbody>
                            <tr>
                                <form method="post" action="{{ route("createMessage") }}">
                                    @csrf

                                    <td id="title">
                                        <input type="text" class="form-control" name="title">
                                    </td>

                                    <td id="message">
                                        <input type="text" style="padding: 30px 10px" class="form-control "
                                            name="message">
                                    </td>

                                    <td id="type">
                                        <select class="form-control" name="type">
                                            <option value="info">Info</option>
                                            <option value="warning">Warning</option>
                                            <option value="success">Success</option>
                                            <option value="error">Error</option>
                                        </select>

                                        <div id="result" class="list-group"></div>
                                    </td>

                                    <td id="AssignedTo">
                                        <select class="form-control" name="AssignedTo">
                                            @foreach ($users as $user)
                                                @if ($user->role !== 'worker'  && $user->role !== 'supplier' )

                                                    <option value="{{ $user->id}}">{{ $user->name }} - ({{ $user->role }})</option>
                                                
                                                    @endif
                                            @endforeach
                                        </select>

                                        <div id="result" class="list-group"></div>
                                    </td>

                                    <td>
                                        <button type="submit" name="update_sale" class="btn btn-primary">send
                                            message</button>
                                    </td>
                                </form>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>


    <main class="content m-auto ">
        <div class="message-wrapper border-0 bg-white shadow rounded mb-4 mt-6">
         
         @foreach ($messages as $message)
         @if ($message->AssignedTo == auth()->user()->id)
             
             
            <div class="card hover-state border-bottom rounded-0 rounded-top py-3">
                <div class="card-body d-flex align-items-center flex-wrap flex-lg-nowrap py-0">
                    <div class="col-1 align-items-center px-0 d-none d-lg-flex">
                    </div>
                    <div class="col-10 col-lg-2 ps-0 ps-lg-3 pe-lg-3">
                        <a href="#" class="d-flex align-items-center">
                            <image src="{{asset( $message->user->image ) }}" class="avatar-sm rounded-circle me-3" alt="Avatar">
                                              
                                
                                <span class="h6 fw-bold mb-0">{{$message->user->name}}</span>
                        
                            </a>
                    </div>
                    <div class="col-2 col-lg-2 d-flex align-items-center justify-content-end px-0 order-lg-4">
                        <div class="text-muted small d-none d-lg-block">{{ $message->created_at->diffForHumans() }}</div>
                        <!-- Dropdown -->
                        <div class="dropdown ms-3">
                            <button type="button" class="btn btn-sm fs-6 px-1 py-0 dropdown-toggle" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                    <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                      <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"></path>
                    </svg>
                  </button>
                            <div class="dropdown-menu dashboard-dropdown dropdown-menu-start mt-2 py-1">
                                <div role="separator" class="dropdown-divider my-1"></div>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <svg class="dropdown-icon text-danger me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                      </svg> Remove </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-7 d-flex align-items-center mt-3 mt-lg-0 ps-0">
                        <a href="./single-message.html" class="fw-normal text-gray-600-900 truncate-text">
                            <span class="fw-bold ps-lg-5 d-block">{{$message->title}}</span>
                            <span class="fw-bold d-none d-md-inline">{{$message->message}}</span>
                        </a>
                    </div>
                </div>
            </div>
            @endif

            @endforeach
        

            <div class="row p-4">
                <div class="col-7 mt-1">Showing 1 - 20 of 289</div>
                <!-- end col-->
                <div class="col-5">
                    <div class="btn-group float-end">
                        <a href="#" class="btn btn-gray-100">
                            <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                  </svg>
                        </a>
                        <a href="#" class="btn btn-gray-800">
                            <svg class="icon icon-sm" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                  </svg>
                        </a>
                    </div>
                </div>
                <!-- end col-->
            </div>
        </div>

    </main>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        @if(session('success'))
            Swal.fire({
                title: 'success!',
                html: "<span style='font-size: 20px;'>{{ session('success') }}</span>",
                icon: 'success',
                confirmButtonText: 'ok',
                width: '600px',  
            padding: '2em',  
    
            });
        @endif 
    
    </script>

    <!-- Core -->
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