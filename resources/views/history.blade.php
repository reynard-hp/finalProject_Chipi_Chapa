@extends('layouts.main')

@section('container')
    <div class="container" style="margin-top: 80px">
        <h1>History Pembelian</h1>
        <div class="table-responsive col-lg-9 mt-3">
            <table class="table table-striped table-hover mt-3">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Alamat Pengiriman</th>
                        <th scope="col">Tanggal Beli</th>
                        <th scope="col">Total Harga</th>
                        <th scope="col">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($invoices as $invoice)
                        <tr>
                            <td>{{ $invoice->id }}</td>
                            <td>{{ $invoice->address }}</td>
                            <td>{{ $invoice->created_at }}</td>
                            <td>{{ $invoice->total_price }}</td>
                            <td colspan="2">
                                <ul>
                                    @foreach ($invoice->invoiceDetails as $detail)
                                        <li>{{ $detail->item->Name }} - {{ $detail->quantity }} x {{ $detail->item->Price }}
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endsection
