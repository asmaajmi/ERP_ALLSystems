@extends("navbarsidebarRH")
@section("contenu")
<link rel="stylesheet" href="{{asset('css/formpointeff.css')}}">
<!--Ajouter un employé-->
<div class="tablesformpointeff">
	<form action="{{ route('pointageeff.update', ['pointageeff'=>$pointageeff->id]) }}" method="post">
	@csrf
            <input type="hidden" name="_method" value="put">
		<div class="ajoutpointeff">
			<h2 class="titrepointeff">Ajouter <span id="emp">Un pointage effectué</span></h2>
			<table class="formpointeff">
				<tr>
					<td class="txtpointeff">
						<h3 class="formtxt" id="nomemp">Nom Employe</h3>
					</td>
					<td>
					@foreach ($employes as $employe)
					<div class="champpoint">	
					   @if($employe->id == $pointageeff->id_emp)					
							<input type="text" name="id_emp" value="{{$employe->prenom_emp}}&nbsp;{{$employe->nom_emp}}" disabled>
						@endif
                    </div>
						@endforeach
					</td>
					
					<td class="txtpointeff">
						<h3 class="formtxt" id="datepointage">Date pointage</h3>
					</td>
					<td>
						<div class="champpoint">
							<input type="date" name="datepe" value="{{$pointageeff->datepe}}">
						</div>
					</td>
				</tr>
				
				<tr>
					<td class="txtpointeff">
						<h3 class="formtxt" id="heureentre">Heure entrée</h3>
					</td>
					<td>
					
						<div class="champpoint">									 
							<input type="time" name="heureentree" class="inputheure" value="{{$pointageeff->heure_entree}}">						 
						</div>
				
					</td>
					<td class="txtpointeff">
						<h3 class="formtxt" id="heuresortie">Heure sortie</h3>
					</td>
					<td>
						<div class="champpoint">
							<input type="time" name="heuresortie" class="inputheure" value="{{$pointageeff->heure_sortie}}">
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