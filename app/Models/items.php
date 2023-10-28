<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class items extends Model
{
  use HasFactory;
  protected $fillable = [
    "item_name",
    "section_id",
    "description"
  ];

  public function section(): BelongsTo
  {
    return $this->belongsTo(sections::class);
  }
}