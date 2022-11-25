
@extends("navbarsidebarMRP2")
@section("contenu")
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
<link rel="stylesheet" href="{{asset('css/calculBesoin.css')}}">
<div class="container">
	<div class="previson_vente">
		<div class="table-title">
				<div>
					<h2 class="title_table">Tableau <b>De calcul des besoins</b></h2>
				</div>
		</div>
		<div class="row_select">
			<div class="text">
				<h5 id="textchamp">le tableau de calcul des besoins pour le produit : </h5>
			</div>
			<div class="champ_select" >
				<select name="id_emp">
					<option value="" >--Produit--</option>
					<option value="" selected>Brouette</option>
				</select>
			</div>
		</div>
		<table class="table table-bordered mt-4">
			<thead>
				<tr>
					<th>Semaine</th>
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
					<td><b>Besoin brut</b></td>
					<td>0</td>
					<td>0</td>
					<td>0</td>
					<td>50</td>
					<td>40</td>
					<td>20</td>
					<td>10</td>
					<td>0</td>
					<td>0</td>
				</tr>
				<tr>
					<td><b>Ordre lancés</b></td>
					<td></td>
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
					<td><b>Stock prévisionnel s0=22</b></td>
					<td>22</td>
					<td>22</td>
					<td>22</td>
					<td>2</td>
					<td>2</td>
					<td>2</td>
					<td>2</td>
					<td>2</td>
					<td>2</td>
				</tr>
				<tr>
					<td><b>Besoin Net</b></td>
					<td>-22</td>
					<td>-22</td>
					<td>-22</td>
					<td>28</td>
					<td>38</td>
					<td>18</td>
					<td>8</td>
					<td>-2</td>
					<td>-2</td>
				</tr>
				<tr>
					<td><b>Ordres proposés fin</b></td>
					<td></td>
					<td></td>
					<td></td>
					<td>30</td>
					<td>40</td>
					<td>20</td>
					<td>10</td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td><b>Ordres proposés début</b></td>
					<td></td>
					<td>30</td>
					<td>40</td>
					<td>20</td>
					<td>10</td>
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