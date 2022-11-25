@extends("navbarsidebarProduction")
@section("contenu")
<link rel="stylesheet" href="{{asset('css/formNomenclature.css')}}">
{{--<script  src="{{asset('js/service.js')}}"></script>--}}
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
<!--Ajouter un employé-->
<div class="tablesformnomenclature">
	<form action="{{route('Nomenclature.create')}}" method="post">
		@csrf
		<div class="ajout_nomen">
			@include('sweetalert::alert')
			<h2 class="titrenomenclature">Ajouter <span id="emp">une nomenclature</span></h2>
			<table class="formNomenclature">
				<tr>
					<td class="txtserv">
						<h3 class="formtxt" id="nom_nomenclature">Nomenclature <span id="obligatoire">*</span></h3>
					</td>
					<td>
						<div class="champserv2">
							<input type="text" name="nom_nomenclature" id="champ_Nomenclature">
							<label><i class="fas fa-share-alt"></i></label>
						</div>
					</td>
					
				</tr>
			
			</table>
			<h2 class="ajoutcomposant">Ajouter Les composants de cette nomenclature</h2>
			<h3 class="ajout_prod_const">Ajouter les sous_produits constructibles</h3>
			<table class="tableprod_const">
				<tr >      
					
					<td>
						<h3 class="formtxt" id="nom_prod" >Nom de produit<span id="obligatoire">*</span></h3>
					</td>
					<td>
						<div class="champserv2" >
							<select type="number" name="nom_produit_const[]" id="champ_nom_prod" class="nom_produit">
								<option value="">produit constructible</option>
								@foreach ($produit_const as $produit)
								<option value="{{$produit->id}}">{{$produit->nom_produit_const}}</option>
								@endforeach
							</select>
						</div>
					</td>
	
					<td>
						<h3 class="formtxt" id="quantite" >Quantité<span id="obligatoire">*</span></h3>
					</td>
					<td>
						<div class="champserv2" >
							<input type="number" name="quantite_produit_const[]" id="champ_quantite">
						</div>
					</td>
					
					<td>
						<h3 class="formtxt" id="arrondi" >Arrondi</h3>
					</td>
					<td>
						<div class="champserv2" >
							<input type="number" name="arrondi_produit_const[]" id="champ_arrondi">
						</div>
					</td>
					<td>
						<h3 class="formtxt" id="unite">Unité <span id="obligatoire">*</span></h3>
					</td>
					<td>
						<div class="champserv2" >
							<input type="text" name="unite_produit_const[]" id="champ_unite">
						</div>
					</td>
					
				</tr>
			</table>
			<div class="add_delete_const">
				<a class="ajouter_prod_const" href="javascript:;" id="">Ajouter </i></a>
				<a class="supprimer_prod_const" href="javascript:;" id="">Supprimer </a>
			</div>
			<h3 class="ajout_prod_const">Ajouter les produits achetables</h3>
			<table class="tableprod_achet">
				<tr >      
					
					<td>
						<h3 class="formtxt" id="nom_prod" >Nom de produit<span id="obligatoire">*</span></h3>
					</td>
					<td>
						<div class="champserv2" >
							<select type="number" name="nom_produit_achet[]" id="champ_nom_prod" class="nom_produit">
								<option value="">produit achetable</option>
								@foreach ($produit_achetable as $produit_ach)
								<option value="{{$produit_ach->id}}">{{$produit_ach->nom_produit}}</option>

								@endforeach
							</select>
						</div>
					</td>
	
					<td>
						<h3 class="formtxt" id="quantite" >Quantité<span id="obligatoire">*</span></h3>
					</td>
					<td>
						<div class="champserv2" >
							<input type="number" name="quantite_prod_achet[]" id="champ_quantite">
						</div>
					</td>
					<td>
						<h3 class="formtxt" id="arrondi" >Arrondi</h3>
					</td>
					<td>
						<div class="champserv2" >
							<input type="number" name="arrondi_prod_achet[]" id="champ_arrondi">
						</div>
					</td>
					<td>
						<h3 class="formtxt" id="unite"  >Unité<span id="obligatoire">*</span></h3>
					</td>
					<td>
						<div class="champserv2" >
							<input type="text" name="unite_prod_achet[]" id="champ_unite">
						</div>
					</td>
					
				</tr>
			</table>
			{{--onclick="addRowServBur()--}}
				<div class="add_delete_achet">
					<a class="ajouter_prod_achet" href="javascript:;" id="">Ajouter </i></a>
					<a class="supprimer_prod_achet" href="javascript:;" id="">Supprimer </a>
				</div>
				<div>
					<button class="buttonserv"  role="button"  id="btncserv">
						{{--<span class="button-82-shadow"></span>--}}
						<span class="button-82-edgec"></span>
						<span class="button-82-frontc text ">
							<span class="fa fa-solid fa-plus"></span>
						Ajouter
						</span>
					</button>
				</div>
				<div id="btnaserv">
				
					<a href="{{url()->previous()}}"  class="buttonserv" >
						<span class="button-82-shadow"></span>
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

$(document).ready(function(){
		$('.add_delete_achet').on('click', '.ajouter_prod_achet', function() {
		var tr ='<tr >'+     
					'<td>'+
						'<h3 class="formtxt" id="nom_prod" >Nom de produit<span id="obligatoire">*</span></h3>'+
					'</td>'+
					'<td>'+
						'<div class="champserv2" >'+
							'<select type="number" name="nom_produit_achet[]" id="champ_nom_prod" class="nom_produit">'+
								'<option value="">produit achetable</option>'+
								'@foreach ($produit_achetable as $produit_ach)'+
								'<option value="{{$produit_ach->id}}">{{$produit_ach->nom_produit}}</option>'+

								'@endforeach'+
							'</select>'+
						'</div>'+
					'</td>'+
	
					'<td>'+
						'<h3 class="formtxt" id="quantite" >Quantité<span id="obligatoire">*</span></h3>'+
					'</td>'+
					'<td>'+
						'<div class="champserv2" >'+
							'<input type="number" name="quantite_prod_achet[]" id="champ_quantite">'+
						'</div>'+
					'</td>'+
					'<td>'+
						'<h3 class="formtxt" id="arrondi" >Arrondi</h3>'+
					'</td>'+
					'<td>'+
						'<div class="champserv2" >'+
							'<input type="number" name="arrondi_prod_achet[]" id="champ_arrondi">'+
						'</div>'+
					'</td>'+
					'<td>'+
						'<h3 class="formtxt" id="unite"  >Unité<span id="obligatoire">*</span></h3>'+
					'</td>'+
					'<td>'+
						'<div class="champserv2" >'+
							'<input type="text" name="unite_prod_achet[]" id="champ_unite">'+
						'</div>'+
					'</td>'+
					
				'</tr>'
		
		$('.tableprod_achet').append(tr);
	});
	$('.add_delete_achet').on('click', '.supprimer_prod_achet', function() {
	
		$('.tableprod_achet tr:last').remove();
	});


	$('.add_delete_const').on('click', '.ajouter_prod_const', function() {
		var tr ='<tr > '+     
					'<td>'+
						'<h3 class="formtxt" id="nom_prod" >Nom de produit<span id="obligatoire">*</span></h3>'+
					'</td>'+
					'<td>'+
						'<div class="champserv2" >'+
							'<select type="number" name="nom_produit_const[]" id="champ_nom_prod" class="nom_produit">'+
								'<option value="">produit construisable</option>'+
								'@foreach ($produit_const as $produit)'+
								'<option value="{{$produit->id}}">{{$produit->nom_produit_const}}</option>'+

								'@endforeach'+
							'</select>'+
						'</div>'+
					'</td>'+
	
					'<td>'+
						'<h3 class="formtxt" id="quantite" >Quantité<span id="obligatoire">*</span></h3>'+
					'</td>'+
					'<td>'+
						'<div class="champserv2" >'+
							'<input type="number" name="quantite_produit_const[]" id="champ_quantite">'+
						'</div>'+
					'</td>'+
					'<td>'+
						'<h3 class="formtxt" id="arrondi" >Arrondi</h3>'+
					'</td>'+
					'<td>'+
						'<div class="champserv2" >'+
							'<input type="number" name="arrondi_produit_const[]" id="champ_arrondi">'+
						'</div>'+
					'</td>'+
					'<td>'+
						'<h3 class="formtxt" id="unite"  >Unité<span id="obligatoire">*</span></h3>'+
					'</td>'+
					'<td>'+
						'<div class="champserv2" >'+
							'<input type="text" name="unite_produit_const[]" id="champ_unite">'+
						'</div>'+
					'</td>'+
					
				'</tr>'
		
		$('.tableprod_const').append(tr);
	});
	$('.add_delete_const').on('click', '.supprimer_prod_const', function() {
	
		$('.tableprod_const tr:last').remove();
	});

	
});
</script>
@endsection
