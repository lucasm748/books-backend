<?php

namespace App\Infrastructure\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectModel extends Model
{
    protected $table = 'Assunto';

    protected $primaryKey = 'CodAs';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['CodAs', 'Descricao'];

    protected $casts = [
        'CodAs' => 'string',
        'Descricao' => 'string',
    ];

    public function getDescriptionAttribute()
    {
        return $this->attributes['Descricao'];
    }

    public function setDescriptionAttribute($value)
    {
        $this->attributes['Descricao'] = $value;
    }

    public function getIdAttribute()
    {
        return $this->attributes['CodAs'];
    }

    public function setIdAttribute($value)
    {
        $this->attributes['CodAs'] = $value;
    }
}