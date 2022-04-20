<?php

namespace Database\Seeders\Auth;

use App\Domains\Auth\Models\Permission;
use App\Domains\Auth\Models\Role;
use App\Domains\Auth\Models\User;
use App\Models\ModelHasRole;
use App\Models\RoleHasPermission;
use Database\Seeders\Traits\DisableForeignKeys;
use Illuminate\Database\Seeder;

/**
 * Class PermissionRoleTableSeeder.
 */
class PermissionRoleUserSeeder extends Seeder
{
   use DisableForeignKeys;

   /**
    * Run the database seed.
    */
   public function run()
   {
      $this->disableForeignKeys();
      // Create Roles
      $userApp = Role::create([
         'type' => User::TYPE_USER,
         'name' => 'UserApp',
      ]);

      // Users category
      $users = Permission::create([
         'type' => User::TYPE_USER,
         'name' => 'user.access.user',
         'description' => 'All User Permissions',
      ]);
      $users->children()->saveMany([
         new Permission([
            'type' => User::TYPE_USER,
            'name' => 'user.access.user.list',
            'description' => 'View Users',
            'sort' => 1,
         ]),
         new Permission([
            'type' => User::TYPE_USER,
            'name' => 'user.access.user.changePassword',
            'description' => 'User Change Password',
            'sort' => 2,
         ]),
         new Permission([
            'type' => User::TYPE_USER,
            'name' => 'user.access.user.changeProfile',
            'description' => 'User Change Profile',
            'sort' => 3,
         ]),
      ]);

      $media_news = Permission::create([
         'type' => User::TYPE_USER,
         'name' => 'user.access.media_news',
         'description' => 'All Media News Permissions',
         'sort' => 2,
      ]);
      $media_news->children()->saveMany([
         new Permission([
            'type' => User::TYPE_USER,
            'name' => 'user.access.media_news.list',
            'description' => 'List Media News',
            'sort' => 1,
         ]),
      ]);

      $event = Permission::create([
         'type' => User::TYPE_USER,
         'name' => 'user.access.events',
         'description' => 'All Event Permissions',
         'sort' => 3,
      ]);
      $event->children()->saveMany([
         new Permission([
            'type' => User::TYPE_USER,
            'name' => 'user.access.events.list',
            'description' => 'List Event',
            'sort' => 1,
         ]),
      ]);

      $vacancy = Permission::create([
         'type' => User::TYPE_USER,
         'name' => 'user.access.vacancy',
         'description' => 'All Vacancy Permissions',
         'sort' => 4,
      ]);
      $vacancy->children()->saveMany([
         new Permission([
            'type' => User::TYPE_USER,
            'name' => 'user.access.vacancy.internship',
            'description' => 'List Vacancy Internship',
            'sort' => 1,
         ]),
         new Permission([
            'type' => User::TYPE_USER,
            'name' => 'user.access.vacancy.job',
            'description' => 'List Vacancy Job',
            'sort' => 2,
         ]),
      ]);
      // Assign Permissions to other Roles

      // userApp
      $data = [
         [
            'permission_id' => $users->id,
            'role_id' => $userApp->id,
         ],
         [
            'permission_id' => $media_news->id,
            'role_id' => $userApp->id,
         ],
         [
            'permission_id' => $event->id,
            'role_id' => $userApp->id,
         ],
         [
            'permission_id' => $vacancy->id,
            'role_id' => $userApp->id,
         ],
      ];

      RoleHasPermission::insert($data);
      //
      $this->enableForeignKeys();
   }
}
