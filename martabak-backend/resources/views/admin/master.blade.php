<!DOCTYPE html>
<html>
    <head>
        @yield('title')
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="noindex,nofollow,nosnippet,noodp,noarchive,noimageindex,none">
        <meta name="googlebot" content="noindex,nofollow,nosnippet,noodp,noarchive,noimageindex,none">
        <!-- <link href='https://fonts.googleapis.com/css?family=Roboto:100' rel='stylesheet' type='text/css'> -->
        <link rel="stylesheet" href="/martabak-frontend/admin/assets/stylesheets/bootstrap/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="/martabak-frontend/admin/assets/stylesheets/theme.css" type="text/css">
        <link rel="stylesheet" href="/martabak-frontend/admin/assets/stylesheets/master.layout.css" type="text/css">
        <script src="/martabak-frontend/admin/assets/scripts/jquery.js"></script>
        <script src="/martabak-frontend/admin/assets/scripts/master.js"></script>
        @yield('style')
    </head>
    <body style="background: rgb(250, 250, 250); margin: 0">
        <input id="theme-color" type="hidden" value="{{ $themeColor }}">
        <!-- Start header -->
        <div id="header" class="bg-{{ $themeColor }} white container-fluid auto {{ $themeColor }}-header {{ $layout->header_position }}">
            <div id="header-top-right" class="right auto">
                <img class="pic user-pic-header right" src="{{ $dir->url('pictures') }}/{{ Auth::user()->profile_picture }}" alt="">
                <div id="user-box-header" class="right auto">
                    <p class="right"><strong>{{ Auth::user()->username }}</strong></p>
                    <br>
                    <a class="right" href="/logout">Sign out</a>
                </div>
                <div id="separator-header" class="separator right auto">
                </div>
                <h1 class="right">@yield('header-title')</h1>
            </div>
            <div id="header-top-left" class="left auto">
                <a href="/"><img id="site-icon" class="pic user-pic-header left" src="/martabak-frontend/admin/assets/icons/site.png" alt="" /></a>
            </div>
        </div>
        <!-- End header -->

        <!-- Start content -->
        <div class="main-content-{{ $layout->header_position }} main-content-{{ $layout->navigation_position }}">
            @yield('content')
        </div>
        <!-- End content -->

        <!-- Start navigation -->
        <div id="navigation" class="{{ $layout->navigation_position }}">
            <div class="main-navigation-layout-{{ $layout->header_position }}">
                <div class="navigation-layout">
                    <div id="nav-dash" class="navigation-wrapper {{ $themeColor }}-navigation-wrapper">
                        <img class="icon icon-navigation left" src="/martabak-frontend/admin/assets/icons/home.png" alt="Dashboard | Homeland">
                        <p>Dashboard</p>
                    </div>
                    <div id="in-dash" class="navigation-inner {{ $themeColor }}-navigation-inner">
                        <a href="{{ $route->homeland_route }}/dashboard"><p>- Overview</p></a>
                        <a href="{{ $route->homeland_route }}/notifications"><p>- Notifications</p></a>
                    </div>
                </div>
                <div class="navigation-layout">
                    <div id="nav-post" class="navigation-wrapper {{ $themeColor }}-navigation-wrapper">
                        <img class="icon icon-navigation left" src="/martabak-frontend/admin/assets/icons/post.png" alt="Posts | Homeland">
                        <p>Contents</p>
                    </div>
                    <div id="in-post" class="navigation-inner {{ $themeColor }}-navigation-inner">
                        <a href="{{ $route->homeland_route }}/posts"><p>- All posts</p></a>
                        <a href="{{ $route->homeland_route }}/create/post"><p>- Create post</p></a>
                        <a href="{{ $route->homeland_route }}/tags"><p>- Tags</p></a>
                        <a href="{{ $route->homeland_route }}/categories"><p>- Categories</p></a>
                    </div>
                </div>
                <div class="navigation-layout">
                    <div id="nav-media" class="navigation-wrapper {{ $themeColor }}-navigation-wrapper">
                        <img class="icon icon-navigation left" src="/martabak-frontend/admin/assets/icons/page.png" alt="Pages | Homeland">
                        <p>Media</p>
                    </div>
                    <div id="in-media" class="navigation-inner {{ $themeColor }}-navigation-inner">
                        <span class="media-click" value="open-picture"><p>- Pictures</p></span>
                    </div>
                </div>
                <div class="navigation-layout">
                    <div id="nav-page" class="navigation-wrapper {{ $themeColor }}-navigation-wrapper">
                        <img class="icon icon-navigation left" src="/martabak-frontend/admin/assets/icons/page.png" alt="Pages | Homeland">
                        <p>Pages</p>
                    </div>
                    <div id="in-page" class="navigation-inner {{ $themeColor }}-navigation-inner">
                        <a href="{{ $route->homeland_route }}/pages"><p>- All pages</p></a>
                        <a href="{{ $route->homeland_route }}/create/page"><p>- Create page</p></a>
                    </div>
                </div>
                <div class="navigation-layout">
                    <div id="nav-theme" class="navigation-wrapper {{ $themeColor }}-navigation-wrapper">
                        <img class="icon icon-navigation left" src="/martabak-frontend/admin/assets/icons/page.png" alt="Theme | Homeland">
                        <p>Themes</p>
                    </div>
                    <div id="in-theme" class="navigation-inner {{ $themeColor }}-navigation-inner">
                        <a href="{{ $route->homeland_route }}/theme/yours"><p>- Yours</p></a>
                        <a href="{{ $route->homeland_route }}/theme/options"><p>- Options</p></a>
                    </div>
                </div>
                <div class="navigation-layout">
                    <div id="nav-comment" class="navigation-wrapper {{ $themeColor }}-navigation-wrapper">
                        <img class="icon icon-navigation left" src="/martabak-frontend/admin/assets/icons/page.png" alt="Comment | Homeland">
                        <p>Comments</p>
                    </div>
                    <div id="in-comment" class="navigation-inner {{ $themeColor }}-navigation-inner">
                        <a href="{{ $route->homeland_route }}/comments"><p>- All comments</p></a>
                        <a href="{{ $route->homeland_route }}/commentators"><p>- <span class="inner-title">Commentators</span></p></a>
                    </div>
                </div>
                <div class="navigation-layout">
                    <div id="nav-set" class="navigation-wrapper {{ $themeColor }}-navigation-wrapper settings">
                        <img class="icon icon-navigation left" src="/martabak-frontend/admin/assets/icons/setting.png" alt="Settings | Homeland">
                        <p>Settings</p>
                    </div>
                    <div id="in-set" class="navigation-inner {{ $themeColor }}-navigation-inner">
                        <a href="{{ $route->homeland_route }}/setting/general"><p>- General</p></a>
                        <a href="{{ $route->homeland_route }}/setting/profile"><p>- Profile</p></a>
                        <a href="{{ $route->homeland_route }}/setting/routes"><p>- Routes</p></a>
                        <a href="{{ $route->homeland_route }}/setting/appearances"><p>- Appearances</p></a>
                    </div>
                    <div id="in-set" class="navigation-inner {{ $themeColor }}-navigation-inner">
                    </div>
                </div>
            </div>
        </div>
        <!-- End navigation -->

        <!-- Start footer -->
        <div id="footer" class="content text-center footer-{{ $layout->header_position }} footer-{{ $layout->navigation_position }}">
            <p class="smoke">Martabak &copy; 2016 <i>the website manager</i></p>
            <p class="smooth-smoke">Trademark of Dali Kewara</p>
        </div>
        <!-- End footer -->

        <!-- Start Media Menu -->
        <div id="load-media">
        </div>
        <!-- End Media Menu -->

        <!-- Index homeland, indicate the homeland. Not for removed -->
        {!! $indexHomeland !!}
    </body>
    @yield('script')
    <script type="text/javascript" src="{{ $dir->url('admin-scripts') }}/media.js"></script>
    <script type="text/javascript" src="{{ $dir->url('admin-scripts') }}/contents.js"></script>
    <!-- <script type="text/javascript" src="{{ $dir->url('admin-scripts') }}/media.js"></script>
    <script type="text/javascript" src="{{ $dir->url('admin-scripts') }}/settings.js"></script>
    <script type="text/javascript" src="{{ $dir->url('admin-scripts') }}/contents.js"></script> -->
</html>
