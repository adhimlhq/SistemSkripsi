<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
            [
                'id' => 10,
                'text_stat' => "Pengajuan Oleh Mahasiswa",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'id' => 11,
                'text_stat' => "Disetujui Oleh Akademik",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'id' => 12,
                'text_stat' => "Disetujui Oleh Kaprodi",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'id' => 120,
                'text_stat' => "Topik Ditolak Oleh Kaprodi",
                'created_at' => new \DateTime,
                'updated_at' => null,

            ],
            [
                'id' => 20,
                'text_stat' => "Pengajuan Seminar Proposal",
                'created_at' => new \DateTime,
                'updated_at' => null,

            ],
            [
                'id' => 21,
                'text_stat' => "Seminar Proposal Disetujui Dosen Pembimbing 1",
                'created_at' => new \DateTime,
                'updated_at' => null,

            ],

            [
                'id' => 22,
                'text_stat' => "Seminar Proposal Disetujui Dosen Pembimbing 2",
                'created_at' => new \DateTime,
                'updated_at' => null,

            ],

            [
                'id' => 23,
                'text_stat' => "Seminar Proposal Disetujui Dosen Pembimbing",
                'created_at' => new \DateTime,
                'updated_at' => null,

            ],

            [
                'id' => 24,
                'text_stat' => "Seminar Proposal Disetujui Kaprodi",
                'created_at' => new \DateTime,
                'updated_at' => null,

            ],

            [
                'id' => 25,
                'text_stat' => "Seminar Proposal Disetujui Akademik",
                'created_at' => new \DateTime,
                'updated_at' => null,

            ],

            [
                'id' => 26,
                'text_stat' => "Nilai Seminar Proposal Disetujui Ketua Prodi",
                'created_at' => new \DateTime,
                'updated_at' => null,

            ],
            [
                'id' => 200,
                'text_stat' => "Pengajuan Seminar Proposal Ditolak",
                'created_at' => new \DateTime,
                'updated_at' => null,

            ],
            [
                'id' => 30,
                'text_stat' => "Unggah Kemajuan I",
                'created_at' => new \DateTime,
                'updated_at' => null,

            ],
            [
                'id' => 31,
                'text_stat' => "Dosen Pembimbing 1 Menyetujui Kemajuan I",
                'created_at' => new \DateTime,
                'updated_at' => null,

            ],
            [
                'id' => 32,
                'text_stat' => "Unggah Pembimbing 2 Menyetujui Kemajuan I",
                'created_at' => new \DateTime,
                'updated_at' => null,

            ],
            [
                'id' => 33,
                'text_stat' => "Kemajuan I Disetujui",
                'created_at' => new \DateTime,
                'updated_at' => null,

            ],
            [
                'id' => 300,
                'text_stat' => "Kemajuan I Ditolak",
                'created_at' => new \DateTime,
                'updated_at' => null,

            ],
            [
                'id' => 40,
                'text_stat' => "Unggah Kemajuan II",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'id' => 41,
                'text_stat' => "Dosen Pembimbing 1 Menyetujui Kemajuan II",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'id' => 42,
                'text_stat' => "Dosen Pembimbing 2 Menyetujui Kemajuan II",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'id' => 43,
                'text_stat' => "Kemajuan II Disetujui",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'id' => 400,
                'text_stat' => "Kemajuan II Ditolak",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'id' => 50,
                'text_stat' => "Unggah Kemajuan III",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'id' => 51,
                'text_stat' => "Dosen Pembimbing 1 Menyetujui Kemajuan III",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'id' => 52,
                'text_stat' => "Dosen Pembimbing 2 Menyetujui Kemajuan III",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'id' => 53,
                'text_stat' => "Kemajuan III Disetujui",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'id' => 500,
                'text_stat' => "Kemajuan III Ditolak",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'id' => 60,
                'text_stat' => "Unggah Kemajuan IV",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'id' => 61,
                'text_stat' => "Dosen Pembimbing 1 Menyetujui Kemajuan IV",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'id' => 62,
                'text_stat' => "Dosen Pembimbing 2 Menyetujui Kemajuan IV",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'id' => 63,
                'text_stat' => "Kemajuan IV Disetujui",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'id' => 600,
                'text_stat' => "Kemajuan IV Ditolak",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'id' => 70,
                'text_stat' => "Pengajuan Seminar Hasil",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'id' => 71,
                'text_stat' => "Pengajuan Semhas Disetujui Dosen Pembimbing 1",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'id' => 72,
                'text_stat' => "Pengajuan Semhas Disetujui Dosen Pembimbing 2",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'id' => 73,
                'text_stat' => "Pengajuan Semhas Disetujui Akademik",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'id' => 74,
                'text_stat' => "Pengajuan Semhas Disetujui Akademik",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'id' => 75,
                'text_stat' => "Nilai Semhas Disetujui Ketua Prodi",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'id' => 700,
                'text_stat' => "Pengajuan Semhas Ditolak",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'id' => 900,
                'text_stat' => "Penelitian Selesai",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
            [
                'id' => 999,
                'text_stat' => "Penelitian Gagal",
                'created_at' => new \DateTime,
                'updated_at' => null,
            ],
        ];
        \DB::table('status')->insert($status);
    }
}
