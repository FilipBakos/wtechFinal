@extends('master')

@section('content')

    @include('partials/categories')

    @include('flash::message')

    <a href="{{ URL::previous() }}" class="back-button">Späť</a>

    @if(count($items)>0)
        <h2 class="basket-headline">Vo Vašom košíku sú tieto položky</h2>
    @else
        <h2 class="basket-headline">Vo Vašom košíku nie je nic</h2>
    @endif

    <div class="basket-wrapper">

    @forelse($items as $item)

        <div class="basket-part group">
            <img class="basket-img"src="{{ URL::asset($item->img_link) }}" alt="LP Hybrid Theory">

            <div class="basket-part-detail">
                <h2 class="artist-name-detail">{{ $item->artist_name }}</h2>
                <h2 class="album-name-detail">{{ $item->album_name }}</h2>
                <h2 class="price-detail">{{ $item->price }} €</h2>
            </div>

            <div class="basket-part-number">
                <p class="number">{{ $item->pivot->number_of_items }}x {{ $item->type }}</p>
                @if($item->number >= $item->pivot->number_of_items)
                    <p>skladom</p>
                @else
                    <p>nie je skladom</p>
                @endif
            </div>

            <div class="basket-part-buttons">
                <a href="/item/{{ $item->id }}" class="basket-part-button">DETAIL</a>
                <a href="/basket/remove/{{ $item->id }}" class="basket-part-button">Odstrániť</a>
            </div>

        </div>
    @endforeach

    @if( count($items)>0 )
                <a href="/order-form" class="basket-button">Objednať</a>
    @endif

    </div>

@endsection