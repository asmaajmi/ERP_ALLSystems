@extends("navbarsidebarRH")
@section("contenu")

<link rel="stylesheet" href="{{asset('css/formInterservice.css')}}">
{{--<script  src="{{asset('js/service.js')}}"></script>--}}
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
<!--Ajouter un employé-->
<div class="tablesformserv">
	<form action="{{route('Interservice.create')}}" method="post">
		@csrf
		<div class="ajoutservice">
			@include('sweetalert::alert')
			<h2 class="titreservice">Ajouter <span id="emp">Un Inter Extra_service</span></h2>
			<table class="formInterservice">
				<tr>
					<td class="txtserv">
						<h3 class="formtxt" id="nomemp">Nom Employe<span id="obligatoire">*</span></h3>
					</td>
					<td>
						<div class="champserv2" >
							<select name="id_emp" id="nomemp_champ">
								<option value=""></option>
								@foreach ($employes as $employe)
								<option value="{{$employe->id}}">{{$employe->prenom_emp}}&nbsp;{{$employe->nom_emp}}</option>
								@endforeach
							</select>
						</div>
					</td>
					<td>
						<h3 class="formtxt" id="txtcout" >Coût par utilisation<span id="obligatoire">*</span></h3>
					</td>
					<td>
						<div class="champserv2">
							<input type="number" name="cout_inter_service" id="cout_champs" >
							<label><i class="fas fa-coins"></i></label>

						</div>
					</td>
					
				</tr>
				<tr>

					<td>
						<h3 class="formtxt" id="txtdtdebut">Date debut<span id="obligatoire">*</span></h3>
					</td>
					<td>
						<div class="champserv2">
							<input type="date" name="dt_debut_inter_service" id="dtdebut" >
						</div>
					</td>
					<td>
						<h3 class="formtxt" id="txtdtfin" >Date fin<span id="obligatoire">*</span></h3>
					</td>
					<td>
						<div class="champserv2">
							<input type="date" name="dt_fin_inter_service" id="dtfin">
						</div>
					</td>
					
				</tr>
			</table>
			<h2 class="ajoutserv">Ajouter Les missions pour ce service</h2>
			<table class="tablemission">
				<tr >      
					<td>
						<h3 class="formtxt">Designation de mission<span id="obligatoire">*</span></h3>
					</td>
					<td>
						<div class="champserv2" >
							<input type="text" name="mission[]" id="desmiss">
							<label><i class="fas fa-boxes"></i></label>

						</div>
					</td>
					<td>
						<h3 class="formtxt" id="prime" >Prime de mission<span id="obligatoire">*</span></h3>
					</td>
					<td>
						<div class="champserv2" >
							<input type="number" name="prime[]" id="champprime">
							<label><i class="fas fa-money-bill"></i></label>

						</div>
					</td>
					
				</tr>
			</table>
			{{--onclick="addRowServBur()--}}
				<div class="add_delete">
					<a class="ajouter_mission" href="javascript:;" id="">Ajouter mission</i></a>
					<a class="supprimer_mission" href="javascript:;" id="">Supprimer mission</a>
				</div>
				<div>
					<button class="buttonserv"  role="button"  id="btncserv">
						{{--<span class="button-82-shadow"></span>--}}
						<span class="button-82-edgec"></span>
						<span class="button-82-frontc text ">
							<span class="fa fa-solid fa-plus"></span>
						Ajouter
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
<script>
$('.add_delete').on('click', '.ajouter_mission', function() {
    var tr =
	'<tr class="ligne">'+     
		'<td>'+ 
			'<h3 class="formtxt">Designation de mission<span id="obligatoire">*</span></h3>'+ 
		'</td>'+ 
		'<td>'+ 
			'<div class="champserv2" >'+ 
				'<input type="text" name="mission[]" id="desmiss">'+ 
			'</div>'+ 
		'</td>'+ 
		'<td>'+ 
			'<h3 class="formtxt" id="prime" >Prime de mission<span id="obligatoire">*</span></h3>'+ 
		'</td>'+ 
		'<td>'+ 
			'<div class="champserv2" >'+ 
				'<input type="number" name="prime[]" id="champprime">'+ 
			'</div>'+ 
		'</td>'+ 
		
    '</tr>';
    $('.tablemission').append(tr);
});
$('.add_delete').on('click', '.supprimer_mission', function() {
   
    $('.tablemission tr:last').remove();
});
</script>
@endsection
