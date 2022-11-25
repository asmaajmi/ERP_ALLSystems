@extends("layouts.Navbar_Sidebar")
@section("contenu")
<link rel="stylesheet" href="{{ asset('css/type outil mesure/Modifier_Un_Type_De_Outil_De_Mesure.css')}}">
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
{{-- ajouter un type outil de mesure --}}
<div class="container" id="modtypeoutilmes">
    <form action="{{route('TypeOutilDeMesure.update',['DesTypeOutil'=>$type_outil])}}" method="post">
        {{ method_field('put')}}
        @csrf
        <div class="modifie_type_outil">
            {{-- @include('sweetalert::alert') --}}
            @foreach ($typeoutilmesures as $typeoutilmesure)
                <h2 class="mb-5 modtypeoutilmestitle">Modifier<b> Un Type D'outil De Mesure</b></h2>
                <div class="info_sur_type_outil">
                    <div class="col">
                        <div class="titre mt-2 mb-4">
                            <h5>Designation</h5>
                        </div>
                        <div class="champ">
                            <input type="text" name="DesTypeOutil" value ="{{$typeoutilmesure->DesTypeOutil}}"> 
                        </div>
                    </div>
                    <div class="col">
                        <div class="titre mb-4">
                            <h5 >Catégorie </h5>
                        </div>
                        <div class="champ">
                            <select name="Categorie">
                                @foreach($Etalons as $Etalon)
                                    @if($Etalon == $typeoutilmesure->Etalon)
                                        <option value="{{$Etalon}}" selected>
                                            @if($typeoutilmesure->Etalon==1)
                                                Etalon
                                            @else
                                                Outil
                                            @endif
                                        </option>
                                    @else
                                        <option value="{{$Etalon}}">
                                            @if($Etalon==1)
                                                Etalon
                                            @else
                                                Outil
                                            @endif  
                                        </option> 
                                    @endif
                                @endforeach    
                            </select>
                        </div> 
                    </div>  
                    @foreach ($typeoutilmesure->avoir_parametre_mesures as $avoir_parametre_mesure)
                        <div class="addparametremesure">
                            <div class="col">
                                <div class="titre mb-4">
                                    <h5 id="parametre">Paramétre</h5>
                                </div>
                                <div class="champ" id="inputparametre">
                                    <input type="text" name="DesParametreMesure[]" id="in_parametre" value="{{$avoir_parametre_mesure->DesParametreMesure}}">
                                    <a href="javascript:;" class="suppavoirparametre"><i class="bi bi-dash"></i></a>   
                                </div>
                            </div>
                            <div class="col">
                                <div class="titre mb-4">
                                    <h5 >Type_Mesure </h5>
                                </div>
                                <div class="champ">
                                    <select name="DesTypeMesure[]">
                                        @foreach ($typemesures as $typemesure)
                                            @if ($avoir_parametre_mesure->parametre_mesure->DesTypeMesure == $typemesure->DesTypeMesure)
                                                <option value="{{$typemesure->DesTypeMesure}}" selected>{{$typemesure->DesTypeMesure}}</option>
                                            @else
                                                <option value="{{$typemesure->DesTypeMesure}}">{{$typemesure->DesTypeMesure}}</option>     
                                            @endif                                       
                                        @endforeach   
                                    </select>
                                </div> 
                            </div>  
                            <div class="col">
                                <div class="titre mb-4">
                                    <h5 id="precision">Préçision</h5>
                                </div>
                                <div class="champ" id="inputprecision">
                                    <input type="text" name="DesPrecision[]" class="place2" value="{{$avoir_parametre_mesure->DesPrecision}}">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="boutonsparametre">
                    <div class="parametrebtn">
                        <a href="javascript:;" class="btnparametre" ><i class="bi bi-plus"></i></a>
                    </div>
                </div> 
            @endforeach                         
        </div>
        <div class="boutons mt-5">
            <button type="submit" role="button" id="titleadd" class="btn" data-toggle="modal"><i class="bi bi-plus-circle-fill"></i><span> Modifier</span></button>
            <a href="{{route('ListeTypeOutil.affiche')}}" role="button" id="titledelete" class="btn " data-toggle="modal"><i class="bi bi-dash-circle-fill"></i><span> Annuler</span></a>
        </div>
       
    </form>
</div>
<script>
    $('.modifie_type_outil').on('click','.btnparametre',function() {
    var line =
             '<div class="addparametremesure">'+
                    '<div class="col">'+
                        '<div class="titre mb-4">'+
                            '<h5 id="parametre">Paramétre</h5>'+
                        '</div>'+
                        '<div class="champ" id="inputparametre">'+
                            '<input type="text" name="DesParametreMesure[]" id="in_parametre">'+
                            '<a href="javascript:;" class="btnparametredel"><i class="bi bi-dash"></i></a> '+
                        '</div>'+
                    '</div>'+

                    '<div class="col">'+
                        '<div class="titre mb-4">'+
                            '<h5 >Type_Mesure </h5>'+
                        '</div>'+
                        '<div class="champ">'+
                            '<select name="DesTypeMesure[]">'+
                                '<option value="">Choisir un type de mesure</option>'+
                                '<option value="Variable Physique">Variable Physique</option>'+
                                '<option value="Quantitative">Quantitative</option>'+
                                '<option value="Qualitative">Qualitative</option>'+
                            '</select>'+
                        '</div>' +
                    '</div>'  +
                    '<div class="col">'+
                        '<div class="titre mb-4">'+
                            '<h5 id="precision">Préçision</h5>'+
                        '</div>'+
                        '<div class="champ" id="inputprecision">'+
                            '<input type="text" name="DesPrecision[]" class="place2">'+
                        '</div>'+
                    '</div>'+
                '</div>';
                   
      $('.info_sur_type_outil').append(line);
    });
    $('.modifie_type_outil').on('click','.btnparametredel',function(){
        $(this).parent().parent().parent().remove();
    });
    $('.modifie_type_outil').on('click','.suppavoirparametre',function(){
        $(this).parent().parent().parent().remove();
    });
    
</script>
{{-- ajouter un type outil de mesure --}}
@endsection