<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\MpesaTransaction;

class CreateMpesaTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mpesa_transaction', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('order_id')->index()->unsigned();
            $table->tinyInteger('status')->default(MpesaTransaction::STATUS_PENDING);
            $table->string('transaction_number');
            $table->string('transaction_time');
            $table->float('amount');
            $table->string('short_code');
            $table->string('bill_reference');
            $table->string('mobile_number');
            $table->string('payer_first_name')->nullable();
            $table->string('payer_middle_name')->nullable();
            $table->string('payer_last_name')->nullable();
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mpesa_transaction');
    }
}
