@extends('layouts.main')

@section('container')
    <div class="container" style="margin-top: 80px">
        @if ($errors->has('out_of_stock'))
            <div class="alert alert-danger">
                {{ $errors->first('out_of_stock') }}
            </div>
        @endif
        @if (session()->has('success'))
            <div class="alert alert-success col-lg-8">
                {{ session('success') }}
            </div>
        @endif
        <h1>Faktur</h1>
        <div class="my-3">
            <h5>Daftar Barang</h5>
            @error('quantities')
                <p style="color: red;">{{ $message }}</p>
            @enderror
            <div class="table-responsive mt-3">
                <table class="table">
                    <thead class="table-info">
                        <tr>
                            <th>Kategori</th>
                            <th>Nama Barang</th>
                            <th>Kuantitas</th>
                            <th>Subtotal Harga</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalPrice = 0;
                        @endphp
                        @forelse ($invoiceItems as $item)
                            <tr>
                                <td>{{ $item->category->Name }}</td>
                                <td>{{ $item->Name }}</td>
                                <td>
                                    <form action="/update-quantity/{{ $item->id }}" method="POST">
                                        @csrf
                                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1"
                                            onchange="this.form.submit()">
                                    </form>
                                </td>
                                <td>Rp<span id="subtotal_{{ $item->id }}">{{ $item->Price * $item->quantity }}</span>
                                </td>
                                <td>
                                    <form action="/delete-item/{{ $item->id }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @php
                                $totalPrice += $item->Price * $item->quantity;
                            @endphp
                        @empty
                            <tr>
                                <td colspan="4">No Item</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <h5>Total Harga</h5>
            <p id="totalPrice">Rp{{ $totalPrice }}</p>
            <form action="/create-invoice" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="address" class="form-label">Alamat Pengiriman</label>
                    <textarea class="form-control" id="address" name="address" rows="4">{{ old('address') }}</textarea>
                    @error('address')
                        <p style="color: red;">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="postal_code" class="form-label">Kode Pos</label>
                    <input type="text" class="form-control" id="postal_code" name="postal_code"
                        value="{{ old('postal_code') }}">
                    @error('postal_code')
                        <p style="color: red;">{{ $message }}</p>
                    @enderror
                </div>
                {{-- field untuk menyimpan kuantitas --}}
                @foreach ($invoiceItems as $itemId => $item)
                    <input type="hidden" name="quantities[{{ $itemId }}]" value="{{ $item['quantity'] }}">
                @endforeach

                {{-- field untuk menyimpan item --}}
                {{-- @foreach ($invoiceItems as $item)
                    <input type="hidden" name="items[]" value="{{ $item->id }}">
                @endforeach --}}
                <input type="hidden" name="UserId" value="{{ $user->id }}">
                <button type="submit" class="btn btn-primary mt-3">Simpan Faktur</button>
            </form>
        </div>
    </div>

    {{-- <script>
        function updateSubtotal(input, price, itemId) {
            var subtotal = input.value * price;
            document.getElementById('subtotal_' + itemId).innerText = 'Rp' + subtotal;
            updateTotalPrice();
        }

        function updateTotalPrice() {
            var total = 0;
            var subtotals = document.querySelectorAll('[id^="subtotal_"]');
            subtotals.forEach(function(subtotal) {
                var subtotalValue = parseInt(subtotal.innerText.replace('Rp', ''), 10);
                total += subtotalValue;
            });
            document.getElementById('totalPrice').innerText = 'Rp' + total;
        }
    </script> --}}
@endsection
