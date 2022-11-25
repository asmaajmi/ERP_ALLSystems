@extends("layouts.Navbar_Sidebar")
@section("contenu")
<link rel="stylesheet" href="{{asset('css/fiche de controle totale/liste_une_Fiche_De_Controle_Totale.css')}}">
{{-- liste des ordres de travail de mesure --}}
   <div class="container" id="crudFicheConTot">
        @include('sweetalert::alert')
        <div class="table-title">
            <div class="row g-2">
                <div class="titre col-sm-8">
                    <h2 class="listetitle">Liste<b> Des des fiche de controle totale</b></h3>
                </div>
                <div class="boutons col-sm-4">
                    <a href="{{route('AjoutUneFicheDeControleTotale.affiche')}}" id="titleadd" class="btn" data-toggle="modal"><i class="bi bi-plus-circle-fill"></i><span> Créer une fiche</span></a>
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
                    <th scope="col ">ID OTM</th>
                    <th scope="col ">Date</th>
                    <th scope="col ">Produit</th>
                    <th scope="col ">Machine</th>
                    <th scope="col ">Opérateur</th>
                    
                    <th scope="col ">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($FCs as $FC)
                <tr>
                    <td scope="col ">
                        <input type="checkbox"  class="select-option"  aria-label="Checkbox for following text input" id="chkbx">
                    </td>
                    <td scope="col ">{{$FC->IDFC}}</td> 
                    <td scope="col ">{{$FC->IDOTMNV}}</td>
                    <td scope="col ">{{$FC->DateFC}}</td>
                    <td scope="col ">{{$FC->OrdreTravailMesureNonValide->ordre_de_travail_de_mesure->DesProduit}}</td>
                    <td scope="col ">{{$FC->OrdreTravailMesureNonValide->ordre_de_travail_de_mesure->IDMachine}}</td>
                    <td scope="col ">{{$FC->OrdreTravailMesureNonValide->ordre_de_travail_de_mesure->operateur_qualite_mesure->employe->prenom_emp}} {{$FC->OrdreTravailMesureNonValide->ordre_de_travail_de_mesure->operateur_qualite_mesure->employe->nom_emp}}</td>
                   
                    <td class="action">
                        <a href="{{route("Fichecontrole.PDF",['IDFC'=>$FC->IDFC])}} " class="btn" id="eye"><i class="bi bi-eye-fill"></i></a>
                        <a href="{{route("FicheDeControleTotale.DownloadPDF",['IDFC'=>$FC->IDFC])}}" class="btn" id="save"><i class="bi bi-download"></i></a>
                        <a href="{{route("FichesDeControleTotale.modifier",['IDFC'=>$FC->IDFC])}}" class="btn" id="edit"><i class="bi bi-pen-fill"></i></a>
                        <a href="#" class="btn" id="delete" onclick="if(confirm('Voulez-vos vraiment supprimer cette fiche de contrôle ?')){document.getElementById('form-{{$FC->IDFC}}').submit()}">
                            <i class="bi bi-trash-fill"></i>
                        </a>   
                        <form id="form-{{$FC->IDFC}}" action="{{route('FichesDeControleTotale.Supprimer' ,['IDFC'=>$FC->IDFC])}}" method="post">
                 
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
