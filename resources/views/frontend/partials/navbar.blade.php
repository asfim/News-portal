<!-- MAIN NAVIGATION BAR -->
<nav class="navbar navbar-expand-lg sticky-nav py-0">
    <div class="container-fluid px-lg-5">
        <button class="navbar-toggler my-2 border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa-solid fa-bars-staggered fs-3 text-dark"></i>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 fw-bold">
                <li class="nav-item">
                    <a class="nav-link-custom {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        <i class="fa-solid fa-house me-1"></i> হোম
                    </a>
                </li>
                @foreach(getMenus() as $menu)
                    <li class="nav-item">
                        <a class="nav-link-custom" href="{{ $menu->url }}" target="{{ $menu->target }}">{{ $menu->name }}</a>
                    </li>
                @endforeach
            </ul>

            <div class="d-none d-lg-block">
                <div class="dropdown">
                    <button class="btn btn-link text-reset text-decoration-none fw-bold dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        আরও
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-3 p-2">
                        <li><a class="dropdown-item rounded-2 py-2" href="#"><i class="fa-solid fa-leaf me-2 text-success"></i> পরিবেশ</a></li>
                        <li><a class="dropdown-item rounded-2 py-2" href="#"><i class="fa-solid fa-graduation-cap me-2 text-info"></i> শিক্ষা</a></li>
                        <li><a class="dropdown-item rounded-2 py-2" href="#"><i class="fa-solid fa-comments me-2 text-warning"></i> মতামত</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item rounded-2 py-2 fw-bold text-danger" href="#"><i class="fa-solid fa-bolt me-2"></i> ই-পেপার</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
