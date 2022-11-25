
@extends("navbarsidebarMRP2")
@section("contenu")
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
<link rel="stylesheet" href="{{asset('css/calculChargesMachine.css')}}">
<div class="container">
	<div class="calcul_charges_machine">
		<div class="table-title">
				<div>
					<h2 class="title_table">Tableau <b>De calcul des charges par machine</b></h2>
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
				<td><b>CM1</b></td>
					<td></td>
					<td>27</td>
					<td>36</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
				<td><b>CM2</b></td>
					<td>59</td>
					<td>58</td>
					<td>29</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
				<td><b>EM1</b></td>
					<td>54.6</td>
					<td>114</td>
					<td>87</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
				<td><b>D1</b></td>
					<td>22.5</td>
					<td>9</td>
					<td>11.5</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				
			</tbody>
		</table>
		<div class="btns">
		<div>
				<button class="buttonDétailSur"  role="button"  >
					<span class="button-82-edgec"></span>
					<span class="button-82-frontDétSur text ">
					Détail Surcharge 
					</span>
				</button>
			</div>
			<div>
				<button class="buttonContrSur"  role="button"  >
					<span class="button-annuler-82-shadow"></span>
					<span class="button-82-edgea"></span>
					<span class="button-82-frontc text ">
					Contrôler Surcharge
					</span>
				</button>  
			</div>
		</div>
	</div>
</div>

@endsection