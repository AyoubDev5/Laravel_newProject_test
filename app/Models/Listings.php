<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listings extends Model
{
    use HasFactory;

    // protected $fillable = ['title', 'company', 'location', 'website', 'email', 'description', 'tags'];

    public function scopeFilter($query, array $filter){

        if($filter['tag'] ?? false)
            $query->where('tags','like','%'.request('tag').'%');

        if($filter['search'] ?? false)
            $query->where('title','like','%'.request('search').'%')
            ->orWhere('description','like','%'.request('search').'%')
            ->orWhere('tags','like','%'.request('tag').'%');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
