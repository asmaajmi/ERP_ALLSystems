@extends("navbarsidebarProduction")
@section("contenu")
<link rel="stylesheet" href="{{asset('css/consommation.css')}}">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>

<!--Ajouter les heures supplémentaires a effectuer-->
<div class="tablesformoutilfabrication">
	<form action="{{route('Cons.ajout')}}" method="post">
		@csrf
		<div class="ajoutoutilfab">
			@include('sweetalert::alert')

            <h2 class="titreoutilfab"><span id="outil">Consommation D' Outils De Fabrication</span></h2>
			<table>
				<tr>
					<td class="txtoutilfab">
						<h3 class="formtxt" id="idoutil" class="lignemachinetit">Machine</h3>
					</td>
					<td>
						<div class="champoutilfab">
                            <select name="machine_id" class="sel lignemachine">
                            <option value=""></option>
                                        @foreach($machines as $machine)
                                            <option value="{{$machine->id}}">{{$machine->nom_machine}}</option>
                                        @endforeach
                            </select>				
						</div>
					</td>
				</tr>

                <tr class="line">
                <td>
                            <!-- le champ pour le nom de produit -->
                                    <h3 class="formtxt">Produit</h3>
                                </td>
                                <td>
                                    <div class="champoutil">                             
                                        <select name="nomproduit" class="outilligne sel" id="selprod">
                                            <option value=""></option>
                                        @foreach($produits as $produit)
                                            <option value="{{$produit->id}}">{{$produit->nom_produit_const}}</option>
                                        @endforeach
                                        </select>                                  
                                    </div>
                                </td>
            
                                <td>
                                <!-- le champ pour la quantité d'outil -->
                                    <h3  class="formtxt" id="qteprodtit">Quantité</h3>
                                </td>
                                <td>
                                    <div class="champoutil">
                                        <input type="number" name="qteprod" id="qteprod">                                    
                                    </div>
                                </td>
                                <td>
                                <!-- le champ pour l'unité d'outil-->
                                    <h3  class="formtxt" id="uniteprodtit">Unité</h3>
                                </td>
                                <td>
                                    <div class="champoutil">
                                        <input type="text" name="uniteprod" id="uniteprod">
                                    </div>
                                </td>
                </tr>
            </table>

<h2 class="outilinfo">Outils De Fabrication</h2>
                    <table id="table2">
                        <tr class="line"> 
                            <td>
                            <!-- le champ pour le nom d'outil de fabrication -->
                                    <h3 class="formtxt">Nom</h3>
                                </td>
                                <td>
                                    <div class="champoutil">                             
                                        <select name="nomoutil[]" class="outilligne sel">
                                            <option value=""></option>
                                        @foreach($outils as $outil)
                                            <option value="{{$outil->id}}">{{$outil->nom}}</option>
                                        @endforeach
                                        </select>                                  
                                    </div>
                                </td>
            
                                <td>
                                <!-- le champ pour la quantité d'outil -->
                                    <h3  class="formtxt" id="qteouttit">Quantité</h3>
                                </td>
                                <td>
                                    <div class="champoutil">
                                        <input type="number" name="qte[]" id="qteout" class="outilligne">                                    
                                    </div>
                                </td>
                                <td>
                                <!-- le champ pour l'unité d'outil-->
                                    <h3  class="formtxt" id="uniteouttit">Unité</h3>
                                </td>
                                <td>
                                    <div class="champoutil">
                                        <input type="text" name="unite[]" id="uniteout" class="outilligne qtunite">
                                    </div>
                                </td>
                            </tr>
                    </table>
                    <div class="add_delete">
                        <a class="ajouter_outil" href="javascript:;" id="">Ajouter un outil</i></a>
                        <a class="supprimer_outil" href="javascript:;" id="">Supprimer un outil</a>
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
$('.add_delete').on('click', '.ajouter_outil', function() {
        var tr =  
        '<tr class="line">'+
                            '<td>'+
                                    '<h3 class="formtxt">Nom</h3>'+
                                '</td>'+
                                '<td>'+
                                    '<div class="champoutil">'+                         
                                        '<select name="nomoutil[]" class="outilligne sel">'+
                                            '<option value=""></option>'+
                                        '@foreach($outils as $outil)'+
                                            '<option value="{{$outil->id}}">{{$outil->nom}}</option>'+
                                       '@endforeach'+
                                        '</select>'+                                
                                    '</div>'+
                                '</td>'+
            
                                '<td>'+
                                    '<h3  class="formtxt" id="qteouttit">Quantité</h3>'+
                                '</td>'+
                                '<td>'+
                                    '<div class="champoutil">'+
                                        '<input type="number" name="qte[]" id="qteout" class="outilligne">'+                                 
                                    '</div>'+
                                '</td>'+
                                '<td>'+
                                    '<h3  class="formtxt" id="uniteouttit">Unité</h3>'+
                                '</td>'+
                                '<td>'+
                                    '<div class="champoutil">'+
                                        '<input type="text" name="unite[]" id="uniteout" class="outilligne qtunite">'+
                                    '</div>'+
                                '</td>'+
                            '</tr>';
        $('#table2').append(tr);               
 });
 $('.add_delete').on('click', '.supprimer_outil', function() {
   
    $('#table2 tr:last').remove();
});
</script>
@endsection