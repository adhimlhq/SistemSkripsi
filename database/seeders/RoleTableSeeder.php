<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = [
            [
                'nama' => "psik",
                'keterangan' => "psik adalah pengguna ...",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'nama' => "jurusan",
                'keterangan' => "jurusan adalah pengguna ...",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'nama' => "akademik",
                'keterangan' => "akademik adalah pengguna ...",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'nama' => "dosen",
                'keterangan' => "dosen adalah pengguna ...",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'nama' => "mahasiswa",
                'keterangan' => "mahasiswa adalah pengguna ...",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
        ];

        \DB::table('roles')->insert($role);
    }
}
