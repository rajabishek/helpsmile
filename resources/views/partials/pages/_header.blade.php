<!-- Header -->
<header id="header-navbar" class="content-mini content-mini-full">
    <div class="content-boxed">
        <!-- Header Navigation Right -->
        <ul class="nav-header pull-right">
            <li class="hidden-md hidden-lg">
                <!-- Toggle class helper (for main header navigation below in small screens), functionality initialized in App() -> uiToggleClass() -->
                <button class="btn btn-link text-white pull-right" data-toggle="class-toggle" data-target=".js-nav-main-header" data-class="nav-main-header-o" type="button">
                    <i class="fa fa-navicon"></i>
                </button>
            </li>
        </ul>
        <!-- END Header Navigation Right -->

        <!-- Main Header Navigation -->
        <ul class="js-nav-main-header nav-main-header pull-right">
            <li class="text-right hidden-md hidden-lg">
                <!-- Toggle class helper (for main header navigation in small screens), functionality initialized in App() -> uiToggleClass() -->
                <button class="btn btn-link text-white" data-toggle="class-toggle" data-target=".js-nav-main-header" data-class="nav-main-header-o" type="button">
                    <i class="fa fa-times"></i>
                </button>
            </li>
            {!! Navigation::make(null,Request::path(),'homemenu') !!}
        </ul>
        <!-- END Main Header Navigation -->

        <!-- Header Navigation Left -->
        <ul class="nav-header pull-left">
            <li class="header-content">
                <a class="h5" href="frontend_home.html">
                    <i class="fa fa-circle-o-notch text-primary"></i> <span class="h4 font-w600 text-white">ne</span>
                </a>
            </li>
        </ul>
        <!-- END Header Navigation Left -->
    </div>
</header>
<!-- END Header -->