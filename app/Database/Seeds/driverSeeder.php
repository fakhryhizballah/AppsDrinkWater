<?php

namespace App\Database\Seeds;

class DriverSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $data = [
            [
                'id_driver' => 'DRV0001PNK002001',
                'nama' => 'Fakhry',
                'email' => 'Fakhry@gmail.com',
                'cv' => 'Kangen',
                'telp' => '0895321701798',
                'password' => '$2y$10$qW2lRi3eNBSweV/SiGZR3uAQIsvXno2a5TuKEHQ5LcmC8n7KtCA4u', //fakhry123
                'profil' => NULL,
                'Trip' => NULL,
                'liter' => NULL,
                'poin' => NULL,
                'created_at' => '2020-07-16 09:21:28',
                'updated_at' => '2020-07-16 09:21:28'
            ],
            [
                'id_driver' => 'DRV0002PNK002001',
                'nama' => 'Naufal',
                'email' => 'naufal@gmail.com',
                'cv' => 'Kangen',
                'telp' => '089918106',
                'password' => '$2y$10$JjwdFcI7vUIS2UH9GNU1yORvtIGBCwv68wqF45sp9IKWI3Q1.2Eo6', //naufal234
                'profil' => NULL,
                'Trip' => NULL,
                'liter' => NULL,
                'poin' => NULL,
                'created_at' => '2020-07-16 09:33:48',
                'updated_at' => '2020-07-16 09:33:48'
            ],
            [
                'id_driver' => 'DRVAdminPNK',
                'nama' => 'Admin',
                'email' => 'admin@spairum.com',
                'cv' => 'Spairum',
                'telp' => '089111',
                'password' => '$2y$10$KGSV.Qz1L2gzeOXMKmfb3.4516sEDs0BKoERj6ClgM/m.kXCazF2a',
                'profil' => NULL,
                'Trip' => NULL,
                'liter' => NULL,
                'poin' => NULL,
                'created_at' => '2020-07-16 09:35:13',
                'updated_at' => '2020-07-16 09:35:13'
            ]
        ];

        // $this->db->table('driver')->insert($data);
        $this->db->table('driver')->insertBatch($data);
    }
}
