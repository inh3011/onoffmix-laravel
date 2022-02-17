<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class Meet extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'view',
        'user_id',
    ];

    public function user()
    {
        return $this->belongTo(User::class);
    }

    // public function user() {

    // }
}
