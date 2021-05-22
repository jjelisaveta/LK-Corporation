<?php


namespace App\Libraries;


class KalendarTermin
{
    private $terminText;

    function __construct($terminText)
    {
        $this->terminText=$terminText;
    }
    function view(){
        $data['terminText'] = $this->terminText;
        echo view('majstor/terminKalendar',$data);
    }
}