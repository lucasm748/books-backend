<?php

namespace App\Infrastructure\Eloquent\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BooksReportModelView extends Model
{
    use HasFactory;
    protected $table = 'books_by_author';
}