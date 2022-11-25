@extends("layouts.Navbar_Sidebar")
@section("contenu")
<link rel="stylesheet" href="{{ asset('css/Fabriquant/Modifier_Un_Fabricant.css')}}">
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
{{-- modifier d'un fabriquant --}}
<div class="container" id="fabmod">
    <form action="{{route('Fabriquant.update',['NomFabriquant'=>$fabriquant])}}" method="post">
        {{ method_field('put')}}
      @csrf
        <div class="modifier_fabriquant">
        @include('sweetalert::alert')
        @foreach ($fabriquants as $fabriquant)
            <h2 class="mb-5 modifierfabtitle">Modifier<b> Un Fabricant</b></h2>           
            <div class="info_sur_fabriquant">
                <div class="line ms-2">
                    <div class="col">
                        <div class="titre mt-2">
                            <h5>Nom</h5>
                        </div>
                        <div class="champ">
                            <input type="text" name="NomFabriquant" value ="{{$fabriquant->NomFabriquant}}"> 
                        </div>
                    </div>
                    <div class="col">
                        <div class="titre mt-2">
                            <h5>Adresse</h5>
                        </div>
                        <div class="champ">
                            <input type="text" name="AdresseFabriquant" value ="{{$fabriquant->AdresseFabriquant}}"> 
                        </div>
                    </div>
                </div>
                <div class="line ms-2">
                    <div class="col">
                        <div class="titre mt-2">
                            <h5>E-mail</h5>
                        </div>
                        <div class="champ">
                            <input type="email" name="EmailFabricant" value ="{{$fabriquant->EmailFabricant}}"> 
                        </div>
                    </div>
                    <div class="col">
                        <div class="titre mt-2">
                            <h5>Fax</h5>
                        </div>
                        <div class="champ">
                            <input type="text" name="FaxFabricant" value ="{{$fabriquant->FaxFabricant}}"> 
                        </div>
                    </div>
                </div>
                <div class="line ms-2">
                    <div class="col">
                        <div class="titre mt-2">
                            <h5>Télèphone 1</h5>
                        </div>
                        <div class="champ">
                            <input type="text" name="Telephone_1Fabriquant" value ="{{$fabriquant->Telephone_1Fabriquant}}">
                        </div>
                    </div>
                    <div class="col">
                        <div class="titre mt-2">
                            <h5>Télèphone 2</h5>
                        </div>
                        <div class="champ">
                            <input type="text" name="Telephone_2Fabriquant" value ="{{$fabriquant->Telephone_2Fabriquant}}">
                        </div>
                    </div>
                </div>
            </div>                          
        </div>
        @endforeach
        <div class="boutons mt-5">
            <button type="submit" role="button" id="titleadd" class="btn" data-toggle="modal"><i class="bi bi-plus-circle-fill"></i><span> Modifier</span></button>
            <a href="{{route('ListeFabriquants.affiche')}}" role="button" id="titledelete" class="btn " data-toggle="modal"><i class="bi bi-dash-circle-fill"></i><span> Annuler</span></a>
        </div>
       
    </form>
</div>

{{-- ajout d'un Fabriquant --}}
@endsection