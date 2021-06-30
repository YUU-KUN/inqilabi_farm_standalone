<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Packages;
class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // KAMBING JANTAN
        Packages::create([
            'nama' => 'Kambing / Domba',
            'berat' => '40',
            'variant' => 'Super',
            'harga' => '4000000',
            'tipe' => 'kambing_jantan',
        ]);
        Packages::create([
            'nama' => 'Kambing / Domba',
            'berat' => '35',
            'variant' => 'Extra',
            'harga' => '3600000',
            'tipe' => 'kambing_jantan',
        ]);
        Packages::create([
            'nama' => 'Kambing / Domba',
            'berat' => '30',
            'variant' => 'Istimewa',
            'harga' => '3100000',
            'tipe' => 'kambing_jantan',
        ]);
        Packages::create([
            'nama' => 'Kambing / Domba',
            'berat' => '25',
            'variant' => 'Spesial',
            'harga' => '2500000',
            'tipe' => 'kambing_jantan',
        ]);

        // SAPI
        Packages::create([
            'nama' => 'Kurban Sapi',
            'berat' => '200',
            'variant' => 'Mandiri',
            'harga' => '17500000',
            'tipe' => 'sapi',
        ]);
        Packages::create([
            'nama' => 'Patungan Kurban',
            'berat' => '200',
            'variant' => ' 2 Orang',
            'harga' => '15000000',
            'tipe' => 'sapi',
        ]);
        Packages::create([
            'nama' => 'Patungan Kurban',
            'berat' => '200',
            'variant' => '3 Orang',
            'harga' => '12500000',
            'tipe' => 'sapi',
        ]);
        Packages::create([
            'nama' => 'Patungan Kurban',
            'berat' => '200',
            'variant' => '4 Orang',
            'harga' => '10000000',
            'tipe' => 'sapi',
        ]);
        Packages::create([
            'nama' => 'Patungan Kurban',
            'berat' => '200',
            'variant' => '5 Orang',
            'harga' => '7500000',
            'tipe' => 'sapi',
        ]);
        Packages::create([
            'nama' => 'Patungan Kurban',
            'berat' => '200',
            'variant' => '6 Orang',
            'harga' => '5000000',
            'tipe' => 'sapi',
        ]);
        Packages::create([
            'nama' => 'Patungan Kurban',
            'berat' => '200',
            'variant' => '7 Orang',
            'harga' => '2500000',
            'tipe' => 'sapi',
        ]);
    }
}
