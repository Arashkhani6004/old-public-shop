<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class MigrationController extends Controller
{
    public function create()
    {
        Schema::connection('mysql')->create('baskets', function($table)
        {
            $table->bigIncrements('id');
            $table->intger('user_id')->nullable();
            $table->double('total_prices')->nullable();
            $table->dobule('total_calculated')->nullable();
            $table->double('payment')->nullable();
            $table->double('discount')->nullable();
            $table->double("tax1")->nullable();
            $table->double('tax2')->nullable();
            $table->double('fee')->nullable();
            $table->intger('quantity')->nullable();
            $table->intger('storage_id')->nullable();
            $table->intger('basket_status_id')->nullable();
            $table->intger('bank_id')->nullable();
            $table->intger('transaction_id')->nullable();
            $table->string('ref_id')->nullable();
            $table->string('tracking_code')->nullable();
            $table->timestamp('delivery_time')->nullable();
            $table->intger('delivery_type_id')->nullable();
            $table->timestamp('paid_date')->nullable();
            $table->timestamp('delivery_date')->nullable();
            $table->timestamp('send_date')->nullable();
            $table->
        });
    }
}
