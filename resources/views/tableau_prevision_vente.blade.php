@extends("navbarsidebarMRP2")
@section("contenu")
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
<link rel="stylesheet" href="{{asset('css/previson_vente.css')}}">
<div class="container">
	<div class="previson_vente">
		<div class="table-title">
				<div>
					<h2 class="title_table">Tableau <b>des prévisions de ventes</b></h2>
				</div>
		</div>
		<div class="row_select">
			<div class="champ_select" >
				<select name="id_emp">
					<option value="" >--Produit--</option>
					<option value="">Brouette</option>
				</select>
			</div>
			<div class="champ_select">
				<select name="id_emp"  >
					<option value="" >--Unité--</option>
					<option value="">Semaine</option>
					<option value="">Jour</option>
				</select>
			</div>
			<div class="champ_select">
				<input type="number" placeholder="--Taille--">
			</div>
		</div>
		<table class="table table-bordered mt-4">
			<thead>
				<tr>
					<th>Article/Semaine</th>
					<th scope="col ">1</th>
					<th scope="col ">2</th>
					<th scope="col ">3</th>
					<th scope="col ">4</th>
					<th scope="col ">5</th>
					<th scope="col ">6</th>
					<th scope="col ">7</th>
					<th scope="col ">8</th>
					<th scope="col ">9</th>
				</tr>
			</thead>

			<tbody>
				<tr>
					<td><b>Brouette</b></td>
					<td>
						<div class="champ_input_table">
							<input type="number" >
						</div>
					</td>
					<td>
						<div class="champ_input_table">
							<input type="number" >
						</div>
					</td>
					<td>
						<div class="champ_input_table">
							<input type="number" >
						</div>
					</td>
				
					<td>
						<div class="champ_input_table">
							<input type="number" >
						</div>
					</td>
					<td>
						<div class="champ_input_table">
							<input type="number">
						</div>
					</td>
					<td>
						<div class="champ_input_table">
							<input type="number">
						</div>
					</td>
					<td>
						<div class="champ_input_table">
							<input type="number">
						</div>
					</td>
					<td>
						<div class="champ_input_table">
							<input type="number">
						</div>
					</td>
					<td>
						<div class="champ_input_table">
							<input type="number">
						</div>
					</td>

				</tr>
			</tbody>
		</table>
		<div class="btnPrevisionVente">
			<div>
				<button class="buttonPrev"  role="button"  >
					{{--<span class="button-82-shadow"></span>--}}
					<span class="button-82-edgec"></span>
					<span class="button-82-frontAjouter text ">
						<span class="fa fa-solid fa-plus"></span>
					Ajouter 
					</span>
				</button>
			</div>
			<div>
				<button class="buttonPrev"  role="button"  >
					{{--<span class="button-82-shadow"></span>--}}
					<span class="button-82-edgec"></span>
					<span class="button-82-frontcreer text ">
						<span class="fa fa-solid fa-plus-circle"></span>
					Créer MRP
					</span>
				</button>
			</div>
			<div>
				<a  href="{{url()->previous()}}" class="buttonPrev"  id="btna">
					<span class="button-annuler-82-shadow"></span>
					<span class="button-82-edgea"></span>
					<span class="button-82-fronta text ">
						<span class="fa fa-solid fa-ban"></span>
					Annuler
					</span>
				</a>  
			</div>
	  </div>
	</div>
</div>

@endsection