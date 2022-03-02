<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Asosiasi Futsal Kabupaten Sumenep</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="{{asset('assets/sumenep.png')}}" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{asset('css/styles.css')}}" rel="stylesheet" />
       
    </head>
    <style>
        .dropbtn {
          color: white;
          padding: 16px;
          font-size: 16px;
          border: none;
        }
        
        .dropdown {
          position: relative;
          display: inline-block;
        }
        
        .dropdown-content {
          display: none;
          position: absolute;
          background-color: #f1f1f1;
          min-width: 160px;
          box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
          z-index: 1;
        }
        
        .dropdown-content a {
          color: #032A63;
          padding: 12px 16px;
          text-decoration: none;
          display: block;
        }
        
        .dropdown-content a:hover {background-color: #ddd;}
        
        .dropdown:hover .dropdown-content {display: block;}
        
        .dropdown:hover .dropbtn {background-color: #032A63;}
        </style>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg text-uppercase fixed-top" id="mainNav" style="background-color: #032A63;">
            <div class="container">
                <a class="navbar-brand" href="{{ url('home'); }}"><img src="{{asset('assets/img/logosumenep.png')}}" style=" height: 50px;"> AFKAB</a>
                
                <button class="navbar-toggler text-uppercase font-weight-bold bg-secondary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{ url('home') }}">Home</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{ url('profile') }}">Profil</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{ url('strukturafkab'); }}">Struktur Organisasi</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{ url('peraturan'); }}">Peraturan</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{ url('layanan'); }}">Layanan</a></li>
                        @if (\Auth::user())
                        <div class="dropdown">
                            <li class="nav-item mx-0 mx-lg-1"><a class="dropbtn nav-link py-3 px-0 px-lg-3 rounded" href="">{{Auth::user()->username}}</a></li>
                            <div class="dropdown-content">
                                @if(\Auth::user()->role_id !== "admin")
                                    @if(\Auth::user()->role_id === "klub")
                                        <a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{route('klub.dashboard')}}">My Profile</a>
                                        <a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{route('changePasswordKlub')}}">Change Password</a>
                                        <a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{route('klub.messageAdmin')}}">Message</a>
                                    @endif
                                    @if(\Auth::user()->role_id === "pemain")
                                        <a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{route('isPemain.dashboard')}}">My Profile</a>
                                        <a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{route('changePasswordPemain')}}">Change Password</a>
                                        <a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{route('pemain.messageAdmin')}}">Message</a>
                                    @endif
                                    
                                    <a class="nav-link py-3 px-0 px-lg-3 rounded" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout </a>
                                @else
                                    <a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{route('admin.dashboard')}}">Access Control</a>
                                    <a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{route('messageAdmin')}}">Message</a>
                                    <a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{route('changePassword')}}">Change Password</a>
                                    <a class="nav-link py-3 px-0 px-lg-3 rounded" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout </a>
                                @endif
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </div>
                        @else
                            <li class="nav-item mx-0 mx-lg-1"><a class="nav-link py-3 px-0 px-lg-3 rounded" href="{{ url('login'); }}">Login</a></li>
                        @endif
                        
                    </ul>
                </div>
            </div>
        </nav>
        
        <section class="page-section portfolio" id="portfolio">
            <div class="container">
                <!-- ISI KONTAINER -->
                @yield("content")
                
            </div>
                
        </section>
       
        <!-- Footer-->
        <footer class="footer text-center">
            <div class="container">
                <div class="row">
                    <!-- Footer Location-->
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <h4 class="text-uppercase mb-4">Location</h4>
                        <p class="lead mb-0">
                            Sekretariat : Jl. Urip Sumoharjo Sumenep
                            <br />
                            Telp. 08235911152
                            <br />
                            Email : afkabsumenep@gmail.com
                        </p>
                    </div>
                    <!-- Footer Social Icons-->
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <h4 class="text-uppercase mb-4">Around the Web</h4>
                        <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social mx-1" href="#!"><i class="fab fa-fw fa-instagram"></i></a>
                    </div>
                    <!-- Footer About Text-->
                    <div class="col-lg-4">
                        <h4 class="text-uppercase mb-4">WEBSITE RESMI AFKAB</h4>
                        <p class="lead mb-0">
                            Asosiasi Futsal Kabupaten Sumenep
                            
                        </p>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Copyright Section-->
        <div class="copyright py-4 text-center text-white">
            <div class="container"><small>Copyright &copy; Your Website 2021</small></div>
        </div>
        <!-- Portfolio Modals-->
               
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
        
    </body>
</html>
