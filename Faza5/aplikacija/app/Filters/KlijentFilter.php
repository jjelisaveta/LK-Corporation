<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
/*
 * klasa Klijent poziva se kod svakog pristupa Klijent kontroleru
 *
 * korisnik koji nije ulogovan tj gost je ima pristup do odredjenih stranica
 * korisnik tipa majstor i admin se preusmerava na svoje podrazumevane stranice
 *
 * koriskik tipa klijent se propusta u potpunosti
 */
class KlijentFilter implements FilterInterface
{

    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        $putanja = $_SERVER['REQUEST_URI'];
        $metoda = explode("/", $putanja)[2];
        if (!isset($_SESSION['Korisnik'])) {
            if (!($metoda == "pretrazivanje" || $metoda == "prikazMajstora"
                || $metoda == "prikazUsluga" || $metoda == "dohvatiSlobodneTermine"
                || $metoda == "dohvatiIdentifikator")) {
                return redirect()->to(site_url("Gost/neovlascen"));
            }
            return;
        }

        if ($session->has("Korisnik")) {
            $ulogovan = $session->get('Korisnik')->idUlo;
            switch ($ulogovan) {
                case 1:
                    return redirect()->to(site_url("Admin"));
                case 2:
                    return redirect()->to(site_url("Majstor"));
            }
        } else {
            return redirect()->to(site_url("klijent"));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }

}