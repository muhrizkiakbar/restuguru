<?php

use Illuminate\Database\Seeder;
use App\CCabangs;
class CabangTableSeeder extends Seeder
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
        		'Kode_Cabang' => 'A',
        		'Nama_Cabang' => 'Admin',
        		'No_Telepon' => '0811513055',
        		'Email' => 'muhrizkiakbar@live.com',
                'Alamat' => 'Jl. Gt. Paikat, Komplek. Buana Permai No. Blok B',
                'Jenis_Cabang' => 'Pusat',
            ],
        ];
        foreach ($users as $key => $value) {
        	CCabangs::create($value);
        }
    }
}
