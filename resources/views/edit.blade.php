@extends('template.navbar')

@section('container')
    <h1 class="mt-3 mb-4">Edit thing</h1>

    @if(session('message'))
        <div class="alert alert-success" role="alert">
            {{ session('message') }}
        </div>
    @endif
    <form action="{{ route('update', ['id' => $data[0]->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="thing_to_do" class="form-label">Edit your activity</label>
            <textarea class="form-control" id="thing_to_do" name="thing_to_do" rows="3">{{ $data[0]->thing_to_do }}</textarea>
        </div>
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" value="true" id="flexCheckDefault" name="completed" {{ $data[0]->completed ? 'checked' : '' }}>
            <label class="form-check-label" for="flexCheckDefault">
              Completed? Check here!
            </label>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('home') }}" class="btn btn-danger ml-auto">Back to Home</a>
    </form>
@endsection
