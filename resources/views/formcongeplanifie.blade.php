@extends("navbarsidebarRH")
@section("contenu")
<link rel="stylesheet" href="{{asset('css/formconge.css')}}">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<!--Ajouter les heures supplémentaires a effectuer-->
<div class="tablesformheureaeff">
	<form action="{{route('congeplanifie.create')}}" method="post">
		@csrf
		<div class="ajoutcongeplan">
			@include('sweetalert::alert')
			<h2 class="titrecongeplanifie">Ajouter <span id="emp">un congé planifié</span></h2>
			<table class="formcongeplanifie">
				<tr>
					<td class="txtcongeplanifie">
						<h3 class="formtxt" >Nom&Prenom employe</h3>
					</td>
					<td>
						<div class="champscongeplanifie">
							<select name="id_emp" class="employename">
								<option value=""></option>
								@foreach ($employes as $employe)
								<option value="{{$employe->id}}">{{$employe->prenom_emp}}&nbsp;{{$employe->nom_emp}}</option>
								@endforeach
							</select>
							
						</div>
					</td>
					
				</tr>
				
				<tr>
					<td class="txtcongeplanifie">
						<h3 class="formtxt" >Date debut</h3>
					</td>
					<td>
						<div class="champscongeplanifie">
							<input type="date" name="date_debut_conge" >
						</div>
					</td>
					<td class="txtcongeplanifie">
						<h3 class="formtxt" id="datefinconge">Date fin</h3>
					</td>
					<td>
						<div class="champscongeplanifie">
							<input type="date" name="date_fin_conge" >
						</div>
					</td>
					
				</tr>
				
				<tr>
					<td class="txtcongeplanifie">
						<h3 class="formtxt" >Type congé</h3>
					</td>
					<td>
						<div class="champscongeplanifie" >
							<select name="desconge" class="selectconge">
								<option value="">Type Congé</option>
								<option value="Conge Maladie">Congé Maladie</option>
								<option value="Conge Accidentel">Congé Accidentel</option>
								<option value="Conge Annuel">Congé Annuel</option>
								@foreach ($conge as $item)
								@if(($item['designation_conge'] !="Conge Maladie" )&& ($item['designation_conge'] !="Conge Accidentel" ) && ($item['designation_conge'] !="Conge Annuel" ))
									<option value="{{$item->designation_conge}}">{{$item->designation_conge}}</option>
								@endif
								@endforeach
								<option value="autre" onclick="javascript:;">autre</option>
								
							</select>				
						</div>
					</td>
					<td class="td1" >

					</td>
					<td class="td2">

					</td>
					
				</tr>
				<tr>
					<td class="txtcongeplanifie">
						<h3 class="formtxt" >Validation</h3>
					</td>
					<td>
						<div class="champscongeplanifie" >
							<select name="validation">
								<option value="1">Oui</option>
								<option value="0">Non</option>
							</select>						
						</div>
					</td>
					<td class="txtcongeplanifie">
						<h3 class="formtxt" id="payement" >Payement</h3>
					</td>
					<td>
						<div class="champscongeplanifie">
							<select name="payement">
								<option value="1">Oui</option>
								<option value="0">Non</option>
							</select>					
						</div>
					</td>
				</tr>
				
			</table>
			<div class="btncongeplanifie">
				<div>
					<button class="buttoncongeplanifie"  role="button"  id="btnajoutcongeplanifie">
						{{--<span class="button-82-shadow"></span>--}}
						<span class="button-82-edgec"></span>
						<span class="button-82-frontc text ">
							<span class="fa fa-solid fa-plus"></span>
						Ajouter
						</span>
					</button>
				</div>
				<div>
					<a href="{{url()->previous()}}"  class="buttoncongeplanifie" role="button"  id="btnannulercongeplanifie">
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
<script type="text/javascript">

$('.selectconge').on('change',function() {
  	var td1 =
		'<h3 class="formtxt" id="autreconge">autre Type de congé</h3>'
	var td2=
		'<div class="champscongeplanifie">'+
			'<input type="text" name="desconge" >'+
		'</div>'
	
	if($(this).val()=="autre"){

    $('.td1').append(td1);
	$('.td2').append(td2);

}
});

</script>
@endsection