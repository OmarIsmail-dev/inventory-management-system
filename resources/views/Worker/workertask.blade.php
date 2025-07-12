@php
    use Carbon\Carbon;
@endphp

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
 

         <div class="table-responsive">
            <table class="table mt-6 table-striped">
                <thead class="table-dark"> 
                    <tr>
                        <th>Task Title</th>
                        <th>ArrivalTime</th>
                        <th>Description</th>
                        <th >Status</th>
                        <th >Assigned By</th>
                        <th >action</th>
                     </tr> 
                </thead>
                <tbody>



                    @foreach ($tasks as $task)
                        @if ($task->user_id == auth()->user()->id) 
                            <tr>
                                <td style="margin-top:6px; "  >
                                    @foreach ($products as $product)
                                        @if ($product->id === $task->order->product_id)
                                            {{ $product->title }}
                                        @endif
                                    @endforeach
                                </td>

                                <td style="margin-top:6px; " >
                                    
                                    <p>{{ Carbon::parse($task->supplierOrder->date)->format('d/m/Y') }}</p>
                                    <p>{{ Carbon::parse($task->supplierOrder->time)->format('h:i A') }}</p>
                                
                                </td>
                            
                            
                             
                                                        

                                <td style="margin-top:6px; " >
                                    {{ $task->description }}
                                </td>

                                <td style="margin-top:6px; " >
                                    <span
                                        class="badge {{ $task->status == 'completed' ? 'bg-success' : ($task->status == 'refused' ? 'bg-danger' : 'bg-warning') }}">
                                        {{ ucfirst($task->status) }}
                                    </span>
                                </td>


                                <td style="margin-top:6px; " >


                                    {{ $task->manager_name }}

                                </td>
                                  
                                @php
                             
    $now = Carbon::now();
    $arrivalTime = Carbon::parse($task->supplierOrder->date . ' ' . $task->supplierOrder->time);
    $startAllowed = $arrivalTime->copy()->subHour(); 
    $endAllowed = $arrivalTime->copy()->addHours(2); 
    $withinAllowedTime = $now->between($startAllowed, $endAllowed);
@endphp

 {{-- @if ($task->status === 'completed') --}}

 {{-- <td class="text-center">
        <span class="badge bg-success">completed</span>
    </td>
    <td>
        <span class="text-dark">No Problem</span>
    </td> --}}



    {{-- @elseif ($task->status === 'refused') --}}

 
 {{-- <td class="text-center">
        <span class="text-dark">No proof</span>
    </td> --}}
   
    {{-- <td>
        <span class="badge bg-danger">refused</span>
    </td> --}}


    {{-- @else --}}
    
 {{-- <td class="text-center">
        @if ($withinAllowedTime)
             <form method="POST" action="{{ route('taskDone', $task->id) }}" enctype="multipart/form-data">
                @csrf
                @method('put')
                 <button type="submit" class="btn btn-md " title="Mark as Done">
           <svg xmlns="http://www.w3.org/2000/svg" class=" text-success" width="23"
                                                height="23" fill="currentColor" class="bi bi-bag-check-fill"
                                                viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0m-.646 5.354a.5.5 0 0 0-.708-.708L7.5 10.793 6.354 9.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0z" />
                                            </svg>
                </button>
            </form>
        @else
            <span class="text-muted">
                You can only report a problem<br> one hour  before and two hours<br> after the delivery time.
            </span>
        @endif
    
    </td> --}}

    <td class="action">
        @if ($withinAllowedTime)
 
@if ($task->status === 'completed')  
<span class="text-success ">
    This request is completed 😊
</span>  
@elseif($task->status === 'refused')
<span class="text-danger ">
    Unfortunately, this request was not completed. 😔 
</span>  
@else
             <form method="POST" style="display: ruby" action="{{ route('taskDone', $task->id) }}" enctype="multipart/form-data">
                @csrf
                @method('put')
                 <button type="submit" class="btn" title="Mark as Done">
           <svg xmlns="http://www.w3.org/2000/svg" class=" text-success" width="23"
                                                height="23" fill="currentColor" class="bi bi-bag-check-fill"
                                                viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0m-.646 5.354a.5.5 0 0 0-.708-.708L7.5 10.793 6.354 9.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0z" />
                                            </svg>
                </button>
            </form>
        
 
             <form method="POST"  style="display: ruby ; margin-left:-10px " action="{{ route('submitProblem', $task->id) }}" enctype="multipart/form-data">
                @csrf
                @method('put')
                 <button type="submit" class="btn" title="Report Problem">
                    <svg xmlns="http://www.w3.org/2000/svg" class=" text-danger" width="23"
                    height="23" fill="currentColor" class="bi bi-bag-x-fill"
                    viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0M6.854 8.146a.5.5 0 1 0-.708.708L7.293 10l-1.147 1.146a.5.5 0 0 0 .708.708L8 10.707l1.146 1.147a.5.5 0 0 0 .708-.708L8.707 10l1.147-1.146a.5.5 0 0 0-.708-.708L8 9.293z" />
                </svg>
</button>
            </form>
 

 
            @endif
 
 
            @else
            <span class="text-muted">
                You can only report a problem<br> one hour  before and two hours<br> after the delivery time.
            </span>
        @endif
 
 
    </td>  
  
 
                             

</tr>
@endif
@endforeach

</tbody>
</table>

</div>
  

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        @if (session('success'))
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


    <script>
        @if (session('error'))
            window.onload = function() {
                Swal.fire({
                    icon: "error",
                    title: "Oops🙁...",
                    html: "<span style='font-size: 20px;'>{{ session('error') }}</span>",
                    width: '600px',
                    padding: '2em',
                    confirmButtonText: 'OK'
                });
            }
        @endif
    </script>

@endsection
