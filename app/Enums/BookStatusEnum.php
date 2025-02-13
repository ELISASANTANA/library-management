<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class BookStatusEnum extends Enum {

    const LOANED = 1;
    const RETURNED = 2;
    const OVERDUE = 3;

}
