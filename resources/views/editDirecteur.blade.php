@extends("navbarsidebarRH")
@section("contenu")
<link rel="stylesheet" href="{{asset('css/employe.css')}}">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!--Ajouter un employé-->
<div class="tables">
            <form action="{{ route('employe.update', ['employe'=>$employe->id]) }}" method="post">
            @csrf
            <input type="hidden" name="_method" value="put">
                <div class="ajoutemp">
                   <h2>Modifier <span id="emp">Un Directeur</span></h2>
                    <h2 class="infoemp">Informations Personnelles</h2>
                    <table>
                        <tr class="line">
                        <td>
                                <h3 class="line1">Id</h3>
                            </td>
                            <td>
                                <div class="champ">
                                    <input type="number" name="id_emp" id="id" value="{{$employe->id}}" disabled> 
                                    <label><i class="fas fa-solid fa-id-badge"></i></label>
                                </div>
                            </td>
                            <td>
                                <h3 class="line2">CIN</h3>
                            </td>
                            <td>
                                <div class="champ">
                                    <input type="text" name="cin_emp" id="cin" value="{{$employe->cin_emp}}"> 
                                    <label><i class="fas fa-id-card"></i></label>
                                </div>
                            </td>
                        </tr>
                        <tr class="line">
                            <td>
                                <h3 class="line1">Nom</h3>
                            </td>
                            <td>
                                <div class="champ">
                                    <input type="text" name="nom_emp" id="nom" value="{{$employe->nom_emp}}">
                                    <label id="icone1"><i class="fas fa-user"></i></label>
                                </div>
                            </td>
        
                            <td>
                                <h3 class="line2">Prénom</h3>
                            </td>
                            <td>
                                <div class="champ">
                                    <input type="text" name="prenom_emp" id="prenom" value="{{$employe->prenom_emp}}">
                                    <label><i class="fas fa-user"></i></label>
                                </div>
                            </td>
                        </tr>
                        <tr class="line">
                            <td>
                                <h3 class="line1">Date de Naissance</h3>
                            </td>
                            <td>
                                <div class="champ">
                                    <input type="date" name="date_nais_emp" id="dt" value="{{$employe->date_naissance_emp}}">
                                </div>
                            </td>
                    
                            <td>
                                <h3 class="line2">État Civil</h3>
                            </td>
                            <td>
                                <div class="champ">
                                    <select name="etat_civil_emp">
                                    @if($employe->etat_civil_emp == "celibataire")
                                            <option value="celibataire" selected>Célibataire</option>
                                            <option value="marie">Marié</option>
                                            <option value="divorce">Divorcé</option>
                                            <option value="veuf">Veuf/Veuve</option>
                                    @elseif($employe->etat_civil_emp == "marie")
                                            <option value="marie" selected>Marié</option>
                                            <option value="celibataire">Célibataire</option>
                                            <option value="divorce">Divorcé</option>
                                            <option value="veuf">Veuf/Veuve</option>
                                    @elseif($employe->etat_civil_emp == "divorce")
                                            <option value="divorce" selected>Divorcé</option>
                                            <option value="celibataire">Célibataire</option>
                                            <option value="marie">Marié</option>
                                            <option value="veuf">Veuf/Veuve</option>
                                    @else
                                            <option value="veuf" selected>Veuf/Veuve</option>
                                            <option value="celibataire">Célibataire</option>
                                            <option value="marie">Marié</option>
                                            <option value="divorce">Divorcé</option>
                                    @endif
                                        </select>
                                </div>
                            </td>
                        </tr>

                        <tr  class="line"> 
                            <td>
                                <h3 class="line1">Téléphone 1</h3>
                            </td>
                            <td>
                                <div class="champ">
                                    <input type="text" name="tel1_emp" id="tel1" value="{{$employe->tel1_emp}}">
                                    <label><i class="fas fa-phone"></i></label>
                                </div>
                            </td>
                            <td>
                                <h3 class="line2">Téléphone 2</h3>
                            </td>
                            <td>
                                <div class="champ">
                                    <input type="text" name="tel2_emp" id="tel2" value="{{$employe->tel2_emp}}">
                                    <label><i class="fas fa-phone" ></i></label>
                                </div>
                            </td>
                        </tr>
                        <tr  class="line"> 
                            <td>
                                <h3 class="line1">Mobile 1</h3>
                            </td>
                            <td>
                                <div class="champ">
                                    <input type="text" name="mob1_emp" id="mob1" value="{{$employe->mob1_emp}}">
                                    <label><i class="fas fa-mobile"></i></label>
                                </div>
                            </td>
                            <td>
                                <h3 class="line2">Mobile 2</h3>
                            </td>
                            <td>
                                <div class="champ">
                                    <input type="text" name="mob2_emp" id="mob2" value="{{$employe->mob2_emp}}">
                                    <label><i class="fas fa-mobile"></i></label>
                                </div>
                            </td>
                        </tr>
                                          
                       
                    </table>


                    <h2 class="infoemp" id="infopro">Informations Professionnelles</h2>
                    <table id="table2">
                        <tr class="line">
                           
                            <td>
                                <h3 class="line1">Date Recrutement</h3>
                            </td>
                            <td>
                                <div class="champ">
                                    <input type="date" name="date_rec_emp" id="dt" class="place1" value="{{$employe->date_recrutement_emp}}">
                                </div>
                            </td>
                            <td>
                                    <h3 class="line2">Congé maladie</h3>
                                </td>
                                <td>
                                    <div class="champ">
                                        <input type="number" name="conge_mal" id="congem" placeholder="Seuil congé maladie (jours)" value="{{$employe->seuil_conge_maladie}}">
                                        <label><i class="fas fa-solid fa-bed"></i></label>
                                    </div>
                                </td>
                        </tr>
                       
                        <tr class="line">
                        <td>
                                    <h3 class="line1">Salaire base</h3>
                                </td>
                                <td>
                                    <div class="champ">
                                        <input type="number" name="salaire_emp" value="{{$employe->salaire_base_emp}}">
                                        <label><i class="fas fa-solid fa-comment-dollar"></i></label>
                                    </div>
                                </td>
                               
                                <td>
                                    <h3 class="line2">Congé annuel</h3>
                                </td>
                                <td>
                                    <div class="champ">
                                        <input type="number" name="conge_annuel" id="congea" placeholder="Seuil congé annuel (jours)" value="{{$employe->seuil_conge_annuel}}">
                                        <label><i class="fas fa-solid fa-bells"></i></label>
                                    </div>
                                </td>
                            </tr>
                                <tr class="line">
                                <td>
                                    <h3 class="line1">Rôle</h3>
                                </td>
                                <td>           
                                    <div id="champ">
                                    <label id="dir"><input type="radio" name="role" value="directeur" checked>&nbsp Directeur</label>
                                    <label id="empl"><input  type="radio" name="role" value="employe" disabled>&nbsp Employé</label>
                                    </div>                                 
                                </td>
                                <td>
                                    <h3 class="line2">Congé accidentel</h3>
                                </td>
                                <td>
                                    <div class="champ">
                                        <input type="number" name="conge_acc" id="congeac" placeholder="Seuil congé accidentel (jours)" value="{{$employe->seuil_conge_accidentel}}">
                                        <label><i class="fas fa-solid fa-hospital"></i></label>
                                    </div>
                                </td>
                            </tr>

                          
                    </table>
                    <h2 class="infoemp" id="infopro">Informations Académidiques</h2>
                        <table>
                    @foreach ($employe->diplome as $item)
                        <tr class="line" id="iddip">
                            <td>
                                <h3 class="line1">Niveau</h3>
                            </td>
                            <td>
                                <div class="champ">
                                    <select id="selectniv" name="niveau_emp[]">
                                        @if($item->niveau == "sans bac")
                                            <option value="sans bac" selected>Sans bac</option>
                                            <option value="baccalaureat">Baccalauréat</option>
                                            <option value="technicien">Technicien</option>
                                            <option value="technicien superieur">Technicien supérieur</option>
                                            <option value="ingenieur">Ingénieur</option>

                                        @elseif($item->niveau == "baccalaureat")
                                        <option value="sans bac">Sans bac</option>
                                            <option value="baccalaureat" selected>Baccalauréat</option>
                                            <option value="technicien">Technicien</option>
                                            <option value="technicien superieur">Technicien supérieur</option>
                                            <option value="ingenieur">Ingénieur</option>

                                        @elseif($item->niveau == "technicien")
                                            <option value="sans bac">Sans bac</option>
                                            <option value="baccalaureat">Baccalauréat</option>
                                            <option value="technicien" selected>Technicien</option>
                                            <option value="technicien superieur">Technicien supérieur</option>
                                            <option value="ingenieur">Ingénieur</option>

                                        @elseif($item->niveau == "technicien superieur")
                                            <option value="sans bac">Sans bac</option>
                                            <option value="baccalaureat">Baccalauréat</option>
                                            <option value="technicien">Technicien</option>
                                            <option value="technicien superieur" selected>Technicien supérieur</option>
                                            <option value="ingenieur">Ingénieur</option>

                                        @else
                                            <option value="sans bac">Sans bac</option>
                                            <option value="baccalaureat">Baccalauréat</option>
                                            <option value="technicien">Technicien</option>
                                            <option value="technicien superieur">Technicien supérieur</option>
                                            <option value="ingenieur" selected>Ingénieur</option>
                                        @endif
                                        </select>
                                </div>
                            </td>
                            
                            <td>
                                <h3 class="line2"></h3>
                            </td>
                            <td>
                                <div class="champ" id="inputdip">
                                    <input type="number" name="num_dip_emp[]" id="dip" value="{{$item->id}}" hidden>
                                </div>
                            </td>
                        </tr>
                        <tr class="line" id="ide">
                            <td>
                                <h3 class="line1" id="tdecole">École</h3>
                            </td>
                            <td>
                                <div class="champ" id="inputecole">
                                    <input type="text" name="ecole_emp[]" id="ecole" value="{{$item->ecole}}">
                                    <label id="iconeecole"><i class="fas fa-university"></i></label>

                                </div>
                            </td>
                                    
                            <td>
                                <h3 class="line2" id="tddate">Date Obtention</h3>
                            </td>
                            <td>
                                <div class="champ" id="inputdate">
                                    <input type="date" name="date_ob_dip[]" value="{{$item->dt_obtention}}">

                                </div>
                            </td>
                           </tr>
                        @endforeach                         
                        </table>
                  
                        <div class="btnconfannuler" >                                   
                    <button class="button-82-pushable"  role="button"  id="btnc">
                        <span class="button-82-shadow"></span>
                        <span class="button-82-edgec"></span>
                        <span class="button-82-frontc text ">
                            <span class="fa fa-solid fa-plus"></span>
                         Modifier
                        </span>
                      </button>

                      <a  href="{{url()->previous()}}" class="btnannuler " role="button"  id="btna">
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

@endsection