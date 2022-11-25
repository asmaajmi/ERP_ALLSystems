@extends("navbarsidebarParcMachine")
@section("contenu")
<link rel="stylesheet" href="{{asset('css/formLocalisationMachine.css')}}">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
{{--<script  src="{{asset('js/service.js')}}"></script>--}}
<!--Ajouter un employé-->
<div class="tablesformLocMachine">
	<form action="{{route('LocMachine.create')}}" method="post">
		@csrf
		<div class="ajoutLocMachine">
			@include('sweetalert::alert')
			<h2 class="titrejour">Ajouter <span id="emp">Un Atelier</span></h2>
			<table class="formLocMachine">
				<tr>
					<td class="txtloc">
						<h3 class="formtxt" >Nom de la machine</h3>
					</td>
					<td>
						<div class="champLocM">
							<select name="id_machine" class="nom_machine" id="nommachineselect">
								<option selected>--choisir la machine--</option>
								@foreach ($machines as $machine)							
								<option value="{{$machine->DesMachine}}">{{$machine->nom_machine}}</option>
								@endforeach
							</select>
						</div>
					</td>
				</tr>
				<tr>
					<td class="txtloc">
						<h3 class="formtxt">L'emplacement</h3>
					</td>
					<td>
						<div class="champLocM" id="emp_machine">
							<select name="emp_machine" class="emplacement">
								
							</select>
						</div>
					</td>
				</tr>
				<tr>
					<td class="txtloc">
						<h3 class="formtxt">Designation de l'atelier</h3>
					</td>
					<td>
						<div class="champLocM">
							<input type="text" name="des_atelier" >
							<label><i class="fas fa-city"></i></label>
						</div>
					</td>
				</tr>
				<tr>
					<td class="txtloc">
						<h3 class="formtxt">Adresse</h3>
					</td>
					<td>
						<div class="champLocM">
						<textarea id="adr_atelier" name="adr_atelier" rows="4" cols="33" ></textarea>
						</div>
					</td>
				</tr>
			</table>
					
			
			<div class="btnLocMachine">
				<div>
					<button class="buttonLocMachine"  role="button"  id="btncLocM">
						{{--<span class="button-82-shadow"></span>--}}
						<span class="button-82-edgec"></span>
						<span class="button-82-frontc text ">
							<span class="fa fa-solid fa-plus"></span>
						Ajouter
						</span>
					</button>
				</div>
				<div>
				
					<a href="{{url()->previous()}}" class="buttonLocMachine" id="btnaLocM">
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
<script type="text/javascript">
$(document).ready(function(){
	//document.getElementById(prix).disabled = true;

	$(document).on('change','.nom_machine',function(){
	// console.log("hmm its change");

		var machine_id=$(this).val();
			//console.log(employe_id);

		var div=$('#emp_machine').parent();
		// console.log(div);

		var op=" ";
		
		$.ajax({
			type:'get',
			url:'{!!URL::to('/ParcMachine/LocalisationMachine/findemp')!!}',
			data:{'id':machine_id},
			success:function(data){
				console.log('success');
				//console.log(data.length);
				op+='<option  value="0" disabled="true" selected="true">Lemplacement</option>';
				for(var i=0;i<data.length;i++){

				//console.log(data.data2[i].id);
					{op+='<option value="'+data[i].id_emplacement+'">'+data[i].des_emp_fk+'</option>';}
				
				
				
			}

			div.find('.emplacement').html(" ");
			div.find('.emplacement').append(op);
			},
			error:function(){

			}
		});
	});
}); 
</script>
@endsection
