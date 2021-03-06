<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

/*
 * klasa AdminFilter poziva se kod svakog pristupa Admin kontroleru
 *
 * pusta prolaz samo korisnicima tipa admin
 * sve ostale preusmeri na njihove podrazumevane stranice
 */
class AdminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        if ($session->has("Korisnik")){
            $ulogovan = $session->get('Korisnik')->idUlo;
            switch ($ulogovan){
                case 2: return redirect()->to(site_url("Majstor"));
                case 3: return redirect()->to(site_url("Klijent"));
            } 
        } else {
            return redirect()->to(site_url("Gost"));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}