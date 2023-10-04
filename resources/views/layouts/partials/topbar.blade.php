
<header class="topbar" data-navbarbg="skin5">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header" data-logobg="skin6">
            
            <a class="navbar-brand" href="{{ route('home') }}"> 
                <img class="logo-icon" src="{{ asset('assets/images/logo.png') }}" alt="homepage" />
                <span class="logo-text"> 
                    <span>Al-noor</span> Traders
                </span>
            </a>            
            <a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none"
                href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
        </div>
        
        
        <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
            
            <ul class="navbar-nav ms-auto d-flex align-items-center">
                <li class=" in">
                        <a class="text-light me-4" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form> 
                </li>
 
                {{-- <li class=" in">
                    <form role="search" class="app-search d-none d-md-block me-3">
                        <input type="text" placeholder="Search..." class="form-control mt-0">
                        <a href="" class="active">
                            <i class="fa fa-search"></i>
                        </a>
                    </form>
                </li> --}}
         
                
                <li>
                    <a class="profile-pic" href="#">
                        <img src="{{ asset('assets/plugins/images/users/varun.jpg') }}" alt="user-img" width="36"
                            class="img-circle"><span class="text-white font-medium">
                                @if (Auth::user())
                                    
                                {{ Auth::user()->name }}
                                @endif
                            </span></a>
                </li>
                
            </ul>
        </div>
    </nav>
</header>