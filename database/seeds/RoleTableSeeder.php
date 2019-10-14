<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
use App\Permission;
class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        
        $users = [
            [
        		'name' => 'admin',
        		'display_name' => 'Admin',
        		'description' => 'Hak Akses Paling Tinggi'
            ]
        ];
        foreach ($users as $key => $value) {
            $role=Role::create($value);

            $permissions=Permission::all();

            foreach ($permissions as $key=>$value)
            {
                $role->attachPermission($value->id);
            }

            
            $users = [
                [
                    'nama' => 'Admin',
                    'username' => 'admin',
                    'password' => bcrypt('wakacau123'),
                    'Telepon' => '0811513055',
                    'gaji' => '50000',
                    'Alamat' => 'Jl. Gt. Paikat, Komplek. Buana Permai No. Blok B',
                    'cabang_id'=> '1'
                ]
            ];
            foreach ($users as $key => $value) {
                $user=User::create($value);
                $user->attachRole($role);
            }
        }
    }
}
