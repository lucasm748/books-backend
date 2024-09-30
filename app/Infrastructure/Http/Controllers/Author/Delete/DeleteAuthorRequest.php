<?php

namespace App\Infrastructure\Http\Controllers\Author\Delete;

use App\Infrastructure\Http\Models\BaseRequest;

class DeleteAuthorRequest extends BaseRequest
{
    public function authorize()
    {
        return true;
    }
}