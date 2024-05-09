@extends('layouts.main')

@section('container')
    <div class="container" style="margin-top: 100px">
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <h1>Dashboard</h1>
        <a href="/add-item" type="button" class="btn btn-primary" style="width: 120px">
            Add Item
        </a>
        <a href="/add-category" type="button" class="btn btn-secondary">
            Add Category
        </a>

        <div class="table-responsive col-lg-8 mt-3">
            <table class="table table-striped table-hover mt-3">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Harga</th>
                        <th scope="col">Jumlah</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->Name }}</td>
                            <td>{{ $item->Price }}</td>
                            <td>{{ $item->Quantity }}</td>
                            <td>{{ $item->category->Name }}</td>
                            <td>
                                <a href="/dashboard/items/{{ $item->id }}" class="badge bg-primary">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                <a href="/edit-item/{{ $item->id }}" class="badge bg-warning">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <form action="/delete-item/{{ $item->id }}" method="POST" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button class="badge bg-danger border-0"
                                        onclick="return confirm('Are you sure want to delete [{{ $item->Name }}] ?')">
                                        <i class="bi bi-x-square"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
