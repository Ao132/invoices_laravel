<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('invoice_number');
            $table->date('invoice_Date');
            $table->date('due_date');
            $table->string('product');
            $table->bigInteger('section_id')->unsigned(); //سيتم حذفه لاحقا
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade'); //سيتم حذفه لاحقا
            $table->decimal('amount_collection', 8, 2,)->nullable(); //سيتم حذفه لاحقا
            $table->decimal('amount_comission', 8, 2,); //سيتم حذفه لاحقا
            $table->decimal('discount', 8, 2,); //سيتم تعديلها ال string
            $table->string('rate_vat');
            $table->decimal('value_vat', 8, 2);
            $table->decimal('Total', 8, 2);
            $table->string('Status', 50);
            $table->integer('value_status');
            $table->text('note')->nullable();
            $table->date('Payment_Date')->nullable();
            $table->string('user');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
