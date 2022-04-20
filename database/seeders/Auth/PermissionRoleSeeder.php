<?php

namespace Database\Seeders\Auth;

use App\Domains\Auth\Models\Permission;
use App\Domains\Auth\Models\Role;
use App\Domains\Auth\Models\User;
use Database\Seeders\Traits\DisableForeignKeys;
use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

/**
 * Class PermissionRoleTableSeeder.
 */
class PermissionRoleSeeder extends Seeder
{
   use DisableForeignKeys, TruncateTable;

   /**
    * Run the database seed.
    */
   public function run()
   {
      $this->disableForeignKeys();

      // $this->truncateMultiple([
      //    'roles',
      //    'permissions',
      //    'role_has_permissions',
      //    'model_has_roles',
      // ]);

      $this->call(PermissionRoleAdminSeeder::class);
      $this->call(PermissionRoleUserSeeder::class);

      $this->enableForeignKeys();
   }
}
