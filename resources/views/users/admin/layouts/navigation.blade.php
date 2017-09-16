<style type="text/css">
    .brand-logo{
        font-weight:900;
    }

    .dropdown-content {
        background-color: #FFFFFF;
        margin: 0;
        display: none;
        min-width: 300px; /* Changed this to accomodate content width */
        max-height: auto;
        margin-left: -1px; /* Add this to keep dropdown in line with edge of navbar */
        overflow: hidden; /* Changed this from overflow-y:auto; to overflow:hidden; */
        opacity: 0;
        position: absolute;
        white-space: nowrap;
        z-index: 1;
        will-change: width, height;
    }
</style>

<div class="navbar navbar-transparent navbar-absolute">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
    </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">

                <li>
                    <a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="material-icons">dashboard</i>
                        <p class="hidden-lg hidden-md">Dashboard</p>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="material-icons">notifications</i>
                        <span class="notification">5</span>
                        <p class="hidden-lg hidden-md">Notifications</p>
                    </a>
                    <ul class="dropdown-menu">
                        <li><i class="material-icons">person</i></li>
                        <li><a href="#">You have 5 new tasks</a></li>
                        <li><a href="#">You're now friend with Andrew</a></li>
                        <li><a href="#">Another Notification</a></li>
                        <li><a href="#">Another One</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#pablo" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="material-icons">person</i>
                        <p class="hidden-lg hidden-md">Profile</p>
                        Tihomir
                    </a>
                    <ul class="dropdown-menu">
                        <li><i class="material-icons">person</i></li>
                        <li><a href="#">Profile</a></li>
                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>

            <form class="navbar-form navbar-right" role="search">
                <div class="form-group  is-empty">
                    <input type="text" class="form-control" placeholder="Search">
                    <span class="material-input"></span>
                </div>
                <button type="submit" class="btn btn-white btn-round btn-just-icon">
                    <i class="material-icons">search</i><div class="ripple-container"></div>
                </button>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    (function($) {
        $(function() {

            $('.dropdown-button').dropdown({
                    inDuration: 300,
                    outDuration: 225,
                    hover: true, // Activate on hover
                    belowOrigin: true, // Displays dropdown below the button
                    alignment: 'right' // Displays dropdown with edge aligned to the left of button
                }
            );

        }); // End Document Ready
    })(jQuery); // End of jQuery name space
</script>