<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class NewsFeeds extends Authenticatable
{
    protected $fillable = [
        'id','username','descendants','kids','score','time','title','text','type','url'
    ];

    
    protected $table = 'newsfeeds';
}
