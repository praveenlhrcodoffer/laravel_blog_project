<nav class="navbar-wrapper">
    <div class="search-container">
        <div class="search-bar-container">
            <form action="{{ route('posts.search') }}" method="GET">
                <input type="search" name="query" placeholder="search posts" />
                <button type="submit">Search</button>
            </form>

        </div>

        {{-- @if ($results) --}}
        {{-- <div class="search-results-container">

        </div> --}}
        {{-- @endif --}}

    </div>
    <div class="login-container">
        @if (!Auth::user())
            <div class="login-btn">
                <a href="{{ route('user.login') }}">
                    Login
                </a>
            </div>
        @else
            <div class="login-btn">
                <a href="">
                    <p>{{ Auth::user()->fullname }}</p>
                </a>
            </div>
            <div class="login-btn">
                <a href="{{ route('post.showAdd') }}">
                    Add
                </a>
            </div>

            <div class="login-btn">
                <a href="{{ route('auth.logout') }}">
                    Logout
                </a>
            </div>
        @endif




</nav>
