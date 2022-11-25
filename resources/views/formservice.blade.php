@extends("navbarsidebarRH")
@section("contenu")

<link rel="stylesheet" href="{{asset('css/formservice.css')}}">
{{--<script  src="{{asset('js/service.js')}}"></script>--}}
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
<!--Ajouter un employé-->
<div class="tablesformserv">
	<form action="{{route('service.create')}}" method="post">
		@csrf
		<div class="ajoutservice">
			@include('sweetalert::alert')
			<h2 class="titreservice">Ajouter <span id="emp">Un service</span></h2>
			<table class="formservice">
				<tr>
					<td class="txtserv">
						<h3 class="formtxt" id="nomemp">Nom Employe<span id="obligatoire">*</span></h3>
					</td>
					<td>
						<div class="champserv">
							<select name="id_emp">
								<option value=""></option>
								@foreach ($employes as $employe)
								<option value="{{$employe->id}}">{{$employe->prenom_emp}}&nbsp;{{$employe->nom_emp}}</option>
								@endforeach
							</select>
						</div>
					</td>
					<td class="txtserv">
						<h3 class="formtxt" id="nomserv">Nom Service<span id="obligatoire">*</span></h3>
					</td>
					<td>
						<div class="champserv">
							<input type="text" name="des_serv" >
							<label><i class="fas fa-user"></i></label>
						</div>
					</td>
				</tr>
			</table>
			<h2 class="ajoutserv">Ajouter Les bureaux pour ce service</h2>
			<table class="tablebureau" id="ajoutbur">
				<tr>      
					<td>
						<h3 class="formtxt" id="titrebureau">Bureau<span id="obligatoire">*</span></h3>
					</td>
					<td>
						<div class="champserv2" id="inputbureau">
							<input type="text" name="numbureau[]" id="dip">
							<label><i class="fas fa-university"></i></label>

						</div>
					</td>
					<td>
						<h3 class="formtxt" id="tel1">Télèphone 1<span id="obligatoire">*</span></h3>
					</td>
					<td>
						<div class="champserv2" id="inputtel1">
							<input type="text" name="tel1_bur[]">
							<label><i class="fas fa-phone-plus"></i></label>

						</div>
					</td>
					<td>
						<h3 class="formtxt" id="tel2">Télèphone 2<span id="obligatoire">*</span></h3>
					</td>
					<td>
						<div class="champserv2" id="inputtel2">
							<input type="text" name="tel2_bur[]">
							<label><i class="fas fa-phone-plus"></i></label>
						</div>
					</td>
				</tr>
			</table>
			{{--onclick="addRowServBur()--}}
			
			<a href="javascript:;"class="buttonbureau"  id="dipbtn">
			Ajouter un autre bureau</a>
			<br>
			<br>
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
$('.ajoutservice').on('click', '.buttonbureau', function() {
    var tr =
		'<tr>' +
        '<td>' +
        '<h3 class="formtxt" id="titrebureau">Bureau<span id="obligatoire">*</span></h3>' +
        '</td>' +
        '<td>' +
        '<div class="champserv2" id="inputbureau">' +
        '<input type="text" name="numbureau[]" id="dip">' +
        '<label><i class="fas fa-university"></i></label>' +

        '</div>' +
        '</td>' +
        '<td>' +
        '<h3 class="formtxt" id="tel1">Télèphone 1<span id="obligatoire">*</span></h3>' +
        '</td>' +
        '<td>' +
        '<div class="champserv2" id="inputtel1">' +
        '<input type="text" name="tel1_bur[]">' +
        '<label><i class="fas fa-phone-plus"></i></label>' +

        '</div>' +
        '</td>' +
        '<td>' +
        '<h3 class="formtxt" id="tel2">Télèphone 2<span id="obligatoire">*</span></h3>' +
        '</td>' +
        '<td>' +
        '<div class="champserv2" id="inputtel2">' +
        '<input type="text" name="tel2_bur[]">' +
        '<label><i class="fas fa-phone-plus"></i></label>' +
        '</div>' +

        '</td>' +
        '</tr>';
    $('.tablebureau').append(tr);
});
</script>
@endsection
