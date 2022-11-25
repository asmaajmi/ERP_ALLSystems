@extends("layouts.Navbar_Sidebar")
@section("contenu")
<link rel="stylesheet" href="{{ asset('css/Outil de mesure/Modifier_Un_Outil_De_Mesure.css')}}">
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
{{-- ajout d'un outil de mesure --}}
<div class="container" id="modoutilmes">
<form action="{{route('OutilDeMesure.update',['DesOutilMesure'=>$outil])}}" method="post">
      {{ method_field('put')}}
      @csrf
        <div class="modifie">
            @include('sweetalert::alert')
            <h2 class="mb-5 modoutilmestitle">Modifier<b> Un Outil De Mesure</b></h2>
            @foreach ($outilmesures as $outilmesure)
                <div class="info_sur_outil ">
                    <div class="col mb-4">
                        <div class="titre mt-2">
                            <h5>Designation</h5>
                        </div>
                        <div class="champ">
                            <input type="text" name="DesOutilMesure" id="id" value="{{$outilmesure->DesOutilMesure}}"> 
                        </div>
                    </div>
                    <div class="col mb-4">
                        <div class="titre mt-2">
                            <h5>Type d'outil</h5>
                        </div>
                        <div class="champ">
                            <select name="DesTypeOutil">
                            <option value="">-- Choisir Le Type D'outil --</option>
                            @foreach ($type_outils as $type_outil )
                            @if ($outilmesure->DesTypeOutil == $type_outil->DesTypeOutil)
                            <option value="{{$type_outil->DesTypeOutil}}" selected>{{$type_outil->DesTypeOutil}}</option>
                            @else
                           <option value="{{$type_outil->DesTypeOutil}}">{{$type_outil->DesTypeOutil}}</option>   
                            @endif
                            @endforeach
                            </select>
                        </div>
                    </div>         
                    <div class="col mb-4">
                        <div class="titre mt-2">      
                            <h5>N° Fiche d'achat</h5>
                        </div>  
                        <div class="champ">
                            <input type="text" name="NumFicheAchat" class="place1" value="{{$outilmesure->NumFicheAchat}}">
                        </div>
                    </div>
                    <div class="col mb-4">
                        <div class="titre mt-2">
                            <h5>Nom Fabriquant</h5>
                        </div>
                        <div class="champ">
                            <select name="NomFabriquant" id="">
                                <option value="">-- Choisir un Fabriquant --</option>
                                @foreach ($fabriquants as $fabriquant )
                                @if ($outilmesure->NomFabriquant == $fabriquant->NomFabriquant)
                                <option value="{{$fabriquant->NomFabriquant}}"selected>{{$fabriquant->NomFabriquant}}</option> 
                                @else
                                <option value="{{$fabriquant->NomFabriquant}}">{{$fabriquant->NomFabriquant}}</option> 
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="boutons mt-5 mb-2">
            <button type="submit" role="button" id="titleadd" class="btn" data-toggle="modal"><i class="bi bi-plus-circle-fill"></i><span> Modifier</span></button>
            <a href="{{route('ListeDesOutils.affiche')}}" role="button" id="titledelete" class="btn " data-toggle="modal"><i class="bi bi-dash-circle-fill"></i><span> Annuler</span></a>
        </div>
    </form>
</div>

{{-- ajout d'un outil de mesure --}}
@endsection