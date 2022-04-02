<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comments extends Model
{
    use HasFactory;
    
    protected $table = 'comments';

    protected $primaryKey = 'comment_id';
    
    protected $fillable = [
        'article_id', 'subject','body'
    ];

    public function articles(){
        return $this->belongsToOne(Articles::class);
    }
    
    public $timestamps = true;
}
