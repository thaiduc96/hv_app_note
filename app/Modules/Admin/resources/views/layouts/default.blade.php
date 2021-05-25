@extends('Admin::layouts.master')

@section('title')
    <?php
    $urls = explode('/', url()->current());
    $title = str_replace('-', ' ', end($urls));
    echo ' | ' . (URL::to('/') == url()->current() ? 'Home Page' : strtoupper($title));
    ?>
@endsection


@section('header')
    @include('Admin::layouts.header')
@endsection

@section('sidebar')
    @include('Admin::layouts.sidebar')
@endsection

@section('content')
    @parent
@endsection


