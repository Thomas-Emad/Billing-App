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
    Schema::create('invoices_dateils', function (Blueprint $table) {
      $table->increments("id");
      $table->unsignedBigInteger('id_invoice');
      $table->foreign("id_invoice")->references("id")->on("invoices")->onDelete("cascade");
      $table->string('section');
      $table->string('product');
      $table->string('status', 50);
      $table->integer('val_status');
      $table->text('note')->nullable();
      $table->string('user');
      $table->date("payment_date")->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('invoices_dateils');
  }
};
