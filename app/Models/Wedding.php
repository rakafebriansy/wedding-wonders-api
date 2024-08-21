<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wedding extends Model
{
    use HasFactory;

    protected $fillable = [
        'groom_name',
        'groom_father_name',
        'groom_mother_name',
        'bride_name',
        'bride_father_name',
        'bride_mother_name',
        'ceremony_time',
        'ceremony_date',
        'ceremony_location',
        'ceremony_coordinates',
        'reception_time',
        'reception_date',
        'reception_location',
        'reception_coordinates',
        'user_id',
        'story',
        'template'
    ];
    protected $primaryKey = 'wedding_id';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
