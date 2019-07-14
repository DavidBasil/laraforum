<?php

namespace LaraForum;
use LaraForum\User;

/* use Illuminate\Database\Eloquent\Model; */

class Discussion extends Model
{
    public function author(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function replies(){
        return $this->hasMany(Reply::class);
    }

    public function getRouteKeyName(){
        return 'slug';
    }

    public function markAsBestReply(Reply $reply)
    {
        $this->update([
            'reply_id' => $reply->id
        ]);
    }
}
