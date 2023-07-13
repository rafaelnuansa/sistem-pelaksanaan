<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\MahasiswaModel;
use App\Models\DosenModel;

class LoginController extends BaseController
{
    public function index()
    {
        return view('auth/login');
    }

    public function login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Cek pengguna di tabel Users
        $userModel = new UserModel();
        $user = $userModel->where('username', $username)->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                // Login berhasil sebagai pengguna
                // Simpan data pengguna ke session
                session()->set([
                    'user_id' => $user['id'],
                    'username' => $user['username'],
                    'nama' => $user['nama'],
                    'level' => 'Admin',
                    'logged_in' => true,
                ]);

                // Redirect ke halaman dashboard
                return redirect()->to('/admin/dashboard');
            }
        }

        // Cek pengguna di tabel Mahasiswa
        $mahasiswaModel = new MahasiswaModel();
        $mahasiswa = $mahasiswaModel->where('nim', $username)->first();

        if ($mahasiswa) {
            if (password_verify($password, $mahasiswa['password'])) {
                // Login berhasil sebagai mahasiswa
                // Simpan data mahasiswa ke session
                session()->set([
                    'mahasiswa_id' => $mahasiswa['id'],
                    'nim' => $mahasiswa['nim'],
                    'nama' => $mahasiswa['nama'],
                    'level' => 'Mahasiswa',
                    'logged_in' => true,
                ]);

                // Redirect ke halaman dashboard mahasiswa
                return redirect()->to('/mahasiswa/dashboard');
            }
        }

        // Cek pengguna di tabel Dosen
        $dosenModel = new DosenModel();
        $dosen = $dosenModel->where('nidn', $username)->first();

        if ($dosen) {
            if (password_verify($password, $dosen['password'])) {
                // Login berhasil sebagai dosen
                // Simpan data dosen ke session
                session()->set([
                    'dosen_id' => $dosen['id'],
                    'nidn' => $dosen['nidn'],
                    'nama' => $dosen['nama'],
                    'level' => 'Dosen',
                    'logged_in' => true,
                ]);

                // Redirect ke halaman dashboard dosen
                return redirect()->to('/dosen/dashboard');
            }
        }

        // Login gagal
        // Lakukan tindakan yang diperlukan, seperti menampilkan pesan kesalahan, mengarahkan ulang ke halaman login, dll.
        return redirect()->back()->with('error', 'Username or password is incorrect');
    }

    public function logout()
    {
        // Hapus semua data session
        session()->destroy();

        // Redirect ke halaman login
        return redirect()->to('/');
    }
}
