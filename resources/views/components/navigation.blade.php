<nav class="navbar-wrapper">
    <div class="search-container">
        <div class="search-bar-container">
            {{-- <form action="{{ route('posts.search') }}" method="GET"> --}}
            <input id="search-input" oninput="debounceSearch('{{ route('posts.search') }}')" type="search" name="query"
                placeholder="search posts" />
            {{-- <button onclick="searchPost(event)" type="submit">Search</button> --}}
            {{-- </form> --}}
        </div>


        <div id="search-list">
            {{-- <div class="search-item-container ">
                <div class="sc-image-wrapper ">
                    <img src={{ asset('/') }} />
                </div>
                <div class="sc-title-wrapper ">
                    <p>This is sample title</p>
                </div>
            </div> --}}
        </div>


    </div>
    <div class="login-container">
        @if (Auth::user())
            <div class="add-btn">
                <a href="{{ route('post.createPage') }}">
                    Add
                </a>
            </div>

            <div class="logout-btn">
                <a href="{{ route('auth.logout') }}">
                    Logout
                </a>
            </div>
            <div class="user-badge">
                <p>{{ Auth::user()->fullname[0] }}</p>
            </div>
        @else
            <div class="login-btn">
                <a href="{{ route('user.login') }}">
                    Login
                </a>
            </div>
        @endif

    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src={{ asset('js/navigation.js') }}></script>

</nav>
