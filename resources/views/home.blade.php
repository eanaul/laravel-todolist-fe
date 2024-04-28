@extends('template.navbar')

@section('container')

<form action="{{ route('add') }}" method="GET">
    @csrf
    <button type="submit" class="btn btn-outline-primary mt-5 mb-3">Add ToDo</button>  
</form>

        @if(session('message'))
        <div class="alert alert-danger" role="alert">
            {{ session('message') }}
        </div>
        @endif

    <table class="table mt-3">
        <thead>
            <tr>
                <th>No.</th>
                <th>Action</th>
                <th>Things To Do</th>
                <th>Created at</th>
                <th>Status</th>
            </tr>
        </thead>
        
        <tbody>
        @php
            $id = 1;
        @endphp
        @foreach ($data as $item)
            <tr class="{{ $item['completed'] ? 'table-success' : '' }}">
                <td>@php echo $id; $id++; @endphp</td>
                <td>
                    <a href="{{ route('edit', ['id' => $item['id']]) }}" class="btn btn-success">Edit</a>
                    <form action="{{ route('delete', ['id' => $item['id']]) }}" method="POST" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
                <td>{{ $item['thing_to_do'] }}</td>
                <td>{{ date('l, d F Y', strtotime($item['createdAt'])) }}</td>
                @if ($item['completed'] == false)
                <td style="color: red;">Not completed</td>
                @else
                <td>Finished</td>
                @endif
            </tr> 
        @endforeach
        </tbody>
    </table>
@endsection

