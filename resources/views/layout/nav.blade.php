<nav class="navbar navbar-light bg-light">
    @if (auth()->user()->role == 'pustakawan')
    <a class="navbar-brand p-2" href="{{ route('home') }}">
        Welcome, {{ auth()->user()->name }}!
    </a>
    @endif
    @if (auth()->user()->role == 'admin')
    <a class="navbar-brand p-2" href="{{ route('home.admin') }}">
        Welcome, {{ auth()->user()->name }}!
    </a>
    @endif
    <div class="d-flex">
        <a href="{{ route('keranjang') }}" class="nav-link text-dark">Keranjang</a>
        <a href="{{ route('history') }}" class="nav-link text-dark">History Pembelian</a>
        <a href="{{ route('log') }}" class="nav-link text-dark">Aktivitas Terakhir</a>
        <a href="{{ route('logout') }}" class="nav-link text-dark" onclick="return confirm('Yakin akan logout?')">Logout</a>
    </div>
</nav>
