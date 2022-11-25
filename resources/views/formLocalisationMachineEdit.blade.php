@extends("navbarsidebarParcMachine")
@section("contenu")
<link rel="stylesheet" href="{{asset('css/formLocalisationMachine.css')}}">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
{{--<script  src="{{asset('js/service.js')}}"></script>--}}
<!--Ajouter un employé-->
<div class="tablesformLocMachine">
	<form action="{{route('LocMachine.update',['atelier'=>$atelier->id])}}" method="post">
		@csrf
		<div class="ajoutLocMachineEdit">
			@include('sweetalert::alert')
			<h2 class="titrejour">Modifier <span id="emp">Un Atelier</span></h2>
			<table class="formLocMachine">
				<tr>
					<td class="txtloc">
						<h3 class="formtxt">Designation de l'atelier</h3>
					</td>
					<td>
						<div class="champLocM">
							<input type="text" name="des_atelier" value="{{$atelier->des_atelier}}">
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
						<textarea id="adr_atelier" name="adr_atelier" rows="4" cols="33" >{{$atelier->adr_atelier}}</textarea>
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
						Modifier
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
