@extends('layouts.main')

@section('container')
    <div class="container" style="margin-top: 80px">
        <h1>List Barang</h1>
        @if (session()->has('success'))
            <div class="alert alert-success col-lg-8 mt-3">
                {{ session('success') }}
            </div>
        @endif
        @forelse ($categories as $c)
            <h2>{{ $c->Name }}</h2>
            @php $hasItems = false; @endphp <!-- Add a flag to check if there are items in the category -->
            <div class="row">
                @foreach ($items as $item)
                    @if ($c->id != $item->CategoryId)
                        @continue
                    @endif
                    @php $hasItems = true; @endphp <!-- Set the flag to true if there are items -->

                    <div class="col-lg-4 col-md-6 my-3">
                        <div class="card d-flex justify-content-center" style="max-width: 20rem">
                            @if ($item->Photo)
                                <img src="{{ asset('/storage' . '/' . $item->Photo) }}" alt="Foto Barang"
                                    class="img-fluid rounded" style="max-height: 230px; object-fit: contain;">
                            @else
                                <img src="{{ asset('assets/no-photos.png') }}" alt="No Photo." class="img-fluid rounded-top"
                                    style="max-height: 230px; object-fit: contain;">
                            @endif
                            {{-- category anchor --}}
                            <div class="text-center bg-secondary bg-opacity-50 w-25 rounded mx-auto mt-2 pt-2">
                                <p><strong>{{ $item->category->Name }}</strong></p>
                            </div>
                            {{-- content --}}
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ $item->Name }}</h5>
                                <p><em>Price: Rp{{ $item->Price }} </em></p>
                                <p>Qty Available: {{ $item->Quantity }}</p>
                                @if (auth()->check() && auth()->user()->role === 'user')
                                    <form action="/add-to-invoice/{{ $item->id }}" method="POST">
                                        @method('POST')
                                        @csrf
                                        @if (in_array($item->id, $existingItemIds))
                                            <button class="btn btn-success" disabled>
                                                Already Added
                                            </button>
                                        @else
                                            <button class="btn btn-primary">
                                                <i class="fa-solid fa-cart-plus"></i> Buy
                                            </button>
                                        @endif
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
                @if (!$hasItems)
                    <p>No items.</p>
                @endif
            @empty
                <p>No category added.</p>
            </div>
        @endforelse
    </div>
@endsection
