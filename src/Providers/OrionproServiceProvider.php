<?php

namespace Osfrportal\OrionproLaravel\Providers;

use Illuminate\Support\ServiceProvider;

class OrionproServiceProvider extends ServiceProvider
{
    public function boot()
    {
	$this->loadRoutesFrom(__DIR__ . '/../../routes/api.php');
    }
}
