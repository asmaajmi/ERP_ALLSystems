@extends("navbarsidebarRH")
@section("contenu")
<link rel="stylesheet" href="{{asset('css/employe.css')}}">
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!--Ajouter un employé-->
<div class="tables">

    <!-- début le formulaire de création d'employe -->
        <form action="{{route('create.employe')}}" method="post">
            @csrf
                <div class="ajoutemp">
                    <h2>Ajouter <span id="emp">Un Employé</span></h2>
                    <h2 class="infoemp">Informations Personnelles</h2>
                    <table>
                        <tr class="line">
                            <!-- le champ pour l'identifiant de l'emplye -->
                        <td>
                                <h3 class="line1">Id<span id="obligatoire">*</span></h3>
                            </td>
                            <td>
                                <div class="champ">
                                    <input type="number" name="id_emp" id="id"> 
                                    <label><i class="fas fa-solid fa-id-badge"></i></label>
                                </div>
                            </td>
                            <td>
                            <!-- le champ pour cin de l'employe -->
                                <h3 class="line2">CIN<span id="obligatoire">*</span></h3>
                            </td>
                            <td>
                                <div class="champ">
                                    <input type="text" name="cin_emp" id="cin"> 
                                    <label><i class="fas fa-id-card"></i></label>
                                </div>
                            </td>
                        </tr>
                        <tr class="line">
                            <td>
                            <!-- le champ pour nom de l'employe -->
                                <h3 class="line1">Nom<span id="obligatoire">*</span></h3>
                            </td>
                            <td>
                                <div class="champ">
                                    <input type="text" name="nom_emp" id="nom">
                                    <label id="icone1"><i class="fas fa-user"></i></label>
                                </div>
                            </td>
        
                            <td>
                            <!-- le champ pour prénom de l'employe -->
                                <h3 class="line2">Prénom<span id="obligatoire">*</span></h3>
                            </td>
                            <td>
                                <div class="champ">
                                    <input type="text" name="prenom_emp" id="prenom">
                                    <label><i class="fas fa-user"></i></label>
                                </div>
                            </td>
                        </tr>
                        <tr class="line">
                            <td>
                            <!-- le champ pour date de naissance de l'employe -->
                                <h3 class="line1">Date de Naissance<span id="obligatoire">*</span></h3>
                            </td>
                            <td>
                                <div class="champ">
                                    <input type="date" name="date_nais_emp" id="dt">
                                </div>
                            </td>
                    
                            <td>
                            <!-- select pour choix d'etat civil de l'employe -->
                                <h3 class="line2">État Civil<span id="obligatoire">*</span></h3>
                            </td>
                            <td>
                                <div class="champ">
                                    <select name="etat_civil_emp">
                                            <option value="celibataire">Célibataire</option>
                                            <option value="marie">Marié</option>
                                            <option value="divorce">Divorcé</option>
                                            <option value="veuf">Veuf/Veuve</option>
                                        </select>
                                </div>
                            </td>
                        </tr>

                        <tr  class="line"> 
                            <td>
                            <!-- champ pour le téléphone 1 de l'employé -->
                                <h3 class="line1">Téléphone 1<span id="obligatoire">*</span></h3>
                            </td>
                            <td>
                                <div class="champ">
                                    <input type="text" name="tel1_emp" id="tel1">
                                    <label><i class="fas fa-phone"></i></label>
                                </div>
                            </td>
                            <td>
                            <!-- champ pour le téléphone 2 de l'employé -->
                                <h3 class="line2">Téléphone 2</h3>
                            </td>
                            <td>
                                <div class="champ">
                                    <input type="text" name="tel2_emp" id="tel2">
                                    <label><i class="fas fa-phone" ></i></label>
                                </div>
                            </td>
                        </tr>
                        <tr  class="line"> 
                            <td>
                            <!-- champ pour le mobile 1 de l'employé -->
                                <h3 class="line1">Mobile 1<span id="obligatoire">*</span></h3>
                            </td>
                            <td>
                                <div class="champ">
                                    <input type="text" name="mob1_emp" id="mob1">
                                    <label><i class="fas fa-mobile"></i></label>
                                </div>
                            </td>
                            <td>
                            <!-- champ pour le mobile 2 de l'employé -->
                                <h3 class="line2">Mobile 2</h3>
                            </td>
                            <td>
                                <div class="champ">
                                    <input type="text" name="mob2_emp" id="mob2">
                                    <label><i class="fas fa-mobile"></i></label>
                                </div>
                            </td>
                        </tr>
                                          
                       
                    </table>


                    <h2 class="infoemp" id="infopro">Informations Professionnelles</h2>
                    <table id="table2">
                        <tr class="line">
                            <td>
                            <!-- champ de date recrutement  de l'employé -->
                                <h3 class="line1">Date Recrutement<span id="obligatoire">*</span></h3>
                            </td>
                            <td>
                                <div class="champ">
                                    <input type="date" name="date_rec_emp" id="dt" class="place1">

                                </div>
                            </td>

                            <td>
                                <!-- le champ pour le  Seuil congé maladie -->
                                    <h3 class="line2">Congé maladie<span id="obligatoire">*</span></h3>
                                </td>
                                <td>
                                    <div class="champ">
                                        <input type="number" name="conge_mal" id="congem" placeholder="Seuil congé maladie (jours)">
                                        <label><i class="fas fa-solid fa-bed"></i></label>
                                    </div>
                                </td>
                            
                        </tr>
                        
                        <tr class="line">
                        <td>
                            <!-- le champ de salaire base de l'employé -->
                                    <h3 class="line1">Salaire base<span id="obligatoire">*</span></h3>
                                </td>
                                <td>
                                    <div class="champ">
                                        <input type="number" name="salaire_emp">
                                        <label><i class="fas fa-solid fa-comment-dollar"></i></label>
                                    </div>
                                </td>
                               
                                <td>
                                <!-- le champ pour le  Seuil congé annuel-->
                                    <h3 class="line2">Congé annuel<span id="obligatoire">*</span></h3>
                                </td>
                                <td>
                                    <div class="champ">
                                        <input type="number" name="conge_annuel" id="congea" placeholder="Seuil congé annuel (jours)">
                                        <label><i class="fas fa-solid fa-bells"></i></label>
                                    </div>
                                </td>
                            </tr>
                            <tr class="line">
                                <td>
                                <!-- ici c'est le choix de role pour l'employe est-ce qui est un directeur pour diriger un service ou bien un employe qui travaille dans un service -->
                                    <h3 class="line1">Rôle<span id="obligatoire">*</span></h3>
                                </td>
                                <td>
                                    <div id="champ">
                                    <label id="dir"><input type="radio" name="role" value="directeur" checked>&nbsp Directeur</label>
                                    <label id="empl"><input  type="radio" name="role" value="employe" >&nbsp Employé</label>
                                    </div>
                                </td>                                   
                                <td>
                                <!-- le champ pour le  Seuil congé accidentel-->
                                    <h3 class="line2">Congé accidentel<span id="obligatoire">*</span></h3>
                                </td>
                                <td>
                                    <div class="champ">
                                        <input type="number" name="conge_acc" id="congeac" placeholder="Seuil congé accidentel (jours)">
                                        <label><i class="fas fa-solid fa-hospital"></i></label>
                                    </div>
                                </td>
                            </tr>
                    </table>
                    <table id="table3">
                        
                            <tr id="service" class="line">
                                <td>
                                <!-- le choix du service pour un employe ces services sont ajouter et un chaque service est dirigé un directeur  -->
                                    <h3 class="line1">Service<span id="obligatoire">*</span></h3>
                                </td>
                                <td>
                                    <div class="champ">
                             <select name="id_serv">
                             <option value=""></option>
								@foreach ($services as $service)
								<option value="{{$service->id}}">{{$service->des_serv}}</option>
								@endforeach
							</select>
                                    </div>
                                </td>
                                <td>
                                <!-- champ date début de travail d'un employé dans un service -->
                                    <h3 class="line2">Date Debut<span id="obligatoire">*</span></h3>
                                </td>
                                <td>
                                    <div class="champ">
                                        <input type="date" name="date_debut_tr" id="dates">
                                    </div>
                                </td>
                        </tr>
                    </table> 
                    <h2 class="infoemp" id="infopro">Informations Académidiques</h2>
                    <table id="table4">
                        <tr class="line" id="iddip">
                            <td>
                            <!-- le niveau académique de l'employe -->
                                <h3 class="txtdip" id="niveau">Niveau<span id="obligatoire">*</span></h3>
                            </td>
                            <td>
                                <div class="champdip">
                                    <select id="selectniv" name="niveau_emp[]">
                                            <option value="sans bac">Sans bac</option>
                                            <option value="baccalaureat">Baccalauréat</option>
                                            <option value="technicien">Technicien</option>
                                            <option value="technicien superieur">Technicien supérieur</option>
                                            <option value="ingenieur">Ingénieur</option>
                                        </select>
                                </div>
                            </td>
                            <td>
                            <!-- le champ de nom de l'école d'obtention du diplome -->
                                <h3 class="txtdip" id="tdecole">École<span id="obligatoire">*</span></h3>
                            </td>
                            <td>
                                <div class="champdip" id="inputecole">
                                    <input type="text" name="ecole_emp[]" id="ecole">
                                    {{--<label id="iconeecole"><i class="fas fa-university"></i></label>--}}

                                </div>
                            </td>
                                    
                            <td>
                            <!-- la date d'obtention du diplome -->
                                <h3 class="txtdip" id="tddate">Date Obtention<span id="obligatoire">*</span></h3>
                            </td>
                            <td>
                                <div class="champdip" id="inputdate">
                                    <input type="date" name="date_ob_dip[]">

                                </div>
                            </td>
                        </tr>
                    </table>
                    
                    <div class="add_delete">
                        <a class="ajouter_emp" href="javascript:;" id="">Ajouter diplome</i></a>
                        <a class="supprimer_emp" href="javascript:;" id="">Supprimer diplome</a>
                    </div>
                          
                        
                    <div class="btnconfannuler" >                                   
                        <button class="button-82-pushable"  role="button"  id="btnc">
                            <span class="button-82-shadow"></span>
                            <span class="button-82-edgec"></span>
                            <span class="button-82-frontc text ">
                                <span class="fa fa-solid fa-plus"></span>
                            Ajouter
                            </span>
                        </button>

                        <a  href="{{url()->previous()}}" class="btnannuler"  id="btna">
                            <span class="button-annuler-82-shadow"></span>
                            <span class="button-82-edgea"></span>
                            <span class="button-82-fronta text ">
                                <span class="fa fa-solid fa-ban"></span>
                            Annuler
                            </span>
                        </a>
                   
                    </div>
                </div>
            </form>
        </div>
<script>
var directeur = document.getElementById('dir');
var aff1 = function(){
    $('#service').hide();
    $('#db').hide();
    $('#champ1').css("margin-right","634px"); 
    $('#champ1').css("margin-left","0"); 
}
directeur.addEventListener('click', aff1);
var emp = document.getElementById('empl');
var aff2 = function(){
    $('#service').show();
    $('#db').show();
     $('#champ1').css("margin-left","0px"); 
     $('#champ1').css("margin-right","170px"); 
}
emp.addEventListener('click', aff2);
</script>

<script>
$('.add_delete').on('click', '.ajouter_emp', function() {
        var tr =  
        '<tr class="line" id="iddip">'+
            '<td>'+
                '<h3 class="txtdip" id="niveau">Niveau<span id="obligatoire">*</span></h3>'+
            '</td>'+
            '<td>'+
                '<div class="champdip">'+
                    '<select id="selectniv" name="niveau_emp[]">'+
                            '<option value="sans bac">Sans bac</option>'+
                            '<option value="baccalaureat">Baccalauréat</option>'+
                            '<option value="technicien">Technicien</option>'+
                            '<option value="technicien superieur">Technicien supérieur</option>'+
                            '<option value="ingenieur">Ingénieur</option>'+
                        '</select>'+
                '</div>'+
            '</td>'+
            '<td>'+
                '<h3 class="txtdip" id="tdecole">École<span id="obligatoire">*</span></h3>'+
            '</td>'+
            '<td>'+
                '<div class="champdip" id="inputecole">'+
                    '<input type="text" name="ecole_emp[]" id="ecole">'+
                    //'<label id="iconeecole"><i class="fas fa-university"></i></label>'+

                '</div>'+
            '</td>'+
                    
            '<td>'+
                '<h3 class="txtdip" id="tddate">Date Obtention<span id="obligatoire">*</span></h3>'+
            '</td>'+
            '<td>'+
                '<div class="champdip" id="inputdate">'+
                    '<input type="date" name="date_ob_dip[]">'+

                '</div>'+
            '</td>'+
        '</tr>'
        $('#table4').append(tr);               
 });
 $('.add_delete').on('click', '.supprimer_emp', function() {
   
    $('#table4 tr:last').remove();
});
</script>
@endsection