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
            'harga' => '5050000',
            'tipe' => 'kambing_jantan',
        ]);
        Packages::create([
            'nama' => 'Kambing / Domba',
            'berat' => '35',
            'variant' => 'Extra',
            'harga' => '3550000',
            'tipe' => 'kambing_jantan',
        ]);
        Packages::create([
            'nama' => 'Kambing / Domba',
            'berat' => '30',
            'variant' => 'Istimewa',
            'harga' => '3050000',
            'tipe' => 'kambing_jantan',
        ]);
        Packages::create([
            'nama' => 'Kambing / Domba',
            'berat' => '25',
            'variant' => 'Spesial',
            'harga' => '2550000',
            'tipe' => 'kambing_jantan',
        ]);

        // KAMBING BETINA
        Packages::create([
            'nama' => 'Kambing / Domba',
            'berat' => '40',
            'variant' => 'Super',
            'harga' => '3350000',
            'tipe' => 'kambing_betina',
        ]);
        Packages::create([
            'nama' => 'Kambing / Domba',
            'berat' => '35',
            'variant' => 'Extra',
            'harga' => '2350000',
            'tipe' => 'kambing_betina',
        ]);
        Packages::create([
            'nama' => 'Kambing / Domba',
            'berat' => '30',
            'variant' => 'Istimewa',
            'harga' => '2150000',
            'tipe' => 'kambing_betina',
        ]);
        Packages::create([
            'nama' => 'Kambing / Domba',
            'berat' => '25',
            'variant' => 'Spesial',
            'harga' => '1850000',
            'tipe' => 'kambing_betina',
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
            'variant' => '7 Orang',
            'harga' => '2500000',
            'tipe' => 'sapi',
        ]);
    }
}
