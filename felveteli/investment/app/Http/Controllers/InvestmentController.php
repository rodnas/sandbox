<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use Illuminate\Http\Request;

class InvestmentController extends Controller
{
	/**
	* Display a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function index(Request $request)
	{
	        //
		if (ISSET($request["searchfields"]) && !is_null($request["searchfields"])) {
			$investments = Investment::where([
				['name', '!=', Null],
				['investment', '!=', Null],
// date type				['transaction_at', '!=', Null],
				['amount', '!=', Null],
				['currency', '!=', Null],
				['exchange', '!=', Null],
				['quantity', '!=', Null],
				['planned', '!=', Null],
				['term', '!=', Null],
				[function ($query) use ($request) {
					if (($name = $request->name)) {
						$query->orWhere('name', 'LIKE', '%' .$name.'%')->get();
					}
					if (($investment = $request->investment)) {
						$query->orWhere('investment', 'LIKE', '%' .$investment.'%')->get();
					}
					if (($amount = $request->amount)) {
						$query->orWhere('amount', 'LIKE', '%' .$amount.'%')->get();
					}
					if (($currency = $request->currency)) {
						$query->orWhere('currency', 'LIKE', '%' .$currency.'%')->get();
					}
					if (($exchange = $request->exchange)) {
						$query->orWhere('exchange', 'LIKE', '%' .$exchange.'%')->get();
					}
					if (($quantity = $request->quantity)) {
						$query->orWhere('quantity', 'LIKE', '%' .$quantity.'%')->get();
					}
					if (($planned = $request->planned)) {
						$query->orWhere('planned', 'LIKE', '%' .$planned.'%')->get();
					}
					if (($term = $request->term)) {
						$query->orWhere('term', 'LIKE', '%' .$term.'%')->get();
					}
				}]
			])
			->orderBy("id","desc")
			->paginate(5);

			$sumData = Investment::select( \DB::raw("sum(amount) as amount"), \DB::raw("sum(exchange) as exchange"))->where([
				['name', '!=', Null],
				['investment', '!=', Null],
// date type				['transaction_at', '!=', Null],
				['amount', '!=', Null],
				['currency', '!=', Null],
				['exchange', '!=', Null],
				['quantity', '!=', Null],
				['planned', '!=', Null],
				['term', '!=', Null],
				[function ($query) use ($request) {
					if (($name = $request->name)) {
						$query->orWhere('name', 'LIKE', '%' .$name.'%')->get();
					}
					if (($investment = $request->investment)) {
						$query->orWhere('investment', 'LIKE', '%' .$investment.'%')->get();
					}
					if (($amount = $request->amount)) {
						$query->orWhere('amount', 'LIKE', '%' .$amount.'%')->get();
					}
					if (($currency = $request->currency)) {
						$query->orWhere('currency', 'LIKE', '%' .$currency.'%')->get();
					}
					if (($exchange = $request->exchange)) {
						$query->orWhere('exchange', 'LIKE', '%' .$exchange.'%')->get();
					}
					if (($quantity = $request->quantity)) {
						$query->orWhere('quantity', 'LIKE', '%' .$quantity.'%')->get();
					}
					if (($planned = $request->planned)) {
						$query->orWhere('planned', 'LIKE', '%' .$planned.'%')->get();
					}
					if (($term = $request->term)) {
						$query->orWhere('term', 'LIKE', '%' .$term.'%')->get();
					}
				}]
			])->get();

		} elseif (ISSET($request["searchterm"]) && !is_null($request["searchterm"])) {

			$investments = Investment::where([
				['name', '!=', Null],
				['investment', '!=', Null],
				[function ($query) use ($request) {
					if (($searchterm = $request->searchterm)) {
						$query->orWhere('name', 'LIKE', '%' .$searchterm.'%')->get();
						$query->orWhere('investment', 'LIKE', '%' .$searchterm.'%')->get();
					}
				}]
			])
			->orderBy("id","desc")
			->paginate(5);

			$sumData = Investment::select( \DB::raw("sum(amount) as amount"), \DB::raw("sum(exchange) as exchange"))->where([
				['name', '!=', Null],
				['investment', '!=', Null],
				[function ($query) use ($request) {
					if (($searchterm = $request->searchterm)) {
						$query->orWhere('name', 'LIKE', '%' .$searchterm.'%')->get();
						$query->orWhere('investment', 'LIKE', '%' .$searchterm.'%')->get();
					}
				}]
			])->get();
		} else {
		
			$investments = Investment::latest()->paginate(5);
			$sumData = Investment::select( \DB::raw("sum(amount) as amount"), \DB::raw("sum(exchange) as exchange"))->get();
		}
		return view('investments.index', compact('investments','sumData'))->with('i', (request()->input('page', 1) - 1) * 5);

	}

	/**
	* Show the form for creating a new resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function create()
	{
		//
		return view('investments.create');
	}
	
	/**
	* Store a newly created resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @return \Illuminate\Http\Response
	*/
	public function store(Request $request)
	{
		//
		
		$request->validate([
			'name' => 'required',
			'investment' => 'required',
			'transaction_at' => 'required',
			'amount' => 'required',
			'currency' => 'required',
			'quantity' => 'required',
			'planned' => 'required',
			'term' => 'required'
		]);
		                        
		Investment::create($request->all());
        
		return redirect()->route('investments.index')->with('success', 'Investment created successfully.');

	}
	
	/**
	* Display the specified resource.
	*
	* @param  \App\Models\Investment  $investment
	* @return \Illuminate\Http\Response
	*/
	public function show(Investment $investment)
	{
		//
		return view('investments.show', compact('investment'));
	}

	/**
	* Show the form for editing the specified resource.
	*
	* @param  \App\Models\Investment  $investment
	* @return \Illuminate\Http\Response
	*/
	public function edit(Investment $investment)
	{
		//
		return view('investments.edit', compact('investment'));
	}

	/**
	* Update the specified resource in storage.
	*
	* @param  \Illuminate\Http\Request  $request
	* @param  \App\Models\Investment  $investment
	* @return \Illuminate\Http\Response
	*/
	public function update(Request $request, Investment $investment)
	{
		//
		$request->validate([
			'name' => 'required',
			'investment' => 'required',
			'transaction_at' => 'required',
			'amount' => 'required',
			'currency' => 'required',
			'quantity' => 'required',
			'planned' => 'required',
			'term' => 'required'
		]);
		$investment->update($request->all());
	
		return redirect()->route('investments.index')->with('success', 'Investment updated successfully');
	}

	/**
	* Remove the specified resource from storage.
	*
	* @param  \App\Models\Investment  $investment
	* @return \Illuminate\Http\Response
	*/
	public function destroy(Investment $investment)
	{
		//
		$investment->delete();

		return redirect()->route('investments.index')->with('success', 'Investment deleted successfully');
	}
}
