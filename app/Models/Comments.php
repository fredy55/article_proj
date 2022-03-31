<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table = 'comments';

    protected $primaryKey = 'comment_id';
    
    protected $fillable = [
        'article_id', 'subject','body'
    ];
    
    public $timestamps = true;
}
