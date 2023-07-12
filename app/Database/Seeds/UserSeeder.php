<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username' => 'admin',
                'nama' => 'Admin',
                'email' => 'operator@example.com',
                'password' => password_hash('admin', PASSWORD_DEFAULT),
                'level' => 1,
                'status_akun' => 1
            ],
            [
                'username' => 'operator',
                'nama' => 'Operator',
                'email' => 'operator@example.com',
                'password' => password_hash('operator', PASSWORD_DEFAULT),
                'level' => 2,
                'status_akun' => 1
            ],
            // Tambahkan data pengguna lainnya sesuai kebutuhan
        ];

        // Memasukkan data ke dalam tabel 'users'
        $this->db->table('users')->insertBatch($data);
    }
}
