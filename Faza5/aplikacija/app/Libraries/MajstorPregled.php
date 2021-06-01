<?php namespace App\Libraries;

class MajstorPregled
{

    public function prikazUsluge($ime,$prezime,$email,$id,$num,$procenat,$slika)
    {
        return view("admin/komponente/majstor2", ['ime'=>$ime,'prezime'=>$prezime,'email'=>$email,'id'=>$id,'num'=>$num,'procenat'=>$procenat,'slika'=>$slika]);
    }
}
