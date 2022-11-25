@extends("navbarsidebarRH")
@section("contenu")

<link rel="stylesheet" href="{{asset('css/formInterservice.css')}}">
{{--<script  src="{{asset('js/service.js')}}"></script>--}}
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
<!--Ajouter un employé-->
<div class="tablesformserv">
	<form action="{{route('mission.create',['interservice'=>$interservice->id])}}" method="post">
		@csrf
		<div class="ajoutmission">
			@include('sweetalert::alert')
			<h2 class="titreservice">Ajouter<span id="emp"> Les missions pour ce service</span></h2>
			<table class="tablemission">
				<tr >      
					<td>
						<h3 class="formtxt">Designation de mission</h3>
					</td>
					<td>
						<div class="champserv2" >
							<input type="text" name="mission[]" id="desmiss">
						</div>
					</td>
					<td>
						<h3 class="formtxt" id="prime" >Prime de mission</h3>
					</td>
					<td>
						<div class="champserv2" >
							<input type="number" name="prime[]" id="champprime">
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
			'<h3 class="formtxt">Designation de mission</h3>'+ 
		'</td>'+ 
		'<td>'+ 
			'<div class="champserv2" >'+ 
				'<input type="text" name="mission[]" id="desmiss">'+ 
			'</div>'+ 
		'</td>'+ 
		'<td>'+ 
			'<h3 class="formtxt" id="prime" >Prime de mission</h3>'+ 
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
