@extends("navbarsidebarMRP2")
@section("contenu")
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
<link rel="stylesheet" href="{{asset('css/capacite_machine.css')}}">
<div class="container">
	<div class="capacite_machine">
		<div class="table-title">
				<div>
					<h2 class="title_table">Tableau <b>de capacité des machines</b></h2>
				</div>
		</div>
		
		<div class="champ_select" >
			<select name="id_emp">
				<option value="" >--choisir le produit--</option>
				<option value="">Brouette</option>
			</select>
		</div>
		
		<table class="table table-bordered mt-4">
			<thead>
				<tr>
					<th scope="col">Centre de charge</th>
					<th scope="col">Capacité</th>
				</tr>
			</thead>

			<tbody>
				
				<tr>
					<td>CM1</td>
					<td>32</td>
				</tr>
				<tr>
					<td>CM2</td>
					<td>35</td>
				</tr>
				<tr>
					<td>EM1</td>
					<td>30</td>
				</tr>
				<tr>
					<td>D1</td>
					<td>40</td>
				</tr>
			</tbody>
		</table>
		
	</div>
</div>

@endsection