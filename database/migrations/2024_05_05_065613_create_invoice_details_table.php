<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_details', function (Blueprint $table) {
            $table->foreignId('InvoiceId')->references('id')->on('invoices')->cascadeOnDelete();
            $table->foreignId('ItemId')->references('id')->on('items')->cascadeOnDelete();
            $table->integer('quantity');
            $table->timestamps();

            $table->primary(['InvoiceId', 'ItemId']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_details');
    }
};
