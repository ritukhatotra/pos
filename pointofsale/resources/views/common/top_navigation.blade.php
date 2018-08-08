<div class="overlay hidden-print"></div>
<div class="top-bar hidden-print">
    <nav class="navbar navbar-default top-bar">
        <div class="menu-bar-mobile" id="open-left"><i class="ti-menu"></i></div>
        @include('common.tagline')
        <ul class="nav navbar-nav navbar-right top-elements">
            <li class="dropdown">
                <a  href="#" class="dropdown-toggle language-dropdown" data-toggle="dropdown" role="button" aria-expanded="false">
                    <img class="flag_img" src="{{asset('public/images/english.png')}}" alt="">
                    <span class="hidden-sm hidden-xs"> English</span>
                    <span class="drop-icon"><i class="ion ion-chevron-down"></i></span>
                </a>
                <ul class="dropdown-menu animated fadeInUp wow language-drop neat_drop animated" data-wow-duration="1500ms" role="menu">
                    <li><a href="#"><img class="flag_img" src="{{asset('public/images/english.png')}}" alt="">English</a> </li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    <i class="ion-ios-bell-outline  icon-notification"></i>
                    <span class="badge info-number count " id="unread_message_count">0</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right animated fadeInUp wow message_drop neat_drop animated" data-wow-duration="1500ms" role="menu">
                    <li class="bottom-links"><a href="#" class="last_info">All Messages</a></li>
                    <li class="bottom-links"><a href="#" class="last_info">Sent Messages</a></li>
                    <li class="bottom-links"><a href="#" class="last_info">New Message</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle avatar_width" data-toggle="dropdown" role="button" aria-expanded="false">
                    <span class="avatar-holder">
                        <img src="{{asset('public/images/avatar-default.jpg')}}" alt="">
                    </span>
                    <span class="avatar_info visible-sm visible-md visible-lg">{{ucfirst(Auth::user()->first_name)}} {{ucfirst(Auth::user()->last_name)}}</span></a>
                <ul class="dropdown-menu user-dropdown animated fadeInUp wow avatar_drop neat_drop animated" data-wow-duration="1500ms" role="menu">
                    <li><a id="support_link" href="#"><i class="ion-help-buoy"></i><span class="text">Support/Documentation</span></a></li>
                    <li><a href="#"><i class="ion-android-settings"></i><span class="text">Settings</span></a></li>
                    <li><a id="switch_user" href="#"><i class="ion-ios-toggle-outline"></i><span class="text">Switch User</span></a></li>
                    <li><a href="#"><i class="ion-edit"></i><span class="text">Edit profile</span></a></li>
                    <li>
                        <a href="{{url('admin/logout')}}" class="logout_button">
                            <i class="ion-power"></i>
                            <span class="text">Logout</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</div>
