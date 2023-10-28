<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class invoices_attchments extends Model
{
  use HasFactory;
  protected $fillable = [
    'id_invoice',
    'name_file',
    'user_add',
  ];

  protected function invoice(): BelongsTo
  {
    return $this->belongsTo(invoices::class, 'id_invoice', 'id');
  }
}