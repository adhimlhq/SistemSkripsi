<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Nullable;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'id' => 1,
                'nama' => "admin",
                'nama_b' => "psik",
                'roles_id' => 1,
                'email' => "17adhim@gmail.com",
                'password' => \Hash::make("coba1234"),
                'no_HP' => 90310931,
                'status' => 1,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'id' => 5,
                'nama' => "admin",
                'nama_b' => "jurusan",
                'roles_id' => 2,
                'email' => "jurusanpsp@gmail.com",
                'password' => \Hash::make("coba1234"),
                'no_HP' => 81928981,
                'status' => 1,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'id' => 6,
                'nama' => "admin",
                'nama_b' => "akademik",
                'roles_id' => 3,
                'email' => "akademikpsp@gmail.com",
                'password' => \Hash::make("coba1234"),
                'no_HP' => 32387273,
                'status' => 1,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'id' => 11,
                'nama' => "Cecep",
                'nama_b' => "Pranowo",
                'roles_id' => 4,
                'email' => "cecp@gmail.com",
                'password' => \Hash::make("coba1234"),
                'no_HP' => 48937475,
                'status' => 1,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'id' => 12,
                'nama' => "Tri",
                'nama_b' => "Hartanto",
                'roles_id' => 4,
                'email' => "dosenpsp@gmail.com",
                'password' => \Hash::make("coba1234"),
                'no_HP' => 48937498,
                'status' => 1,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'id' => 13,
                'nama' => "I Nyoman",
                'nama_b' => "Mahesa",
                'roles_id' => 4,
                'email' => "nyoman7@gmail.com",
                'password' => \Hash::make("coba1234"),
                'no_HP' => 27427925,
                'status' => 1,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],

            //student
            [
                'id' => 201,
                'nama' => "Putri",
                'nama_b' => "Ekawati",
                'roles_id' => 5,
                'email' => "putriek@gmail.com",
                'password' => \Hash::make("coba1234"),
                'no_HP' => 12345678910,
                'status' => 1,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'id' => 202,
                'nama' => "Ahmad",
                'nama_b' => "Mustaqim",
                'roles_id' => 5,
                'email' => "taqim@gmail.com",
                'password' => \Hash::make("coba1234"),
                'no_HP' => 1098234567,
                'status' => 1,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],

            [
                'id' => 301,
                'nama' => "Fajar",
                'nama_b' => "Senja",
                'roles_id' => 5,
                'email' => "fajar@gmail.com",
                'password' => \Hash::make("coba1234"),
                'no_HP' => 10987654321,
                'status' => 1,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],

            [
                'id' => 302,
                'nama' => "Suci",
                'nama_b' => "Paramita",
                'roles_id' => 5,
                'email' => "suci@gmail.com",
                'password' => \Hash::make("coba1234"),
                'no_HP' => 10987654521,
                'status' => 1,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
        ];

        \DB::table('users')->insert($user);


        // Dummy Dosen
        $lecture = [
            [
                'user_id' => 11,
                'previllege' => "KAPRODI_PSP",
                'ruangan' => null,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'user_id' => 12,
                'previllege' => "KAPRODI_IK",
                'ruangan' => null,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'user_id' => 13,
                'previllege' => "DOSEN",
                'ruangan' => null,
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
        ];

        \DB::table('lecturers')->insert($lecture);

        // Dummy Mahasiswa
        $student = [
            [
                'user_id' => 201,
                'program_id' => 1,
                'jurusan' => "PSPK",
                'alamat' => "Joyo Agung 1A",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'user_id' => 202,
                'program_id' => 1,
                'jurusan' => "PSPK",
                'alamat' => "Joyo Agung 1B",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'user_id' => 301,
                'program_id' => 2,
                'jurusan' => "PSPK",
                'alamat' => "Joyo Agung 2A",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'user_id' => 302,
                'program_id' => 2,
                'jurusan' => "PSPK",
                'alamat' => "Joyo Agung 2B",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ]
        ];

        \DB::table('students')->insert($student);
    }
}
