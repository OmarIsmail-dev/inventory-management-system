@extends('layouts.app')

 
@section('content')

<div class="container">

    <div class="row justify-content-center"> 
        <div class="col-md-8">

    <div class="card mb-4 mt-4">
        <div class="card-header bg-primary text-white">Assign Task</div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{route("assignTask")}}" method="POST">
                @csrf

 
                <input type="hidden" name="manager_name" value="{{auth()->user()->name}}">


                <div class="form-group">
                    <label for="user_id">Select Worker:</label>
                    <select name="user_id" id="user_id" class="form-control" required>                                       
                        @foreach($workers as $worker)

                        @if ($worker->role == "worker")
                                     
                            <option value="{{ $worker->id }}">{{ $worker->name }}</option>
 
                        @endif
                        @endforeach


                    </select>
                </div>

                <div class="form-group mt-2"> 
                    <label for="supplier_order_id">Select Supplier Order:</label>
<select name="supplier_order_id" class="form-control">
    @foreach($SupplierOrders as $SupplierOrder)
    @if ($SupplierOrder->order && $SupplierOrder->order->product && $SupplierOrder->status != "pending")
        <option value="{{ $SupplierOrder->id }}">
            {{ $SupplierOrder->supplier_name }} - ({{ $SupplierOrder->order->product->title }})
        </option>
    @endif
        @endforeach
</select> 
                </div>

                <div class="form-group mt-2">
                    <label for="title">Task Title:</label> 
                    <select name="order_id" id="title" class="form-control" required>                                       
                        @foreach($orders as $order)                                       
              <option value="{{ $order->id }}">{{ $order->product->title }}</option>  
                         @endforeach 
                    </select>

                </div>
                <div class="form-group mt-2">
                    <label for="description">Task Description:</label>
                    <textarea class="form-control" name="description"></textarea>
                </div>
                <input type="hidden" name="debug_test" value="form_submitted">
                <button type="submit" class="btn btn-success mt-3">Assign Task</button>
            </form>
        </div>
    </div>
    <a href="{{route("Task")}}" class="btn btn-primary mt-3">View Assigned Tasks</a>

 
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

<style>
    div#swal2-html-container {
    font-size: 17px;
}
</style>

@endsection