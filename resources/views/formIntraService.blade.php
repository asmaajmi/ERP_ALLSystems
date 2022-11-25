@extends("navbarsidebarRH")
@section("contenu")
<link rel="stylesheet" href="{{asset('css/intraService.css')}}">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!--Ajouter un employé-->
<div class="tablesintraservices">
	<form action="{{route('create.intraservice')}}" method="post">
	@csrf
		<div class="ajoutintraservice">
			<h2 class="titreintraservice">Ajouter <span id="intraserv">Un Intra-Service</span></h2>
			<table class="formintraservice">
				<tr class="line">
					<td class="txtintraservice">
						<h3 class="formtxt nomemp">Nom Opérateur<span id="obligatoire">*</span></h3>
					</td>
					<td>
						<div class="champintra" id="opdiv">
							<select name="id_op" id="id_op">
								<option value=""></option>
								@foreach ($employes as $employe)
								<option value="{{$employe->id}}">{{$employe->prenom_emp}}&nbsp;{{$employe->nom_emp}}</option>
								@endforeach
							</select>
						</div>
					</td>

					<td class="txtintraservice">
						<h3 class="formtxt nomemp col2" >Nom Superviseur<span id="obligatoire">*</span></h3>
					</td>
					<td>
						<div class="champintra" id="supdiv">
							<select name="id_sup" id="supid">	</select>
						</div>
					</td>
				</tr>
				<tr class="line">
					<td class="txtintraservice">
						<h3 class="formtxt" id="serviceid">Service<span id="obligatoire">*</span></h3>
					</td>
					<td>
						<div class="champintra">
						<select name="id_serv">
								@foreach ($services as $service)
								<option value="{{$service->id}}">{{$service->des_serv}}</option>
								@endforeach
							</select>
						</div>
					</td>

					<td class="txtintraservice">
						<h3 class="formtxt col2" id="prime">Prime<span id="obligatoire">*</span></h3>
					</td>
					<td>
						<div class="champintra">
							<input type="number" name="prime">
						</div>
					</td>
				</tr>
				
				<tr class="line">
					<td class="txtintraservice">
						<h3 class="formtxt" id="dtdeb">Date Début<span id="obligatoire">*</span></h3>
					</td>
					<td>
						<div class="champintra">
							<input type="date" name="datedeb">
						</div>
					</td>
					<td class="txtintraservice">
						<h3 class="formtxt col2" id="dtfin">Date Fin<span id="obligatoire">*</span></h3>
					</td>
					<td>
						<div class="champintra">
							<input type="date" name="datefin">
						</div>
					</td>
				</tr>


				<tr class="line">
					<td class="txtintraservice">
						<h3 class="formtxt" id="hrdeb">Heure Début<span id="obligatoire">*</span></h3>
					</td>
					<td>
						<div class="champintra">
							<input type="time" name="hrdebut">
						</div>
					</td>
					<td class="txtintraservice">
						<h3 class="formtxt col2" id="hrfin">Heure Fin<span id="obligatoire">*</span></h3>
					</td>
					<td>
						<div class="champintra">
							<input type="time" name="hrfin">
						</div>
					</td>
				</tr>
				
			</table>
			<div class="btnconfannuler" >                                   
                        <button class="button-82-pushable"  role="button"  id="btnc">
                            <span class="button-82-shadow"></span>
                            <span class="button-82-edgec"></span>
                            <span class="button-82-frontc text ">
                                <span class="fa fa-solid fa-plus"></span>
                            Ajouter
                            </span>
                        </button>

                        <a  href="{{url()->previous()}}" class="btnannuler"  id="btna">
                            <span class="button-annuler-82-shadow"></span>
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

<meta name="csrf-token" content="{{ csrf_token() }}">
<script>
    $(document).ready(function(){
        $(document).on('change','#id_op',function(){
            console.log("its work good");

            var empop_id=$(this).val();
            
            var div = $("#supdiv").parent();
            console.log(div);
            var op=" ";
            $.ajax({
                type:'get',
                url:'{!!URL::to('RH/IntraExtraService/operateur')!!}',
                data:{'idempop':empop_id},

                success:function(data){
                    // console.log('success');
                    // console.log(data);
                    // console.log(data.length);
                op+='<option value="0" disabled="true" selected="true">---</option>';
				for(var i=0;i<data.length;i++){
				//console.log(op);
				op+='<option value="'+data[i].id+'">'+data[i].prenom_emp+" "+data[i].nom_emp+'</option>';}
                console.log(op);
                div.find('#supid').html(" ");
			    div.find('#supid').append(op);
			},
            });
        });
	});
	</script>
@endsection