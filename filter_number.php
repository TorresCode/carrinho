<?php

    function filter_number($number)
    {
        $number = filter_var($number, FILTER_SANITIZE_NUMBER_INT);
        $number = filter_var($number, FILTER_VALIDATE_INT);
        return $number;
    }