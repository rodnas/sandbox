<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
	
	use HasFactory;

	protected $table = 'investments';
	public $timestamps = true;


	protected $casts = [
		'exchange' => 'float',
		'quantity' => 'float',
		'planned' => 'float'
	];
	
	protected $fillable = [
		'name',
		'investment',
		'transaction_at',
		'amount',
		'currency',
		'exchange',
		'exchange',
		'quantity',
		'planned',
		'term',
		'created_at'
	];

}
