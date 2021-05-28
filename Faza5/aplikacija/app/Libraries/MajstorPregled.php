<?php namespace App\Libraries;

class MajstorPregled
{

    public function prikazUsluge($ime,$prezime,$email,$id,$num)
    {
        return view("admin/komponente/majstor2", ['ime'=>$ime,'prezime'=>$prezime,'email'=>$email,'id'=>$id,'num'=>$num]);
    }
}
