<?php
      function formatNumber($number) {
        $suffix = '';
        if($number < 1000){
          return $number;
        }else{
        if ($number >= 1000 && $number < 1000000) {
            $number = $number / 1000;
            $suffix = 'K';
        } elseif ($number >= 1000000 && $number < 1000000000) {
            $number = $number / 1000000;
            $suffix = 'M';
        }else{
            $number = $number / 1000000000;
            $suffix = 'T';
        }
          return number_format($number, ($number >= 1 ? 1 : 1)) . $suffix;
        }
    }
?>