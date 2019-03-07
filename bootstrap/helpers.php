<?php

if (!function_exists('current_admin')) {

    function current_admin()
    {
        if (Auth::guard('web')->check()) {
            return Auth::guard('web')->user();
        }

        return false;
    }
}

if (!function_exists('current_user')) {

    function current_user()
    {
        if (Auth::guard('api')->check()) {
            return Auth::guard('api')->user();
        }

        return false;
    }
}

function format_money($amount)
{
    return number_format($amount/100 ?? 0, 2, '.', '');
}

function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}