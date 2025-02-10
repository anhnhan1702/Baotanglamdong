<!DOCTYPE html>
<!--
Template Name: Rubick - HTML Admin Dashboard Template
Author: Left4code
Website: http://www.left4code.com/
Contact: muhammadrizki@left4code.com
Purchase: https://themeforest.net/user/left4code/portfolio
Renew Support: https://themeforest.net/user/left4code/portfolio
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ $dark_mode ? 'dark' : '' }}">
<!-- BEGIN: Head -->

<head>
    <meta charset="utf-8">
    <!-- <link href="{{ asset('/favicon.ico') }}" rel="shortcut icon"> -->
    <!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Rubick admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Rubick admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="LEFT4CODE">
    <!-- <link rel="stylesheet" href="./jsmain/jquery.fancybox.min.css" /> -->
    <!-- <link rel="stylesheet" href="https://codepen.io/fancyapps/pen/Kxdwjj" /> -->
    <link href="./jsmain/tailwind.min.css" rel="stylesheet">
    <!-- BEGIN: CSS Assets-->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="./dist/css/app.css" />
    <link rel="apple-touch-icon" sizes="57x57" href="./images/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="./images/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="./images/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="./images/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="./images/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="./images/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="./images/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="./images/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="./images/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="./images/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="./images/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon-16x16.png">
    <link rel="manifest" href="./images/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    @yield('head')
    <!-- Link mở file upload -->

    <!-- END: CSS Assets-->

</head>
<!-- END: Head -->

@yield('body')

</html>