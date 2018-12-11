@extends('master')

@section('content')

    @include('partials/categories')

    @include('flash::message')

    <a href="{{ URL::previous() }}" class="back-button">Späť</a>
    <div class="product-page group">
        <img class="product-img float-left"src="{{ URL::asset( $item->img_link ) }}" alt="obrazok nie je dostupny">
        <div class="product-info-wrapper float-right">
            <h2 class="artist-name-detail">{{ $item->artist_name }}</h2>
            <h2 class="album-name-detail">{{ $item->album_name }}</h2>
            <h2 class="price-detail">{{ $item->price }} €<span class="badge">{{ $item->type }}</span></h2>

            {!! Form::open(['url'=> "/basket/$item->id", 'class' => 'add-to-basket']) !!}
            <input type="number" name="number_of_products" min="1" value="1">
            <label for="number_of_products">ks</label>
            <input type="submit" class="button-add" id="button-add" value="Vložiť do košíka">
            {!! Form::close() !!}
        </div>

    </div>

    <ol class="tracks">
        <h3>Skladby</h3>
        @foreach($tracks as $track)
            <li>{{ $track}}</li>
        @endforeach
    </ol>
@endsection
