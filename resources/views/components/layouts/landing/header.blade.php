<header class="header header-secondary">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="main-header__menu-box">
                    <nav class="navbar p-0">
                        <div class="navbar-logo">
                            <a href="index.html">
                                <img src="{{ asset('assets/images/logo.png') }}" alt="Image">
                            </a>
                        </div>
                        <div class="navbar__menu-wrapper">
                            <div class="navbar__menu d-none d-xl-block">
                                <ul class="navbar__list">
                                    <li class="navbar__item nav-fade">
                                        <a href="/">Home</a>
                                    </li>
                                    <li class="navbar__item nav-fade">
                                        <a href="#aboutSection">Tentang Kami</a>
                                    </li>
                                    <li class="navbar__item nav-fade">
                                        <a href="#causeSection">Cek Bantuan</a>
                                    </li>
                                    <li class="navbar__item nav-fade">
                                        <a href="#eventSection">Event</a>
                                    </li>
                                    <li class="navbar__item nav-fade">
                                        <a href="#teamSection">Team</a>
                                    </li>
                                    <li class="navbar__item nav-fade">
                                        <a href="#blogSection">Blog</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="contact-btn">
                                <div class="contact-icon">
                                    <i class="icon-support"></i>
                                </div>
                                <div class="contact-content">
                                    <p>Hubungi Kami</p>
                                    <a href="tel:01-793-7938">(+62)-7933-7938-2344 </a>
                                </div>
                            </div>
                        </div>
                        <div class="navbar__options">
                            <div class="navbar__mobile-options ">
                                <div class="search-box">
                                    <button class="open-search" aria-label="search products"
                                            title="open search box">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                                <a href="{{ route('filament.admin.auth.login') }}"
                                   class="btn--primary d-none d-md-flex">Daftar Sekarang <i
                                        class="fa-solid fa-arrow-right"></i></a>
                            </div>
                            <button class="open-offcanvas-nav d-flex d-xl-none" aria-label="toggle mobile menu"
                                    title="open offcanvas menu">
                                <span class="icon-bar top-bar"></span>
                                <span class="icon-bar middle-bar"></span>
                                <span class="icon-bar bottom-bar"></span>
                            </button>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
