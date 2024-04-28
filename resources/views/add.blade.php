@extends('template.navbar')

@section('container')
    <h1 class="mt-3 mb-4">Add Page</h1>

    @if(isset($message))
    <div class="alert alert-success" role="alert">
        {{ $message }}
    </div>
    @endif
    <form action="{{ route('store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="thing_to_do" class="form-label">Add your activity here</label>
            <textarea class="form-control" id="thing_to_do" name="thing_to_do" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('home') }}" class="btn btn-danger ml-auto">Back to Home</a>

    </form>
@endsection