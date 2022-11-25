@extends("navbarsidebarParcMachine")
@section("contenu")
<link rel="stylesheet" href="{{asset('css/machine.css')}}">
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!--Ajouter un employé-->
<div class="tables">

    <!-- début le formulaire de création de machine -->
        <form action="{{route('machine.ajout')}}" method="post">
            @csrf
                <div class="ajoutmachine">
                    <h2>Ajouter <span id="machine">Une Machine</span></h2>
                    <h2 class="infomach">Informations De La Machine</h2>
                    <table>
                        <tr class="line">
                            <!-- le champ pour l'identifiant de la machine -->
                        <td>
                                <h3 class="line1">Id</h3>
                            </td>
                            <td>
                                <div class="champ">
                                    <input type="text" name="id_mach" id="id"> 
                                    <label><i class="fas fa-solid fa-id-badge"></i></label>
                                </div>
                            </td>
                            <td>
                            <!-- le champ pour nom  de la machine -->
                                <h3 class="line2">Nom</h3>
                            </td>
                            <td>
                                <div class="champ">
                                    <input type="text" name="nomMachine" id="nom_mach"> 
                                    <label><i class="fas fa-id-card"></i></label>
                                </div>
                            </td>
                        </tr>
                        <tr class="line">
                            <td>
                            <!-- le champ pour MTBF de la machine -->
                                <h3 class="line1">MTBF</h3>
                            </td>
                            <td>
                                <div class="champ">
                                    <input type="text" name="mtbf" id="mtbf" >
                                </div>
                            </td>
        
                            <td>
                            <!-- le champ pour MTTR de la machine -->
                                <h3 class="line2">MTTR</h3>
                            </td>
                            <td>
                                <div class="champ">
                                    <input type="text" name="mttr" id="mttr" >
                                </div>
                            </td>
                        </tr>
                        <tr class="line">
                            <td>
                            <!-- le champ pour le prix d'achat  de la machine -->
                                <h3 class="line1">Prix Achat</h3>
                            </td>
                            <td>
                                <div class="champ">
                                    <input type="text" name="prixachat" id="prixachat">
                                </div>
                            </td>
                    
                            <td>
                            <!-- le champ pour la date d'achat de la machine -->
                                <h3 class="line2">Date D'Achat</h3>
                            </td>
                            <td>
                                <div class="champ">
                                <input type="date" name="dtachat" id="dtachat">
                                </div>
                            </td>
                        </tr>

                        <tr  class="line"> 
                            <td>
                            <!-- champ pour la capacité de la machine -->
                                <h3 class="line1">Capacité</h3>
                            </td>
                            <td>
                                <div class="champ">
                                    <input type="text" name="capacite" id="capacite" placeholder="nombre d'heure par semaine">
                                </div>
                            </td>
                            <td>
                            <!-- champ pour la description de la machine -->
                                <h3 class="line2">Description</h3>
                            </td>
                            <td>
                                <div class="champ">
                                    <textarea  name="description" id="description" rows="4" cols="37"></textarea>
                                </div>
                            </td>
                        </tr>
                                                                                       
                    </table>
                                 
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
       
@endsection