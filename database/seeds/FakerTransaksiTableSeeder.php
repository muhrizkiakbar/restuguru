<?php


use App\CSub_Tpenjualans;
use App\CTransaksi_Penjualans;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class FakerTransaksiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $faker = Faker::create();

        for( $i= 0 ; $i <= 20000 ; $i++ )
        {
            $nonow=CTransaksi_Penjualans::withTrashed()->orderBy('id','desc')->first();
            // dd($nonow->id);
            $transaksi=new CTransaksi_Penjualans;
            $transaksi->nomor_nota=$nonow->id+1;
            $transaksi->hp_pelanggan="08115130555";
            $transaksi->nama_pelanggan=$faker->name;
            $transaksi->tanggal=$faker->dateTimeBetween($startDate = '-30 years', $endDate = 'now', $timezone = null);
            $transaksi->total_harga=$faker->numberBetween($min = 55000, $max = 1000000);
            $transaksi->diskon=$faker->numberBetween($min = 10, $max = 100);
            $transaksi->metode_pembayaran="Cash";
            $transaksi->sisa_tagihan=$faker->numberBetween($min = 55000, $max = 1000000);
            $transaksi->jumlah_pembayaran=$faker->numberBetween($min = 55000, $max = 1000000);
            $transaksi->user_id=1;
            $transaksi->cabang_id=1;
            $transaksi->pajak=$faker->numberBetween($min = 55000, $max = 1000000);
            
            if ($transaksi->save())
            {

                for( $i= 0 ; $i <= 5 ; $i++ )
                {
                    $subtransaksi=new CSub_Tpenjualans;
                    $subtransaksi->penjualan_id=$transaksi->id;
                    $subtransaksi->produk_id=1;
                    $subtransaksi->harga_satuan=$faker->numberBetween($min = 25000, $max = 1000000);
                    $subtransaksi->panjang=$faker->numberBetween($min = 10, $max = 100);
                    $subtransaksi->lebar=$faker->numberBetween($min = 10, $max = 100);
                    $subtransaksi->banyak=$faker->numberBetween($min = 1, $max = 10);
                    $subtransaksi->keterangan=$faker->text($maxNbChars = 200);
                    $subtransaksi->user_id=1;
                    $subtransaksi->subtotal=$faker->numberBetween($min = 25000, $max = 1000000);
                    $subtransaksi->finishing="Tanpa Finishing";
                    $subtransaksi->satuan="m";
                    $subtransaksi->diskon=$faker->numberBetween($min = 1, $max = 100);
                    $subtransaksi->save();
                }
            }

        }


    }
}
