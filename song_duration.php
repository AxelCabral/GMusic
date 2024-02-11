<?php
    function song_duration($time){
        $minutes = 0;
        $seconds = 0;
            while ($time != 0){
                if($time >= 60){
                    $minutes++;
                    $time = $time -60;
                }
                else{
                    $seconds = $time;
                    $time = $time - $seconds;
                }
            }
            if($minutes < 10){
                $minutes = "0".$minutes;
            }
            if($seconds < 10){
                $seconds = "0".$seconds;
            }
        $duration = $minutes.":".$seconds;

        return $duration;
    }
    function total_playlist_duration($time){
        $hours = 0;
        $minutes = 0;
        $seconds = 0;
            while ($time != 0){
                if($time >= 3600){
                    $hours++;
                    $time = $time - 3600;
                }
                else if($time >= 60){
                    $minutes++;
                    $time = $time - 60;
                }
                else{
                    $seconds = $time;
                    $time = $time - $seconds;
                }
            }
            if($minutes < 10){
                $minutes = "0".$minutes;
            }
        $duration = $hours."h ".$minutes."min";

        return $duration;
    }
