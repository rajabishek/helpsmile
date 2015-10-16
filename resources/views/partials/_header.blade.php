<header id="header-navbar" class="content-mini content-mini-full">
    <!-- Header Navigation Right -->
    <ul class="nav-header pull-right">
        <li>
            <div class="btn-group">
                <button class="btn btn-default btn-image dropdown-toggle" data-toggle="dropdown" type="button">
                    <img src="{{ Auth::user()->photocss }}" alt="Avatar">
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li>
                        <a tabindex="-1" href="{{ route(Auth::user()->getSettingsRoute(),$domain) }}">
                            <i class="si si-settings pull-right"></i>Settings
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li class="dropdown-header">Actions</li>
                    <li>
                        <a tabindex="-1" href="{{route('auth.logout',$domain)}}">
                            <i class="si si-logout pull-right"></i>Log out
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        @if(Request::url() == route(Auth::user()->getHomeRoute(),$domain))
            <li>
                <!-- Layout API, functionality initialized in App() -> uiLayoutApi() -->
                <button class="btn btn-default" data-toggle="layout" data-action="side_overlay_toggle" type="button">
                    <i class="fa fa-tasks"></i>
                </button>
            </li>
        @endif
    </ul>
    <!-- END Header Navigation Right -->

    <!-- Header Navigation Left -->
    <ul class="nav-header pull-left">
        <li class="hidden-md hidden-lg">
            <!-- Layout API, functionality initialized in App() -> uiLayoutApi() -->
            <button class="btn btn-default" data-toggle="layout" data-action="sidebar_toggle" type="button">
                <i class="fa fa-navicon"></i>
            </button>
        </li>
        <li class="hidden-xs hidden-sm">
            <!-- Layout API, functionality initialized in App() -> uiLayoutApi() -->
            <button class="btn btn-default" data-toggle="layout" data-action="sidebar_mini_toggle" type="button">
                <i class="fa fa-ellipsis-v"></i>
            </button>
        </li>
        <li class="visible-xs">
            <!-- Toggle class helper (for .js-header-search below), functionality initialized in App() -> uiToggleClass() -->
            <button class="btn btn-default" data-toggle="class-toggle" data-target=".js-header-search" data-class="header-search-xs-visible" type="button">
                <i class="fa fa-search"></i>
            </button>
        </li>
    </ul>
    <!-- END Header Navigation Left -->
</header>