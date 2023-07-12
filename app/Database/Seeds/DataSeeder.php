<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DataSeeder extends Seeder
{
    public function run()
    {
        // Reset data

        // Seeding
        $this->call('UserSeeder');
        $this->call('DosenSeeder');
        $this->call('FakultasSeeder');
        $this->call('ProdiSeeder');
        $this->call('MahasiswaSeeder');
        // $this->call('PklSeeder');
        // $this->call('AnggotaPklSeeder');
    }
}
