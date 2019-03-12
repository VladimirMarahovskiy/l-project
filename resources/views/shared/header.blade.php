<!-- Header -->
<header id="header">
    <!-- Nav -->
    <div id="nav">
        <!-- Main Nav -->
        <div id="nav-fixed">
            <div class="container">
                <!-- logo -->
                <div class="nav-logo">
                    <a href="/" class="logo"><img width="200px" src="/img/logo.gif" alt=""></a>
                </div>
                <!-- /logo -->

                <!-- nav -->
                <ul class="nav-menu nav navbar-nav">

                    @php
                        use App\Http\Controllers\SiteController;
                        echo SiteController::show();
                    @endphp

                </ul>
                <!-- /nav -->

                <!-- search & aside toggle -->
                <div class="nav-btns">
                    <button class="aside-btn"><i class="fa fa-bars"></i></button>


                </div>
                <!-- /search & aside toggle -->
            </div>
        </div>
        <!-- /Main Nav -->

        <!-- Aside Nav -->
        <div id="nav-aside">
            <!-- nav -->
            <div class="section-row">
                <ul class="nav-aside-menu">
                    <li class="language">
                        <a href="{{ route('setlocale',['lang'=>'ru']) }}"
                           class="<?= \App\Http\Middleware\Locale::getLocale() === 'ru' ? 'active' : '' ?>">
                            </i> {{ __('base.Ru') }}
                        </a>
                        <a href="{{ route('setlocale',['lang'=>'en']) }}"
                           class="<?= \App\Http\Middleware\Locale::getLocale() === null ? 'active' : '' ?>">
                            {{ __('base.En') }}
                        </a>
                    </li>
                    <li>
                        {{ link_to_route('backpack.dashboard', __('dashboard.dashboard'), [], ['class' => 'nav-link']) }}
                    </li>
                    @guest
                        <li class="nav-item">{{ link_to_route('login', __('auth.login'), [], ['class' => 'nav-link']) }}</li>
                        <li class="nav-item">{{ link_to_route('register', __('auth.register'), [], ['class' => 'nav-link']) }}</li>
                    @else
                    @endguest
                </ul>
            </div>
            <!-- /nav -->

            <!-- aside nav close -->
            <button class="nav-aside-close"><i class="fa fa-times"></i></button>
            <!-- /aside nav close -->
        </div>
        <!-- Aside Nav -->
    </div>
    <!-- /Nav -->
</header>
<!-- /Header -->
