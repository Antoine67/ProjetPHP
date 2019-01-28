@extends('layout')

@section('content')

<link rel="stylesheet" href="{{ asset('/css/mentions_legales.css') }}">
<span hidden id="csrf-token"><?=csrf_token() ?></span>

<div class="container-fluid container"> 
  <h1> Mentions Legales </h1>
  <hr/>
</div>

<div class="container-fluid container"> 

</div>

@endsection
