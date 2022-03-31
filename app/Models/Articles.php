<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    protected $table = 'articles';

    protected $primaryKey = 'article_id';
    
    protected $fillable = [
        'title', 'full_text','tag'
    ];
    
    public $timestamps = true;
}
