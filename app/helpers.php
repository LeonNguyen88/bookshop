<?php
    function limit_character($text){
        if(mb_strlen($text, "utf-8") <= 16){
            return $text;
        }
        else {
            $space = mb_strpos($text, " ", 16,"utf-8");
            if($space >= 16){
                $text = mb_substr($text, 0, $space, "utf-8");
                return $text."...";
            }
            else{
                return $text;
            }
        }
    }
    function format_money($money){
        return number_format($money, 0, '.', ',');
    }
?>