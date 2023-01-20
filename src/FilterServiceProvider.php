<?php

namespace Rosamarsky\RangeFilter;

use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;

class FilterServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Nova::serving(function (ServingNova $event) {
            Nova::script('range-filter', __DIR__.'/../dist/js/filter.js');
            Nova::style('range-filter', __DIR__.'/../dist/css/filter.css');
        });
    }
}
