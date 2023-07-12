<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DosenSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama' => 'Yusuf Yudhistira, M.Kom', 
                'nidn' => '06131278',
                'no_telpon' => '08112607462', 
                'alamat' => 'Bumiayu',
                'password' => password_hash('password', PASSWORD_DEFAULT),
                'status_akun' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Mukrodin, M.Kom', 
                'nidn' => '12345890',
                'no_telpon' => '089712347654', 
                'alamat' => 'Paguyangan',
                'password' => password_hash('password', PASSWORD_DEFAULT),
                'status_akun' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Achmad Syauqi, M.Kom', 
                'nidn' => '7678899',
                'no_telpon' => '098765431256', 
                'alamat' => 'Adisana',
                'password' => password_hash('password', PASSWORD_DEFAULT),
                'status_akun' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Fuaida Nabyla, M.Kom', 
                'nidn' => '56786547',
                'no_telpon' => '098766557743', 
                'alamat' => 'Tonjong',
                'password' => password_hash('password', PASSWORD_DEFAULT),
                'status_akun' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Eko Sudrajat, M.Kom', 
                'nidn' => '56567654',
                'no_telpon' => '098755664434', 
                'alamat' => 'Banyumas',
                'password' => password_hash('password', PASSWORD_DEFAULT),
                'status_akun' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Danar, M.Kom', 
                'nidn' => '65438888',
                'no_telpon' => '098755664432', 
                'alamat' => 'Cilacap',
                'password' => password_hash('password', PASSWORD_DEFAULT),
                'status_akun' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('dosen')->insertBatch($data);
    }
}
