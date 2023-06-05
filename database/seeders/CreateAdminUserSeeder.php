<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
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
        //Admin Seeder
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password')
        ]);

        $role = Role::create(['name' => 'Admin']);

        // $permissions = Permission::pluck('id','id')->all();

        // $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);

        Role::where('name', 'Admin')->update(['guard_name' => 'web']);
        $role = Role::where('name', 'Admin')->first();
        $permissions = Permission::pluck('id','id')->all();
        if($permissions){
            $role->syncPermissions($permissions);
        }
    }
}
