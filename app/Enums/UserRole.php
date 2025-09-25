<?php

namespace App\Enums;

use Illuminate\Validation\Rules\Enum;

enum UserRole: string {

    case ADMIN = 'admin';
    case TEACHER = 'teacher';
    case STUDENT = 'student';

    public function label(): string
    {
        return match ($this) {
            self::ADMIN => __('main.admin'),
            self::TEACHER => __('main.teacher'),
            self::STUDENT => __('main.student'),
        };
    }

}
