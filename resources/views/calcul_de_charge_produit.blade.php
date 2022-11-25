
@extends("navbarsidebarMRP2")
@section("contenu")
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
<link rel="stylesheet" href="{{asset('css/calculChargesProduit.css')}}">
<div class="container">
	<div class="calcul_charges_prod">
		<div class="table-title">
				<div>
					<h2 class="title_table">Tableau <b>De calcul des charges par produit</b></h2>
				</div>
		</div>
		<div class="row_select">
			<div class="text">
				<h5 id="textchamp">Le tableau de calcul des charges pour le produit : </h5>
			</div>
			<div class="champ_select" >
				<select name="id_emp">
					<option value="" >--Produit--</option>
					<option value="">Brouette</option>
				</select>
			</div>
		</div>
		<table class="table table-bordered mt-4">
			<thead>
				<tr>
					<th></th>
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
					<td></td>
					<td>CM1=27<br>
						EM1=36
					</td>
					<td>CM1=36<br>
						EM1=48
					</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td><b>Benne</b></td>
					<td>CM2=35<br>
						EM1=54.6
					</td>
					<td>CM2=50<br>
						EM1=78
					</td>
					<td>CM2=25<br>
						EM1=39
					</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				
				</tr>
				<tr>
					<td><b>Structure</b></td>
					<td>CM2=24<br>
						D1=15
					</td>
					<td>CM2=36<br>
						D1=5
					</td>
					<td>CM2=4<br>
						D1=2.5
					</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				
				</tr>
				<tr>
					<td><b>Support</b></td>
					<td>
						D1=22.5
					</td>
					<td>D1=9</td>
					<td>D1=9</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				
				</tr>
				<tr>
					<td><b>Manchons</b></td>
					<td>CM1=14<br>
						D1=8
					</td>
					<td>CM2=9<br>
						E1=16
					</td>
					<td>D1=25</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					
				</tr>
				<tr>
					<td><b>Roue</b></td>
					<td>CM2=21<br>
						E1=28</td>
					<td>CM2=4<br>
						E2=20</td>
					<td>E2=18</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					
				</tr>
				<tr>
					<td><b>Axe de la roue</b></td>
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
					<td><b>Boulon</b></td>
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
				
			</tbody>
		</table>
		
	</div>
</div>

@endsection