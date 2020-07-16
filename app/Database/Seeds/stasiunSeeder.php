<?php

namespace App\Database\Seeds;

use CodeIgniter\I18n\Time;


class StasiunSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $data = [
            [
                'id_mesin'      => 'COV 0001 PNK 002', // Kode mesin, nomor urut, Kota, kecamatan, mitra
                'lokasi'        => 'Alun Alun Kapuas',
                'geo'           => '-0.021974, 109.339413',
                'status'        => '4',
                'isi'           => '1000',
                'indikator'     => '3',
                'created_at'    => '2020-07-16 09:21:28',
                'updated_at'    => '2020-07-16 09:21:28'
            ],
            [
                'id_mesin'      => 'COV 0002 PNK 003',
                'lokasi'        => 'Pelabuhan SengHie',
                'geo'           => '-0.028365, 109.345620',
                'status'        => '5',
                'isi'           => '0',
                'indikator'     => '3',
                'created_at'    => '2020-07-16 09:21:28',
                'updated_at'    => '2020-07-16 09:21:28'
            ],
            [
                'id_mesin'      => 'COV 0003 PNK 003',
                'lokasi'        => 'Water Front',
                'geo'           => '-0.021974, 109.339413',
                'status'        => '1',
                'isi'           => '21000',
                'indikator'     => '1',
                'created_at'    => '2020-07-16 09:21:28',
                'updated_at'    => '2020-07-16 09:21:28'
            ],
            [
                'id_mesin'      => 'COV 0004 PNK 004',
                'lokasi'        => 'Taman Catur',
                'geo'           => '-0.054945, 109.348640',
                'status'        => '1',
                'isi'           => '22500',
                'indikator'     => '1',
                'created_at'    => '2020-07-16 09:21:28',
                'updated_at'    => '2020-07-16 09:21:28'
            ]
        ];

        $this->db->table('mesin')->insertBatch($data);
    }
}
