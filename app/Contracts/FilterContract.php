<?php

namespace App\Contracts;

interface FilterContract
{
    public function handle($value): void;
}
