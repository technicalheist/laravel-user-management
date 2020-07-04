<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>{{(isset($title)) ? $title : 'Laravel Usermanagement'}}</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="{{ url('/public/assets/css/materialize.css')}}" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="{{ url('/public/assets/css/style.css')}}" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet"/>
</head>
<body>
    @if(Auth::check())
        @if(Auth::user()->user_type == 1)
        @include('layouts.nav_admin')
        @else
        @include('layouts.nav_staff')
        @endif
    @else
    @include('layouts.nav_guest')
    @endif
