@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel 8 Investment </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('investments.create')}}" title="Create a investment"> <i class="fas fa-plus-circle"></i>
                    </a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ session()->get('success') }}</p>
        </div>
    @endif

    <table class="table table-bordered table-responsive-lg">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>investment</th>
            <th>Transaction</th>
            <th>Amount</th>
            <th>Currency</th>
            <th>Exchange</th>
            <th>Quantity</th>
            <th>Planned</th>
            <th>Term</th>
            <th>Date Created</th>
            <th>Actions</th>
        </tr>
        @foreach ($investments as $investment)
            <tr>
                <td>{{$investment->id}}</td>
                <td>{{$investment->name}}</td>
                <td>{{$investment->investment}}</td>
                <td>{{$investment->transaction_at}}</td>
                <td>{{$investment->amount}}</td>
                <td>{{$investment->currency}}</td>
                <td>{{$investment->exchange}}</td>
                <td>{{$investment->quantity}}</td>
                <td>{{$investment->planned}}</td>
                <td>{{$investment->term}}</td>
                <td>{{$investment->created_at}}</td>
                <td>
                    <form action="{{ route('investments.destroy', $investment->id)}}" method="POST">

                        <a href="{{ route('investments.show',$investment->id)}}" title="show">
                            <i class="fas fa-eye text-success  fa-lg"></i>
                        </a>

                        <a href="{{ route('investments.edit',$investment->id)}}">
                            <i class="fas fa-edit  fa-lg"></i>
                        </a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" title="delete" style="border: none; background-color:transparent;">
                            <i class="fas fa-trash fa-lg text-danger"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>



    
    {!! $investments->links() !!}

@endsection