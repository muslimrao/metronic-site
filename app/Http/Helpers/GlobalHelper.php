<?php
if (! function_exists('get_airline_ID')) {
    function get_airline_ID()
    {
        if ( session("airline_details") )
        {
            return session("airline_details")["id"];
        }
        return 0;
    }
}

if (! function_exists('get_airline_NAME')) {
    function get_airline_NAME()
    {
        if ( session("airline_details") )
        {
            return session("airline_details")["airline_name"];
        }
        return 0;
    }
}



if (! function_exists('get_airline_DATA')) {
    function get_airline_DATA( $key )
    {
        if ( session("airline_details") )
        {
            return @session("airline_details")[ $key ];
        }
        return 0;
    }
}