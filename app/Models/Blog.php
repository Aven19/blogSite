<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'route',
        'description',
        'file',
        'created_by'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [];

    public function scopeSearchByRouteName($query, $searchParam, $blogId = null)
    {
        if (!is_null($blogId)) {
            return  $query->where("id", '=', "$blogId");
        }

        if (!is_null($searchParam)) {
            return  $query->where("title", "like", "%$searchParam%");
        }

        return $query;
    }

    /**
     * Get the author that owns the blog.
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
    
}
