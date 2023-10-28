<?php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

use App\Models\User;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    //Permissions
    $permissions = [
      'invoices',
      'invoices_table',
      'invoices_create',
      'invoices_excel',
      'invoices_status',
      'invoices_paid',
      'invoices_unpaid',
      'invoices_partpaid',
      'invoices_archive',

      'reports',
      'reports_invoices',
      'reports_customers',

      'users',
      'users_table',
      'roles',

      'settings',
      'sections',
      'product',
    ];
    foreach ($permissions as $permission) {
      Permission::create(['name' => $permission]);
    }

    //Admin Seeder
    $user = User::create([
      'name' => 'Admin',
      'email' => 'admin@gmail.com',
      'password' => bcrypt('123456789'),
      'status' => 'مفعل',
    ]);
    $role = Role::create(['name' => 'owner']);
    $permissions = Permission::pluck('id', 'id')->all();
    $role->syncPermissions($permissions);
    $user->assignRole([$role->id]);
  }
}
