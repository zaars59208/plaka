<?php

namespace Modules\Plaka\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Plaka\Listeners\InstallModule;
use Modules\Plaka\Listeners\ShowSetting;
use Modules\Plaka\Listeners\AddMenu;

class Event extends ServiceProvider
{
    /**
     * The event listener mappings for the module.
     *
     * @var array
     */
    protected $listen = [
        \App\Events\Module\Installed::class => [
            InstallModule::class,
        ],
        \App\Events\Module\SettingShowing::class => [
            ShowSetting::class,
        ],
        \App\Events\Menu\AdminCreated::class => [
            AddMenu::class,
        ]
    ];
}
