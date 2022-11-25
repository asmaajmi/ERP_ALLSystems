@extends("navbarsidebarParcMachine")
@section("contenu")
<link rel="stylesheet" href="{{asset('css/formEmpMachine.css')}}">
{{--<script  src="{{asset('js/service.js')}}"></script>--}}
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
<!--Ajouter un employé-->
<div class="tablesformserv">
	<form action="{{route('EmpMachine.create')}}" method="post">
		@csrf
		<div class="ajoutempmachine">
			@include('sweetalert::alert')
			<h2 class="titremachine">Ajouter <span id="emp">les emplacements des machines</span></h2>
			<table class="formMachine">
				<tr>
					<td class="txtserv">
						<h3 class="formtxt" id="nommachine">Nom de la machine</h3>
					</td>
					<td>
						<div class="champemp2" >
							<select name="id_machine" id="nommachineselect">
								<option selected>--choisir la machine--</option>
								@foreach ($machines as $machine)							
								<option value="{{$machine->DesMachine}}">{{$machine->nom_machine}}</option>
								@endforeach
							</select>
						</div>
					</td>
				</tr>
			</table>
			<table class="tableEmp">
				<tr >      
					<td>
						<h3 class="formtxt" id="desEmpMachine">L'emplacement</h3>
					</td>
					<td>
						<div class="champemp2" >
							<input type="text" name="emp_machine" id="desEmpMachineChamp">
						</div>
					</td>
					<td>
						<h3 class="formtxt" id="dtDateEmpMachine" >Date de l'emplacement</h3>
					</td>
					<td>
						<div class="champemp2" >
							<input type="date" id="dtDateEmpMachineChamp" name="dt_emp_machine">
						</div>
					</td>
					
					
				</tr>
				<tr >      
					<td>
						<h3 class="formtxt">Longueur</h3>
					</td>
					<td>
						<div class="champemp2" >
							<input type="float" name="longueur" id="longueur" >
						</div>
					</td>
					<td>
						<h3 class="formtxt" id="txtlargeur">Largeur</h3>
					</td>
					<td>
						<div class="champemp2" >
							<input type="float" name="largeur" id="largeur" >
						</div>
					</td>
					<td>
						<h3 class="formtxt" id="hauteurtxt" >Hauteur</h3>
					</td>
					<td>
						<div class="champemp2" >
							<input type="float" name="hauteur" id="hauteur">
						</div>
					</td>
				</tr>
			</table>
			{{--onclick="addRowServBur()--}}
				{{--<div class="add_delete_emplacement">
					<a class="ajouter_emplacement" href="javascript:;" id="">Ajouter emplacement</i></a>
					<a class="supprimer_emplacement" href="javascript:;" id="">Supprimer emplacement</a>
				</div>--}}
				<div>
					<button class="buttonempMachine"  role="button"  id="btncEmpMachine">
						{{--<span class="button-82-shadow"></span>--}}
						<span class="button-82-edgec"></span>
						<span class="button-82-frontc text ">
							<span class="fa fa-solid fa-plus"></span>
						Ajouter
						</span>
					</button>
				</div>
				<div id="btnaEmpMachine">
				
					<a href="{{url()->previous()}}"  class="buttonempMachine" >
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

@endsection
