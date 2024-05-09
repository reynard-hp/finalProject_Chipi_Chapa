@extends('layouts.main')

@section('container')
    <div class="container" style="margin-top: 80px">
        <h1>Add Category</h1>
        <form action="/categories" method="POST">
            @csrf
            <div class="mb-5">
                <label for="Name" class="form-label">Category Name</label>
                <input type="text" class="form-control" id="Name" aria-describedby="emailHelp" name="Name"
                    value="{{ old('Name') }}">
                @error('Name')
                    <p style="color: red;">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
