<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoices_dateils extends Model
{
  use HasFactory;
  protected $fillable = [
    'id_invoice',
    'section',
    'product',
    'status',
    'val_status',
    'payment_date',
    'note',
    'user',
  ];
}
