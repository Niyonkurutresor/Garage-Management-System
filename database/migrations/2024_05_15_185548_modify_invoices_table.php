<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('invoices', function (Blueprint $table) {
            
            $table->string('customer_name')->default();
            $table->string('customer_phone')->default();
            $table->string('invoice_number')->default();
        });
    }

    public function down()
    {
        Schema::table('invoices', function (Blueprint $table) {

            $table->dropColumn(['customer_name', 'customer_phone', 'invoice_number']);

        });
    }
};
