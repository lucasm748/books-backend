<?php

namespace App\Infrastructure\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

class AuthorModel extends Model
{
    protected $table = 'autor';

    protected $primaryKey = 'CodAu';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['CodAu', 'Nome'];

    protected $casts = [
        'CodAu' => 'string',
        'Nome' => 'string',
    ];

    public function getNameAttribute($value)
    {
        return $this->attributes['Nome'];
    }

    public function setNameAttribute($value)
    {
        $this->attributes['Nome'] = $value;
    }

    public function getIdAttribute($value)
    {
        return $this->attributes['CodAu'];
    }

    public function setIdAttribute($value)
    {
        $this->attributes['CodAu'] = $value;
    }
}