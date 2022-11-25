@extends("navbarsidebarRH")
@section("contenu")
<link rel="stylesheet" href="{{asset('css/formheuresuppaeff.css')}}">

<!--Ajouter les heures supplémentaires a effectuer-->
<div class="tablesformheureaeff">
	<form action="" method="post">
		@csrf
		<div class="ajoutheureaeff">
			<h2 class="titreheureaeff">Modifier <span id="emp">les heures supplémentaires à effectuer</span></h2>
			<table class="formheureaeff">
				<tr>
					<td class="txtheureaeff">
						<h3 class="formtxt" >Nom&Prenom employe</h3>
					</td>
					<td>
						<div class="champheuraeff">
							<input type="hidden" name="id_emp" value="{{$heureaeff->employe['id']}}">
							<input type="text" value=" {{$heureaeff->employe['prenom_emp']}} {{$heureaeff->employe['nom_emp']}}" readonly >
						</div>
					</td>
					<td class="txtheureaeff">
						<h3 class="formtxt" id="dateheuresupp">Date heure supplementaire</h3>
					</td>
					<td>
						<div class="champheuraeff">
							<input type="date" name="dt_heure_a_eff" value="{{$heureaeff->dt_heure_supp}}" >
						</div>
					</td>
				</tr>
				
				<tr>
					<td class="txtheureaeff">
						<h3 class="formtxt" id="heuredebut">Heure debut</h3>
					</td>
					<td>
						<div class="champheuraeff">
							<input type="time" name="heuredebut" class="inputheure" value="{{$heureaeff->hr_debut}}">
						</div>
					</td>
					<td class="txtheureaeff">
						<h3 class="formtxt" id="heurefin">Heure fin</h3>
					</td>
					<td>
						<div class="champheuraeff">
							<input type="time" name="heurefin" class="inputheure" value="{{$heureaeff->hr_fin}}">
						</div>
					</td>
				</tr>
				<tr>
					<td class="txtheureaeff">
						<h3 class="formtxt" id="heuredebut">Prix</h3>
					</td>
					<td>
						<div class="champheuraeff">
							<input type="number" name="prix" class="inputheure" value="{{$heureaeff->prix}}">
						</div>
					</td>
		
				</tr>
				
			</table>
			<div class="btnheuresuppaeff">
				<div>
					<button class="buttonpointeff"  role="button"  id="btncpointeff">
						<span class="button-82-shadow"></span>
						<span class="button-82-edgec"></span>
						<span class="button-82-frontc text ">
							<span class="fa fa-solid fa-plus"></span>
						Modifier
						</span>
					</button>
				</div>
				<div>
					<button class="buttonpointeff" role="button"  id="btnapointeff">
						<span class="button-82-shadow"></span>
						<span class="button-82-edgea"></span>
						<span class="button-82-fronta text ">
							<span class="fa fa-solid fa-ban"></span>
						Annuler
						</span>
					</button>
				</div>
		  </div>
		</div>
	</form>
</div>
@endsection