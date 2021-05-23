<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Pravila
 *
 * @author Jovan
 */

namespace App\Validations;


class Pravila {
    function validIme(string $str, string $err = null) : bool{          //ime mora da sadrzi samo slova
        if(ctype_alpha($str))
            return true;
        return false;
    }
    
    function validTelefon(string $str, string $err = null) : bool{      //telefon mora da sadrzi samo cifre
        if (preg_match('/^[0-9 +-]*$/', $str)) {
            return true;
        }
        return false;
    }
    
    
}
