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
class PermissionRoleAdminSeeder extends Seeder
{
   use DisableForeignKeys;

   /**
    * Run the database seed.
    */
   public function run()
   {
      $this->disableForeignKeys();

      // Create Roles
      Role::create([
         'id' => 1,
         'type' => User::TYPE_ADMIN,
         'name' => 'Administrator',
      ]);
      $operator = Role::create([
         'type' => User::TYPE_ADMIN,
         'name' => 'Operator',
      ]);
      $providerRole = Role::create([
         'type' => User::TYPE_ADMIN,
         'name' => 'Provider',
      ]);

      // Non Grouped Permissions
      //

      // Grouped permissions
      // Users category
      $users = Permission::create([
         'type' => User::TYPE_ADMIN,
         'name' => 'admin.access.user',
         'description' => 'All User Permissions',
      ]);
      $users->children()->saveMany([
         new Permission([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.access.user.list',
            'description' => 'View Users',
         ]),
         new Permission([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.access.user.deactivate',
            'description' => 'Deactivate Users',
            'sort' => 2,
         ]),
         new Permission([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.access.user.reactivate',
            'description' => 'Reactivate Users',
            'sort' => 3,
         ]),
         new Permission([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.access.user.clear-session',
            'description' => 'Clear User Sessions',
            'sort' => 4,
         ]),
         new Permission([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.access.user.impersonate',
            'description' => 'Impersonate Users',
            'sort' => 5,
         ]),
         new Permission([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.access.user.change-password',
            'description' => 'Change User Passwords',
            'sort' => 6,
         ]),
      ]);

      $media_news = Permission::create([
         'type' => User::TYPE_ADMIN,
         'name' => 'admin.access.media_news',
         'description' => 'All Media News Permissions',
         'sort' => 2,
      ]);

      $media_news->children()->saveMany([
         new Permission([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.access.media_news.list',
            'description' => 'List Media News',
            'sort' => 1,
         ]),
         new Permission([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.access.media_news.create',
            'description' => 'Create Media News',
            'sort' => 2,
         ]),
         new Permission([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.access.media_news.edit',
            'description' => 'Edit Media News',
            'sort' => 3,
         ]),
         new Permission([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.access.media_news.show',
            'description' => 'Show Media News',
            'sort' => 4,
         ]),
         new Permission([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.access.media_news.store',
            'description' => 'Store Media News',
            'sort' => 5,
         ]),
         new Permission([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.access.media_news.delete',
            'description' => 'Delete Media News',
            'sort' => 6,
         ]),
      ]);

      $category = Permission::create([
         'type' => User::TYPE_ADMIN,
         'name' => 'admin.access.category',
         'description' => 'All Category Permissions',
         'sort' => 3,
      ]);

      $category->children()->saveMany([
         new Permission([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.access.category.list',
            'description' => 'List Category',
            'sort' => 1,
         ]),
         new Permission([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.access.category.create',
            'description' => 'Create Category',
            'sort' => 2,
         ]),
         new Permission([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.access.category.edit',
            'description' => 'Edit Category',
            'sort' => 3,
         ]),
         new Permission([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.access.category.show',
            'description' => 'Show Category',
            'sort' => 4,
         ]),
         new Permission([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.access.category.store',
            'description' => 'Store Category',
            'sort' => 5,
         ]),
         new Permission([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.access.category.delete',
            'description' => 'Delete Category',
            'sort' => 6,
         ]),
      ]);

      $event = Permission::create([
         'type' => User::TYPE_ADMIN,
         'name' => 'admin.access.event',
         'description' => 'All Event Permissions',
         'sort' => 4,
      ]);

      $event->children()->saveMany([
         new Permission([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.access.event.list',
            'description' => 'List Event',
            'sort' => 1,
         ]),
         new Permission([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.access.event.create',
            'description' => 'Create Event',
            'sort' => 2,
         ]),
         new Permission([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.access.event.edit',
            'description' => 'Edit Event',
            'sort' => 3,
         ]),
         new Permission([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.access.event.show',
            'description' => 'Show Event',
            'sort' => 4,
         ]),
         new Permission([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.access.event.store',
            'description' => 'Store Event',
            'sort' => 5,
         ]),
         new Permission([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.access.event.delete',
            'description' => 'Delete Event',
            'sort' => 6,
         ]),
      ]);

      $vacancy = Permission::create([
         'type' => User::TYPE_ADMIN,
         'name' => 'admin.access.vacancy',
         'description' => 'All Vacancy Permissions',
         'sort' => 6,
      ]);

      $vacancy->children()->saveMany([
         new Permission([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.access.vacancy.list',
            'description' => 'List Vacancy',
            'sort' => 1,
         ]),
         new Permission([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.access.vacancy.create',
            'description' => 'Create Vacancy',
            'sort' => 2,
         ]),
         new Permission([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.access.vacancy.edit',
            'description' => 'Edit Vacancy',
            'sort' => 3,
         ]),
         new Permission([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.access.vacancy.show',
            'description' => 'Show Vacancy',
            'sort' => 4,
         ]),
         new Permission([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.access.vacancy.store',
            'description' => 'Store Vacancy',
            'sort' => 5,
         ]),
         new Permission([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.access.vacancy.delete',
            'description' => 'Delete Vacancy',
            'sort' => 6,
         ]),
      ]);

      $provider = Permission::create([
         'type' => User::TYPE_ADMIN,
         'name' => 'admin.access.provider',
         'description' => 'All Provider Permissions',
         'sort' => 7,
      ]);

      $provider->children()->saveMany([
         new Permission([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.access.provider.list',
            'description' => 'List Provider',
            'sort' => 1,
         ]),
         new Permission([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.access.provider.create',
            'description' => 'Create Provider',
            'sort' => 2,
         ]),
         new Permission([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.access.provider.edit',
            'description' => 'Edit Provider',
            'sort' => 3,
         ]),
         new Permission([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.access.provider.show',
            'description' => 'Show Provider',
            'sort' => 4,
         ]),
         new Permission([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.access.provider.store',
            'description' => 'Store Provider',
            'sort' => 5,
         ]),
         new Permission([
            'type' => User::TYPE_ADMIN,
            'name' => 'admin.access.provider.delete',
            'description' => 'Delete Provider',
            'sort' => 6,
         ]),
      ]);
      // Assign Permissions to other Roles

      // operator
      RoleHasPermission::create([
         'permission_id' => $media_news->id,
         'role_id' => $operator->id,
      ]);
      RoleHasPermission::create([
         'permission_id' => $category->id,
         'role_id' => $operator->id,
      ]);
      RoleHasPermission::create([
         'permission_id' => $event->id,
         'role_id' => $operator->id,
      ]);
      RoleHasPermission::create([
         'permission_id' => $vacancy->id,
         'role_id' => $operator->id,
      ]);

      // providerRole
      RoleHasPermission::create([
         'permission_id' => $media_news->id,
         'role_id' => $providerRole->id,
      ]);
      RoleHasPermission::create([
         'permission_id' => $event->id,
         'role_id' => $providerRole->id,
      ]);
      RoleHasPermission::create([
         'permission_id' => $vacancy->id,
         'role_id' => $providerRole->id,
      ]);

      $adminOpr = User::where('email', 'operator@operator.com')->first();
      // Assign User to Roles
      ModelHasRole::create([
         'role_id' => $operator->id,
         'model_type' => User::class,
         'model_id' => $adminOpr->id
      ]);
      $this->enableForeignKeys();
   }
}
