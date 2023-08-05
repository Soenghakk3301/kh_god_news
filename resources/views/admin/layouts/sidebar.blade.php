<div class="navbar-bg"></div>
@include('admin.layouts.navbar')
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown active">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-fire"></i><span>Dashboard</span></a>
                <ul class="dropdown-menu">
                    <li class="active">
                        <a class="nav-link" href="index-0.html">General Dashboard</a>
                    </li>
                    <li>
                        <a class="nav-link" href="index.html">Ecommerce Dashboard</a>
                    </li>
                </ul>
            </li>
            <li class="menu-header">Starter</li>

            <li>
                <a class="nav-link" href="{{ route('admin.category.index') }}"><i class="far fa-square"></i>
                    <span>Category</span></a>
            </li>

            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-th"></i>
                    <span>News</span></a>
                <ul class="dropdown-menu">

                    <li>
                        <a class="nav-link" href="{{ route('admin.news.index') }}">All News</a>
                    </li>
                    <li>
                        <a class="nav-link" href="bootstrap-collapse.html">Collapse</a>
                    </li>
                    <li>
                        <a class="nav-link" href="bootstrap-dropdown.html">Dropdown</a>
                    </li>

                </ul>
            </li>

            <li>
                <a class="nav-link" href="{{ route('admin.social-count.index') }}"><i class="far fa-square"></i>
                    <span>Social Count</span></a>
            </li>

            <li>
                <a class="nav-link" href="{{ route('admin.home-section-setting.index') }}"><i class="far fa-square"></i>
                    <span>Home Section Setting</span></a>
            </li>

            <li>
                <a class="nav-link" href="{{ route('admin.ad.index') }}"><i class="far fa-square"></i>
                    <span>Advertisment</span></a>
            </li>

            <li>
                <a class="nav-link" href="{{ route('admin.language.index') }}"><i class="far fa-square"></i>
                    <span>Languages</span></a>
            </li>

            <li>
                <a class="nav-link" href="{{ route('admin.subscribers.index') }}"><i class="far fa-square"></i>
                    <span>Subscribers</span></a>
            </li>

            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-th"></i>
                    <span>Footer Setting</span></a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="nav-link" href="{{ route('admin.social-link.index') }}">Social Links</a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('admin.footer-info.index') }}">Footer Info</a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('admin.footer-grid-one.index') }}">Footer Grid One</a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('admin.footer-grid-two.index') }}">Footer Grid Two</a>
                    </li>
                    <li>
                        <a class="nav-link" href="{{ route('admin.footer-grid-three.index') }}">Footer Grid Three</a>
                    </li>
                </ul>
            </li>

            {{-- <li>
                <a class="nav-link" href="blank.html"><i class="far fa-square"></i>
                    <span>Blank Page</span></a>
            </li> --}}

            {{-- <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-th"></i>
                    <span>Bootstrap</span></a>
                <ul class="dropdown-menu">

                    <li>
                        <a class="nav-link" href="bootstrap-carousel.html">Carousel</a>
                    </li>
                    <li>
                        <a class="nav-link" href="bootstrap-collapse.html">Collapse</a>
                    </li>
                    <li>
                        <a class="nav-link" href="bootstrap-dropdown.html">Dropdown</a>
                    </li>

                </ul>
            </li> --}}

        </ul>
    </aside>
</div>
