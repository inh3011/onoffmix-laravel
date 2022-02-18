<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Meet;
use App\Models\Manage;

class Form extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'total',
        'addmission',
        'meet_start',
        'meet_end',
        'apply_start',
        'apply_end',
        'meet_id',
    ];

    public function meet() {
        return $this->belongTo(Meet::class);
    }

    public function manage() {
        return $this->belongTo(\App\Models\User::class);
    }
}
