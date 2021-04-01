<ul class="sidebar-menu">

    {{-- Dashboard --}}
    <li class="header"><strong>MAIN NAVIGATION</strong></li>
    <li class="treeview"><a href="{{route('dashboard')}}">
        <i class="icon icon-sailing-boat-water purple-text s-18"></i> <span>Dashboard</span>
        <i class="icon icon-angle-right s-18 pull-right"></i>
    </a>
    </li>


    {{-- master role/permission --}}
    @can('Admin')

    <li class="header light"><strong>MASTER ROLE</strong></li>
    <li>
        <a href="{{route('MasterRole.role.index')}}">
            <i class="icon icon-key4 amber-text s-18"></i> <span>Role</span>
            <i class="icon icon-angle-right s-18 pull-right"></i>
        </a>
    </li>
    <li class="no-b">
        <a href="{{route('MasterRole.permissions.index')}}">
            <i class="icon icon-clipboard-list2 text-success s-18"></i> <span>Permission</span>
            <i class="icon icon-angle-right s-18 pull-right"></i>
        </a>
    </li>
    <li>
        <a href="{{route('MasterRole.pengguna.index')}}"><i class="icon icon-user blue-text s-18"></i>
        <span>Pengguna</span>
        <i class="icon icon-angle-right s-18 pull-right"></i>
        </a>
    </li>

    @endcan

    @can('Umum')
    {{-- Data Kas Kita --}}
    <li class="header light"><strong>DATA KAS KITA</strong></li>

    <li>
        <a href="{{route('Data.anggota.index')}}"><i class="icon icon-users blue-text s-18"></i>
        <span>Anggota</span>
        <i class="icon icon-angle-right s-18 pull-right"></i>
        </a>
    </li>

    <li>
        <a href="{{route('Data.kasMasuk.index')}}"><i class="icon icon-sign-in blue-text s-18"></i>
        <span>Kas Masuk</span>
        <i class="icon icon-angle-right s-18 pull-right"></i>
        </a>
    </li>

    <li>
        <a href="{{route('Data.kasKeluar.index')}}"><i class="icon icon-sign-out blue-text s-18"></i>
        <span>Kas Keluar</span>
        <i class="icon icon-angle-right s-18 pull-right"></i>
        </a>
    </li>

    <li class="treeview ">
        <a href="#">
            <i class="header icon icon-list blue-text s-18"></i> <span>Laporan</span>
            <i class="icon icon-angle-left s-18 pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li>
                <a href="{{route('Laporan.Masuk')}}">
                    <i class="icon icon-circle-o blue-text s-10"></i>
                    Kas Masuk
                <i class="icon icon-angle-right s-18 pull-right"></i>
                </a>
            </li>
            <li>
                <a href="{{route('Laporan.Keluar')}}">
                    <i class="icon icon-circle-o blue-text s-10"></i>Kas Keluar
                    <i class="icon icon-angle-right s-18 pull-right"></i>
                </a>
            </li>
            <li>
                <a href="{{route('Laporan.Rekafitulasi')}}">
                    <i class="icon icon-circle-o blue-text s-10"></i>Rekapitulasi Kas
                </a>
            </li>
        </ul>
    </li>
    @endcan

    <li class="header light"><strong></strong></li>
</ul>
