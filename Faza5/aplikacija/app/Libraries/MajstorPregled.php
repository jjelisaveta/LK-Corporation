<?php namespace App\Libraries;

class MajstorPregled
{

    public function prikazUsluge($ime,$prezime,$email,$num)
    {
        return view("admin/komponente/majstor", ['ime'=>$ime,'prezime'=>$prezime,'email'=>$email,'num'=>$num]);
    }
}
