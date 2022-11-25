@extends("layouts.Navbar_Sidebar")
@section("contenu")
<link rel="stylesheet" href="{{asset('css/bon de validation/liste_des_bons_de_validation.css')}}"/>
{{-- liste des bons de  validation --}}
@include('sweetalert::alert')
   <div class="container" id="listebonval">
        <div class="table-title">
            <div class="row g-2">
                <div class="titre col-sm-7">
                    <h2 class="listebonvaltitle">Liste<b> Des Bons De Validation</b></h2>
                </div>
                <div class="boutons col-sm-5">
                    <a href="{{route('AjoutUnBonDeValidation.affiche')}}" id="titleadd" class="btn" data-toggle="modal"><i class="bi bi-plus-circle-fill"></i><span> Créer un Bon de Validation</span></a>
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
                        <th scope="col ">Validité </th>
                        <th scope="col ">Type du test</th>
                        <th scope="col ">Date </th>
                        <th scope="col ">ID OT test validation</th>
                        {{--  --}}
                        <th scope="col ">Execution OT</th> 
                        {{--  --}}
                        <th scope="col ">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($BonDeValidations as $BonDeValidation )
                        <tr>
                            <td scope="col ">
                                <input type="checkbox" class="select-option" aria-label="Checkbox for following text input" id="chkbx">
                            </td>
                            <td scope="col ">{{$BonDeValidation->IDBV}}</td>
                           
                            <td scope="col ">
                                @if($BonDeValidation->ValidationBonValidation== 1)<span>Valide</span>
                                @else <span>Non valide</span>
                                @endif
                            </td>
                            <td scope="col ">{{$BonDeValidation->TypeDuTest}}</td>
                            <td scope="col ">{{$BonDeValidation->DateValidation}}</td>
                            <td scope="col ">{{$BonDeValidation->IDOrdreTravailTestValidation}}</td>
                            <td scope="col "> 
                                @if($BonDeValidation->ValidationOrdreTravail == 1) <span>Valide</span>
                                @else <span>Non valide</span>
                                @endif
                            </td>
                            <td class="action">
                                <a href="{{route("BonDeValidation.Affiche",['IDBV'=>$BonDeValidation->IDBV])}}" class="btn" id="eye"><i class="bi bi-eye-fill"></i></a>
                                <a href="{{route("BonDeValidation.Enregistre",['IDBV'=>$BonDeValidation->IDBV])}}" class="btn" id="save"><i class="bi bi-download"></i></a>
                                <a href="{{route("BonValidation.modifier",['IDBV'=>$BonDeValidation->IDBV])}}" class="btn" id="edit"><i class="bi bi-pen-fill"></i></a>
                                <a href="#" class="btn" id="delete" onclick="if(confirm('Voulez-vos vraiment supprimer cet ordre de travil de test de validation ?')){document.getElementById('form-{{$BonDeValidation->IDBV}}').submit()}">
                                    <i class="bi bi-trash-fill"></i>
                                </a>   
                                <form id="form-{{$BonDeValidation->IDBV}}" action="{{route('BonDeValidationController.Supprimer' ,['IDBV'=>$BonDeValidation->IDBV])}}" method="post">
                         
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