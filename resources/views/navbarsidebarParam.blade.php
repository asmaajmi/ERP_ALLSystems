<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/navbar.css')}}">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('css/crud.css')}}">


    <title>Ressource Humaine</title>
</head>
<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark ">
        <div class="container-fluid">
            <!--btn side bar(offcanvas) -->
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                <span class="navbar-toggler-icon" data-bs-target="#offcanvasExample"></span>
              </button>
            <!--btn side bar(offcanvas) -->
            <a class="navbar-brand fw-bold" href="#">AllSystems</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- les liens -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li  class="nav-item">
                        <a class="nav-link active" href="{{route('service.list')}}">Paramètres</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('emp.list')}}">RH</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="{{route('Produit.list')}}">Fabrication</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Achats</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Stock</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('Previson_Vente.list')}}">MRP2</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('ListeDesOrdresDeTravailDeMesure')}}">Qualité</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Vente</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Maintenance</a>
                    </li>
                </ul>
                <!-- bar de recherche -->
                <form id="topbarrecherche" >
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Rechercher" aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn " type="button" id="button-addon2"><i class="bi bi-search"></i></button>
                    </div>
                </form>
                <!-- connexion user -->
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle ps-3" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person-fill"></i> Voir Profil</a></li>
                            <li><a class="dropdown-item" href="{{url('/')}}"><i class="bi bi-box-arrow-right"></i> Déconnecter</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- navbar -->
    <!-- side bar -->
    <div class="offcanvas offcanvas-start text-white sidebar-nav" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-body px-2">
            <nav class="navbar-dark">
                <ul class="navbar-dark-ul mt-2">
                    <li>
                        <a href="/accueil" class="nav-link px-0">
                            <span class="me-1">
                        <i class="bi bi-house-fill sideicon"></i>
                       </span>
                            <span class="txtsidebar">Accueil</span>
                        </a>
                    </li>
                    <li class="{{'RH/employe' == request()->path() ? 'active' : ''}}">
                            <a href="{{route('service.list')}}" class="nav-link px-0">
                                <span class="me-2">
                                     <i class="bi bi-bank2 sideicon"></i>
                                </span>                      

                                <span class="txtsidebar">Gestion des Services</span>
                            </a>
                    </li>
                    <li>
                        <a href="{{route('jourferie.list')}}" class="nav-link px-0 active">
                            <span class="me-2">
                        <i class="bi bi-calendar-event sideicon"></i>
                    </span>
                            <span class="txtsidebar">Gestion des Jours <br>&ensp;&ensp;Feriés</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('EmpMachine.list')}}" class="nav-link px-0 active">
                            <span class="me-2">
                        <i class="bi bi-geo-alt-fill sideicon"></i>
                    </span>
                            <span class="txtsidebar">Emplacement des <br>&ensp;&ensp;machines</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('LocMachine.list')}}" class="nav-link px-0 active">
                            <span class="me-2">
                        <i class="bi bi-hospital-fill sideicon"></i>
                    </span>
                            <span class="txtsidebar">Les ateliers</span>
                        </a>
                    </li>
        
                </ul>
            </nav>
        </div>
    </div>
    <main class="container">
        @yield("contenuserice")
    </main>
    <!-- side bar -->
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    <script  src="{{asset('css/dataTables.bootstrap5.min.css')}}"></script>
    <script  src="{{asset('js/jquery-3.5.1.js')}}"></script>
    <script  src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script  src="{{asset('js/script.js')}}"></script>
   
</body>

</html>