@extends("layouts.Navbar_Sidebar")
@section("contenu")
<link rel="stylesheet" href="{{asset('css/Bon de sortie/liste_des_bons_de_sortie.css')}}">
{{-- liste de outils de mesure --}}
<div class="container" id="bonsortie">
    @include('sweetalert::alert')
    <div class="table-title">
        <div class="row g-2">
            <div class="titre col-sm-7">
            <h2 class="bonsortietitle">Liste<b> Des Bons De Retour</b></h2>
            </div>
            <div class="boutons col-sm-5">
                <a href="{{route('AjoutBonDeRetour.affiche')}}" id="titleadd" class="btn" data-toggle="modal"><i class="bi bi-plus-circle-fill"></i><span> Créer Un Bon</span></a>
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
                <th scope="col ">ID Bon Sortie</th>
                <th scope="col ">Type d'outil</th>
                <th scope="col ">Nom d'outil</th>
                <th scope="col ">Date de retour</th>
                <th scope="col ">Nom responsable</th>
                <th scope="col ">Nom opérateur</th>
                <th scope="col ">Action</th>
            </tr>
        </thead>
        <tbody>      @foreach($bonRetours as $bonRetour)              
                    <tr>
                        
                        <td scope="col ">
                            <input type="checkbox" class="select-option" aria-label="Checkbox for following text input" id="chkbx">
                        </td>
                        <td>{{$bonRetour->id}}</td>
                        <td>{{$bonRetour->IDBS}}</td>
                        <td>{{$bonRetour->outil_mesure->DesTypeOutil}}</td>
                        <td>{{$bonRetour->IDOutil}}</td>
                        <td>{{$bonRetour->DateRetour}}</td>
                        <td>{{$bonRetour->responsable_qualite->employe->nom_emp}} {{ $bonRetour->responsable_qualite->employe->prenom_emp}} </td>
                        <td>{{$bonRetour->operateur_qualite_mesure->employe->nom_emp}} {{$bonRetour->operateur_qualite_mesure->employe->prenom_emp}}</td>
                        <td class="action">
                            <a href="{{route('AjoutUnBonDeRetour.VoirPDF',['id'=>$bonRetour->id])}}" class="btn" id="eye"><i class="bi bi-eye-fill"></i></a>
                            <a href="{{route('AjoutUnBonDeRetour.TelechargePDF',['id'=>$bonRetour->id])}}" class="btn" id="save"><i class="bi bi-download"></i></a>
                            <a href="{{route('AjoutUnBonDeRetour.Modifier',['id'=>$bonRetour->id])}}" class="btn" id="edit"><i class="bi bi-pen-fill"></i></a>     
                            <a href="#" class="btn" id="delete" onclick="if(confirm('Voulez-vos vraiment supprimer cet Bon De Retour  ?')){document.getElementById('form-{{$bonRetour->id}}').submit()}">
                                <i class="bi bi-trash-fill"></i>
                            </a>
                            <form id="form-{{$bonRetour->id}}" action="{{route('AjoutUnBonDeRetour.Supprimer' ,['id'=>$bonRetour->id])}}" method="post">
                         
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