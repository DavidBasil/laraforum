<?php

namespace LaraForum;
use LaraForum\User;

/* use Illuminate\Database\Eloquent\Model; */

class Discussion extends Model
{
    public function author(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getRouteKeyName(){
        return 'slug';
    }
}
