@extends("layouts.Navbar_Sidebar")
@section("contenu")
<link rel="stylesheet" href="{{asset('css/ordre de travail de mesure/liste_des_ordre_travail_de_mesure.css')}}">
{{-- liste des ordres de travail de mesure --}}
   <div class="container" id="listeordretravailmes">
        @include('sweetalert::alert')
        <div class="table-title">
            <div class="row g-2">
                <div class="titre col-sm-8">
                    <h2 class="listeordretravailmestitle">Liste<b> Des Ordres De Travail De Mesure</b></h2>
                </div>
                <div class="boutons col-sm-4">
                    <a href="{{route('CreerUnOrdreDeTravailDeMesure.affiche')}}" id="titleadd" class="btn" data-toggle="modal"><i class="bi bi-plus-circle-fill"></i><span> Créer un Ordre</span></a>
                    <a href="#" id="titledelete" class="btn " data-toggle="modal"><i class="bi bi-dash-circle-fill"></i><span> Supprimer</span></a>
                </div>
            </div>
        </div>
        <table class="table table-hover mt-4">
            <thead>
                <tr>
                    <th scope="col ">
                        <input type="checkbox" aria-label="Checkbox for following text input"  id="chkbxAll">
                    </th>
                    <th scope="col ">ID Fiche</th>
                    <th scope="col ">Date de réalisation</th>
                    <th scope="col ">Produit</th>
                    <th scope="col ">Machine</th>
                    <th scope="col ">Opérateur</th>
                    <th scope="col ">Etat</th>
                    <th scope="col ">Action</th>
                </tr>
            </thead>
        @foreach($OTM as $OTM)
            <tbody>
                <tr>
                    <td scope="col ">
                        <input type="checkbox"  class="select-option"  aria-label="Checkbox for following text input" id="chkbx">
                    </td>
                    <td scope="col ">{{$OTM->IDOrdreTravailMesure}}</td>
                    <td scope="col ">{{$OTM->Date}}</td>
                    <td scope="col ">{{$OTM->DesProduit}}</td>
                    <td scope="col ">{{$OTM->IDMachine}}</td>
                    <td scope="col ">{{$OTM->operateur_qualite_mesure->employe->nom_emp}} {{$OTM->operateur_qualite_mesure->employe->prenom_emp}}</td>
                    <td scope="col ">{{$OTM->Etat}}</td>
                    <td class="action">
                        <a href="{{route("OrdereDeMesure.VUPDF",['IDOrdreTravailMesure'=>$OTM->IDOrdreTravailMesure])}} " class="btn" id="eye"><i class="bi bi-eye-fill"></i></a>
                        <a href="{{route("OrdereDeMesure.DownloadPDF",['IDOrdreTravailMesure'=>$OTM->IDOrdreTravailMesure])}} "class="btn" id="save"><i class="bi bi-download"></i></a>
                        <a href="{{route("OrdereDeMesure.modifier",['IDOrdreTravailMesure'=>$OTM->IDOrdreTravailMesure])}} " class="btn" id="edit"><i class="bi bi-pen-fill"></i></a>
                        <a href="# " class="btn" id="delete" onclick="if(confirm('Voulez-vos vraiment supprimer cet ordre de travail de test de validation ?')){document.getElementById('form-{{$OTM->IDOrdreTravailMesure}}').submit()}">
                        <i class="bi bi-trash-fill"></i></a>
                        <form id="form-{{$OTM->IDOrdreTravailMesure}}" action="{{route('OrdereDeMesure.Supprimer' ,['IDOrdreTravailMesure'=>$OTM->IDOrdreTravailMesure])}}" method="post">
                                 {{ method_field('delete')}}
                                    @csrf
                                </form>
                    </td>

                </tr>                    
            </tbody>
        @endforeach    
        </table>
    </div>
    <script  src="{{asset('js/checkboxAll.js')}}"></script>
@endsection