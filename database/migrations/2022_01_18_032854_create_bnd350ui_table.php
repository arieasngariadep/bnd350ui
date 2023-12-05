<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBnd350uiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bnd350ui', function (Blueprint $table) {
            $table->id();
            $table->string('mid', 9)->nullable();
            $table->string('mname', 50)->nullable();
            $table->string('alamat', 255)->nullable();
            $table->string('account_number', 16)->nullable();
            $table->date('proc_date')->nullable();
            $table->string('oo_batch', 5)->nullable();
            $table->string('batch', 5)->nullable();
            $table->string('seqnum', 3)->nullable();
            $table->string('type', 1)->nullable();
            $table->date('txn_date')->nullable();
            $table->string('auth', 6)->nullable();
            $table->string('cardnum', 20)->nullable();
            $table->string('amount', 14)->nullable();
            $table->string('rate', 11)->nullable();
            $table->string('disc_amount', 13)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bnd350ui');
    }
}
