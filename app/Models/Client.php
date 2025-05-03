<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name',
        'email',
        'cpf_numbers',
        'phone_number',
        'password',
        'address'
    ];
}
