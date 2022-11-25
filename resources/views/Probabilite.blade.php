@extends("navbarsidebarRH")
@section("contenu")
<link rel="stylesheet" href="{{asset('css/Probabilite.css')}}">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>

<!--Ajouter les heures supplémentaires a effectuer-->

<div class="tablesformProb">
	<div class="ajoutProbabilite">
		<div>
			<h2 class="titreProb"><span id="emp">Probabilité</span></h2>
		</div>
		<div class="champProb"  >
			<select name="service" id="" class="nom_serv">
				<option value="">--Service--</option>
				@foreach ($services as $service )
					<option value="{{$service->id}}">{{$service->des_serv}}</option>
				@endforeach
			</select>
		</div>

		<div class="champProb" id="champ_emp">
			<select name="id_emp" id="nom_emp_champ" >
				<option value="" >--Nom Employé--</option>
			</select>
		</div>
		<div class="champProb" id="champ_emp">
			<select name="type_prob" id="type_prob_champ" >
				<option value="" >--Type probabilité--</option>
				<option value="Présence" >Présence</option>
				<option value="Congé" >Congé</option>
			</select>
		</div>

	</div>
	<div class="ajoutProbPars">
		<div>
			<h2 class="titreProbPars"><span id="emp_moy">-- Probabilité Partielle --</span></h2>
		</div>
	</div>
	<form action="{{route('ProbMensuelle.calculer')}}" method="post">
		@csrf
		<div class="ajoutProbMensuelle">
			@include('sweetalert::alert')
			<h2 class="titreProbMens"><span id="emp_min">Probabilité Mensuelle</span></h2>
			<table class="formProbMens">

				<tr>
					<td class="txtProbMens">
						<h3 class="formtxt" >Année</h3>
					</td>
					<td>
						<div class="champProbabiliteMens">
							<select name="annee_mensuelle" id="">
								<option value="">--Année--</option>
								@foreach ($annees as $annee)
									<option value="{{$annee->annee}}">{{$annee->annee}}</option>
								@endforeach
							</select>
						</div>
					</td>
				</tr>
				<tr >
					<td class="txtProbMens">
						<h3 class="formtxt" id="Mois">Mois</h3>
					</td>
					<td>
						<div class="champProbabiliteMens">
							<select name="mois_mensuelle" id="">
								<option value="">--Mois--</option>
								<option value="1">Janvier</option>
								<option value="2">Février</option>
								<option value="3">Mars</option>
								<option value="4">Avril</option>
								<option value="5">Mai</option>
								<option value="6">Juin</option>
								<option value="7">Juillet</option>
								<option value="8">Août</option>
								<option value="9">Septembre</option>
								<option value="10">Octobre</option>
								<option value="11">Nouvembre</option>
								<option value="12">Décembre</option>
							</select>
						</div>
					</td>
					<td class="probMensEmp">

					</td>
					<td class="probMens">

					</td>
				</tr>
				

			</table>
			<div class="btnProbMensuelle">
				<div>
					<button class="buttonProbMensu"  role="button"  >
						{{--<span class="button-82-shadow"></span>--}}
						<span class="button-82-edgec"></span>
						<span class="button-82-frontc text ">
							<span class="fa fa-solid fa-calculator"></span>
						Calculer
						</span>
					</button>
				</div>
				<div>
					<a href="{{route('ProbMensuelle.Afficher')}}" class="buttonProbMensu"  role="button"  id="">
						{{--<span class="button-82-shadow"></span>--}}
						<span class="button-82-edgec"></span>
						<span class="button-82-frontaff text ">
							<span class="fas fa-eye"></span>
						Afficher
						</span>
					</a>
				</div>
				
		  </div>
		</div>
	</form>
	
	<form action="{{route('ProbAnnuelle.calculer')}}" method="post">
		@csrf
		<div class="ajoutProbAnnuelle">
			@include('sweetalert::alert')
			<h2 class="titreProbAnnuelle"><span id="emp_min">Probabilité Annuelle</span></h2>
			<table class="formProbAnnuelle">
				<tr>
					<td class="txtProbMens">
						<h3 class="formtxt" >Année</h3>
					</td>
					<td>
						<div class="champProbabiliteMens">
							<select name="Annee_annuelle" id="">
								<option value="">--Année--</option>
								@foreach ($annees as $annee)
									<option value="{{$annee->annee}}">{{$annee->annee}}</option>
								@endforeach
							</select>
						</div>
					</td>
					<td class="probAnnuelleEmp">

					</td>
					<td class="probAnnuelle">

					</td>
				</tr>
			</table>
			<div class="btnProbAnnuelle">
				<div>
					<button class="buttonProbMensu"  role="button"  >
						{{--<span class="button-82-shadow"></span>--}}
						<span class="button-82-edgec"></span>
						<span class="button-82-frontc text ">
							<span class="fa fa-solid fa-calculator"></span>
						Calculer
						</span>
					</button>
				</div>
				
				<div>
					<a href="{{route('ProbAnnuelle.Afficher')}}" class="buttonProbMensu"  role="button"  id="">
						{{--<span class="button-82-shadow"></span>--}}
						<span class="button-82-edgec"></span>
						<span class="button-82-frontaff text ">
							<span class="fas fa-eye"></span>
						Afficher
						</span>
					</a>
				</div>
		  </div>
		</div>
	</form>
	<div class="ajoutProbPars">
		<div>
			<h2 class="titreProbPars"><span id="emp_moy">-- Probabilité Totale --</span></h2>
		</div>
	</div>
	<form action="{{route('ProbTotal.calculer')}}" method="post">
		@csrf
		<div class="ajoutProbabiliteTot">
			@include('sweetalert::alert')
			<div class="titre_ponct">
				<h2 class="titreProbTotal"><span id="emp">Probabilité Totale</span></h2>

			</div>
			<span class="probTotEmp">

			</span>
			<span class="probTotal">

			</span>
			<div class="btnProbTotal">
				<div>
					<button class="buttonProbMensu"  role="button"  >
						{{--<span class="button-82-shadow"></span>--}}
						<span class="button-82-edgec"></span>
						<span class="button-82-frontc text ">
							<span class="fa fa-solid fa-calculator"></span>
						Calculer
						</span>
					</button>
				</div>
				
				<div>
					<a href="{{route('ProbTotal.Afficher')}}" class="buttonProbMensu"  role="button"  id="">
						{{--<span class="button-82-shadow"></span>--}}
						<span class="button-82-edgec"></span>
						<span class="button-82-frontaff text ">
							<span class="fas fa-eye"></span>
						Afficher
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

	$(document).on('change','.nom_serv',function(){
	// console.log("hmm its change");

		var id_serv=$(this).val();
			//console.log(employe_id);

		var div=$('#champ_emp').parent();
		// console.log(div);

		var op=" ";
		var op2=" ";

		
		$.ajax({
			type:'get',
			url:'{!!URL::to('/RH/PonctualitePersonnelle/findEmploye')!!}',
			data:{'id':id_serv},
			success:function(data){
				console.log('success');

				console.log(data);

				console.log(data.data1.length);
				console.log(data.data2.length);

				op+='<option  value="" >--Nom Employe--</option>';
				for(var i=0;i<data.data1.length;i++){
				//console.log(op);
				op+='<option value="'+data.data1[i].id+'">'+data.data1[i].prenom_emp+' '+data.data1[i].nom_emp+'</option>';
				}
				for(var j=0;j<data.data2.length;j++){

				op2+='<option value="'+data.data2[j].id+'">'+data.data2[j].prenom_emp+' '+data.data2[j].nom_emp+'</option>';

				}
			

				div.find('#nom_emp_champ').html(" ");
				div.find('#nom_emp_champ').append(op);
				div.find('#nom_emp_champ').append(op2);

			},
			error:function(){

			}
		});
	});
	$(document).on('change','#nom_emp_champ',function(){
	// console.log("hmm its change");

		var id_employe=$(this).val();
		var div=$('.formProbMens').parent();
		var input='<input type="text" hidden value="'+id_employe+'" name="id_employe" class="id_emp">';
		div.find('.probMensEmp').html(" ");
		div.find('.probMensEmp').append(input);
		var id_emp = $(".id_emp").val();
		console.log(id_emp);
		
	});

	$(document).on('change','#type_prob_champ',function(){
	// console.log("hmm its change");

		var type_prob=$(this).val();
		var div=$('.formProbMens').parent();
		var input='<input type="text" hidden value="'+type_prob+'" name="type_probabilite" class="type_pr">';
		div.find('.probMens').html(" ");
		div.find('.probMens').append(input);
		var type = $(".type_pr").val();
		console.log(type);
		
	});

	$(document).on('change','#nom_emp_champ',function(){
	// console.log("hmm its change");

		var id_employe=$(this).val();
		var div=$('.formProbAnnuelle').parent();
		var input='<input type="text" hidden value="'+id_employe+'" name="id_employe_ann" class="id_emp">';
		div.find('.probAnnuelleEmp').html(" ");
		div.find('.probAnnuelleEmp').append(input);
		var id_emp = $(".id_emp").val();
		console.log(id_emp);
		
	});

	$(document).on('change','#type_prob_champ',function(){
	// console.log("hmm its change");

		var type_prob=$(this).val();
		var div=$('.formProbAnnuelle').parent();
		var input='<input type="text" hidden value="'+type_prob+'" name="type_probabilite_ann" class="type_pr">';
		div.find('.probAnnuelle').html(" ");
		div.find('.probAnnuelle').append(input);
		var type = $(".type_pr").val();
		console.log(type);
		
	});

	$(document).on('change','#nom_emp_champ',function(){
	// console.log("hmm its change");

		var id_employe=$(this).val();
		var div=$('.ajoutProbabiliteTot').parent();
		var input='<input type="text" hidden value="'+id_employe+'" name="id_employe_tot" class="id_emp">';
		div.find('.probTotEmp').html(" ");
		div.find('.probTotEmp').append(input);
		var id_emp = $(".id_emp").val();
		console.log(id_emp);
		
	});

	$(document).on('change','#type_prob_champ',function(){
	// console.log("hmm its change");

		var type_prob=$(this).val();
		var div=$('.ajoutProbabiliteTot').parent();
		var input='<input type="text" hidden value="'+type_prob+'" name="type_probabilite_tot" class="type_pr">';
		div.find('.probTotal').html(" ");
		div.find('.probTotal').append(input);
		var type = $(".type_pr").val();
		console.log(type);
		
	});
});
</script>
@endsection