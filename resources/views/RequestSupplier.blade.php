@php
    use Carbon\Carbon;
@endphp

@extends('layouts.app')


<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>

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


    <div class="table-responsive">
        <table class="table mt-3 table-striped">
            <thead class="table-dark">
                <tr>
                    <th class="text-center" style="width: 5%;">image</th>
                    <th class="text-center" style="width: 7%;"> Product name </th>
                    <th class="text-center" style="width: 7%;"> name-supplier </th>
                    <th class="text-center" style="width: 7%;"> DateDelivery </th>
                    <th class="text-center" style="width: 7%;"> Address</th>
                    <th class="text-center" style="width: 7%;"> Email</th>  
                    <th class="text-center" style="width: 7%;">phone </th>
                    <th class="text-center" style="width: 7%;">Qty </th>
                    <th class="text-center" style="width: 7%;">Price </th>
                    <th class="text-center" style="width: 7%;">TotalAmount</th>
                    <th class="text-center" style="width: 5%;"> Actions </th>
                </tr>
            </thead>
            <tbody>

                @foreach ($SupplierOrders as $SupplierOrder)
                    @if ($SupplierOrder->status == 'pending')
                        <tr>
                            <td class="text-center" style="font-size: 12px; font-weight: bold">
                                @foreach ($orders as $order)
                                    @if ($order->id == $SupplierOrder->order_id)
                                        
                                    <img width="50" src="{{ asset($order->image) }}" class=" "> 

                                        @endif
                                @endforeach

                            </td>
                            <td class="text-center" style="font-size: 12px; font-weight: bold">

                                @foreach ($products as $product)
                                    @if ($product->id === $SupplierOrder->order->product_id)
                                          
                                            @if ($product->category->name == "shoes")
                                                  
                                              {{ $product->title }} <br>
                                               (  {{$product->size_shoes}} )
 
                                              @elseif ($product->category->name == "clothing")
                                                  
                                                  {{ $product->title }} <br>
                                                 ( {{$product->size_clothes}} )
                                             
 
                                              @else

                                              {{ $product->title }}

                                              @endif
                                              @endif
                                @endforeach


                            </td>
                            <td class="text-center" style="font-size: 12px; font-weight: bold">
                                {{ $SupplierOrder->supplier_name }} <br>
                                 ( {{$SupplierOrder->user->supplierType}} )                    
                            </td>
                            <td class="text-center" style="font-size: 12px; font-weight: bold">

                                {{ $SupplierOrder->date }} <br>
                                {{ Carbon::parse($SupplierOrder->time)->format('h:i A') }}

                            </td>
                            <td class="text-center" style="font-size: 12px; font-weight: bold">
                                {{ $SupplierOrder->order->Address }}
                            </td>

                            <td class="text-center" style="font-size: 12px; font-weight: bold">
                                {{ $SupplierOrder->email }}
                            </td>
                            <td class="text-center" style="font-size: 12px; font-weight: bold">
                                {{ $SupplierOrder->phone }}

                            </td>
                            <td class="text-center" style="font-size: 12px; font-weight: bold">
                                {{ $SupplierOrder->quantity }}

                            </td>

                            <td class="text-center" style="font-size: 12px; font-weight: bold">
                                {{ $SupplierOrder->price }}EGP

                            </td>

                            <td class="text-center" style="font-size: 12px; font-weight: bold">

                                {{ $SupplierOrder->TotalAmount }}EGP


                            </td>

                                @php 
                                $now = Carbon::now();
                                $deliveryTime = Carbon::parse($SupplierOrder->date . ' ' . $SupplierOrder->time);
                                $isExpired = $now->gt($deliveryTime);  
                                @endphp

                            @if ($isExpired )
                            <td class="text-center text-danger">The deadline <br> has passed</td>
                            @else
             
                                <td class="text-center  " style="font-size: 0 !important; ">

                                    @method('put')

                                    <form style="display: ruby-text"
                                        action="{{ route('StatusWaiting', $SupplierOrder->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn ">
                                            <svg xmlns="http://www.w3.org/2000/svg" class=" text-success" width="20"
                                                height="20" fill="currentColor" class="bi bi-bag-check-fill"
                                                viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0m-.646 5.354a.5.5 0 0 0-.708-.708L7.5 10.793 6.354 9.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0z" />
                                            </svg>
                                        </button>
                                    </form>


                                    <form style="display: ruby-text"
                                        action="{{ route('StatusFailed', $SupplierOrder->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn ">
                                            <svg xmlns="http://www.w3.org/2000/svg" class=" text-danger" width="20"
                                                height="20" fill="currentColor" class="bi bi-bag-x-fill"
                                                viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0M6.854 8.146a.5.5 0 1 0-.708.708L7.293 10l-1.147 1.146a.5.5 0 0 0 .708.708L8 10.707l1.146 1.147a.5.5 0 0 0 .708-.708L8.707 10l1.147-1.146a.5.5 0 0 0-.708-.708L8 9.293z" />
                                            </svg>
                                        </button>
                                    </form>

                                </td>

                                @endif
                        </tr>
                    @endif
                @endforeach

            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script></script>
    <script>
        < script >

            @if (session('success'))
                window.onload = function() {
                    Swal.fire({
                        title: 'Success!',
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
        @if (session('success'))
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




    </script>


    <style>
        button.swal2-confirm.btn.btn-success {
            margin-left: 7px;
        }

        button.swal2-confirm.swal2-styled.swal2-default-outline {
            padding: 9px 16px;
            font-size: 13px;
        }

        button.swal2-cancel.swal2-styled.swal2-default-outline {

            padding: 9px 16px;
            font-size: 13px;
        }

        div#swal2-html-container {
            font-size: 17px;
        }
    </style>


    <script>
        @if (session('error'))
            window.onload = function() {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    html: "<span style='font-size: 20px;'>{{ session('error') }}</span>",
                    width: '600px',
                    padding: '2em',
                    confirmButtonText: 'OK'
                });
            }
        @endif
    </script>



    @if (session('warning') && session('offer_id'))
        <audio id="alertSound" src="{{ asset('sounds/alert.mp3') }}"></audio>

        <script>
            document.getElementById('alertSound').play();

            Swal.fire({
                title: "Are you sure?",
                text: "{{ session('warning') }}",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, I accept the offer.",
                cancelButtonText: "Cancel"
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = "{{ route('accept.offer', ['id' => session('offer_id')]) }}"; //  

                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = csrfToken;
                    form.appendChild(csrfInput);

                    const forceInput = document.createElement('input');
                    forceInput.type = 'hidden';
                    forceInput.name = 'force';
                    forceInput.value = '1';
                    form.appendChild(forceInput);

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        </script>
    @endif





    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
