<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProgramFieldTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bidang = [
            [
                'nama' => "Manajemen Penangkapan Ikan",
                'keterangan' => "Manajemen Penangkapan Ikan adalah ...",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'nama' => "Dinamika Populasi Ikan",
                'keterangan' => "Dinamika Penangkapan ikan adalah ...",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'nama' => "Terumbu Karang",
                'keterangan' => "Terumbu Karang adalah ...",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
        ];

        \DB::table('fields')->insert($bidang);


        $prodi = [
            [
                'nama' => "PEMANFAATAN SUMBERDAYA PERIKANAN",
                'keterangan' => "Pemanfaatan sumberdaya perikanan adalah program studi ...",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'nama' => "ILMU KELAUTAN",
                'keterangan' => "Ilmu Kelautan adalah program studi ...",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
        ];

        \DB::table('programs')->insert($prodi);
    }
}
