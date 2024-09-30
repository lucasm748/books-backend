<?php

namespace App\Infrastructure\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

class AuthorModel extends Model
{
    protected $table = 'authors';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'name'];

    protected $casts = [
        'id' => 'string',
        'name' => 'string',
    ];
}