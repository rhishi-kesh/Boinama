<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $fillable = ['name','price','discount','quantity','writer_id','subject_id','user_id','prakasani_id','image','preview','status'];

    public function users_id()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function subjects_id()
    {
        return $this->belongsTo(Subjects::class, 'subject_id', 'id');
    }
    public function prakasanis_id()
    {
        return $this->belongsTo(Prakasanis::class, 'prakasani_id', 'id');
    }
    public function writers_id()
    {
        return $this->belongsTo(Writers::class, 'writer_id', 'id');
    }
    public function scopeSearch($query, $value){
        $query->where('name', 'like', "%$value%");
    }
}
