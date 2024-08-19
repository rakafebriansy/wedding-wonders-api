<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $fillable = ['fullname', 'email', 'phone_number', 'address', 'content', 'isAttending'];
    protected $primaryKey = 'comment_id';
    public function detailComment()
    {
        return $this->hasOne(DetailComment::class, 'comment_id', 'comment_id');
    }
}
