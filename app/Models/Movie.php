<?php

namespace App\Models;

use App\Models\Actor;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'logo', 'trailer', 'release_date', 'production_date', 'rating'];

    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orwhereHas('actors', function ($q) {
                    $q->where('first_name', 'like', '%' . request('search') . '%');
                })
                ->orwhereHas('actors', function ($q) {
                    $q->where('last_name', 'like', '%' . request('search') . '%');
                });
        }
    }

    public function actors()
    {
        return $this->belongsToMany(Actor::class, 'movie_actor')->withPivot('character_name');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'movie_category');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_movie');
    }
}
