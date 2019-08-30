<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['title', 'body', 'user_id'];

    protected $table = 'articles';

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public static function archives()
    {
        return static::selectRaw("extract(year from created_at) as year, to_char(min(created_at), 'month') as monthname, extract(month from created_at) as month, count(*) as published")
            ->groupBy('year', 'month')
            ->orderByRaw('min(created_at) desc')
            ->get()
            ->toArray();
    }

    /*public function scopeFilter($query, $filters)
    {
        if($month = $filters['month'])
        {
            $query->whereMonth('created_at', $month);
        }

        if($year = $filters['year'])
        {
            $query->whereYear('created_at', $year);
        }
    }*/
}
