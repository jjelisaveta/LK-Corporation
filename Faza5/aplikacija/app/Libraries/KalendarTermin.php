<?php


namespace App\Libraries;


class KalendarTermin
{
    private $terminText;
    private $id;
    private $class;

    function __construct($terminText, $id, $class)
    {
        $this->terminText = $terminText;
        $this->id = $id;
        $this->class = $class;
    }

    function view()
    {
        $data['terminText'] = $this->terminText;
        $data['id'] = $this->id;
        $data['class'] = $this->class;
        echo view('majstor/terminKalendar', $data);
    }
}