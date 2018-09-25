<?php

use Illuminate\Database\Seeder;

use App\Role;
use App\User;
use App\Permission;
use App\stokbahanbaku;

class UpdateDeleteStokBahanBakuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $permissions = [
            [
        		'name' => 'edit-stokbahanbaku',
        		'display_name' => 'Edit Stok Bahan Baku',
                'description' => 'Edit Stok Bahan Baku',
                'index'=>'0',
                'urlindex'=>'editstokbahanbaku'
            ],
            [
        		'name' => 'delete-stokbahanbaku',
        		'display_name' => 'Hapus Stok Bahan Baku',
                'description' => 'Hapus Stok Bahan Baku',
                'index'=>'0',
                'urlindex'=>'deletestokbahanbaku'
            ],
        ];
        foreach ($permissions as $key => $value) {
            $permission=Permission::create($value);
            
            // dd($permission);

            $role=Role::where('id','=','1')->first();

            $role->attachPermission($permission->id);


        }
    }
}
