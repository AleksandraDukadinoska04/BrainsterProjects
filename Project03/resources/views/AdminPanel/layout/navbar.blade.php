<header>
    <nav
        class="navbar navbar-expand-xl navbar-light bg-white p-1 shadow fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ Auth::check() ? route('admin.welcome') : '' }}"><img src="{{ asset('images/logo.png') }}" alt="MHRA Logo" class="w-100"></a>
            <button
                class="navbar-toggler d-xl-none"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapsibleNavId"
                aria-controls="collapsibleNavId"
                aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                @if(Auth::check())
                <ul class="navbar-nav mx-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-center @hasSection('users') active text-white @endif" href="{{ route('users') }}">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-center @hasSection('blogs') active text-white @endif" href="{{ route('blogs') }}">Blogs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-center @hasSection('events') active text-white @endif" href="{{ route('events') }}">Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-center  @hasSection('speakers') active text-white @endif" href="{{ route('speakers') }}">Speakers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-center @hasSection('employees') active text-white @endif" href="{{ route('employees') }}">Employees</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-center @hasSection('feedbacks') active text-white @endif" href="{{ route('feedbacks') }}">Feedbacks</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-center @hasSection('comments') active text-white @endif" href="{{ route('comments') }}">Comments</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-center @hasSection('recommendations') active text-white @endif" href="{{ route('recommendations') }}">Recommendations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-center @hasSection('generalInfo') active text-white @endif" href="{{ route('generalInfo') }}">General Info</a>
                    </li>
                </ul>
                <div class="nav-item">
                    <form method="POST" action="{{ route('logout') }}" class="">
                        @csrf

                        <button type="submit" class="Btn mx-auto">

                            <div class="sign"><svg viewBox="0 0 512 512">
                                    <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path>
                                </svg></div>

                            <div class="btntext">Logout</div>
                        </button>
                    </form>
                </div>

                @else
                <ul class="navbar-nav ms-auto mt-2 mt-lg-0">

                    <li class="nav-item">
                        <a class="nav-link text-center @hasSection('login') active text-white @endif" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link text-center @hasSection('register') active text-white @endif" href="{{ route('register') }}">Register</a>
                    </li>
                </ul>

                @endif

            </div>
        </div>
    </nav>

</header>