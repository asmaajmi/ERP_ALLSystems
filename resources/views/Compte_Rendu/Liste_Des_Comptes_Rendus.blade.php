@extends("layouts.Navbar_Sidebar")
@section("contenu")
<link rel="stylesheet" href="{{asset('css/Compte_Rendu/Liste_Des_Comptes_Rendus.css')}}">
{{-- liste des Comptes Rendus --}}
   <div class="container" id="listecompterendu">
        <div class="table-title">
            <div class="row g-2">
                <div class="titre col-sm-8">
                    <h2 class="listecompterendutitle">Liste<b> Des Comptes Rendus</b></h2>
                </div>
                <div class="boutons col-sm-4">
                    <a href="{{route('AjoutCompteRendu.affiche')}}" id="titleadd" class="btn" data-toggle="modal"><i class="bi bi-plus-circle-fill"></i><span> Créer un compte </span></a>
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
                    <th scope="col ">ID Compte-rendu</th>
                    <th scope="col ">ID Fiche</th>
                    <th scope="col ">Date</th>
                    <th scope="col ">Opérateur</th>
                    <th scope="col ">Totale contrôlé</th>
                    <th scope="col ">% défaut réel</th>
                    <th scope="col ">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($CRs as $CR )
                <tr>
                    <td scope="col ">
                        <input type="checkbox"  class="select-option"  aria-label="Checkbox for following text input" id="chkbx">
                    </td>
                    <td scope="col ">{{$CR->IDCR}}</td>
                    <td scope="col ">{{$CR->IDFC}}</td>
                    <td scope="col ">{{$CR->DateCR}}</td>
                    <td scope="col ">{{$CR->OperateurCalcul->employe->prenom_emp}} {{$CR->OperateurCalcul->employe->nom_emp}}</td>
                    <td scope="col ">{{$CR->TotaleControler}}</td>
                    <td scope="col ">{{$CR->Pourcentage_defaut_reel}} %</td>
                    <td class="action">
                        <a href="{{route("CompteRendu.VoirPDF",['IDCR'=>$CR->IDCR])}}" class="btn" id="eye"><i class="bi bi-eye-fill"></i></a>
                        <a href="{{route("CompteRendu.TelechargePDF",['IDCR'=>$CR->IDCR])}}" class="btn" id="save"><i class="bi bi-download"></i></a>
                        <a href="{{route("CompteRendu.modifier",['IDCR'=>$CR->IDCR])}}" class="btn" id="edit"><i class="bi bi-pen-fill"></i></a>
                        <a href="#" class="btn" id="delete" onclick="if(confirm('Voulez-vos vraiment supprimer cet Compte-rendu ?')){document.getElementById('form-{{$CR->IDCR}}').submit()}">
                            <i class="bi bi-trash-fill"></i>
                        </a>   
                        <form id="form-{{$CR->IDCR}}" action="{{route('CompteRendu.Supprimer' ,['IDCR'=>$CR->IDCR])}}" method="post">
                 
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