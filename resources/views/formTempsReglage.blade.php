@extends("navbarsidebarProduction")
@section("contenu")
<link rel="stylesheet" href="{{asset('css/formTempsReg.css')}}">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>

<!--Ajouter les heures supplémentaires a effectuer-->
<div class="tablesformTempsReg">
	<form action="{{route('tempsReglage.create')}}" method="post">
		@csrf
		<div class="ajoutTempsReg">
			@include('sweetalert::alert')
			<h2 class="titreTempsReg">Temps <span id="emp">réglages inter-produit</span></h2>
			<table class="formTempsReg">
				<tr>
					<td class="txtTempsReg">
						<h3 class="formtxt" id="nomproduit1">Nom de produit N°1</h3>
					</td>
					<td>
						<div class="champTempsReg" >
							<select name="nom_prod1" id="" class="nom_prod1">
								<option value="">--Nom de produit 1--</option>
								@foreach ($produit_construisable as $prod)

								<option value="{{$prod->DesProduitC}}">{{$prod->nom_produit_const}}</option>

								@endforeach
							</select>
						</div>
					</td>
					<td class="txtTempsReg">
						<h3 class="formtxt" id="nomproduit2">Nom de produit N°2</h3>
					</td>
					<td>
						<div class="champTempsReg">
							<select name="nom_prod2" id="prod2" class="nom_prod2">
								<option value="" >--Nom de produit 2--</option>
							</select>
						</div>
					</td>
					
				</tr>
				
				<tr>
					<td class="txtTempsReg">
						<h3 class="formtxt" id="nommachine">Nom de machine</h3>
					</td>
					<td>
						<div class="champTempsReg">
							<select name="id_machine" id="">
								<option value="">--Nom de machine--</option>
								@foreach ($machines as $machine )
								<option value="{{$machine->DesMachine}}">{{$machine->nom_machine}}</option>

								@endforeach

							</select>
						</div>
					</td>
					
					<td class="txtTempsReg">
						<h3 class="formtxt" id="tempsreg">Temps de réglage</h3>
					</td>
					<td>
						<div class="champTempsReg">
							<input type="number" name="temps_reg" >
						</div>
					</td>
					
					
				</tr>
				
				
			</table>
			<div class="btnTempsReg">
				<div>
					<button class="buttonTempsReg"  role="button"  id="btncpointeff">
						{{--<span class="button-82-shadow"></span>--}}
						<span class="button-82-edgec"></span>
						<span class="button-82-frontc text ">
							<span class="fa fa-solid fa-plus"></span>
						Ajouter
						</span>
					</button>
				</div>
				<div>
					<a href="{{url()->previous()}}"  class="buttonTempsReg" role="button"  id="btnapointeff">
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
<script>
$(document).ready(function(){
	//document.getElementById(prix).disabled = true;

	$(document).on('change','.nom_prod1',function(){
	// console.log("hmm its change");

		var prod2_id=$(this).val();
			//console.log(employe_id);

		var div=$('#prod2').parent();
		// console.log(div);

		var op=" ";
		
		$.ajax({
			type:'get',
			url:'{!!URL::to('/Production/Produit/AjouterProduitAchetable/prod2')!!}',
			data:{'id':prod2_id},
			success:function(data){
				console.log('success');

				console.log(data);

				//console.log(data.length);
				op+='<option disabled="true" value="">--Nom de produit 2--</option>';
				for(var i=0;i<data.length;i++){
				//console.log(op);
				op+='<option value="'+data[i].DesProduitC+'">'+data[i].nom_produit_const+'</option>';
			}

			div.find('.nom_prod2').html(" ");
			div.find('.nom_prod2').append(op);
			},
			error:function(){

			}
		});
	});
});
</script>
@endsection