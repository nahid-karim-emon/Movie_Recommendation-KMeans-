<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title> @yield('title') | @isset($SiteOption)
        {{ $SiteOption[0]->value }}
    @endisset </title>
    <!-- Custom fonts for this template-->
    <link href="{{  asset('vendor/fontawesome-free/css/all.min.css')  }}" rel="stylesheet" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
        <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Extra For Multi Selection -->
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}" />
    <!-- Or for RTL support -->
    <link rel="stylesheet" href="{{ asset('css/select2-bootstrap-5-theme.rtl.min.css') }}" />

    <!-- Scripts -->
    <script src="{{ asset('js/jquery.slim.min.js') }}"></script>
    <script src="{{ asset('js/select2.full.min.js') }}"></script>
    </head>