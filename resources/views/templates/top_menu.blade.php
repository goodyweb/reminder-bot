<nav class="navbar top-navbar" style="background-color: #FFD20A">
    <div class="container">
        <div class="navbar-content">
            <a href="#" class="navbar-brand" style="color: black">
                GOODY<span><b>Reminder</b></span>
            </a>
            <form class="search-form">
                <div class="input-group">
                    <div class="input-group-text">
                        <i data-feather="search"></i>
                    </div>
                    <input type="text" class="form-control" id="navbarForm" placeholder="Search here...">
                </div>
            </form>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="flag-icon flag-icon-us mt-1" title="us"></i> <span class="ms-1 me-1 d-none d-md-inline-block"></span>
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="{{url('profile')}}">
                        <i data-feather="user"></i>
                        <div class="indicator">
                            <div class="circle"></div>
                        </div>
                    </a>
                </li>
                <!--<li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="appsDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i data-feather="user"></i>
                        <div class="indicator">
                            <div class="circle"></div>
                        </div>
                    </a>
                    <div class="dropdown-menu p-0 align-items-center" aria-labelledby="appsDropdown">
                        <div class="row g-0 p-0">
                            <div class="col-3 text-center">
                                <a href="{{url('profile')}}" class="dropdown-item d-flex flex-column align-items-center justify-content-center wd-70 ht-70"><i data-feather="user" class="icon-lg mb-1"></i><p class="tx-12">Edit Profile</p></a>
                            </div>
                        </div>
                    </div>
                </li>-->

                
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="wd-30 ht-30 rounded-circle" src="{{asset('img/bg-login.jpg')}}" alt="profile">
                    </a>
                    <div class="dropdown-menu p-0" aria-labelledby="profileDropdown">
                        <div class="d-flex flex-column align-items-center border-bottom px-5 py-3">
                            <div class="mb-3">
                                <img class="wd-80 ht-80 rounded-circle" src="{{asset('img/bg-login.jpg')}}" alt="">
                            </div>
                            <div class="text-center">
                                <p class="tx-16 fw-bolder">{{ Auth::user()->name }}</p>
                                <p class="tx-12 text-muted">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                        <ul class="list-unstyled p-1">
                            <li class="dropdown-item py-2">
                               
                                   
                                   
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <i class="me-2 icon-md" data-feather="log-out"></i>
                            <x-dropdown-link 
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                               Log Out
                            </x-dropdown-link>
                        </form>
                                    
                             
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
                <i data-feather="menu"></i>
            </button>
        </div>
    </div>
</nav>
