@extends("navbarsidebarRH")
@section("contenu")
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<link rel="stylesheet" href="{{asset('css/formheuresuppaeff.css')}}">
<!--Ajouter les heures supplémentaires a effectuer-->
<div class="tablesformheureeff">
	<form action="{{route('heureeff.create')}}" method="post">
		@csrf
		<div class="ajoutheureeff">
			@include('sweetalert::alert')

			<h2 class="titreheureeff">Ajouter <span id="emp">les heures supplémentaires effectuées</span></h2>
			<table class="formheureaeff">
				<tr>
					<td class="txtheureeff">
						<h3 class="formtxteff">Nom&Prenom employe<span id="obligatoire">*</span></h3>
					</td>
					<td>
						<div class="champheureff">
							<select name="id_emp" class="employename" id="id_emp">
								<option value=""></option>
								@foreach ($employes as $item)
								<option value="{{$item->id}}">{{$item->nom_emp}}&nbsp;{{$item->prenom_emp}}</option>
								@endforeach
							</select>
						</div>
					</td>
					<td>
						<h3 class="formtxteff" id="dtheuretxt">Date Heure supplémentaire<span id="obligatoire">*</span></h3>
					</td>
					<td>
						<div class="champheureff" id="dtheure">
							<select class="dtheure" name="dtheure" id="col2">
								<option value="0"  disabled="true" selected="true">Date heure supp</option>
							</select>
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<h3 class="formtxteff" >Heure debut<span id="obligatoire">*</span></h3>
					</td>
					<td>
						<div class="champheureff" id="hrdebut">
							<input type="time" name="hr_debut"  class="heuredebut" value="" placeholder="">
						</div>
					</td>
					<td>
						<h3 class="formtxteff" id="heuretxt" >Heure Fin<span id="obligatoire">*</span></h3>
					</td>
					<td>
						<div class="champheureff" id="hrfin">
							<input type="time" name="hr_fin" class="heurefin" value="" placeholder=""id="col2">
						</div>
					</td>
				</tr>
				<tr>
					<td>
						<h3 class="formtxteff" >prix<span id="obligatoire">*</span></h3>

					</td>
					<td>
						<div class="champheureff" id="prix">
							<input type="number" name="prix" class="prixinput" value="" placeholder="">
						</div>
					</td>
					
				</tr>
				
			</table>
			<div class="btnheuresuppeff">
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
<script type="text/javascript">
$("#prix").prop("readonly",true);
$("#heuredebuteff").prop("readonly",true);
$("#heurefineff").prop("readonly",true);

$(document).ready(function(){
	//document.getElementById(prix).disabled = true;

	$(document).on('change','.employename',function(){
	// console.log("hmm its change");

		var employe_id=$(this).val();
			//console.log(employe_id);

		var div=$('#dtheure').parent();
		// console.log(div);

		var op=" ";
		
		$.ajax({
			type:'get',
			url:'{!!URL::to('/RH/AjouterHeureEffectué/dt')!!}',
			data:{'id':employe_id},
			success:function(data){
				console.log('success');

				console.log(data);

				//console.log(data.length);
				op+='<option  value="0" disabled="true" selected="true">Date heure supp</option>';
				for(var i=0;i<data.length;i++){
				//console.log(op);
				op+='<option value="'+data[i].dt_heure_supp+'">'+data[i].dt_heure_supp+'</option>';
			}

			div.find('.dtheure').html(" ");
			div.find('.dtheure').append(op);
			},
			error:function(){

			}
		});
	});
	$(document).on('change','.dtheure',function(){
	// console.log("hmm its change");

		var dt_heure=$(this).val();
	 	console.log(dt_heure);

		var debut=$('#hrdebut').parent();
		var fin=$('#hrfin').parent();
		var prix=$('#prix').parent();

		$.ajax({
			type:'get',
			url:'{!!URL::to('/RH/AjouterHeureEffectué/prix')!!}',
			data:{'dt':dt_heure},
			success:function(data){
				//console.log('success');

				for(var i = 0; i < data.length; i++)
				{
					console.log(data[i]);

				prix.find('.prixinput').val(data[i].prix);
				debut.find('.heuredebut').val(data[i].hr_debut);
				fin.find('.heurefin').val(data[i].hr_fin);

				}
			},
			error:function(){

			}
		});
	});
});

</script>
@endsection