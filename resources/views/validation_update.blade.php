@extends("navbarsidebarRH")
@section("contenu")
<link rel="stylesheet" href="{{asset('css/formheuresuppaeff.css')}}">
<link rel="stylesheet" href="{{asset('css/editvalidationform.css')}}">

<!--Ajouter les heures supplémentaires a effectuer-->
<div class="tablesformheureaeff">
	<form action="{{route('validation.update')}}" method="post">
		@csrf
		<div class="ajoutheureaeff">
			<h2 class="titreheureaeff">Valider <span id="emp">les heures supplémentaires à effectuer</span></h2>
			<table class="formheureaeff">
				<tr>
					<td class="txtheureaeff">
						<h3 class="formtxt" >Nom&Prenom employe</h3>
					</td>
					<td>
						<div class="champheuraeff">
							<input type="text" name="id_emp" value="{{$heureaeff->employe['prenom_emp']}} {{$heureaeff->employe['nom_emp']}}" readonly>
						</div>
					</td>
					<td class="txtheureaeff">
						<h3 class="formtxt" id="dateheuresupp">Date heure supplementaire</h3>
					</td>
					<td>
						<div class="champheuraeff">
							<input type="date" name="dt_heure_a_eff" value="{{$heureaeff->dt_heure_supp}}" readonly >
						</div>
					</td>
				</tr>
				
				<tr>
					<td class="txtheureaeff">
						<h3 class="formtxt" id="heuredebut">Heure debut</h3>
					</td>
					<td>
						<div class="champheuraeff">
							<input type="time" name="heuredebut" class="inputheure" value="{{$heureaeff->hr_debut}}" readonly>
						</div>
					</td>
					<td class="txtheureaeff">
						<h3 class="formtxt" id="heurefin">Heure fin</h3>
					</td>
					<td>
						<div class="champheuraeff">
							<input type="time" name="heurefin" class="inputheure" value="{{$heureaeff->hr_fin}}" readonly>
						</div>
					</td>
				</tr>
				<tr>
					<td class="txtheureaeff">
						<h3 class="formtxt" id="heuredebut">Prix</h3>
					</td>
					<td>
						<div class="champheuraeff">
							<input type="number" name="prix" class="inputheure" value="{{$heureaeff->prix}}" readonly>
						</div>
					</td>
					<td class="txtheureaeff">
						<h3 class="formtxt" id="heurefin">Validation</h3>
					</td>
					<td>
						<div class="switch-field inputheure">
							<input type="hidden" name="id" value="{{$heureaeff->id}}">
							<input type="radio" id="radio-one" name="validation" value="Validé" />
							<label  for="radio-one" ><i class="fas fa-check"></i>&nbsp; Validé </label>
							<input type="radio" id="radio-two" name="validation" value="Non validé" />
							<label   for="radio-two"><i class="fas fa-times"></i>&nbsp; Non validé</label>
	
						</div>
					</td>
				</tr>
				
			</table>
			<div class="btnheuresuppedit">
				<div>
					<button class="buttonpointeff"  role="button"  id="btncheureaeff">
						<span class="button-82-edgec" id="heureaeff"></span>
						<span class="button-82-frontc text ">
							<span class="fa fa-solid fa-plus"></span>
						Enregistrer
						</span>
					</button>
				</div>
				<div>
					<a href="{{url()->previous()}}" class="buttonpointeff" role="button"  id="btnapointeff">
						<span class="button-82-shadow"></span>
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