@extends("navbarsidebarProduction")
@section("contenu")
<link rel="stylesheet" href="{{asset('css/formProduit.css')}}">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>

<!--Ajouter les heures supplémentaires a effectuer-->
<div class="tablesformproduitconstrui">
	<form action="{{route('ProduitAchetable.create')}}" method="post">
		@csrf
		<div class="ajoutProduitAch">
			@include('sweetalert::alert')
			<h2 class="titreProduitConst">Ajouter <span id="emp">un produit achetable</span></h2>
			<table class="formProduitConst">
				<tr>
					<td class="txtProduitConst">
						<h3 class="formtxt" id="nomproduit">Nom de produit</h3>
					</td>
					<td>
						<div class="champProduitConstruisable">
								<input type="text" name="nomproduit_achetable" >
								<label><i class="fas fa-box"></i></label>
						</div>
					</td>
					
				</tr>
				
				
			</table>
			<div class="btnProduitAchetable">
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

@endsection