<?php namespace App\Libraries;


class KalendarTermin
{
    public function prikaz($terminText, $id, $class)
    {
        return view('majstor/komponente/terminKalendar', ['terminText' => $terminText, 'id' => $id, 'class' => $class]);
    }
}