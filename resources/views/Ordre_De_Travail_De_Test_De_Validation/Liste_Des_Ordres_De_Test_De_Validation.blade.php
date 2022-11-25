@extends("layouts.Navbar_Sidebar")
@section("contenu")
<link rel="stylesheet" href="{{asset('css/ordre de travail de test de validation/liste_des_ordre_test_de_validation.css')}}"/>
{{-- liste des ordres de test de validation --}}
@include('sweetalert::alert')
   <div class="container" id="listeordretestval">
        <div class="table-title">
            <div class="row g-2">
                <div class="titre col-sm-7">
                    <h2 class="listeordretestvaltitle">Liste<b> Des Ordres De Travail De Test De Validation</b></h2>
                </div>
                <div class="boutons col-sm-5">
                    <a href="{{route('CreerUnOrdreDeTestDeValidation')}}" id="titleadd" class="btn" data-toggle="modal"><i class="bi bi-plus-circle-fill"></i><span> Créer un Ordre</span></a>
                    <a href="#" id="titledelete" class="btn " data-toggle="modal"><i class="bi bi-dash-circle-fill"></i><span> Supprimer</span></a>
                </div>
            </div>
        </div>
        @if(session()->has('successDelete'))
        <div class="alert alert-success">
            <h3>{{session()->get('successDelete')}}</h3>
        </div>
        @endif
        <table class="table table-hover mt-4">
                <thead>
                    <tr>
                        <th scope="col ">
                            <input type="checkbox" aria-label="Checkbox for following text input" id="chkbxAll">
                        </th>
                        <th scope="col ">ID Fiche</th>
                        <th scope="col ">Objectif</th>
                        <th scope="col ">Date </th>
                        <th scope="col ">Produit</th>
                        <th scope="col ">Responsable</th>
                        <th scope="col ">Etat</th>
                        <th scope="col ">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($ordretravailtestvalidations as $ordretravailtestvalidation )
                        <tr>
                            <td scope="col ">
                                <input type="checkbox" class="select-option" aria-label="Checkbox for following text input" id="chkbx">
                            </td>
                            <td scope="col ">{{$ordretravailtestvalidation->IDOTTV}}</td>
                            <td scope="col ">{{$ordretravailtestvalidation->Objectif}}</td>
                            <td scope="col ">{{$ordretravailtestvalidation->DateOrdreTestValidation}}</td>
                            <td scope="col ">{{$ordretravailtestvalidation->DesProduit}}</td>
                            <td scope="col ">{{$ordretravailtestvalidation->responsable_qualite->employe->nom_emp}} {{$ordretravailtestvalidation->responsable_qualite->employe->prenom_emp}}</td>
                            <td scope="col ">{{$ordretravailtestvalidation->Etat}}</td>
                            <td class="action">
                                <a href="{{route('FicheDeTestDeValidation.Affiche',['IDOTTV'=>$ordretravailtestvalidation->IDOTTV])}}" class="btn" id="eye"><i class="bi bi-eye-fill"></i></a>
                                <a href="{{route('FicheDeTestDeValidation.Enregistre',['IDOTTV'=>$ordretravailtestvalidation->IDOTTV])}}" class="btn" id="save"><i class="bi bi-download"></i></a>
                                <a href="{{route('UnOrdreDeTravailDeTestDeValidation.modifier',['IDOTTV'=>$ordretravailtestvalidation->IDOTTV])}}" class="btn" id="edit"><i class="bi bi-pen-fill"></i></a> 
                                <a href="#" class="btn" id="delete" onclick="if(confirm('Voulez-vos vraiment supprimer cet ordre de travail de test de validation ?')){document.getElementById('form-{{$ordretravailtestvalidation->IDOTTV}}').submit()}">
                                    <i class="bi bi-trash-fill"></i>
                                </a>   
                                <form id="form-{{$ordretravailtestvalidation->IDOTTV}}" action="{{route('OrdreDeTestDeValidation.Supprimer' ,['IDOTTV'=>$ordretravailtestvalidation->IDOTTV])}}" method="post">
                         
                                 {{ method_field('delete')}}
                                    @csrf
                                </form>
                            </td>

                        </tr>
                    @endforeach
                   
                </tbody>
            </table>
            <div class="pagination justify-content-end mt-4">
                {{ $ordretravailtestvalidations->links()}}
            </div>
    </div>
    <script  src="{{asset('js/checkboxAll.js')}}"></script>
@endsection