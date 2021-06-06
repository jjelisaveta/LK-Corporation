<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;


/*
 * klasa GostFilter poziva se kod svakog pristupa Gost kontroleru
 *
 * propusta svaki saobracaj zato sto svaki koriskik treba da ima mogucnosti gosta
 *
 * dodatne funkcije gosta se dalje filtriraju u klasi KlijentFilter
 */
class GostFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        if ($session->has("Korisnik")){
            $putanja = $_SERVER['REQUEST_URI'];
            $metoda = explode("/", $putanja)[1];
            if ($metoda=="izlogujSe" || $metoda=="promeniPodatke"){
                return;
            }
            $ulogovan = $session->get('Korisnik')->idUlo;
            switch ($ulogovan){
                case 1: return redirect()->to(site_url("Admin"));
                case 2: return redirect()->to(site_url("Majstor"));
                case 3: return redirect()->to(site_url("Klijent"));
            } 
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}