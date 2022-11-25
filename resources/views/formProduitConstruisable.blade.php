@extends("navbarsidebarProduction")
@section("contenu")
<link rel="stylesheet" href="{{asset('css/formProduit.css')}}">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!--Ajouter les heures supplémentaires a effectuer-->
<div class="tablesformproduitconstrui">
	<form action="{{route('ProduitConstruisable.create')}}" method="post">
		@csrf
		<div class="ajoutProduitCon">
			@include('sweetalert::alert')
			<h2 class="titreProduitConst">Ajouter <span id="emp">un produit constructible</span></h2>
			<table class="formProduitConst">
				<tr>
					<td class="txtProduitConst">
						<h3 class="formtxt" id="nomproduit">Nom de produit <span id="obligatoire">*</span></h3>
					</td>
					<td>
						<div class="champProduitConstruisable">
								<input type="text" name="nomproduit" >
								<label><i class="fas fa-box"></i></label>

						</div>
					</td>
					<td class="txtProduitConst">
						<h3 class="formtxt" id="typeproduit">Type de produit <span id="obligatoire">*</span></h3>
					</td>
					<td>
						<div class="champProduitConstruisable">
							<select name="typeproduit" id="">
								<option value="">--type de produit--</option>
                                <option value="Sous_produit">Sous produit</option>
								<option value="Produit fini">Produit fini</option>

							</select>
						</div>
					</td>
					
				</tr>
				
				<tr>
					<td class="txtProduitConst">
						<h3 class="formtxt" id="codebarre">Code à barre <span id="obligatoire">*</span></h3>
					</td>
					<td>
						<div class="champProduitConstruisable">
							<input type="text" name="codebarre" >
							<label><i class="fas fa-barcode-read"></i></label>

						</div>
					</td>
					<td class="txtProduitConst">
						<h3 class="formtxt" id="lotoptimal">Lot_optimal <span id="obligatoire">*</span></h3>
					</td>
					<td>
						<div class="champProduitConstruisable">
							<input type="number" name="lotoptimal">
							<label><i class="fas fa-ball-pile"></i></label>

						</div>
					</td>
					
				</tr>
				<tr>
					<td class="txtProduitConst">
						<h3 class="formtxt" id="nommachine">Nom de machine <span id="obligatoire">*</span></h3>
					</td>
					<td>
						<div class="champProduitConstruisable">
							<select name="id_machine" id="">
								<option value="">--Nom de machine--</option>
								@foreach ($machines as $machine )
								<option value="{{$machine->DesMachine}}">{{$machine->nom_machine}}</option>
								@endforeach
							</select>
						</div>
					</td>
					
					<td class="txtProduitConst">
						<h3 class="formtxt" id="tempsunitaire">Temps unitaire de fabrication <span id="obligatoire">*</span></h3>
					</td>
					<td>
						<div class="champProduitConstruisable">
							<input type="number" name="tempsunitaire" placeholder="Nbre d'heure de fabrication">
							<label><i class="fas fa-alarm-clock"></i></label>

						</div>
					</td>
		
				</tr>
				<tr>
					<td class="txtProduitConst">
						<h3 class="formtxt" id="tempsreglages">Temps de reglage d'un lot <span id="obligatoire">*</span></h3>
					</td>
					<td>
						<div class="champProduitConstruisable">
							<input type="number" name="tempsreglages" placeholder="Nbre d'heure de réglage">
							<label><i class="fas fa-alarm-clock"></i></label>

						</div>
					</td>
					<td>
					<!-- ici c'est le choix de produit est que ce produit est vendable ou non s'il est vendable un champ input sera afficher pour entrer prix_vente -->
						<h3 class="formtxt" id="prod_vend">Nature de produit <span id="obligatoire">*</span></h3>
					</td>
					<td>
						<div id="champ">
						<label id="vend"><input type="radio" name="nature" value="vendable" checked> Vendable</label>
						<label id="nonVend"><input  type="radio" name="nature" value="non vendable" > Non vendable</label>
						</div>
					</td>                                   
					
				</tr>
				<tr id="prix">
					<td class="txtProduitConst">
						<h3 class="formtxt" id="prix_vente">Prix unitaire de vente <span id="obligatoire">*</span></h3>
					</td>
					<td>
						<div class="champProduitConstruisable">
							<input type="number" name="prix_unit_vente">
							<label><i class="fas fa-coins"></i></label>
						</div>
					</td>
				</tr>
			</table>
			<div class="btnProduitConstruisable">
				<div>
					<button class="buttonpointeff"  role="button"  id="btncpointeff">
						{{--<span class="button-82-shadow"></span>--}}
						<span class="button-82-edgec"></span>
						<span class="button-82-frontc text ">
							<span class="fa fa-solid fa-plus"></span>
						Ajouter
						</span>
					</button>
				</div>
				<div>
					<a href="{{url()->previous()}}"  class="buttonpointeff" role="button"  id="btnapointeff">
						<span class="button-82-edgea"></span>
						<span class="button-82-fronta text ">
							<span class="fa fa-solid fa-ban"></span>
						Annuler
						</span>
					</a>
				</div>
		  </div>
		</div>
	</form>
</div>
<script>
var non_vendable = document.getElementById('nonVend');
var aff1 = function(){
    $('#prix').hide();
}
non_vendable.addEventListener('click', aff1);
var vendable = document.getElementById('vend');
var aff2 = function(){
    $('#prix').show();
}
vendable.addEventListener('click', aff2);
</script>
@endsection