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
    Schema::create('invoices_attchments', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger("id_invoice");
      $table->foreign("id_invoice")->references("id")->on("invoices")->onDelete("cascade");
      $table->string("name_file", 999);
      $table->string("user_add");
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('invoices_attchments');
  }
};