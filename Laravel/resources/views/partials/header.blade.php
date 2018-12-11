
<header class="behind">
    <nav>
        <ul class="nav-bar">
            <li class="header-a"><a href="/" id="logo" >LOGO</a></li>

            <li class="link ls"><a href="/about" >O nás</a></li>
            <li class="link ls"><a href="/contact" >Kontakt</a></li>
            <li class="link ls"><a href="/rules" >O. podmienky</a></li>
            <li class="link">
                <a href="#" id="search-button"><i class="fas fa-search"></i></a>
                <form id="search" method="get" action="#">
                    <input type="text" id="search-input" name="query" placeholder="Search" />
                </form>
            </li>

            <li class="basket">
                <a href="{{ URL::route('basket') }}" id="basket" ><i class="fas fa-shopping-basket"></i></a>
            </li>

            @guest
                <li class="header-a" id="login-button"><a href="{{ route('login') }}"  >LOGIN</a></li>
            @else
                <li class="header-a" id="login-button"><a href="{{ route('user') }}"  > {{ Auth::user()->first_name }}</a></li>
            @endguest


        </ul>
    </nav>
</header>