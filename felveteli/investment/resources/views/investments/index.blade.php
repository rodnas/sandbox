@extends('layouts.app')

@section('content')
<div>
        <div class="mx-auto pull-right">
                <form action="{{ route('investments.index') }}" method="GET" role="search">

                    <div class="input-group">
	<table><tr>
		<td>
                        <span class="input-group-btn mr-5 mt-1">
                            <button class="btn btn-info" type="submit" title="Search investment" name="search" value="search">
                                <span class="fas fa-search"></span>
                            </button>
                        </span>
		</td><td>
                        <input type="text" class="form-control mr-2" name="searchterm" placeholder="Search investment" id="searchterm" value="{{ request()->has('searchterm') ? request()->get('searchterm') : '' }}">
		</td><td>
                        <a href="{{ route('investments.index') }}" class=" mt-1">
                            <span class="input-group-btn">
                                <button class="btn btn-danger" type="button" title="Refresh page">
                                    <span class="fas fa-sync-alt"></span>
                                </button>
                            </span>
                        </a>
		</td></tr></table>
                    </div>
                </form>
        </div>
</div>    
<div>
    <div class="row">
                <form action="{{ route('investments.index') }}" method="GET" role="searchfields">
	<table>
		<tr>
			<td>Name:</td><td> <input type="text" class="form-control mr-2" name="name" placeholder="Search Name" id="name" value="{{ request()->has('name') ? request()->get('name') : '' }}"></td>
			<td>Investment:</td><td> <input type="text" class="form-control mr-2" name="investment" placeholder="Search Investment" id="investment" value="{{ request()->has('investment') ? request()->get('investment') : '' }}"></td>
		</tr>
		<tr>
			<td>Amount:</td><td> <input type="text" class="form-control mr-2" name="amount" placeholder="Search Amount" id="amount" value="{{ request()->has('amount') ? request()->get('amount') : '' }}"></td>
			<td>Currancy:</td><td> <input type="text" class="form-control mr-2" name="currency" placeholder="Search Currency" id="currency" value="{{ request()->has('currency') ? request()->get('currency') : '' }}"></td>
		</tr>
		<tr>
			<td>Exchange:</td><td> <input type="text" class="form-control mr-2" name="exchange" placeholder="Search Exchange" id="exchange" value="{{ request()->has('exchange') ? request()->get('exchange') : '' }}"></td>
			<td>Quantity:</td><td> <input type="text" class="form-control mr-2" name="quantity" placeholder="Search Quantity" id="quantity" value="{{ request()->has('quanity') ? request()->get('quantity') : '' }}"></td>
		</tr>
		<tr>
			<td>Planned:</td><td> <input type="text" class="form-control mr-2" name="planned" placeholder="Search Planned" id="planned" value="{{ request()->has('planned') ? request()->get('planned') : '' }}"></td>
			<td>Term:</td><td> <input type="text" class="form-control mr-2" name="term" placeholder="Search Term" id="term" value="{{ request()->has('term') ? request()->get('term') : '' }}"></td>
		</tr>
		<tr>
			<td>
	                <button type="submit" class="btn btn-primary" name="searchfields" value="searchfileds">Search fields</button>
			</td>
		</tr>
		
	</table>
		</form>
    </div>	
</div>
<div>
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel 8 Investment </h2>
            </div>
            <div class="mx-auto pull-right">
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
            <th>Toral Amount</th>
            <th>Total Exchange</th>
        </tr>
        @foreach ($sumData as $sumDataAct)
            <tr>
                <td>{{$sumDataAct->amount}}</td>
                <td>{{$sumDataAct->exchange}}</td>
	    </tr>
        @endforeach
    </table>	    
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