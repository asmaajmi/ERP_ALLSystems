@extends("navbarsidebarRH")
@section("contenu")
<link rel="stylesheet" href="{{asset('css/formpointeff.css')}}">
<!--Ajouter un employé-->
<div class="tablesformpointeff">
	<form action="{{route('pointeff.create')}}" method="post">
	@csrf
		<div class="ajoutpointeff">
			<h2 class="titrepointeff">Ajouter <span id="emp">Un pointage effectué</span></h2>
			<table class="formpointeff">
				<tr>
					<td class="txtpointeff">
						<h3 class="formtxt" id="nomemp">Nom Employe<span id="obligatoire">*</span></h3>
					</td>
					<td>
					<div class="champpoint">
                                <select name="id_emp">
								@foreach ($employes as $employe)
								<option value="{{$employe->id}}">{{$employe->prenom_emp}}&nbsp;{{$employe->nom_emp}}</option>
								@endforeach
							</select>
                                </div>
					</td>
					
					<td class="txtpointeff">
						<h3 class="formtxt" id="datepointage">Date pointage<span id="obligatoire">*</span></h3>
					</td>
					<td>
						<div class="champpoint">
							<input type="date" name="datepe" >
						</div>
					</td>
				</tr>
				
				<tr>
					<td class="txtpointeff">
						<h3 class="formtxt" id="heureentre">Heure entrée<span id="obligatoire">*</span></h3>
					</td>
					<td>
						<div class="champpoint">
							<input type="time" name="heureentree" class="inputheure">
						</div>
					</td>
					<td class="txtpointeff">
						<h3 class="formtxt" id="heuresortie">Heure sortie<span id="obligatoire">*</span></h3>
					</td>
					<td>
						<div class="champpoint">
							<input type="time" name="heuresortie" class="inputheure">
						</div>
					</td>
				</tr>			
				
			</table>

			<div class="btnpointeff">
				<div>
					<button class="buttonpointeff"  role="button"  id="btncpointeff">
						<span class="button-82-shadow"></span>
						<span class="button-82-edgec"></span>
						<span class="button-82-frontc text ">
							<span class="fa fa-solid fa-plus"></span>
						Ajouter
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