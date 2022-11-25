@extends("layouts.Navbar_Sidebar")
@section("contenu")
<link rel="stylesheet" href="{{asset('css/Fabriquant/liste_des_Fabriquants.css')}}">
{{-- liste des fabriquants--}}
<div class="container" id="listefab">
    @include('sweetalert::alert')
    <div class="table-title">
        <div class="row g-2">
            <div class="titre col-sm-7">
                <h2 class="listefabtitle">Liste<b> Des Fabriquants</b></h2>
            </div>
            <div class="boutons col-sm-5">
                <a href="{{route('AjoutFabriquant.affiche')}}" id="titleadd" class="btn" data-toggle="modal"><i class="bi bi-plus-circle-fill"></i><span> Ajouter un Fabricant</span></a>
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
                <th scope="col ">Nom</th>
                <th scope="col ">E-mail</th>
                <th scope="col ">Adresse</th>
                <th scope="col ">Fax</th>
                <th scope="col ">Télèphone 1</th>
                <th scope="col ">Télèphone 2</th>
                <th scope="col ">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($fabriquants as $fabriquant )
            <tr>
                <td scope="col ">
                    <input type="checkbox" class="select-option" aria-label="Checkbox for following text input" id="chkbx">
                </td>
                <td>{{$fabriquant->NomFabriquant}}</td>
                <td>{{$fabriquant->EmailFabricant}}</td>
                <td>{{$fabriquant->AdresseFabriquant}}</td>
                <td>{{$fabriquant->FaxFabricant}}</td>
                <td>{{$fabriquant->Telephone_1Fabriquant}}</td>
                <td>{{$fabriquant->Telephone_2Fabriquant}}</td>
                <td class="action">
                    <a href="{{route('Fabriquant.modifier',['NomFabriquant'=>$fabriquant->NomFabriquant])}}" class="btn" id="edit"><i class="bi bi-pen-fill"></i></a>     
                    <a href="#" class="btn" id="delete" onclick="if(confirm('voulez-vous vraiment supprimer cet fabricant?')){document.getElementById('form-{{$fabriquant->NomFabriquant}}').submit()}">
                        <i class="bi bi-trash-fill"></i>
                    </a>
                   
                         <form id="form-{{$fabriquant->NomFabriquant}}" action="{{route('Fabriquant.Supprimer',['NomFabriquant'=>$fabriquant->NomFabriquant])}}" method="POST">  
                            @csrf
                            <input type="hidden" name="_method" value='delete'>
                         </form>         
                </td>
            </tr>
            @endforeach
        </tbody>
</div>
<script  src="{{asset('js/checkboxAll.js')}}"></script>
@endsection