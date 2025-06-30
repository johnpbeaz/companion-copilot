<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Template;
use App\Policies\TemplatePolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Template::class => TemplatePolicy::class,
    ];

    public function boot(): void
    {
        // No need to call Gate::guessPolicyNamesUsing — Laravel will guess properly
    }
}
