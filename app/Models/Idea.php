<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    use HasFactory;

    protected $with = ['user:id,username,image', 'comments.user:id,username,image']; // Eager loading
    // You could select the especific columns in the table to save even more memory:
    // 'user':id,username'
    // This would be very important on a large scale application

    protected $withCount = ['likes'];

    protected $fillable = ['user_id', 'content'];

    protected $guarded = ['id', 'created_at', 'updated_at'];
    // guarded is infered when using fillable and vice-versa
    // so if you have a Model with dozens of fillable attributes, you can instead set the ones that shouldnt be fillable ($guarded) instead, or vice-versa. 

    // Also, writing $guarded=[] would make it so every field is fillable (unadvised). 


    public function comments()
    {
        return $this->hasMany(Comment::class, 'idea_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'idea_like')->withTimestamps();
    }
}
