@extends("layouts.Navbar_Sidebar")
@section("contenu")
<link rel="stylesheet" href="{{asset('css/Outil de mesure/liste_des_outils_de_mesure.css')}}">
{{-- liste de outils de mesure --}}
<div class="container" id="listeoutilmes">
    @include('sweetalert::alert')
    <div class="table-title">
        <div class="row g-2">
            <div class="titre col-sm-7">
                <h2 class="listeoutilmestitle">Liste<b> Des Outils De Mesure</b></h2>
            </div>
            <div class="boutons col-sm-5">
                <a href="{{route('AjoutUnOutilDeMesure.affiche')}}" id="titleadd" class="btn" data-toggle="modal"><i class="bi bi-plus-circle-fill"></i><span> Ajouter un Outil</span></a>
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
                <th scope="col ">Nom_d'outil</th>
                <th scope="col ">Type_d'outil</th>
                <th scope="col ">Disopnibilité</th>
                <th scope="col ">Fiche Achat </th>
                <th scope="col ">Nom_Fabriquant</th>
                <th scope="col ">Action</th>
            </tr>
        </thead>
        <tbody>
                @foreach ( $outils as $outil )                       
                    <tr>
                        <td scope="col ">
                            <input type="checkbox" class="select-option" aria-label="Checkbox for following text input" id="chkbx">
                        </td>
                        <td scope="col ">{{$outil->DesOutilMesure}}</td>
                        <td scope="col ">{{$outil->type_outil->DesTypeOutil}}</td>
                        <td scope="col ">
                            @if ($outil->Disponibilite == 1)
                            Disponible
                            @else
                            Non Disponible
                            @endif
                        </td>
                        <td scope="col ">{{$outil->NumFicheAchat}}</td>
                        <td scope="col ">{{$outil->NomFabriquant}}</td>
                        <td class="action">
                           
                            <a href="{{route('OutilDeMesure.modifier',['DesOutilMesure'=>$outil->DesOutilMesure])}}" class="btn" id="edit"><i class="bi bi-pen-fill"></i></a>     
                            
                            <a href="#" class="btn" id="delete" onclick="if(confirm('voulez-vous vraiment supprimer cet outil de mesure?')){document.getElementById('form-{{$outil->DesOutilMesure}}').submit()}">
                                <i class="bi bi-trash-fill"></i>
                            </a>
                           
                                 <form id="form-{{$outil->DesOutilMesure}}" action="{{route('SupprimerOutilMesure',['DesOutilMesure'=>$outil->DesOutilMesure])}}" method="POST">  
                                    @csrf
                                    <input type="hidden" name="_method" value='delete'>
                                 </form>             
                         </td>
                    </tr>
                @endforeach 
        </tbody>
    </table>   
</div>
<script  src="{{asset('js/checkboxAll.js')}}"></script>
@endsection