<?php

namespace App\Infrastructure\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

class AuthorModel extends Model
{
    protected $table = 'Autor';

    protected $primaryKey = 'CodAu';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['CodAu', 'Nome'];

    protected $casts = [
        'CodAu' => 'string',
        'Nome' => 'string',
    ];

    public function getNameAttribute()
    {
        return $this->attributes['Nome'];
    }

    public function setNameAttribute($value)
    {
        $this->attributes['Nome'] = $value;
    }

    public function getIdAttribute()
    {
        return $this->attributes['CodAu'];
    }

    public function setIdAttribute($value)
    {
        $this->attributes['CodAu'] = $value;
    }
}