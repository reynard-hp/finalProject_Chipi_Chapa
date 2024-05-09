@extends('layouts.main')

@section('container')
    <div class="container text-center d-flex flex-column justify-content-center align-items-center border border-dark rounded p-3"
        style="max-width: 800px; margin-top: 100px">
        <div class="img-container">
            @if ($item->Photo)
                <img src="{{ asset('/storage' . '/' . $item->Photo) }}" alt="Foto Item" class="img-fluid rounded"
                    style="height: 400px; width: 300px; object-fit: contain;">
            @else
                <img src="{{ asset('assets/no-photos.png') }}" alt="Foto Item" class="img-fluid rounded"
                    style="height: 400px; width: 300px; object-fit: contain;">
            @endif
        </div>
        <div class="mt-3">
            <h2>{{ $item->Name }}</h2>
            <p>Price : Rp.{{ $item->Price }}</p>
            <p>Jumlah : {{ $item->Quantity }} pc(s)</p>
            <p>Category : {{ $item->category->Name }}</p>
        </div>
        <div class="mt-3">
            <a href="/dashboard" class="btn bg-primary text-white">
                <i class="bi bi-arrow-left-square"></i> Go Back
            </a>
            <a href="/edit-item/{{ $item->id }}" class="btn bg-warning text-white">
                <i class="bi bi-pencil-square"></i> Edit
            </a>
            <form action="/delete-item/{{ $item->id }}" method="POST" class="d-inline">
                @method('delete')
                @csrf
                <button class="btn btn-danger"
                    onclick="return confirm('Are you sure want to delete [{{ $item->name }}] ?')">
                    <i class="bi bi-x-square"></i> Delete
                </button>
            </form>
        </div>
    </div>
@endsection
