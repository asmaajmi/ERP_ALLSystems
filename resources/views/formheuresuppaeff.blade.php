@extends("navbarsidebarRH")
@section("contenu")
<link rel="stylesheet" href="{{asset('css/formheuresuppaeff.css')}}">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>

<!--Ajouter les heures supplémentaires a effectuer-->
<div class="tablesformheureaeff">
	<form action="{{route('heureaeff.create')}}" method="post">
		@csrf
		<div class="ajoutheureaeff">
			@include('sweetalert::alert')
			<h2 class="titreheureaeff">Ajouter <span id="emp">les heures supplémentaires a effectuer</span></h2>
			<table class="formheureaeff">
				<tr>
					<td class="txtheureeff">
						<h3 class="formtxt" id="nomempeff">Nom&Prenom employe<span id="obligatoire">*</span></h3>
					</td>
					<td>
						<div class="champheuraeff">
							<select name="id_emp">
								<option value=""></option>
								@foreach ($employes as $employe)
								<option value="{{$employe->id}}">{{$employe->prenom_emp}}&nbsp;{{$employe->nom_emp}}</option>
								@endforeach
							</select>
							{{--<div class="champheuraeff">
							<input type="text" name="id_emp" >
							<label><i  class="fas fa-user"></i></label>--}}
						</div>
					</td>
					<td class="txtheureeff">
						<h3 class="formtxt" id="dateheuresupp">Date heure supplementaire<span id="obligatoire">*</span></h3>
					</td>
					<td>
						<div class="champheuraeff">
							<input type="date" name="dt_heure_a_eff"  >
						</div>
					</td>
				</tr>
				
				<tr>
					<td class="txtheureeff">
						<h3 class="formtxt" id="heuredebut">Heure debut<span id="obligatoire">*</span></h3>
					</td>
					<td>
						<div class="champheuraeff">
							<input type="time" name="heuredebut" class="inputheure">
						</div>
					</td>
					<td class="txtheureeff">
						<h3 class="formtxt" id="heurefin">Heure fin<span id="obligatoire">*</span></h3>
					</td>
					<td>
						<div class="champheuraeff">
							<input type="time" name="heurefin" >
						</div>
					</td>
				</tr>
				<tr>
					<td class="txtheureeff">
						<h3 class="formtxt" id="heuredebut">Prix<span id="obligatoire">*</span></h3>
					</td>
					<td>
						<div class="champheuraeff">
							<input type="number" name="prix" class="inputheure">
						</div>
					</td>
		
				</tr>
				
			</table>
			<div class="btnheuresuppaeff">
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