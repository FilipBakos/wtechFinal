@extends('master')

@section('content')

    @include('partials/categories')

    @include('flash::message')


    {{--<form action="#" class="basic-filter">--}}
        {{--<div class="basic-filter-part">--}}
            {{--<input type="checkbox" value="1" id="all">--}}
            {{--<label for="all">Všetko</label>--}}
        {{--</div>--}}

        {{--<div class="basic-filter-part">--}}
            {{--<input type="checkbox" value="2" id="offer">--}}
            {{--<label for="offer">Akcia</label>--}}
        {{--</div>--}}

        {{--<div class="basic-filter-part">--}}
            {{--<input type="checkbox" value="3" id="new">--}}
            {{--<label for="new">Novinky</label>--}}
        {{--</div>--}}

        {{--<div class="basic-filter-part">--}}
            {{--<input type="checkbox" value="4" id="sklad">--}}
            {{--<label for="sklad">Na sklade</label>--}}
        {{--</div>--}}

    {{--</form>--}}

    <div class="group category-wrapper">
        {!! Form::open(['url'=> "/filter/$type", 'class' => 'filter float-left']) !!}
        {{--<form method="get" class="">--}}
            <div class="filter-part">
                <h3 class="filter-headline">Žáner</h3>

                @foreach($genres as $genre)
                    <input type="checkbox" class="gen" value="{{$genre->name}}" id="{{$genre->name}}" name="tag[]">
                    <label class="big-label gen" for="{{$genre->name}}">{{$genre->name}}</label>
                @endforeach
                <a href="#" class="moreG" >+ďalšie</a>
                <a href="#" class="lessG invisible">-zbaľ</a>
                {{--<input type="checkbox" value="punk" id="punk" name="tag[]">--}}
                {{--<label class="big-label" for="punk">Punk</label>--}}

                {{--<input type="checkbox" value="pop" id="pop" name="tag[]">--}}
                {{--<label class="big-label" for="pop">Pop</label>--}}

                {{--<input type="checkbox" value="disco" id="disco" name="tag[]">--}}
                {{--<label class="big-label" for="disco">Disco</label>--}}
            </div>

            <div class="filter-part">
                <h3 class="filter-headline">Artist</h3>
                @foreach($artists as $artist)
                    <input type="checkbox" class="art" value="{{$artist->name}}" id="{{$artist->name}}" name="artist[]" >
                    <label class="big-label art" for="{{$artist->name}}">{{$artist->name}}</label>
                @endforeach
                <a href="#" class="moreA">+ďalšie</a>
                <a href="#" class="lessA invisible">-zbaľ</a>

                {{--<input type="checkbox" value="Billy Talent" id="billy-talent"  name="artist[]">--}}
                {{--<label class="big-label" for="billy-talent">Billy Talent</label>--}}
                {{--<input type="checkbox" value="ACDC" id="acdc"  name="artist[]">--}}
                {{--<label class="big-label" for="acdc">ACDC</label>--}}
                {{--<input type="checkbox" value="Sum 41" id="sum-41"  name="artist[]">--}}
                {{--<label class="big-label" for="sum-41">Sum 41</label>--}}
            </div>

            <div class="filter-part">
                <h3 class="filter-headline">Rok</h3>
                <label class="small-label" for="from">Od</label>
                <input type="number" value="2000" min="1900" max="2018" id="from" name="year_from">
                <label class="small-label" for="to">Do</label>
                <input type="number" value="2018" min="1900" max="2018" id="to" name="year_to">
            </div>

            <div class="filter-part">
                <h3 class="filter-headline">Cena</h3>
                <label class="small-label" for="from">Od</label>
                <input type="number" value="0" min="0" max="150" id="from" name="price_from">
                <label class="small-label" for="to">Do</label>
                <input type="number" value="150" min="0" max="150" id="to" name="price_to">
            </div>

            <input type="submit"  class="search-button" value="Hľadaj">
        {{--</form>--}}
        {!! Form::close() !!}




        <a href="#" class="filter-button ">filter</a>

        <div class="products-3 float-right">

            @foreach($items as $item)
                <div class="product-3">
                    <img  src="{{ URL::asset( $item->img_link ) }}" alt="LP Hybrid Theory">
                    <h2 class="artist-name">{{ $item->artist_name }}</h2>
                    <h2 class="album-name">{{ $item->album_name }}</h2>
                    @if($item->number > 0)
                        <h2 class="price">{{ $item->price }} €<span class="badge on-stock">{{ $item->type }}</span></h2>
                    @else
                        <h2 class="price">{{ $item->price }} €<span class="badge not-on-stock">{{ $item->type }}</span></h2>
                    @endif
                    <a href="/item/{{ $item->id }}" class="detail-button">detail</a>
                </div>
            @endforeach
                <div class="pageing">
                    <a href={{$items->url(1)}}>Prva</a>
                    <a href={{$items->previousPageUrl()}}><</a>
                    <a href={{$items->nextPageUrl()}}>></a>
                    <a href={{$items->url($items->lastPage())}}>Posledna</a>
                </div>
        </div>


    </div>
@endsection