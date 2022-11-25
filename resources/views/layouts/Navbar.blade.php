<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/dataTables.bootstrap5.min.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{asset('css/layouts/navbar_Accueil.css')}}">
  </head>
  <body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
      <div class="container-fluid">
        {{-- logo --}}
        <a class="navbar-brand me-auto ms-lg-0 ms-3 text-uppercase fw-bold" href="#">AllSystems</a>
        {{-- logo --}}
        {{-- user connexion --}}
        <ul class="ms-auto my-0 my-lg-0">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle ps-3" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-person-circle"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#"><i class="bi bi-person-fill"></i> Voir Profil</a></li>
              <li><a class="dropdown-item" href="{{'/'}}"><i class="bi bi-box-arrow-right"></i> Déconnecter</a></li>
            </ul>
          </li>
        </ul>
        {{-- user connexion --}}
      </div>
    </nav> 
    <!-- navbar -->
    {{-- main --}}
    <main class="main">
      @yield("main")
    </main>
    {{-- main --}}
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
  </body>
</html>