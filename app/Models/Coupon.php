<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $fillable = ['code', 'amount', 'expire_date'];
    public function users()
    {
        return $this->belongsToMany(User::class, 'coupon_users')->withTimestamps();
    }
}
