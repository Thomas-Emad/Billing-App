<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('invoices', function (Blueprint $table) {
      $table->bigIncrements("id");
      $table->string('invoice_number');
      $table->date('date_invoice');
      $table->date('pay_invoice');
      $table->unsignedBigInteger('section_id');
      $table->foreign('section_id')->references('id')->on("sections")->onDelete("cascade");
      $table->string('product');
      $table->decimal('value_get', 20, 2);
      $table->decimal('value_work', 20, 2);
      $table->decimal('discount', 20, 2);
      $table->string('rate_vat');
      $table->decimal('value_get_vat', 8, 2);
      $table->decimal('total', 8, 2);
      $table->string('status', 50);
      $table->integer('val_status');
      $table->text('note')->nullable();
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
