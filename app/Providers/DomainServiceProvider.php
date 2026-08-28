<?php

declare(strict_types=1);

namespace App\Providers;

use App\Domain\Task\TaskRepositoryInterface;
use App\Infrastructure\Task\Persistence\TaskRepository;
use Illuminate\Support\ServiceProvider;

final class DomainServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(TaskRepositoryInterface::class, TaskRepository::class);
    }
}
