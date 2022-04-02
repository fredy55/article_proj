<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Articles extends Model
{
    use HasFactory;
    
    protected $table = 'articles';

    protected $primaryKey = 'article_id';
    
    protected $fillable = [
        'title', 'full_text','tag'
    ];

    public function comment(){
        return $this->hasMany(Comments::class, 'article_id');
    }
    
    public $timestamps = true;
}
