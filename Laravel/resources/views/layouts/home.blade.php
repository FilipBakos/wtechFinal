@extends('master')

@section('content')
    @include('partials/categories')

    @include('flash::message')

    <div class="banner-commercial">
        <div id="banner-slider" >
            <figure>
                <img src="img/banner-1.jpg">
                <img src="img/banner-2.jpg">
            </figure>
        </div>
    </div>

    <div class="products-4">
        @foreach($items as $item)
            <div class="product">
                <img  src="{{ $item->img_link }}" alt="LP Hybrid Theory">
                <h2 class="artist-name">{{ $item->artist_name }}</h2>
                <h2 class="album-name">{{ $item->album_name }}</h2>
                @if($item->number > 0)
                    <h2 class="price">{{ $item->price }} €<span class="badge on-stock">{{ $item->type }}</span></h2>
                @else
                    <h2 class="price">{{ $item->price }} €<span class="badge not-on-stock">{{ $item->type }}</span></h2>
                @endif
                <a href="item/{{ $item->id }}" class="detail-button">detail</a>
            </div>
        @endforeach


        <div class="pageing">
            <a href={{$items->url(1)}}>Prva</a>
            <a href={{$items->previousPageUrl()}}><</a>
            <a href={{$items->nextPageUrl()}}>></a>
            <a href={{$items->url($items->lastPage())}}>Posledna</a>
        </div>
    </div>
@endsection