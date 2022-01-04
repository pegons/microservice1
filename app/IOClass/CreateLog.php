<?php

declare(strict_types=1);

namespace App\IOClass;

use Illuminate\Support\Facades\Log;


class CreateLog
{
    public function execute($text): void
    {
        log::info("Mensaje recibido ->" . $text['message']);
    }
}
