@extends("navbarsidebarRH")
@section("contenu")

<link rel="stylesheet" href="{{asset('css/formjourferie.css')}}">
{{--<script  src="{{asset('js/service.js')}}"></script>--}}
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
<!--Ajouter un employé-->
<div class="tablesformjourferie">
	<form action="{{route('jourferie.create')}}" method="post">
		@csrf
		<div class="ajoutjourferie">
			@include('sweetalert::alert')
			<h2 class="titrejour">Ajouter <span id="emp">Un jour ferié</span></h2>
			<table class="formjourferie">
				<tr>
					<td class="txtjour">
						<h3 class="formtxt" >Designation Jour Ferié<span id="obligatoire">*</span></h3>
					</td>
					<td>
						<div class="champjour">
							<input type="text" name="des_jour" >
							<label><i class="fas fa-bells"></i></label>
						</div>
					</td>
					<td class="txtjour">
						<h3 class="formtxt" id="dtdebjour">Date Debut<span id="obligatoire">*</span></h3>
					</td>
					<td>
						<div class="champjour">
							<input type="date" name="dt_debut" >
						</div>
					</td>
				</tr>
				<tr>
					<td class="txtjour">
						<h3 class="formtxt">Date Fin<span id="obligatoire">*</span></h3>
					</td>
					<td>
						<div class="champjour">
							<input type="date" name="dt_fin" >
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
						Ajouter
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
