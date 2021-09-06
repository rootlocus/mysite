<?php

namespace App\Models\Shop;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Address extends Model
{
    use SoftDeletes;
    use HasFactory;
    use Uuid;

    protected $fillable = [
        'uuid',
        'user_id',
        'name',
        'contact_name',
        'contact_phone_no',
        'address_line',
        'postcode',
        'state',
        'country',
        'is_default',
    ];

    protected $appends = [
        'full_address'
    ];

    protected $casts = ['is_default' => 'boolean'];
    
    protected static function booted()
    {
        static::addGlobalScope('user', function (Builder $builder) {
            $builder->where('user_id', Auth::check() ? Auth::user()->id : null);
        });
    }
    
    public function user()
    {
        return $this->belongsTo(User::class)->using(UserAddress::class);
    }

    public function displayAddress()
    {
        $address[] = $this->address_line;
        $address[] = $this->postcode . ', ' . $this->state;
        $address[] = $this->country;

        return $address;
    }

    public function getFullAddressAttribute()
    {
        return $this->displayAddress();
    }
}
