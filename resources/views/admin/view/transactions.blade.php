@extends('admin.panel')

@section('content')
    <h2>Daftar Transaksi</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>User ID</th>
                <th>Amount Product</th>
                <th>Total Price</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($trans as $tran)
                <tr>
                    <td>{{ $tran->id }}</td>
                    <!-- Access the user information through the relationship -->
                    <td>{{ $tran->user->last_name . ' ' . $tran->user->first_name }}</td>
                    <td>{{ $tran->user->email }}</td>
                    <td>{{ $tran->user_id }}</td>
                    <td>{{ $tran->amount_product }}</td>
                    <td>{{ $tran->total_price }}</td>
                    <td>{{ $tran->created_at }}</td>
                    <td>{{ $tran->updated_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
