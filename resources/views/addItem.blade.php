@extends('layouts.main')

@section('container')
    <div class="container" style="margin-top: 80px">
        <h1>Add Barang</h1>
        <div class="my-3">
            <form action="/items" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="Name" class="form-label">Item Name</label>
                    <input type="text" class="form-control" id="Name" name="Name" value="{{ old('Name') }}">
                    @error('Name')
                        <p style="color: red;">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="Price" class="form-label">Price</label>
                    <input type="number" class="form-control" id="Price" name="Price"value="{{ old('Price') }}">
                    @error('Price')
                        <p style="color: red;">Price field is required.</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="Quantity" class="form-label">Quantity</label>
                    <input type="number" class="form-control" id="Quantity" aria-describedby="emailHelp" name="Quantity"
                        value="{{ old('Quantity') }}">
                    @error('Quantity')
                        <p style="color: red;">Quantity field is required.</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="Photo" class="form-label">Photo</label>
                    <input type="file" class="form-control" id="Photo" aria-describedby="emailHelp" name="Photo">
                    @error('Photo')
                        <p style="color: red;">Photo field is required.</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label>Category</label><br>
                    @forelse ($categories as $c)
                        <input type="radio" id="{{ $c->id }}" name="CategoryId" value="{{ $c->id }}">
                        <label for="{{ $c->id }}">{{ $c->Name }}</label><br>
                    @empty
                        <p>No category added.</p>
                    @endforelse

                    @error('CategoryId')
                        <p style="color: red;">Choose a category</p>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>

            </form>
        </div>
    </div>
@endsection
