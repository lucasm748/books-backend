<?php

namespace App\Infrastructure\Eloquent\Models;

use Illuminate\Database\Eloquent\Model;

class BookModel extends Model
{
    protected $table = 'Livro';

    protected $primaryKey = 'Codl';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'Codl',
        'Titulo',
        'Editora',
        'Edicao',
        'AnoPublicacao',
        'Preco'
    ];

    protected $casts = [
        'Codl' => 'string',
        'Titulo' => 'string',
        'Editora' => 'string',
        'Edicao' => 'integer',
        'AnoPublicacao' => 'integer',
        'Preco' => 'float'
    ];

    public function getTitleAttribute()
    {
        return $this->attributes['Titulo'];
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['Titulo'] = $value;
    }

    public function getIdAttribute()
    {
        return $this->attributes['Codl'];
    }

    public function setIdAttribute($value)
    {
        $this->attributes['Codl'] = $value;
    }

    public function getPublisherAttribute()
    {
        return $this->attributes['Editora'];
    }

    public function setPublisherAttribute($value)
    {
        $this->attributes['Editora'] = $value;
    }

    public function getEditionAttribute()
    {
        return $this->attributes['Edicao'];
    }

    public function setEditionAttribute($value)
    {
        $this->attributes['Edicao'] = $value;
    }

    public function getPublicationYearAttribute()
    {
        return $this->attributes['AnoPublicacao'];
    }

    public function setPublicationYearAttribute($value)
    {
        $this->attributes['AnoPublicacao'] = $value;
    }

    public function getPriceAttribute()
    {
        return $this->attributes['Preco'];
    }

    public function setPriceAttribute($value)
    {
        $this->attributes['Preco'] = $value;
    }

    public function authors()
    {
        return $this->belongsToMany(
            AuthorModel::class,
            'Livro_Autor',
            'Livro_Codl',
            'Autor_CodAu'
        )
            ->withTimestamps();
    }

    public function subjects()
    {
        return $this->belongsToMany(
            SubjectModel::class,
            'Livro_Assunto',
            'Livro_Codl',
            'Assunto_CodAs'
        )
            ->withTimestamps();
    }
}