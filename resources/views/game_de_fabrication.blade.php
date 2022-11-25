
@extends("navbarsidebarMRP2")
@section("contenu")
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
<link rel="stylesheet" href="{{asset('css/gammeFabrication.css')}}">
<div class="container">
	<div class="gamme_fab">
		<div class="table-title">
				<div>
					<h2 class="title_table">Tableau <b>De gamme de fabrication </b></h2>
				</div>
		</div>
		<div class="row_select">
		<div class="text">
				<h5 id="textchamp">Le tableau de gamme de fabrication pour le produit : </h5>
			</div>
			<div class="champ_select" >
				<select name="produit">
					<option value="" >--Produit--</option>
					<option value="">Brouette</option>
				</select>
			</div>
		</div>
		<table class="table table-bordered mt-4">
			<thead>
				<tr>
					<th>Article</th>
					<th scope="col ">Brouette</th>
					<th scope="col ">Benne</th>
					<th scope="col ">Structure</th>
					<th scope="col ">Support</th>
					<th scope="col ">Manchons</th>
					<th scope="col ">Roue</th>
					<th scope="col ">Axe de la roue</th>
					<th scope="col ">Boulon</th>
				</tr>
			</thead>

			<tbody>
				<tr>
					<td><b>Phases de fabrication</b></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td><b>Centre</b></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td><b>TU</b></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td><b>TR</b></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			</tbody>
		</table>
		
	</div>
</div>

@endsection