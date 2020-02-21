<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <div class="container">
        <div class="row">
            <!-- Left navbar links -->
            <div class="col-6 col-md-4">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="index3.html" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="#" class="nav-link">Contact</a>
                    </li>
                </ul>
                <!-- SEARCH FORM -->
            </div>

                       <!-- Right navbar links -->
            <div class="col-6 col-md-4 mr-0">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">My profile
                        <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                    <li><a href="{{route('users.profile')}}">Profile</a></li>
                        <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();" class="d-block">Logout</a></li>
                    </ul>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</nav>
