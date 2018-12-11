@extends('master')

<?php
    $user = Auth::user();
?>

@section('content')
    <a href="{{ route('userLogout') }}" class="login-button logout-button float-right">Odhlásiť sa</a>
    <div class="basket-wrapper">
        <h3 class="method-headline">Kontaktné údaje</h3>

        <p class="label">Meno</p>
        <p class="value">{{ $user->first_name }}</p>

        <p class="label">Priezvisko</p>
        <p class="value">{{ $user->second_name }}</p>

        <p class="label">Ulica, pop. číslo</p>
        <p class="value">{{ $user->street }}, {{ $user->house_number }}</p>

        <p class="label">Mesto</p>
        <p class="value">{{ $user->city }}</p>

        <p class="label">PSČ</p>
        <p class="value">{{ $user->psc }}</p>

        <p class="label">Telefón</p>
        <p class="value">{{ $user->phone }}</p>

        <p class="label">E-mail</p>
        <p class="value">{{ $user->email }}</p>
    </div>
@endsection