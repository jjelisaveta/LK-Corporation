<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class GostFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        if ($session->has("Korisnik")){
            $ulogovan = $session->get('Korisnik')->idUlo;
            echo $ulogovan;
            switch ($ulogovan){
                case 1: return redirect()->to(site_url("Admin"));
                case 2: return redirect()->to(site_url("Majstor"));
                case 3: return redirect()->to(site_url("Korisnik"));
            } 
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}