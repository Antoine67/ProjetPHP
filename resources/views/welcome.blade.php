@extends('layout')

@section('content')
<link rel="stylesheet" href="{{ asset('/css/acceuil.css') }}">
<div class="imgcontainer">

    <img class="ligne1" id="img1" src="{{ asset('/img/1.jpeg') }}" > 
    <img class="ligne1" src="{{ asset('/img/2.png') }}"> 
    <br>
    <img class="ligne1" src="{{ asset('/img/3.jpg') }}"> 
    <img class="ligne1" src="{{ asset('/img/4.png') }}"> 



</div>
@endsection
