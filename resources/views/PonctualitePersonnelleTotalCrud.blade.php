@extends("navbarsidebarRH")
@section("contenu")

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>

<div class="crudemp">
<div class="cards">
    <div class="card" id="c1">
        <div class="card-content">
            <div class="card-name">Nombre Totale</div>
            <div class="number">67</div>

        </div>
        <div class="icon-box">
            <i class="fas fa-sigma"></i>
        </div>
    </div>
    <div class="card" id="c2">
        <div class="card-content">
            <div class="card-name">Nombre des Directeurs</div>
            <div class="number">67</div>

        </div>
        <div class="icon-box">
            <i class="fas fa-user-tie"></i>
        </div>
    </div>
    <div class="card" id="c3">
        <div class="card-content">
            <div class="card-name">Nombre des Employés</div>
            <div class="number">67</div>
        </div>
        <div class="icon-box">
            <i class="fas fa-users"></i>
        </div>
    </div>
</div>
<!--<div class="d-flex justify-content mb-2">
</div>-->
<div class="table-title">
    <div class="row">
        <div class="">
            <h2 class="listetitle" id="titleponctpersmens">Liste <b>Des Notes De Ponctualité Total Des Employés</b></h2>
        </div>
    </div>
</div>

<table class="table table-hover mt-4">
    <thead>
        <tr>
            <th scope="col ">Employé</th>
            <th scope="col ">Total</th>
            <th scope="col ">Mention</th>
        </tr>
    </thead>
        
    <tbody>
    @foreach($ponctTot as $ponctPersT)
        @foreach($employes as $employe)            
        <tr>
        @if($ponctPersT->id_emp == $employe->id)
            <td>{{ $employe->nom_emp }}&nbsp;{{ $employe->prenom_emp}}</td>
            <td>{{ $ponctPersT->total}}</td>
            <td>{{ $ponctPersT->mention}}</td>                                                              
        @endif
        </tr>  
        @endforeach       
    @endforeach
        </tbody>                                                                                                
        </table>

    </div>         
</div>                                          
 
@endsection