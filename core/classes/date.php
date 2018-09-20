<?php
class Date extends Db{

    public function convertToTime($date){
        $time = date("H:i",strtotime($date));
        return $time;
    }
}
?>