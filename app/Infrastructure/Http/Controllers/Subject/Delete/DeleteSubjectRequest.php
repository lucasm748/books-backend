<?php

namespace App\Infrastructure\Http\Controllers\Subject\Delete;

use App\Infrastructure\Http\Models\BaseRequest;

class DeleteSubjectRequest extends BaseRequest
{
    public function authorize()
    {
        return true;
    }
}