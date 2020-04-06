<?php

namespace Modules\Plaka\Listeners;

use App\Events\Module\Installed as Event;
use App\Models\Auth\Role;
use App\Models\Auth\Permission;

class InstallModule
{
    /**
     * Handle the event.
     *
     * @param  Event $event
     * @return void
     */
    public function handle(Event $event)
    {
        if ($event->alias != 'plaka') {
            return;
        }

        $this->updatePermissions();
    }

    protected function updatePermissions()
    {
        $permissions = [];

        $permissions[] = Permission::firstOrCreate([
            'name' => 'read-plaka-settings'
        ], [
            'display_name' => 'Read Plaka Settings',
            'description' => 'Read Plaka Settings',
        ]);

        $permissions[] = Permission::firstOrCreate([
            'name' => 'update-plaka-settings'
        ], [
            'display_name' => 'Update Plaka Settings',
            'description' => 'Update Plaka Settings',
        ]);

        $permissions[] = Permission::firstOrCreate([
            'name' => 'delete-plaka-settings'
        ], [
            'display_name' => 'Delete Plaka Settings',
            'description' => 'Delete Plaka Settings',
        ]);

        $roles = Role::all()->filter(function ($r) {
            return $r->hasPermission('read-admin-panel');
        });

        foreach ($roles as $role) {
            foreach ($permissions as $permission) {
                if ($role->hasPermission($permission->name)) {
                    continue;
                }

                $role->attachPermission($permission);
            }
        }
    }
}
