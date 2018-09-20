<?php
class Date extends Db{

    public function convertToTime($date){
        $time = date("H:i",strtotime($date));
        return $time;
    }
    public function convertToDayAndTime($date){
        setlocale(LC_ALL, 'danish');
        $day = date("l", strtotime($date));;
        $time = date("H:i", strtotime($date));
        switch (strtolower($day)) {
            case 'monday':
                $day = "Mandag";
                break;
            case "tuesday":
                $day = "Tirsdag";
                break;
            case "wednesday":
                $day = "Onsdag";
                break;
            case "thursday":
                $day = "Torsdag";
                break;
            case "friday":
                $day = "Fredag";
                break;
            case "sunday":
                $day = "Lørdag";
                break;
            case "saturday":
                $day = "Søndag";
                break;
            default:
                # code...
                break;
        }
        return mb_strtoupper($day .' kl. '.$time, 'UTF-8');
    }
    public function getDay($date){
        $day = date("l", strtotime($date));;
        return $day;
    }
}
?>