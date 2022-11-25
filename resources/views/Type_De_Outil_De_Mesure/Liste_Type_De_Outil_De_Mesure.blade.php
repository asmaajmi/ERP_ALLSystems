@extends("layouts.Navbar_Sidebar")
@section("contenu")
<link rel="stylesheet" href="{{asset('css/type outil mesure/liste_des_types_outils_de_mesure.css')}}">
{{-- liste de type d'outils de mesure --}}
<div class="container" id="listetypeoutilmes">
    @include('sweetalert::alert')
    <div class="table-title">
        <div class="row g-2">
            <div class="titre col-sm-7">
                <h2 class="listetypemestitle">Liste<b> Des Types D'outils De Mesure</b></h2>
            </div>
            <div class="boutons col-sm-5">
                <a href="{{route('AjoutTypeOutil.affiche')}}" id="titleadd" class="btn" data-toggle="modal"><i class="bi bi-plus-circle-fill"></i><span> Ajouter un Type Outil</span></a>
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
                <th scope="col ">Designation</th>
                <th scope="col ">Catégorie</th>
                <th scope="col ">Quantité</th>
                <th scope="col ">Nbr outils disponible</th>
                <th scope="col ">Paramètre Mesurer</th>
                <th scope="col ">Type De Mesure</th>
                <th scope="col ">Préçision</th>
                <th scope="col ">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $type_outils as $type_outil )   
            <tr>
                <td scope="col ">
                    <input type="checkbox" class="select-option" aria-label="Checkbox for following text input" id="chkbx">
                </td>
                <td>{{$type_outil->DesTypeOutil}}</td>
                <td>
                    @if($type_outil->Etalon==1)
                        Etalon
                    @else
                        Outil
                    @endif
                </td>
                <td>
                    @php($count = 0)
                    @foreach ($outils as $outil )
                        @if($outil->DesTypeOutil == $type_outil->DesTypeOutil)
                        @php($count++) 
                        @endif
                    @endforeach
                    {{$count}} outil(s)
                </td>
                <td>
                    @php($count = 0)
                    @foreach ($outils as $outil )
                        @if($outil->DesTypeOutil == $type_outil->DesTypeOutil)
                            @if ($outil->Disponibilite == 1)
                                @php($count++)
                            @endif
                        @endif
                    @endforeach
                    {{$count}} outil(s)
                </td>
                <td>
                    @foreach ($type_outil->avoir_parametre_mesures as $avoir_parametre_mesure)
                         <span>
                            {{$avoir_parametre_mesure->DesParametreMesure}} 
                            <br>
                        </span>
                    @endforeach
                </td>
                <td>
                    @foreach ($type_outil->avoir_parametre_mesures as $avoir_parametre_mesure)
                        <span>
                            {{$avoir_parametre_mesure->parametre_mesure->DesTypeMesure}} 
                            <br>
                        </span>  
                    @endforeach
                </td>
                <td>
                    @foreach ($type_outil->avoir_parametre_mesures as $avoir_parametre_mesure)
                        <span>
                            {{$avoir_parametre_mesure->DesPrecision}}
                            <br>
                        </span>       
                    @endforeach
                </td>
                
                <td class="action">
                    <a href="{{route('TypeOutilDeMesure.modifier',['DesTypeOutil'=>$type_outil->DesTypeOutil])}}" class="btn" id="edit"><i class="bi bi-pen-fill"></i></a>  
                    <a href="#" class="btn" id="delete" onclick="if(confirm('voulez-vous vraiment supprimer cet Type outil de mesure?')){document.getElementById('form-{{$type_outil->DesTypeOutil}}').submit()}">
                        <i class="bi bi-trash-fill"></i>
                    </a>
                   
                         <form id="form-{{$type_outil->DesTypeOutil}}" action="{{route('TypeOutilMesure.Supprimer',['DesTypeOutil'=>$type_outil->DesTypeOutil])}}" method="POST">  
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