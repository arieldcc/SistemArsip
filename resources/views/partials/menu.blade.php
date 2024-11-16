<div class="list-group list-group-flush">
    <a href="/" class="list-group-item list-group-item-action">
        <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
    </a>

    <!-- Menu khusus Admin -->
    @auth
        @if(Auth::user()->level == 'admin')
            <a href="/bagian" class="list-group-item list-group-item-action">
                <i class="fas fa-users mr-2"></i> Bagian
            </a>
            <a href="/surat-masuk" class="list-group-item list-group-item-action">
                <i class="fas fa-envelope-open-text mr-2"></i> Surat Masuk
            </a>
            <a href="/surat-keluar" class="list-group-item list-group-item-action">
                <i class="fas fa-paper-plane mr-2"></i> Surat Keluar
            </a>
            <!-- Menu Manajemen User -->
            {{-- <a href="/user-management" class="list-group-item list-group-item-action">
                <i class="fas fa-user-cog mr-2"></i> Manajemen User
            </a> --}}
        @endif

        <!-- Menu untuk Admin dan Pimpinan -->
        @if(Auth::user()->level == 'admin' || Auth::user()->level == 'pimpinan')
            <a href="/disposisi" class="list-group-item list-group-item-action">
                <i class="fas fa-clipboard-list mr-2"></i> Disposisi
            </a>
            <a href="/arsip" class="list-group-item list-group-item-action">
                <i class="fas fa-archive mr-2"></i> Arsip
            </a>
            <a href="/laporan" class="list-group-item list-group-item-action">
                <i class="fas fa-chart-line mr-2"></i> Laporan
            </a>
        @endif
    @endauth

    <!-- Pemisah -->
    <hr class="my-2">

    <!-- Menu Login/Logout -->
    @guest
        <a href="{{ route('login') }}" class="list-group-item list-group-item-action">
            <i class="fas fa-sign-in-alt mr-2"></i> Login
        </a>
    @else

        @if(Auth::user()->level == 'admin')
            <!-- Menu Manajemen User -->
            <a href="/user-management" class="list-group-item list-group-item-action">
                <i class="fas fa-user-cog mr-2"></i> Manajemen User
            </a>
        @endif

        <a href="{{ route('logout') }}" class="list-group-item list-group-item-action"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt mr-2"></i> Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    @endguest
</div>
