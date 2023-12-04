<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteInformations extends Model
{
    use HasFactory;

    protected $fillable = ['image', 'address','number','gmail','facebook','linkedin','youtube','twitter','fabout'];
}
