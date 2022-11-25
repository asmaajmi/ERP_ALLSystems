@extends("navbarsidebarRH")
@section("contenu")

<link rel="stylesheet" href="{{asset('css/formInterservice.css')}}">
{{--<script  src="{{asset('js/service.js')}}"></script>--}}
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
<!--Ajouter un employé-->
<div class="tablesformserv">
	<form action="{{route('Interservice.update',['interservice'=>$interservice->id])}}" method="post">
		@csrf
		<div class="ajoutservice">
			@include('sweetalert::alert')
			<h2 class="titreservice">Modifier <span id="emp">Un Inter Extra_service</span></h2>
			<table class="formInterservice">
					<tr>
					<td class="txtserv">
						<h3 class="formtxt" id="nomemp">Nom Employe</h3>
					</td>
					<td>
						<div class="champserv2" >
								<input type="hidden" name="id_emp" value="{{$interservice->employes['id']}}">
								<input type="text" value=" {{$interservice->employes['prenom_emp']}} {{$interservice->employes['nom_emp']}}" disabled >
						</div>
					</td>
					<td>
						<h3 class="formtxt" id="txtcout" >Coût par utilisation</h3>
					</td>
					<td>
						<div class="champserv2">
							<input type="number" name="cout_inter_service" value="{{$interservice->cout_par_utilisation}}">
						</div>
					</td>
					
					
				</tr>
				<tr>
					<td>
						<h3 class="formtxt" id="txtdtdebut">Date debut </h3>
					</td>
					<td>
						<div class="champserv2">
							<input type="date" name="dt_debut_inter_service" value="{{$interservice->dt_debut_ex_serv}}">
						</div>
					</td>
					<td>
						<h3 class="formtxt">Date fin</h3>
					</td>
					<td>
						<div class="champserv2">
							<input type="date" name="dt_fin_inter_service" id="dtfin" value="{{$interservice->dt_fin_ex_serv}}">
						</div>
					</td>
					
				</tr>

			</table>
			<h2 class="ajoutserv">Modifier Les missions pour ce service</h2>
			<table class="tablemission">
				@foreach ($primes as $prime)
	
				<tr >

					<td>
						<h3 class="formtxt">Designation de mission</h3>
					</td>
					<td>
						<div class="champserv2" >
							<select name="mission[]" id="desmiss">
								@foreach ($missions as $mission )
								@if($mission->id == $prime->id_mission)    
								<option value="{{$mission->id}}" selected>{{$mission->des_mission}}</option>
								@else
								<option value="{{$mission->id}}">{{$mission->des_mission}}</option>
								@endif

								@endforeach

							</select>
						</div>
					</td>
					<td>
						<h3 class="formtxt" id="prime" >Prime de mission</h3>
					</td>
					<td>
						<div class="champserv2" >
							<input type="number" name="prime[]" id="champprime" value="{{$prime->prime}}">
						</div>
					</td>

				</tr>
			
				@endforeach

			</table>
			{{--onclick="addRowServBur()--}}
				
				<div>
					<button class="buttonserv"  role="button"  id="btncserv">
						{{--<span class="button-82-shadow"></span>--}}
						<span class="button-82-edgec"></span>
						<span class="button-82-frontc text ">
							<span class="fa fa-solid fa-plus"></span>
						Modifier
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

@endsection
