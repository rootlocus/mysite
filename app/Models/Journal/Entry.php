<?php

namespace App\Models\Journal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entry extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'entry_categories_id',
        'content',
    ];

    public function category()
    {
        return $this->belongsTo(EntryCategory::class);
    }
}
