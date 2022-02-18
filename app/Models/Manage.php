<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Form;
use App\Models\User;

class Manage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'form_id',
        'approval',
        'role',
        'reason',
    ];

    public function forms() {
        return $this->hasMany(Form::class);
    }

    public function users() {
        return $this->hasMany(User::class);
    }
}
