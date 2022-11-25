@extends("navbarsidebarRH")
@section("contenu")
<link rel="stylesheet" href="{{asset('css/Note.css')}}">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>

<!--Ajouter les heures supplémentaires a effectuer-->

<div class="tablesformProb">
	<div class="NoteAssiduite">
		<div>
			<h2 class="titreProb"><span id="emp">Note d'assiduité </span></h2>
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

	</div>
	<form action="{{route('NoteProbaJournaliere.calculer')}}" method="post">
		@csrf
		<div class="ajoutProbMensuelle">
			@include('sweetalert::alert')
			<h2 class="titreProbMens"><span id="emp_min">Note de probabilité de ponctualité journalière</span></h2>
			<table class="formProbJour">
				<tr >
					<td class="txtProbMens">
						<h3 class="formtxt" id="Mois">C1</h3>
					</td>
					<td>
						<div class="champProbabiliteMens">
							<input type="number" name="c1" id="coefficient1">
						</div>
					</td>
					<td class="txtProbMens">
						<h3 class="formtxt" id="txtcoefficient2">C2</h3>
					</td>
					<td>
						<div class="champProbabiliteMens">
							<input type="number" name="c2" id="coefficient2">
						</div>
					</td>
					<td class="txtProbMens">
						<h3 class="formtxt" id="txtcoefficient3">C3</h3>
					</td>
					<td>
						<div class="champProbabiliteMens">
							<input type="number" name="c3" id="coefficient3">
						</div>
					</td>
				</tr>

				<tr>
					<td class="txtProbMens">
						<h3 class="formtxt" >Année</h3>
					</td>
					<td>
						<div class="champProbabiliteMens">
							<select name="annee_probJour" id="">
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
							<select name="mois_probJour" id="">
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
					<td class="probJour">

					</td>
				</tr>
				<tr >
					<td class="txtProbMens">
						<h3 class="formtxt" id="Mois">Jours</h3>
					</td>
					<td>
						<div class="champProbabiliteMens">
							<select name="desj_probJour" id="">
								<option value="">--Jour--</option>
								<option value="lundi">Lundi</option>
								<option value="mardi">Mardi</option>
								<option value="mercredi">Mercredi</option>
								<option value="jeudi">Jeudi</option>
								<option value="vendredi">Vendredi</option>
								<option value="samedi">Samedi</option>
								<option value="dimanche">Dimanche</option>
							
							</select>
						</div>
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
					<button class="buttonProbMensu"  role="button"  id="btnAff">
						{{--<span class="button-82-shadow"></span>--}}
						<span class="button-82-edgec"></span>
						<span class="button-82-frontaff text ">
							<span class="fas fa-eye"></span>
						Afficher
						</span>
					</button>
				</div>
				
		  </div>
		</div>
	</form>
	
	<form action="{{route('NotePresenceMensuelle.calculer')}}" method="post">
		@csrf
		<div class="ajoutPresence">
			@include('sweetalert::alert')
			<h2 class="titreProbAnnuelle"><span id="emp_min">Note de présence <br>mensuelle</span></h2>
			<table class="formProbMens">
				<tr>
					<td class="txtProbMens">
						<h3 class="formtxt" >Année</h3>
					</td>
					<td>
						<div class="champProbabiliteMens">
							<select name="Annee_presence" id="">
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
							<select name="mois_pres_mensuelle" id="">
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
					<td class="Prob_mens_id_emp">

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
					<a href="{{route('NotePresenceMensuelle.evaluer')}}" class="buttonProbMensu"  role="button"  id="btnEva">
						{{--<span class="button-82-shadow"></span>--}}
						<span class="button-82-edgec"></span>
						<span class="button-82-frontev text ">
							<span class="fa fa-solid fa-chart-line"></span>
							Évaluer
						</span>
					</a>
				</div>
				<div>
					<a href="{{route('NotePresenceMensuelle.Afficher')}}" class="buttonProbMensu"  role="button"  >
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
	<form action="{{route('NotePresenceAnnuelle.calculer')}}" method="post">
		@csrf
		<div class="ajoutPresenceAnnuelle">
			@include('sweetalert::alert')
			<div class="titre_ponct">
				<h2 class="titreProbTotal"><span id="emp">Note de présence annuelle</span></h2>

			</div>
			<table class="formProbAnn">
				<tr>
					<td class="txtProbAnn">
						<h3 class="formtxt" >Année</h3>
					</td>
					<td>
						<div class="champProbabiliteMens">
							<select name="Annee_presence_ann" id="">
								<option value="">--Année--</option>
								@foreach ($annees as $annee)
									<option value="{{$annee->annee}}">{{$annee->annee}}</option>
								@endforeach
							</select>
						</div>
					</td>
					<td class="Prob_ann_id_emp">

					</td>
				</tr>
			</table>
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
					<button class="buttonProbMensu"  role="button"  id="">
						{{--<span class="button-82-shadow"></span>--}}
						<span class="button-82-edgec"></span>
						<span class="button-82-frontaff text ">
							<span class="fas fa-eye"></span>
						Afficher
						</span>
					</button>
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
			console.log(id_employe);
		var div=$('.formProbMens').parent();
		var input='<input type="text" hidden value="'+id_employe+'" name="id_employe" class="id_emp">';
		div.find('.Prob_mens_id_emp').html(" ");
		div.find('.Prob_mens_id_emp').append(input);
		var id_emp = $(".id_emp").val();
		console.log(id_emp);
		
	});

	$(document).on('change','#nom_emp_champ',function(){
	// console.log("hmm its change");

		var id_employe=$(this).val();
		console.log(id_employe);
		var div=$('.formProbAnn').parent();
		var input='<input type="text" hidden value="'+id_employe+'" name="id_employe_ann" class="id_emp">';
		div.find('.Prob_ann_id_emp').html(" ");
		div.find('.Prob_ann_id_emp').append(input);
		var id_emp = $(".id_emp").val();
		console.log(id_emp);
		
	});

	$(document).on('change','#nom_emp_champ',function(){
	// console.log("hmm its change");

		var id_employe=$(this).val();
		console.log(id_employe);
		var div=$('.formProbJour').parent();
		var input='<input type="text" hidden value="'+id_employe+'" name="id_employe_jour" class="id_emp">';
		div.find('.probJour').html(" ");
		div.find('.probJour').append(input);
		var id_emp = $(".id_emp").val();
		console.log(id_emp);
		
	});
});
</script>
@endsection
