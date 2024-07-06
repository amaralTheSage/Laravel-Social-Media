<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'image',
        'bio',
        'email',
        'password',
    ];

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follower_user', 'user_id', 'follower_id')->withTimestamps();

        // In this case, user_id would be the user's id, while follower_id would be the person thats following the user

    }

    public function followings()
    {
        return $this->belongsToMany(User::class, 'follower_user', 'follower_id', 'user_id')->withTimestamps();
        // In this case, follower_id would be the user's id, while user_id would be the person thats being followed's id
    }

    public function follows(User $user)
    {
        // function to help determine if user is following
        return $this->followings()->where('user_id', $user->id)->exists();
    }

    public function hasLiked(Idea $idea)
    {
        return $this->likes()->where('idea_id', $idea->id)->exists();
    }


    public function likes()
    {
        // Laravel is handling the pivot-key stuff by itself
        return $this->belongsToMany(Idea::class, 'idea_like')->withTimestamps();
    }

    public function getImageURL()
    {
        if ($this->image) {
            return url('storage/' . $this->image);
        }

        return "https://api.dicebear.com/6.x/fun-emoji/svg?seed={$this->username}";
    }

    public function ideas()
    {
        return $this->hasMany(Idea::class, 'user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
