@extends("navbarsidebarRH")
@section("contenu")
<link rel="stylesheet" href="{{asset('css/formservice.css')}}">
<script  src="{{asset('js/service.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>

<!--Ajouter un employé-->
{{--{{route('service.update',['service'=>$service->id])}}--}}
<div class="tablesformserv">
	<form action="{{route('bureau.create',['service'=>$service->id])}}" method="post">
		@csrf
		<div class="ajoutBureau">
			<h2 class="titreBur">Ajouter des bureaux pour le service <span id="emp">{{$service->des_serv}}</span></h2>
			<table class="tablebureau" id="ajoutbur">

					<tr>  
                         
					<td>
						<h3 class="formtxt" id="titrebureau">Bureau</h3>
					</td>
					<td>
						<div class="champserv2" id="inputbureau">
							<input type="text" name="numbureau[]" id="dip" >
							<label><i class="fas fa-university"></i></label>

						</div>
					</td>
					<td>
						<h3 class="formtxt" id="tel1">Télèphone 1</h3>
					</td>
					<td>
						<div class="champserv2" id="inputtel1">
							<input type="text" name="tel1_bur[]">
							<label><i class="fas fa-phone-plus"></i></label>

						</div>
					</td>
					<td>
						<h3 class="formtxt" id="tel2">Télèphone 2</h3>
					</td>
					<td>
						<div class="champserv2" id="inputtel2">
							<input type="text" name="tel2_bur[]">
							<label><i class="fas fa-phone-plus"></i></label>

						</div>
					</td>
				</tr>
				
			</table>
			<a href="javascript:;"class="buttonbureau"  id="dipbtn">
                Ajouter un autre bureau</a>
                <br>
                <br>
           
                <div>
                    <button class="buttonserv"  role="button"  id="btncserv">
                        <span class="button-82-edgec"></span>
                        <span class="button-82-frontc text ">
                            <span class="fa fa-solid fa-plus"></span>
                        Ajouter
                        </span>
                    </button>
                </div>
                <div id="btnaserv">
				
					<a href="{{url()->previous()}}"  class="buttonserv" >
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
	$('.ajoutservice').on('click', '.buttonbureau', function() {
		var tr =
			'<tr>' +
			'<td>' +
			'<h3 class="formtxt" id="titrebureau">Bureau</h3>' +
			'</td>' +
			'<td>' +
			'<div class="champserv2" id="inputbureau">' +
			'<input type="text" name="numbureau[]" id="dip">' +
			'<label><i class="fas fa-university"></i></label>' +
	
			'</div>' +
			'</td>' +
			'<td>' +
			'<h3 class="formtxt" id="tel1">Télèphone 1</h3>' +
			'</td>' +
			'<td>' +
			'<div class="champserv2" id="inputtel1">' +
			'<input type="text" name="tel1_bur[]">' +
			'<label><i class="fas fa-phone-plus"></i></label>' +
	
			'</div>' +
			'</td>' +
			'<td>' +
			'<h3 class="formtxt" id="tel2">Télèphone 2</h3>' +
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