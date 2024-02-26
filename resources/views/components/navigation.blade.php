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
        <div class="login-btn">
            <a href="">
                <p>Login</p>
            </a>


        </div>
        <div class="login-btn">
            <a href="">
                <p>Add</p>
            </a>
        </div>


</nav>
