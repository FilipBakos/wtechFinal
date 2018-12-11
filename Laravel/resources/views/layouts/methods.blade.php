@extends('master')

@section('content')

    @include('partials/categories')

    @include('flash::message')

    <a href="{{ URL::previous() }}" class="back-button">Späť</a>

    <h2 class="order-headline">Doprava a Platba</h2>

    {!! Form::open([
        'url' =>'/order-sum/'.$order->id.'',
        'class' => 'order-form'
    ]) !!}

        <h3 class="method-headline">Vyberte spôsob dopravy</h3>



        <div class="logistic-wrapper">
            <div class="part">
                <input type="radio" name="logistic" id="DHL" value="DHL">
                <label for="DHL">DHL</label>
                <img src="img/dhl.jpeg" alt="dhl">
                <p>0€</p>
            </div>

            <div class="part">
                <input type="radio" name="logistic" id="UPS" value="UPS">
                <label for="UPS">UPS</label>
                <img src="img/ups.jpeg" alt="up">
                <p>0€</p>
            </div>

            <div class="part">
                <input type="radio" name="logistic" id="Sposta" value="Sposta">
                <label for="Sposta">Slovenská pošta</label>
                <img src="img/dhl.jpeg" alt="posta">
                <p>0€</p>
            </div>

            <div class="part">
                <input type="radio" name="logistic" id="OsobnyOdber" value="Osobny">
                <label for="OsobnyOdber">Osobný odber</label>
                <img src="img/dhl.jpeg" alt="asd">
                <p>0€</p>
            </div>


            <h3 class="method-headline">Vyberte spôsob platby</h3>


            <div class="logistic-wrapper">
                <div class="part">
                    <input type="radio" name="payment" id="Bp" value="Bankovy prevod">
                    <label for="Bp">Bankový prevod</label>
                    <img src="img/dhl.jpeg" alt="dhl">
                    <p>0€</p>
                </div>

                <div class="part">
                    <input type="radio" name="payment" id="dobierka" value="Dobierka">
                    <label for="dobierka">Dobierka</label>
                    <img src="img/ups.jpeg" alt="up">
                    <p>0€</p>
                </div>

            </div>

            <div class="wrapper-submit-order">
                <input class="methods-button" type="submit" id="registrate-button" value="Prejsť na zhrnutie objednávky">
            </div>


    {!! Form::close() !!}
    {{--</form>--}}
    </div>

@endsection
