<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eshop-Uvod</title>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700&amp;subset=latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ URL::asset('css/normalize.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/slider.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">



</head>
<body>

@include('partials/header')




<main class="behind">
    @yield('content')
</main>


<div class="pre-footer behind">
    <ul class="socials">
        <li class="social-icon">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
        </li>
        <li class="social-icon">
            <a href="#"><i class="fab fa-twitter"></i></a>
        </li>
        <li class="social-icon">
            <a href="#"><i class="fab fa-instagram"></i></a>
        </li>
        <li class="social-icon">
            <a href="#"><i class="fab fa-google-plus-g"></i></a>
        </li>
    </ul>
</div>

<footer class="behind">
    <div class="footer-wrapper">
        <ul class="bottom-info">

            <li class="bottom-info-part">
                Informácie
                <ul class="information">
                    <li class="info"><a href="#">- Doprava</a></li>
                    <li class="info"><a href="#">- Platba</a></li>
                    <li class="info"><a href="#">- Reklamačný poriadok</a></li>
                    <li class="info"><a href="#">- Obchodné podmienky</a></li>
                    <li class="info"><a href="#">- Vrátenie/Výmena tovaru</a></li>
                </ul>
            </li>

            <li class="bottom-info-part">
                O nás
                <ul class="about">
                    <li class="about-info"><a href="#">- História</a></li>
                    <li class="about-info"><a href="#">- Adresa</a></li>
                    <li class="about-info"><a href="#">- Kamenná predajňa</a></li>
                    <li class="about-info"><a href="#">- Galéria</a></li>
                </ul>
            </li>

            <li class="bottom-info-part">
                <a href="#">BLOG</a>
            </li>

            <li class="bottom-info-part">
                Kontakt
                <ul class="contact">
                    <li class="contact-info"><a href="#">- Formulár</a></li>
                    <li class="contact-info"><a href="#">- Návrhy, chyby</a></li>
                    <li class="contact-info"><a href="#">- Prihlásenie</a></li>
                    <li class="contact-info"><a href="#">- Registrácia</a></li>
                    <li class="contact-info"><a href="#">- Odhlásenie</a></li>
                </ul>
            </li>

        </ul>
    </div>

</footer>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<script src="{{ URL::asset('js/script.js') }}"></script>
<script>
    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
</script>
</body>
</html>
