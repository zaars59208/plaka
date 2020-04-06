<?php

namespace Modules\Plaka\Listeners;

use App\Events\Module\SettingShowing as Event;

class ShowSetting
{
    /**
     * Handle the event.
     *
     * @param  Event $event
     * @return void
     */
    public function handle(Event $event)
    {
        $event->modules->settings['plaka'] = [
            'name' => trans('plaka::general.name'),
            'description' => trans('plaka::general.description'),
            'url' => route('plaka.settings.edit'),
            'icon' => 'fas fa-credit-card',
        ];
    }
}
