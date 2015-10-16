<!-- Side Overlay-->
<aside id="side-overlay">
    <!-- Side Overlay Scroll Container -->
    <div id="side-overlay-scroll">
        <!-- Side Header -->
        <div class="side-header side-content">
            <!-- Layout API, functionality initialized in App() -> uiLayoutApi() -->
            <button class="btn btn-default pull-right" type="button" data-toggle="layout" data-action="side_overlay_close">
                <i class="fa fa-times"></i>
            </button>
            <span>
                <img class="img-avatar img-avatar32" src="{{ Auth::user()->photocss }}" alt="">
                <span class="font-w600 push-10-l">{{ Auth::user()->fullname }}</span>
            </span>
        </div>
        <!-- END Side Header -->

        <!-- Side Content -->
        <div class="side-content remove-padding-t">

            <!-- Notifications -->
            <div class="block pull-r-l" id="notifications-block" data-action="{{ $notificationsRoute }}">
                <div class="block-header bg-gray-lighter">
                    <ul class="block-options">
                         <li>
                            <button type="button" id="refresh-notifications-button"><i class="si si-refresh"></i></button>
                        </li>
                        <li>
                            <button type="button" data-toggle="block-option" data-action="content_toggle"></button>
                        </li>
                    </ul>
                    <h3 class="block-title">Recent Activity</h3>
                </div>
                <div class="block-content">
                    @if($notifications->count())
                        <!-- SlimScroll Container -->
                        <div data-toggle="slimscroll" data-height="300px" data-always-visible="true">
                           <ul class="list list-activity push" id="notifications-container">
                                @foreach($notifications as $notification)
                                    <li>
                                        @if($notification->type == 'donation.created')
                                            <i class="si si-wallet text-success"></i>
                                        @elseif($notification->type == 'donor.created')
                                            <i class="si si-plus text-success"></i>
                                        @elseif($notification->type == 'donation.assigned')
                                            <i class="si si-pencil text-info"></i>
                                        @elseif($notification->type == 'donation.successful')
                                            <i class="si si-check text-success"></i>
                                        @elseif($notification->type == 'donation.cancelled')
                                            <i class="si si-close text-danger"></i>
                                        @else
                                            <i class="si si-close text-danger"></i>
                                        @endif
                                        <div class="font-w600">{{ $notification->title }}</div>
                                        <div>{{ $notification->description }}</div>
                                        <div><small class="text-muted">{{ $notification->happened_at->diffForHumans() }}</small></div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- END SlimScroll Container -->
                    @else
                        <div class="alert alert-info">
                            <p>There are no notifications to display.</p>
                        </div>
                    @endif
                </div>
            </div>
            <!-- END Notifications -->
           

            @if(Auth::user()->hasRole('Manager'))
                <!-- Best Performer of the month -->
                @if(isset($teamleader) && $teamleader)
                    <div class="block pull-r-l">
                        <div class="block-header bg-gray-lighter">
                            <ul class="block-options">
                                <li>
                                    <button type="button" data-toggle="block-option" data-action="content_toggle"></button>
                                </li>
                            </ul>
                            <h3 class="block-title">Best permormer <small>(Monthly)</small></h3>
                        </div>
                        <div class="block-content block-content-full text-center bg-image" style="background-image: url('/assets/img/photos/photo2.jpg');">
                            <div>
                                <img class="img-avatar img-avatar96 img-avatar-thumb" src="{{ $teamleader->photocss }}" alt="">
                            </div>
                            <div class="h5 text-white push-15-t push-5">{{$teamleader->fullname}}</div>
                            <div class="h5 text-white-op">{{ $teamleader->designation }}</div>
                        </div>
                        <div class="block-content text-center">
                            <div class="row items-push">
                                <div class="col-xs-6">
                                    <div class="h3 push-5">{{ $teamleader->total_donations }}</div>
                                    <div class="h5 font-w300 text-muted">Donations</div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="h3 push-5">₹ {{ $teamleader->total_earnings }}</div>
                                    <div class="h5 font-w300 text-muted">Raised</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <!-- END Best Performer of the month -->
            @endif
        </div>
        <!-- END Side Content -->
    </div>
    <!-- END Side Overlay Scroll Container -->
</aside>
<!-- END Side Overlay -->       