<?php

namespace App\Infrastructure\Http\Controllers\Book\Delete;

use App\Infrastructure\Http\Models\BaseRequest;

class DeleteBookRequest extends BaseRequest
{
    public function authorize()
    {
        return true;
    }
}