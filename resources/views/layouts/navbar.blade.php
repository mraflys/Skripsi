<div class="sidebar">
    <label for="menu-side" class="sidebar-menu">
        <input type="checkbox" name="" id="menu-side">
        <i class="las la-bars"></i>
    </label>
    <ul class="navigasi">
        <li class="menu @if(Route::currentRouteName()=='home') active @endif"><a href="{{ route('home') }}"><i class="las la-home"></i><span>Home</span></a></li>
        {{-- <li class="menu"><a href=""><i class="las la-clipboard-list"></i><span>Transaksi</span></a></li> --}}
        @if(Auth::user()->role == 'administrator')
            <li class="menu @if(Route::currentRouteName()=='user.list') active @endif"><a href="{{ route('user.list') }}"><i class="las la-user"></i><span>User</span></a></li>
            <li class="menu @if(Route::currentRouteName()=='absent-face') active @endif"><a href="{{ route('absent-face') }}"><i class="la-clipboard-list"></i><span>Laporan Absent</span></a></li>
        @endif
        <li class="menu logout"><a href="{{ route('logout') }}"onclick="event.preventDefault();
            document.getElementById('logout-form').submit();"><i class="las la-door-open"></i><span>Logout</span></a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                class="d-none">
                @csrf
            </form>
        </li>
    </ul>
</div>