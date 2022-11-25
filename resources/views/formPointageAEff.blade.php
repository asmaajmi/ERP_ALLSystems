@extends("navbarsidebarRH")
@section("contenu")
<link rel="stylesheet" href="{{asset('css/pointageAEff.css')}}">
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
<!--Ajouter un pointage à effectuer-->
<div class="tables">
            <form action="{{route('pointaeff.add')}}" method="post">
            @csrf
                <div class="ajout1">
                   <h2>Ajouter <span id="emp">Un Pointage À Effectuer</span></h2>
                    <table>
                        <tr class="line">
                        <td>
                                <h3 class="line1">Nom Employé</h3>
                            </td>
                            <td>
                                <div class="champ">
                                <select name="id_emp">
								@foreach ($employes as $employe)
								<option value="{{$employe->id}}">{{$employe->prenom_emp}}&nbsp;{{$employe->nom_emp}}</option>
								@endforeach
							</select>
                                </div>
                            </td>
                            <td>
                                <h3 class="line2"><label class="tit">Designation</label></h3>
                            </td>
                            <td>
                                <div class="champ">
                                    <input type="text" name="des_pointage" class="espace m"> 
                                </div>
                            </td>
                        </tr>
                        <tr class="line">
                            <td>
                                <h3 class="line1">Date Debut Période</h3>
                            </td>
                            <td>
                                <div class="champ">
                                    <input type="date" name="date_deb_periode"> 
                                </div>
                            </td>

                            <td>
                                <h3 class="line2"><label class="tit">Fin Période</label></h3>
                            </td>
                            <td>
                                <div class="champ">
                                    <input type="date" name="date_fin_periode" class="espace m">
                                </div>
                            </td>
                        </tr>
                        <tr class="line">
                            <td class="semaine">
                                <h3 class="line1"><b>Lundi</b></h3></td>

                            <td class="semaine">
                            <h3 class="labelheures labelentree">Heure Entrée:
                            <input type="time" name="heureentree1" class="heures he1"></h3></td>

                            <td class="semaine">   
                            <h3 class="labelheures labelsortie">Heure Sortie:
                            <input type="time" name="heuresortie1" class="heures hs1"></h3></td> 
                        </tr>
                
                            <tr class="line">
                            <td class="semaine">
                                <h3 class="line1"><b>Mardi</b></h3></td>

                            <td class="semaine">
                            <h3 class="labelheures labelentree">Heure Entrée:
                            <input type="time" name="heureentree2" class="heures he1"></h3></td>

                            <td class="semaine">   
                            <h3 class="labelheures labelsortie">Heure Sortie:
                            <input type="time" name="heuresortie2" class="heures hs1"></h3></td> 
                        </tr>
                            
                            <tr class="line">
                            <td class="semaine">
                                <h3 class="line1"><b>Mercredi</b></h3></td>

                            <td class="semaine">
                            <h3 class="labelheures labelentree">Heure Entrée:
                            <input type="time" name="heureentree3" class="heures he1"></h3></td>

                            <td class="semaine">   
                            <h3 class="labelheures labelsortie">Heure Sortie:
                            <input type="time" name="heuresortie3" class="heures hs1"></h3></td> 
                        </tr>
                            
                            <tr class="line">
                            <td class="semaine">
                                <h3 class="line1"><b>Jeudi</b></h3></td>

                            <td class="semaine">
                            <h3 class="labelheures labelentree">Heure Entrée:
                            <input type="time" name="heureentree4" class="heures he1"></h3></td>

                            <td class="semaine">   
                            <h3 class="labelheures labelsortie">Heure Sortie:
                            <input type="time" name="heuresortie4" class="heures hs1"></h3></td> 
                        </tr>
                           
                            <tr class="line">
                            <td class="semaine">
                                <h3 class="line1"><b>Vendredi</b></h3></td>

                            <td class="semaine">
                            <h3 class="labelheures labelentree">Heure Entrée:
                            <input type="time" name="heureentree5" class="heures he1"></h3></td>

                            <td class="semaine">   
                            <h3 class="labelheures labelsortie">Heure Sortie:
                            <input type="time" name="heuresortie5" class="heures hs1"></h3></td> 
                        </tr>
                           
                            <tr class="line">
                            <td class="semaine">
                                <h3 class="line1"><b>Samedi</b></h3></td>

                            <td class="semaine">
                            <h3 class="labelheures labelentree">Heure Entrée:
                            <input type="time" name="heureentree6" class="heures he1"></h3></td>

                            <td class="semaine">   
                            <h3 class="labelheures labelsortie">Heure Sortie:
                            <input type="time" name="heuresortie6" class="heures hs1"></h3></td> 
                        </tr>
                          
                            <tr class="line">
                            <td class="semaine">
                                <h3 class="line1"><b>Dimanche</b></h3></td>

                            <td class="semaine">
                            <h3 class="labelheures labelentree">Heure Entrée:
                            <input type="time" name="heureentree7" class="heures he1"></h3></td>

                            <td class="semaine">   
                            <h3 class="labelheures labelsortie">Heure Sortie:
                            <input type="time" name="heuresortie7" class="heures hs1"></h3></td> 
                        </tr>
                            
                    </table>

                    <button class="button-82-pushable"  role="button"  id="btnc">
                        <span class="button-82-shadow"></span>
                        <span class="button-82-edgec"></span>
                        <span class="button-82-frontc text ">
                            <span class="fa fa-solid fa-plus"></span>
                         Ajouter
                        </span>
                      </button>
                      </form>
                      
                      <button class="button-82-pushable " role="button"  id="btna" onclick="{{route('pointaeff.list')}}">
                        <span class="button-82-shadow"></span>
                        <span class="button-82-edgea"></span>
                        <span class="button-82-fronta text ">
                            <span class="fa fa-solid fa-ban"></span>
                         Annuler
                        </span>
                      </button>
                </div>
                             
<script>
    /**Lundi pause */
 $('.ajout1').on('click', '.btnpauselundi', function() {
var tr = 
                '<tr>'+
                        '<td>'+
                                '<h3 class="line1"><label class="despause">Designation De Pause</label></h3>'+
                            '</td>'+
                            '<td>'+
                                '<div class="champ">'+
                                    '<input type="text" name="des_pause1[]">'+
                                '</div>'+
                            '</td>'+

                            '<td class="semaine">'+  
                            '<h3 class="labelheures labelsortie">Heure Début:<input type="time" name="heurepausedebut1[]" class="heures hs1">'+
                            '</h3>'+
                            '</td>'+

                            '<td class="semaine">'+ 
                            '<h3 class="labelheures labelpausef">Heure Fin:<input type="time" name="heurepausefin1[]" class="heures hs1">'+
                            '</h3>'+
                            '</td>'+          
                '</tr>';
                $('#tablundi').append(tr);
 });


/**Mardi pause */
 $('.ajout1').on('click', '.btnpausemardi', function() {
var tr = 
                    '<tr>'+
                        '<td>'+
                                '<h3 class="line1"><label class="despause">Designation De Pause</label>'+
                                '</h3>'+
                            '</td>'+
                            '<td>'+
                                '<div class="champ">'+
                                    '<input type="text" name="des_pause2[]">'+
                                '</div>'+
                            '</td>'+

                            '<td class="semaine">'+   
                            '<h3 class="labelheures labelsortie">Heure Début:<input type="time" name="heurepausedebut2[]" class="heures hs1">'+
                            '</h3>'+
                            '</td>'+

                            '<td class="semaine">'+   
                            '<h3 class="labelheures labelpausef">Heure Fin:<input type="time" name="heurepausefin2[]" class="heures hs1">'+
                            '</h3>'+
                            '</td>'+           
                        '</tr>';
                $('#tabmardi').append(tr);
 });



/**Mercredi pause */
$('.ajout1').on('click', '.btnpausemercredi', function() {
var tr = 
                   '<tr>'+
                        '<td>'+
                            '<h3 class="line1"><label class="despause">Designation De Pause</label>'+
                            '</h3>'+
                        '</td>'+
                        '<td>'+
                            '<div class="champ">'+
                                    '<input type="text" name="des_pause3[]">'+
                            '</div>'+
                        '</td>'+

                        '<td class="semaine">'+  
                            '<h3 class="labelheures labelsortie">Heure Début:<input type="time" name="heurepausedebut3[]" class="heures hs1">'+
                            '</h3>'+
                        '</td>'+ 

                        '<td class="semaine">'+   
                            '<h3 class="labelheures labelpausef">Heure Fin:<input type="time" name="heurepausefin3[]" class="heures hs1">'+
                            '</h3>'+
                        '</td>'+         
                    '</tr>';
                $('#tabmercredi').append(tr);
 });



 /**Jeudi pause */
$('.ajout1').on('click', '.btnpausejeudi', function() {
var tr = 
'<tr>'+
        '<td>'+
            '<h3 class="line1"><label class="despause">Designation De Pause</label>'+
            '</h3>'+
        '</td>'+
        '<td>'+
            '<div class="champ">'+
                '<input type="text" name="des_pause4[]">'+
            '</div>'+
        '</td>'+

        '<td class="semaine">'+  
            '<h3 class="labelheures labelsortie">Heure Début:<input type="time" name="heurepausedebut4[]" class="heures hs1">'+
            '</h3>'+
        '</td>'+

        '<td class="semaine">'+  
            '<h3 class="labelheures labelpausef">Heure Fin:<input type="time" name="heurepausefin4[]" class="heures hs1">'+
            '</h3>'+
        '</td>'+          
'</tr>';
        $('#tabjeudi').append(tr);
 });



 /**Vendredi pause */
$('.ajout1').on('click', '.btnpausevendredi', function() {
var tr = 
'<tr>'+
        '<td>'+
            '<h3 class="line1"><label class="despause">Designation De Pause</label>'+
            '</h3>'+
        '</td>'+
        '<td>'+
            '<div class="champ">'+
                '<input type="text" name="des_pause5[]">'+ 
            '</div>'+
        '</td>'+

        '<td class="semaine">'+   
            '<h3 class="labelheures labelsortie">Heure Début:<input type="time" name="heurepausedebut5[]" class="heures hs1">'+
            '</h3>'+
        '</td>'+ 

        '<td class="semaine">'+   
            '<h3 class="labelheures labelpausef">Heure Fin:<input type="time" name="heurepausefin5[]" class="heures hs1">'+
            '</h3>'+
        '</td>'+         
'</tr>';
        $('#tabvendredi').append(tr);
 });



 /**Samedi pause */
$('.ajout1').on('click', '.btnpausesamedi', function() {
var tr = 
'<tr>'+
        '<td>'+
            '<h3 class="line1"><label class="despause">Designation De Pause</label>'+
            '</h3>'+
        '</td>'+
        '<td>'+
            '<div class="champ">'+
                '<input type="text" name="des_pause6[]">'+ 
            '</div>'+
        '</td>'+

        '<td class="semaine">'+  
            '<h3 class="labelheures labelsortie">Heure Début:<input type="time" name="heurepausedebut6[]" class="heures hs1">'+
            '</h3>'+
        '</td>'+ 

        '<td class="semaine">'+  
            '<h3 class="labelheures labelpausef">Heure Fin:<input type="time" name="heurepausefin6[]" class="heures hs1">'+
            '</h3>'+
        '</td>'+           
'</tr>';
        $('#tabsamedi').append(tr);
 });


 /**Samedi pause */
$('.ajout1').on('click', '.btnpausedimanche', function() {
var tr = 
'<tr>'+
        '<td>'+
            '<h3 class="line1"><label class="despause">Designation De Pause</label>'+
            '</h3>'+
        '</td>'+
        '<td>'+
            '<div class="champ">'+
                '<input type="text" name="des_pause7[]">'+
            '</div>'+
        '</td>'+

        '<td class="semaine">'+ 
            '<h3 class="labelheures labelsortie">Heure Début:<input type="time" name="heurepausedebut7[]" class="heures hs1">'+
            '</h3>'+
        '</td>'+

        '<td class="semaine">'+ 
            '<h3 class="labelheures labelpausef">Heure Fin:<input type="time" name="heurepausefin7{]" class="heures hs1">'+
            '</h3>'+
        '</td>'+           
'</tr>';
        $('#tabdimanche').append(tr);
 });

</script>
@endsection