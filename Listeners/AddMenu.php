<?php

namespace Modules\Plaka\Listeners;

use App\Events\Menu\AdminCreated as Event;

class AddMenu
{
    /**
     * Handle the event.
     *
     * @param  Event $event
     * @return void
     */
    public function handle(Event $event)
    {
        // Add new menu item
        $event->menu->add([
            'url' => 'modules/plaka/posts',
            'title' => 'Plaka Posts',
            'icon' => 'fa fa-rocket',
            'order' => 5,
        ]);

         // Add child to existing menu item
         $item = $event->menu->whereTitle('Plaka Posts');
         $item->url('modules/plaka/posts', 'Child Plaka Posts', 4, ['icon' => '']);
    }
}