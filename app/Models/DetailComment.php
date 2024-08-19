<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailComment extends Model
{
    use HasFactory;
    protected $table = 'detail_comments';
    protected $fillable = ['wedding_id', 'comment_id'];
    protected $primaryKey = 'detail_comment_id';
    public function comment()
    {
        return $this->belongsTo(Comment::class, 'comment_id', 'comment_id');
    }

    public function wedding()
    {
        return $this->belongsTo(Wedding::class, 'wedding_id', 'wedding_id');
    }
}
