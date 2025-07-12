@extends('layouts.app')

 
@section('content')
<div class="container">

    <div class="row justify-content-center"> 
        <div class="col-md-8">

    <h3 class="mt-4 m-auto text-black-50  bold">Assigned Tasks</h3>

    <table class="table table-dark mt-6">
        <thead>
            <tr>
                <th>Worker</th>
                <th>Task Title</th>
                <th>Status</th>
                <th>Proof</th>
                <th>problem</th>

            </tr>
        </thead>
        <tbody>

            @foreach ($tasks as $task)
                <tr>
                    <td>{{ $task->user->name ?? 'Unknown' }}</td>
                    <td>
                        @foreach ($products as $product)
                        @if ($product->id === $task->order->product_id)
                            {{ $product->title }}
                        @endif
                    @endforeach
                </td>
                    
                    <td>
                        @if ($task->status == 'completed') 
                        <span class="badge {{ $task->status == 'completed' ? 'bg-success' : 'bg-warning' }}">
                            {{ ucfirst($task->status) }}
                        </span>

                       @elseif($task->status == 'refused')
                        <span class="badge {{ $task->status == 'danger' ? 'bg-success' : 'bg-danger' }}">
                            {{ ucfirst($task->status) }}
                        </span>

                        @else
                        <span class="badge {{ $task->status == 'warning' ? 'bg-success' : 'bg-warning' }}">
                            {{ ucfirst($task->status) }}
                        </span>

                 @endif
                    </td>
                    
                    <td>
                        @if ($task->status == 'completed')
                            <a href="{{ asset('storage/' . $task->proof) }}" target="_blank" class="btn btn-info btn-sm">
                                View Proof
                            </a>
                        @else
                            No proof uploaded.
                        @endif
                    </td>
                    <td>
                        @if ($task->status == 'refused')
                            <a href="{{ asset('storage/' . $task->image) }}" target="_blank" class="btn btn-info btn-sm">
                                View problem
                            </a>
                        @else
                            No problem uploaded.
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
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
