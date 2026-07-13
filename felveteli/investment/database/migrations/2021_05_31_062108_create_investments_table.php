<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestmentsTable extends Migration
{
	/**
	* Run the migrations.
	*
	* @return void
	*/
	public function up()
	{
		Schema::create('investments', function (Blueprint $table) {
			$table->id();
			$table->string('name', 255);
			$table->string('investment', 20);
			$table->timestamp('transaction_at');
			$table->decimal('amount', 22);
			$table->string('currency', 3);
			$table->float('exchange', 22,8)->nullable()->default(0.00);
			$table->float('quantity', 22,8);
			$table->float('planned', 22,2);
			$table->integer('term')->length(4);
			$table->timestamp('created_at')->useCurrent();
			$table->timestamp('updated_at')->nullable();
		});
	}
	
	/**
	* Reverse the migrations.
	*
	* @return void
	*/
	public function down()
	{
		Schema::dropIfExists('investments');
	}
}
