@extends('master')

@section('content')

    @include('partials/categories')

    @include('flash::message')

    <a href="{{ URL::previous() }}" class="back-button">Späť</a>

    <h2 class="order-headline">Zhrnutie objednávky</h2>

    <div class="basket-wrapper">
        <h3 class="method-headline">Kontaktné údaje</h3>

        <p class="label">Meno</p>
        <p class="value">{{ $order->first_name }}</p>

        <p class="label">Priezvisko</p>
        <p class="value">{{ $order->second_name }}</p>

        <p class="label">Ulica, pop. číslo</p>
        <p class="value">{{ $order->street }}, {{ $order->house_number }}</p>

        <p class="label">Mesto</p>
        <p class="value">{{ $order->city }}</p>

        <p class="label">PSČ</p>
        <p class="value">{{ $order->psc }}</p>

        <p class="label">Telefón</p>
        <p class="value">{{ $order->phone }}</p>

        <p class="label">E-mail</p>
        <p class="value">{{ $order->email }}</p>

        <p class="label">Doprava</p>
        <p class="value">{{ $order->logistic_method }}</p>

        <p class="label">Platba</p>
        <p class="value"> {{ $order->payment_method }}</p>


        <h3 class="method-headline">Objednávané položky</h3>

        @foreach($items as $item)
            <div class="basket-part">
                <img class="basket-img"src="{{ URL::asset($item->img_link) }}" alt="Nedostupny obrazok">

                <div class="basket-part-detail">
                    <h2 class="artist-name-detail">{{ $item->artist_name }}</h2>
                    <h2 class="album-name-detail">{{ $item->album_name }}</h2>
                    <h2 class="price-detail">{{ $item->price }}</h2>
                </div>

                <div class="basket-part-number">
                    <p class="number">{{ $item->pivot->number_of_items }}x {{ $item->type }}</p>
                    <p>skladom</p>
                </div>

                <div class="basket-part-buttons">
                    <a href="/item/{{ $item->id }}" class="basket-part-button">DETAIL</a>
                </div>

            </div>
        @endforeach

        <p class="total-price">Výsledná cena:<span> {{ $order->price }}€</span></p>
        <p class="total-price">Bez DPH: <span>{{ $order->price }}€</span></p>
        <a href="/confirm/{{ $order->id }}" class="basket-button">Objednať</a>

    </div>

@endsection