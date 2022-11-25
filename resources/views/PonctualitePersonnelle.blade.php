@extends("navbarsidebarRH")
@section("contenu")
<link rel="stylesheet" href="{{asset('css/PonctualitePersonnelle.css')}}">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>

<!--Ajouter les heures supplémentaires a effectuer-->

<div class="tablesformPonctPerson">
	<div class="ajoutPonctualiteper">
		<div>
			<h2 class="titrePonctper"><span id="emp">Ponctualité Personnelle</span></h2>
		</div>
		<div class="champPonctualitePer"  >
			<select name="service" id="" class="nom_serv">
				<option value="">--Service--</option>
				@foreach ($services as $service )
					<option value="{{$service->id}}">{{$service->des_serv}}</option>
				@endforeach
			</select>
		</div>

		<div class="champPonctualitePer" id="champ_emp">
			<select name="id_emp" id="nom_emp_champ" >
				<option value="" >--Nom Employé--</option>
			</select>
		</div>

	</div>
	<div class="ajoutPonctualiteperPars">
		<div>
			<h2 class="titrePonctperPars"><span id="emp_moy">-- Ponctualité Personnelle Partielle --</span></h2>
		</div>
	</div>
	<form action="{{route('Ponctualite.calculer')}}" method="post">
		@csrf
		<div class="ajoutPonctualiteMens">
			@include('sweetalert::alert')
			<h2 class="titrePonctMens"><span id="emp_min">Ponctualité Mensuelle</span></h2>
			<table class="formPonctualiteMens">

				<tr>
					<td class="txtPonctMens">
						<h3 class="formtxt" >Année</h3>
					</td>
					<td>
						<div class="champPonctualiteMens">
							<select name="annee_mensuelle">
								<option value="">--Année--</option>
								@foreach ($annees as $annee)
									<option value="{{$annee->annee}}">{{$annee->annee}}</option>
								@endforeach
							</select>
						</div>
					</td>
				</tr>
				<tr >
					<td class="txtPonctMens">
						<h3 class="formtxt" id="Mois">Mois</h3>
					</td>
					<td>
						<div class="champPonctualiteMens">
							<select name="mois_mensuelle">
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
					<td class="ponctMens">

					</td>
				</tr>

			</table>
			<div class="btnPonctMensuelle">
				<div>
					<button class="buttonPonctMensu"  role="button"  >
						{{--<span class="button-82-shadow"></span>--}}
						<span class="button-82-edgec"></span>
						<span class="button-82-frontc text ">
							<span class="fa fa-solid fa-calculator"></span>
						Calculer
						</span>
					</button>
				</div>
			
				<div>
					<a href="{{route('PonctualitePersonnelleMens.chart')}}" class="buttonPonctMensu">
						<span class="button-82-edgec"></span>
						<span class="button-82-frontev text ">
						<span class="fa fa-solid fa-chart-line"></span>
						Evaluer
						</span>
					</a>
				</div>
				<div>
					<a href="{{route('PonctualitePersonnelleMens.crud')}}" class="buttonPonctMensu"    id="btnaffnotepersmens">
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
	
	<form action="{{route('PonctualitePerAnn.calculer')}}" method="post">
		@csrf
		<div class="ajoutPonctualiteAnn">
			@include('sweetalert::alert')
			<h2 class="titrePonctAnnuelle"><span id="emp_min">Ponctualité Annuelle</span></h2>
			<table class="formPonctualiteAnn">
				<tr>
					<td class="txtPonctMens">
						<h3 class="formtxt ponctannid" >Année</h3>
					</td>
	
					<td>
						<div class="champPonctualiteMens ponctannid">
							<select name="annee_ponct" id="">
								<option value="">--Année--</option>
								@foreach ($annees as $annee)
									<option value="{{$annee->annee}}">{{$annee->annee}}</option>
								@endforeach
							</select>
						</div>
					</td>
					<td class="ponctann">

					</td>
				</tr>
			</table>
			<div class="btnPonctAnnuelle">
				<div>
					<button class="buttonPonctMensu"  role="button"  >
						{{--<span class="button-82-shadow"></span>--}}
						<span class="button-82-edgec"></span>
						<span class="button-82-frontc text ">
							<span class="fa fa-solid fa-calculator"></span>
						Calculer
						</span>
					</button>
				</div>
				<div>
					<a href="{{route('PonctualitePersonnelleAnn.crud')}}" class="buttonPonctMensu"  role="button"  id="">
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

	<form action="{{route('PonctualitePerJournalier.calculer')}}" method="post">
		@csrf
		<div class="ajoutPonctualiteJour">
			@include('sweetalert::alert')
			<h2 class="titrePonctJour"><span id="emp_min">Ponctualité Journalière</span></h2>
			<table class="formPonctualiteJour">
				<tr>
					<td class="txtPonctMens">
						<h3 class="formtxt" id="annee_j">Année</h3>
					</td>
				</tr>
				<tr>
					<td>
						<div class="champPonctualiteJour">
							<select name="annee_journaliere" id="annee_j_champ">
								<option value="">--Année--</option>
								@foreach ($annees as $annee)
									<option value="{{$annee->annee}}">{{$annee->annee}}</option>
								@endforeach
							</select>
						</div>
					</td>
				</tr>
				<tr>
					<td class="txtPonctMens">
						<h3 class="formtxt" id="Mois_j">Mois</h3>
					</td>
					<td class="txtPonctMens">
						<h3 class="formtxt" id="num_jour">Numéro de jour</h3>
					</td>
					<td class="txtPonctMens">
						<h3 class="formtxt" id="des_jour">Désignation de jour</h3>
					</td>
				</tr>
				<tr>
					
					<td>
						<div class="champPonctualiteJour">
							<select name="mois_journaliere" id="mois_champ">
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
					
					<td>
						<div class="champPonctualiteJour">
							<select name="jour_journalier" id="num_jour_champ">
								<option value="">--Numéro de jour--</option>
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
								<option value="10">10</option>
								<option value="11">11</option>
								<option value="12">12</option>
								<option value="13">13</option>
								<option value="14">14</option>
								<option value="15">15</option>
								<option value="16">16</option>
								<option value="17">17</option>
								<option value="18">18</option>
								<option value="19">19</option>
								<option value="20">20</option>
								<option value="21">21</option>
								<option value="22">22</option>
								<option value="23">23</option>
								<option value="24">24</option>
								<option value="25">25</option>
								<option value="26">26</option>
								<option value="27">27</option>
								<option value="28">28</option>
								<option value="29">29</option>
								<option value="30">30</option>
								<option value="31">31</option>
							</select>
						</div>
					</td>
					
					<td>
						<div class="champPonctualiteJour">
							<select name="des_jour_journalier" id="des_jour_champ">
								<option value="">--Désignation de jour--</option>
								<option value="Lundi">Lundi</option>
								<option value="Mardi">Mardi</option>
								<option value="Mercredi">Mercredi</option>
								<option value="Jeudi">Jeudi</option>
								<option value="Vendredi">Vendredi</option>
								<option value="Samedi">Samedi</option>
								<option value="Dimanche">Dimanche</option>
							</select>
						</div>
					</td>
				</tr>
				<tr>
				<td class="ponctjour">

				</td>
				</tr>
			</table>
			<div class="btnPonctJounaliere">
				<div>
					<button class="buttonPonctMensu"  role="button"  >
						{{--<span class="button-82-shadow"></span>--}}
						<span class="button-82-edgec"></span>
						<span class="button-82-frontc text ">
							<span class="fa fa-solid fa-calculator"></span>
						Calculer
						</span>
					</button>
				</div>
				<div>
					<a class="buttonPonctMensu"  href="{{route('PonctualitePersonnelleJournaliere.chart')}}"  id="">
						{{--<span class="button-82-shadow"></span>--}}
						<span class="button-82-edgec"></span>
						<span class="button-82-frontev text ">
							<span class="fa fa-solid fa-chart-line"></span>
							Évaluer
						</span>
</a>
				</div>
				<div>
					<a href="{{route('PonctualitePersonnelleJournaliere.crud')}}" class="buttonPonctMensu"  role="button"  id="btnAff">
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
	<div class="ajoutPonctualiteperPars">
		<div>
			<h2 class="titrePonctperPars"><span id="emp_moy">-- Ponctualité Personnelle Totale --</span></h2>
		</div>
	</div>
	<form action="{{route('PonctualitePerTotal.calculer')}}" method="post">
		@csrf
		<div class="ajoutPonctualiteTot">
			@include('sweetalert::alert')
				<h2 class="titrePonctTotal"><span id="emp">Ponctualité Totale</span></h2>
				<table class="formPonctualiteTot">
					<tr>
				<td class="poncttot">

				</td>
					</tr>
				</table>
			<div class="btnPonctTotal">
				<div>
					<button class="buttonPonctMensu"  role="button"  >
						{{--<span class="button-82-shadow"></span>--}}
						<span class="button-82-edgec"></span>
						<span class="button-82-frontc text ">
							<span class="fa fa-solid fa-calculator"></span>
						Calculer
						</span>
					</button>
				</div>
				
				<div>
					<a href="{{route('PonctualitePersonnelleTotal.crud')}}" class="buttonPonctMensu"  role="button"  id="">
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
			console.log(id_employe);
		var div=$('.formPonctualiteMens').parent();
		var input='<input type="text" hidden value="'+id_employe+'" name="id_employe" class="id_emp">';
		div.find('.ponctMens').html(" ");
		div.find('.ponctMens').append(input);
		var id_emp = $(".id_emp").val();
		console.log(id_emp);
		
	});

	$(document).on('change','#nom_emp_champ',function(){
	// console.log("hmm its change");

		var id_employe2=$(this).val();
		console.log(id_employe2);
		var div=$('.formPonctualiteAnn').parent();
		var input='<input type="text" hidden value="'+id_employe2+'" name="id_employe2" class="id_emp">';
		div.find('.ponctann').html(" ");
		div.find('.ponctann').append(input);
		var id_emp2 = $(".id_emp").val();
		console.log(id_emp2);		
	});

	$(document).on('change','#nom_emp_champ',function(){
	// console.log("hmm its change");

		var id_employe3=$(this).val();
		console.log(id_employe3);
		var div=$('.formPonctualiteTot').parent();
		var input='<input type="text" hidden value="'+id_employe3+'" name="id_employe3" class="id_emp">';
		div.find('.poncttot').html(" ");
		div.find('.poncttot').append(input);
		var id_emp3 = $(".id_emp").val();
		console.log(id_emp3);		
	});

	$(document).on('change','#nom_emp_champ',function(){
	// console.log("hmm its change");

		var id_employe4=$(this).val();
		console.log(id_employe4);
		var div=$('.formPonctualiteJour').parent();
		var input='<input type="text" hidden value="'+id_employe4+'" name="id_employe4" class="id_emp">';
		div.find('.ponctjour').html(" ");
		div.find('.ponctjour').append(input);
		var id_emp4 = $(".id_emp").val();
		console.log(id_emp4);		
	});
});

</script>
@endsection