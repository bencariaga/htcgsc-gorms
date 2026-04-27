<?php

namespace App\Traits\Concerns;

use Illuminate\Support\Facades\{DB, Log};
use Throwable;

trait ManagesTransactions
{
    protected function executeTransaction(callable $callback, string $errorMessage = 'Operation failed', array $context = []): mixed
    {
        DB::beginTransaction();

        try {
            $result = $callback();
            DB::commit();

            return $result;
        } catch (Throwable $e) {
            DB::rollBack();
            $logData = collect($context)->merge(['exception' => $e->getMessage(), 'file' => $e->getFile(), 'line' => $e->getLine()])->toArray();
            Log::error("{$errorMessage}: {$e->getMessage()}", $logData);

            throw $e;
        }
    }
}
