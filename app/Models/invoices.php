<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class invoices extends Model
{
  use HasFactory;
  use SoftDeletes;
  protected $fillable = [
    "invoice_number",
    "date_invoice",
    "pay_invoice",
    "section_id",
    "product",
    "value_get",
    "value_work",
    "discount",
    "value_get_vat",
    "rate_vat",
    "value_vat",
    "total",
    "val_status",
    "status",
    "user",
    "note",
  ];

  protected function section(): BelongsTo
  {
    return $this->belongsTo(sections::class);
  }
}
