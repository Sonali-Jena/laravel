<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class registrationModel extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $table='registration';
    protected $fillable=[
        'id',
        'name',
        'email',
        'phone',
        'password',
    ];
}
