<?php namespace App\Libraries;

class MajstorPregled
{

    public function pregledMajstora($ime,$prezime,$email,$id,$num,$procenat,$slika,$ukupno)
    {
        return view("admin/komponente/majstor", ['ime'=>$ime,'prezime'=>$prezime,'email'=>$email,'id'=>$id,'num'=>$num,'procenat'=>$procenat,'slika'=>$slika,'ukupno'=>$ukupno]);
    }
}
