<?php

namespace Database\Seeders;

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User as ModelsUser;
use Spatie\Permission\Models\Permission;
class CreateAdminUserSeeder extends Seeder
{
/**
* Run the database seeds.
*
* @return void
*/
public function run()
{
    
         $user = ModelsUser::create([
        'name' => 'ahmed osama', 
        'email' => 'ahmedo17.132@gmail.com',
        'password' => bcrypt('12345678'),
        'roles_name' => ["owner"],
        'Status' => 'مفعل',
        ]);
  
        $role = Role::create(['name' => 'owner']);
   
        $permissions = Permission::pluck('id','id')->all();
  
        $role->syncPermissions($permissions);
   
        $user->assignRole([$role->id]);


}
}