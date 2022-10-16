<header class="header text-center">
    <!-- <h1 class="blog-name pt-lg-4 mb-0"><a class="no-text-decoration" href="index.html">Anthony's Blog</a></h1> -->

    <nav class="navbar navbar-expand-lg navbar-dark">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div id="navigation" class="collapse navbar-collapse flex-column">

            <ul class="navbar-nav flex-column text-start">
                <li class="nav-item">
                    <a class="nav-link active" href="/"><i class="fas fa-home fa-fw me-2"></i>Blog Home <span class="sr-only">(current)</span></a>
                </li>
                <hr>
                @auth
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('blogs.index') }}"><i class="fas fa-bookmark fa-fw me-2"></i>My Blogs <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out fa-fw me-2"></i>{{ __('Logout') }}<span class="sr-only">(current)</span></a>
                </li>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                @else
                <li class="nav-item">
                    <a class="nav-link" href="{{route('login')}}"><i class="fas fa-sign-in fa-fw me-2"></i>Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('register')}}"><i class="fas fa-user-plus fa-fw me-2"></i>Register</a>
                </li>
                @endauth

            </ul>

        </div>
    </nav>
</header>