@extends("navbarsidebarRH")
@section("contenu")

<link rel="stylesheet" href="{{asset('css/formjourferie.css')}}">
{{--<script  src="{{asset('js/service.js')}}"></script>--}}
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
<!--Ajouter un employé-->
<div class="tablesformjourferie">
	<form action="{{route('jourferie.update',['jourferie'=>$jourferie->id])}}" method="post">
		@csrf
		<div class="ajoutjourferie">
			@include('sweetalert::alert')
			<h2 class="titrejour">Modifier <span id="emp">Un jour ferié</span></h2>
			<table class="formjourferie">
				<tr>
					<td class="txtjour">
						<h3 class="formtxt" >Designation Jour Ferié</h3>
					</td>
					<td>
						<div class="champjour">
							<input type="text" name="des_jour" value="{{$jourferie->des_jourferie}}">
							<label><i class="fas fa-bells"></i></label>
						</div>
					</td>
					<td class="txtjour">
						<h3 class="formtxt" id="dtdebjour">Date Debut</h3>
					</td>
					<td>
						<div class="champjour">
							<input type="date" name="dt_debut" value="{{$jourferie->dt_debut_jourferie}}">
						</div>
					</td>
				</tr>
				<tr>
					<td class="txtjour">
						<h3 class="formtxt">Date Fin</h3>
					</td>
					<td>
						<div class="champjour">
							<input type="date" name="dt_fin" value="{{$jourferie->dt_fin_jourferie}}">
						</div>
					</td>
				</tr>
			</table>
					
			
			<div class="btnjour">
				<div>
					<button class="buttonjour"  role="button"  id="btncjour">
						{{--<span class="button-82-shadow"></span>--}}
						<span class="button-82-edgec"></span>
						<span class="button-82-frontc text ">
							<span class="fa fa-solid fa-plus"></span>
						Modifier
						</span>
					</button>
				</div>
				<div>
				
					<a href="{{url()->previous()}}" class="buttonjour" id="btnajour">
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
     
@endsection
