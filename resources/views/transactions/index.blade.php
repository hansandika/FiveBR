@extends('layouts.app',['title' => 'Transaction'])
@section('content')
    <div class="container py-5">
        <table class="table table-striped table-hover table-borderless">
            <thead>
                <tr>
                    <th scope="col">Seller Name</th>
                    <th scope="col">Gig Title</th>
                    <th scope="col">Type</th>
                    <th scope="col">Price</th>
                    <th scope="col">Transaction Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->seller->name }}</td>
                        <td>{{ Str::limit($transaction->gig->title, 26) }}</td>
                        <td>{{ ucfirst($transaction->type) }}</td>
                        <td>${{ $transaction->price }}</td>
                        <td>{{ $transaction->transaction_date->toDayDateTimeString() }}</td>
                        <td><a href="{{ route('show-gig', $transaction->gig->id) }}"
                                class="btn btn-info text-light">View</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $transactions->links() }}
    </div>
@endsection
