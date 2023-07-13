<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class RedirectIfAuthenticated implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (session('logged_in')) {
            if (session()->get('level') === 'Mahasiswa') {
                return redirect()->to(site_url('mahasiswa/dashboard'));
            } elseif (session()->get('level') === 'Dosen') {
                return redirect()->to(site_url('dosen/dashboard'));
            } elseif (session()->get('level') === 'Admin') {
                return redirect()->to(site_url('admin/dashboard'));
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}

