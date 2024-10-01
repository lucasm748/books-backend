<?php

namespace App\Infrastructure\Eloquent\Enums;

enum DatabaseExceptionCodesEnum: int
{
    case INTEGRITY_CONSTRAINT_VIOLATION = 23000;
}