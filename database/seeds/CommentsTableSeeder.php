<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Module
        $moduleId = DB::table('modules')->insertGetId([
            'name' => 'comments',
            'display_name' => 'Comments',
            'icon' => 'icon-briefcase'
        ]);

        // Permissions
        DB::table('permissions')->insert([
            [
                'name' => 'read-comments',
                'display_name' => 'Read',
                'guard_name' => 'web',
                'module_id' => $moduleId
            ],
            [
                'name' => 'create-comments',
                'display_name' => 'Create',
                'guard_name' => 'web',
                'module_id' => $moduleId
            ],
            [
                'name' => 'update-comments',
                'display_name' => 'Update',
                'guard_name' => 'web',
                'module_id' => $moduleId
            ],
            [
                'name' => 'delete-comments',
                'display_name' => 'Delete',
                'guard_name' => 'web',
                'module_id' => $moduleId
            ]
        ]);

        // Assign permissions
        $admin = Role::findByName('admin');
        $admin->givePermissionTo('read-comments', 'create-comments', 'update-comments', 'delete-comments');

        $user = Role::findByName('user');
        $user->givePermissionTo('read-comments', 'create-comments');

        $guest = Role::findByName('guest');
        $guest->givePermissionTo('read-comments', 'create-comments');
    }
}
