@extends("layouts.Navbar_Sidebar")
@section("contenu")
<link rel="stylesheet" href="{{asset('css/Bon de sortie/liste_des_bons_de_sortie.css')}}">
{{-- liste de outils de mesure --}}
<div class="container" id="bonsortie">
    @include('sweetalert::alert')
    <div class="table-title">
        <div class="row g-2">
            <div class="titre col-sm-7">
                <h2 class="bonsortietitle">Liste<b> Des Bons De Sortie</b></h2>
            </div>
            <div class="boutons col-sm-5">
                <a href="{{route('AjoutBonDeSortie.affiche')}}" id="titleadd" class="btn" data-toggle="modal"><i class="bi bi-plus-circle-fill"></i><span> Créer Un Bon</span></a>
                <a href="#" id="titledelete" class="btn " data-toggle="modal"><i class="bi bi-dash-circle-fill"></i><span> Supprimer</span></a>
            </div>
        </div>
    </div>
    <table class="table table-hover mt-4">
        <thead>
            <tr>
                <th scope="col ">
                    <input type="checkbox" aria-label="Checkbox for following text input" id="chkbxAll">
                </th>
                <th scope="col ">ID Bon</th>
                <th scope="col ">ID Ordre</th>
                <th scope="col ">Type d'outil</th>
                <th scope="col ">Nom d'outil</th>
                <th scope="col ">Date de sortie</th>
                <th scope="col ">Nom responsable</th>
                <th scope="col ">Nom opérateur</th>
                <th scope="col ">Action</th>
            </tr>
        </thead>
        <tbody>      @foreach($bonSorties as $bonSortie)              
                    <tr>
                        
                        <td scope="col ">
                            <input type="checkbox" class="select-option" aria-label="Checkbox for following text input" id="chkbx">
                        </td>
                        <td>{{$bonSortie->id}}</td>
                        <td>{{$bonSortie->IDOT}}</td>
                        <td>{{$bonSortie->outil_mesure->DesTypeOutil}}</td>
                        <td>{{$bonSortie->IDOutil}}</td>
                        <td>{{$bonSortie->DateSortie}}</td>
                        <td>{{$bonSortie->responsable_qualite->employe->nom_emp}} {{ $bonSortie->responsable_qualite->employe->prenom_emp}} </td>
                        <td>{{$bonSortie->operateur_qualite_mesure->employe->nom_emp}} {{$bonSortie->operateur_qualite_mesure->employe->prenom_emp}}</td>
                        <td class="action">
                            <a href="{{route('AjoutUnBonDeSortie.VoirPDF',['id'=>$bonSortie->id])}}" class="btn" id="eye"><i class="bi bi-eye-fill"></i></a>
                            <a href="{{route('AjoutUnBonDeSortie.TelechargePDF',['id'=>$bonSortie->id])}}" class="btn" id="save"><i class="bi bi-download"></i></a>
                            <a href="{{route('AjoutUnBonDeSortie.Modifier',['id'=>$bonSortie->id])}}" class="btn" id="edit"><i class="bi bi-pen-fill"></i></a>     
                            <a href="#" class="btn" id="delete" onclick="if(confirm('Voulez-vos vraiment supprimer cet Bon De Sortie  ?')){document.getElementById('form-{{$bonSortie->id}}').submit()}">
                                <i class="bi bi-trash-fill"></i>
                            </a>
                            <form id="form-{{$bonSortie->id}}" action="{{route('AjoutUnBonDeSortie.Supprimer' ,['id'=>$bonSortie->id])}}" method="post">
                         
                                 {{ method_field('delete')}}
                                    @csrf
                                </form> 
                                      
                         </td>
                         
                    </tr>
                    @endforeach
        </tbody>
    </table>   
</div>
<script  src="{{asset('js/checkboxAll.js')}}"></script>
@endsection