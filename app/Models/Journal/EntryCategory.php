<?php

namespace App\Models\Journal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EntryCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'entry_categories';
    
    protected $fillable = [
        'name',
    ];

    public function entries()
    {
        return $this->hasMany(Entry::class);
    }
}
