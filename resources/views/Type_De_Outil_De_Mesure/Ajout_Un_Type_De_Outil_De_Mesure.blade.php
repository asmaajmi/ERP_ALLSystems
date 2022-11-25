@extends("layouts.Navbar_Sidebar")
@section("contenu")
<link rel="stylesheet" href="{{ asset('css/type outil mesure/Ajout_Un_Type_De_Outil_De_Mesure.css')}}">
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
{{-- ajouter un type outil de mesure --}}
<div class="container" id="addtypeoutilmes">
    <form action="{{route('AjoutTypeOutil.Ajouter')}}" method="post">
      @csrf
        <div class="ajout_type_outil">
            @include('sweetalert::alert')
            <h2 class="mb-5 addtypeoutilmestitle">Ajouter<b> Un Type D'outil De Mesure</b></h2>
            <div class="info_sur_type_outil">
                <div class="col">
                    <div class="titre mt-2 mb-4">
                        <h5>Designation</h5>
                    </div>
                    <div class="champ">
                        <input type="text" name="DesTypeOutil"> 
                    </div>
                </div>
                <div class="col">
                        <div class="titre mb-4">
                            <h5 >Catégorie </h5>
                        </div>
                        <div class="champ">
                            <select name="Categorie">
                                <option value="">-- Choisir la catégorie --</option>
                                <option value= true >Etalon</option>
                                <option value= false >Outil</option>
                            </select>
                        </div> 
                    </div>  
                <div class="addparametremesure">
                    <div class="col">
                        <div class="titre mb-4">
                            <h5 id="parametre">Paramétre</h5>
                        </div>
                        <div class="champ" id="inputparametre">
                            <input type="text" name="DesParametreMesure[]" id="in_parametre">
                        </div>
                    </div>

                    <div class="col">
                        <div class="titre mb-4">
                            <h5 >Type_Mesure </h5>
                        </div>
                        <div class="champ">
                            <select name="DesTypeMesure[]">
                                <option value="">-- Choisir un type de mesure --</option>
                                <option value="Variable Physique">Variable Physique</option>
                                <option value="Quantitative">Quantitative</option>
                                <option value="Qualitative">Qualitative</option>
                            </select>
                        </div> 
                    </div>  
                    <div class="col">
                        <div class="titre mb-4">
                            <h5 id="precision">Préçision</h5>
                        </div>
                        <div class="champ" id="inputprecision">
                            <input type="text" name="DesPrecision[]" class="place2">
                        </div>
                    </div>
                </div>
            </div>
            <div class="boutonsparametre">
                <div class="parametrebtn">
                    <a href="javascript:;" class="btnparametre" ><i class="bi bi-plus"></i></a>
                </div>
            </div>                          
        </div>
        <div class="boutons mt-5">
            <button type="submit" role="button" id="titleadd" class="btn" data-toggle="modal"><i class="bi bi-plus-circle-fill"></i><span> Ajouter</span></button>
            <a href="{{route('ListeTypeOutil.affiche')}}" role="button" id="titledelete" class="btn " data-toggle="modal"><i class="bi bi-dash-circle-fill"></i><span> Annuler</span></a>
        </div>
       
    </form>
</div>
<script>
    $('.ajout_type_outil').on('click','.btnparametre',function() {
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
    $('.ajout_type_outil').on('click','.btnparametredel',function(){
        $(this).parent().parent().parent().remove();
    });
</script>
{{-- ajouter un type outil de mesure --}}
@endsection
