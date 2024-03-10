<header class="header-sticky header-absolute">
    <nav class="navbar navbar-expand-xl">
        <div class="container">
            <a class="navbar-brand me-0" href="index.php">
                <img width="250px" src="{{ asset('frontend/images/logo_indekost.svg') }}" alt="logo">
            </a>

            <div class="navbar-collapse collapse" id="navbarCollapse">
                <ul class="navbar-nav navbar-nav-scroll dropdown-hover mx-auto">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('landing-page.home') }}">Home</a> </li>
                    
                    @auth
                        <li class="nav-item"> <a class="nav-link" href="{{ route('landing-page.rekomendasi') }}">Rekomendasi</a> </li>
                    @endauth

                    <li class="nav-item"> <a class="nav-link" href="{{ route('landing-page.cari-kost') }}">Cari Kost</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('landing-page.maps') }}">Maps</a> </li>
                </ul>
                
                <ul class="nav align-items-center dropdown-hover ms-sm-2 my-2">
                    @if(!auth()->user())
                        <li class="nav-item d-flex gap-3">
                                <a class="btn btn-sm btn-primary mb-0" href="{{ route('register') }}">Daftar</a>
                                <a class="btn btn-sm btn-outline-primary mb-0" href="{{ route('login.user') }}">Masuk</a>
                        </li>
                    @else  
                        <div class="d-flex gap-4">
                            <div>
                                <p class="mb-0">{{ auth()->user()->email }}</p>
                                <small class="text-primary">Ada telah login!</small>
                            </div>
                            <div>
                                <a class="btn btn-sm btn-danger mt-2" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">Logout</a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    @endif
                </ul>
            </div>
            <ul class="nav align-items-center dropdown-hover ms-sm-2">
                <li class="nav-item">
                    <button class="navbar-toggler ms-sm-3 p-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-animation">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                    </button>
                </li>
            </ul>

        </div>
    </nav>
</header>