<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexBnd350uiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bnd350ui', function (Blueprint $table) {
            $table->index('mid');
            $table->index('mname');
            $table->index('alamat');
            $table->index('account_number');
            $table->index('proc_date');
            $table->index('oo_batch');
            $table->index('batch');
            $table->index('seqnum');
            $table->index('type');
            $table->index('txn_date');
            $table->index('auth');
            $table->index('cardnum');
            $table->index('amount');
            $table->index('rate');
            $table->index('disc_amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bnd350ui', function (Blueprint $table)
        {
            $table->index('mid');
            $table->index('mname');
            $table->index('alamat');
            $table->index('account_number');
            $table->index('proc_date');
            $table->index('oo_batch');
            $table->index('batch');
            $table->index('seqnum');
            $table->index('type');
            $table->index('txn_date');
            $table->index('auth');
            $table->index('cardnum');
            $table->index('amount');
            $table->index('rate');
            $table->index('disc_amount');
        });
    }
}
