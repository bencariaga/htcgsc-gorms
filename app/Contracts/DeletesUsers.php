<?php

namespace App\Contracts;

interface DeletesUsers
{
    public function handle(int $userId): void;
}
