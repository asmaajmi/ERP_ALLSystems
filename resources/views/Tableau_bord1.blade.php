@extends("navbarsidebarRH")
@section("contenu")
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="{{asset('css/TableauBord1Chart.css')}}">
<div class="container">
	<div class="TableauBord">
		<h2 class="titreTableauBord"><span id="emp_max">-- Tableau de bord --</span></h2>
	</div>
	<div class="PonctualitePersMens">
		<div>
			<h2 class="titrePonctperMens"><span id="emp_moy">--Note de ponctualité personnelle mensuelle--</span></h2>
		</div>
		<div class="input_select">
			<div class="champPonctualitePer" id="champ_emp_ponct_pres_mens">
				<select name="nom_emp_ponct_pres_mens" id="id_emp_ponct_pres_mens" >
					<option value="" >--Nom Employé--</option>
					@foreach($employes as $emp)
					<option value="{{$emp->id}}" >{{$emp->prenom_emp}}&nbsp;{{$emp->nom_emp}}</option>
					@endforeach
				</select>
			</div>
			<div class="champPonctualitePer" id="champ_annee_ponct_pres_mens">
				<select name="annee_ponct_pers_mens" id="annee_ponct_pers_mens" >
					<option value="" >--Année--</option>
				</select>
			</div>
		</div>
	</div>
	<div class="chartcontainer">
	<div class="rowchart">
		<div class="col-xl-6">
			<div class="chart mb-4 ">
				<div class="">
					<i class="fas fa-chart-pie me-1"></i>
					Pie Chart
				</div>
				<div class="canv"><canvas id="myPieChartPonctPersMens" width="100%" height="60"></canvas></div>
			</div>
		</div>
		<div class="col-xl-6">
			<div class="chart mb-4 ">
				<div class="">
					<i class="fas fa-chart-bar me-1"></i>
					Bar Chart
				</div>
				<div class="canv"><canvas id="myBarChartPersMens" width="100%" height="60"></canvas></div>
			</div>
		</div>
	</div>
</div>
	<div class="Probabilite">
		<div>
			<h2 class="titreProbMens"><span id="emp_moy">--Note de probabilité de présence mensuelle--</span></h2>
		</div>
		<div class="input_select">
			<div class="champPonctualitePer" id="champ_emp_prob_pres">
				<select name="id_emp_prob_pres" id="nom_emp_prob_pres_champ" >
					<option value="" >--Nom Employé--</option>
					@foreach($employes as $emp)
					<option value="{{$emp->id}}" >{{$emp->prenom_emp}}&nbsp;{{$emp->nom_emp}}</option>
					@endforeach
				</select>
			</div>
			<div class="champPonctualitePer" id="champ_annee_prob_pres">
				<select name="annee_prob_presence" id="annee_prob_presence" >
					<option value="" >--Année--</option>
				</select>
			</div>
		</div>
	</div>
	<div class="chartcontainer">
		<div class="rowchart">
			<div class="col-xl-6">
				<div class="chart mb-4 ">
					<div class="">
						<i class="fas fa-chart-pie me-1"></i>
						Pie Chart
					</div>
					<div class="labels">
						<table class="label">

						</table>
					</div>
					<div class="canv"><canvas id="myPieChartProbPres" width="100%" height="70"></canvas></div>
				</div>
			</div>
			<div class="col-xl-6">
				<div class="chart mb-4 ">
					<div class="">
						<i class="fas fa-chart-bar me-1"></i>
						Bar Chart
					</div>
					<div class="canv"><canvas id="myBarChart" width="100%" height="70"></canvas></div>
				</div>
			</div>
		</div>
	</div>
	<div class="Probabilite">
		<div>
			<h2 class="titreProbJour"><span id="emp_moy">--Note de probabilité de ponctualité journalière--</span></h2>
		</div>
		<div class="input_selectJourna">
			<div class="champPonctualiteJournaliere" id="champ_emp_Proba_Journa">
				<select name="nom_emp_Proba_Journa" id="id_emp_Proba_Journa" >
					<option value="" >--Nom Employé--</option>
					@foreach($employes as $emp)
					<option value="{{$emp->id}}" >{{$emp->prenom_emp}}&nbsp;{{$emp->nom_emp}}</option>
					@endforeach
				</select>
			</div>
			<div class="champPonctualiteJournaliere" id="champ_mois_Proba_Journa">
				<select name="nom_mois_Proba_Journa" id="id_mois_Proba_Journa" >
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
			<div class="champPonctualiteJournaliere" id="champ_annee_Proba_Journa">
				<select name="nom_annee_Proba_Journa" id="id_annee_Proba_Journa" >
					<option value="" >--Année--</option>
				</select>
			</div>
		</div>
	</div>
	<div class="chartcontainer">
		<div class="rowchart">
			<div class="col-xl-6">
				<div class="chart mb-4 ">
					<div class="">
						<i class="fas fa-chart-pie me-1"></i>
						Pie Chart 
					</div>
					<div class="canv"><canvas id="myPieChartProbJourna" width="100%" height="60"></canvas></div>
				</div>
			</div>
			<div class="col-xl-6">
				<div class="chart mb-4 ">
					<div class="">
						<i class="fas fa-chart-bar me-1"></i>
						Bar Chart 
					</div>
					<div class="canv"><canvas id="myBarChartProbJourna" width="100%" height="60"></canvas></div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script type="text/javascript">
//var _ydata=JSON.parse('');
//var _xdata=JSON.parse('');
$(document).ready(function(){
	//document.getElementById(prix).disabled = true;

	$(document).on('change','#nom_emp_prob_pres_champ',function(){
	// console.log("hmm its change");

		var id_employe=$(this).val();
			//console.log(employe_id);

		var div=$('#champ_emp_prob_pres').parent();
		// console.log(div);

		var op=" ";

		
		$.ajax({
			type:'get',
			url:'{!!URL::to('/RH/TableauBord/annee')!!}',
			data:{'id':id_employe},
			success:function(data){
				console.log('success');

				console.log(data);
				op+='<option  value="" >--Année--</option>';
				for(var i=0;i<data.length;i++){
				//console.log(op);
				op+='<option value="'+data[i].annee+'">'+data[i].annee+'</option>';
				}
				
			

				div.find('#annee_prob_presence').html(" ");
				div.find('#annee_prob_presence').append(op);

			},
			error:function(){

			}
		});
	});



	$(document).on('change','#id_emp_ponct_pres_mens',function(){
	// console.log("hmm its change");

		var id_employe=$(this).val();
			//console.log(employe_id);

		var div=$('#champ_emp_ponct_pres_mens').parent();
		// console.log(div);

		var op=" ";

		
		$.ajax({
			type:'get',
			url:'{!!URL::to('/RH/TableauBord/anneePonctMens')!!}',
			data:{'id':id_employe},
			success:function(data){
				console.log('success');

				console.log(data);
				op+='<option  value="" >--Année--</option>';
				for(var i=0;i<data.length;i++){
				//console.log(op);
				op+='<option value="'+data[i].annee+'">'+data[i].annee+'</option>';
				}

				div.find('#annee_ponct_pers_mens').html(" ");
				div.find('#annee_ponct_pers_mens').append(op);

			},
			error:function(){

			}
		});
	});



	$(document).on('change','#id_emp_Proba_Journa',function(){
	// console.log("hmm its change");

		var id_employe=$(this).val();
			//console.log(employe_id);

		var div=$('#champ_emp_Proba_Journa').parent();
		// console.log(div);

		var op=" ";

		
		$.ajax({
			type:'get',
			url:'{!!URL::to('/RH/TableauBord/anneeProbaJourna')!!}',
			data:{'id':id_employe},
			success:function(data){
				console.log('success');

				console.log(data);
				op+='<option  value="" >--Année--</option>';
				for(var i=0;i<data.length;i++){
				//console.log(op);
				op+='<option value="'+data[i].annee+'">'+data[i].annee+'</option>';
				}

				div.find('#id_annee_Proba_Journa').html(" ");
				div.find('#id_annee_Proba_Journa').append(op);

			},
			error:function(){

			}
		});
	});

});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.0.0/chartjs-plugin-datalabels.min.js" integrity="sha512-R/QOHLpV1Ggq22vfDAWYOaMd5RopHrJNMxi8/lJu8Oihwi4Ho4BRFeiMiCefn9rasajKjnx9/fTQ/xkWnkDACg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script type="text/javascript">
$(document).ready(function(){
	//document.getElementById(prix).disabled = true;

	$(document).on('change','#annee_prob_presence',function(){
	// console.log("hmm its change");

		var annee=$(this).val();
			//console.log(employe_id);

		var div=$('#champ_annee_prob_pres').parent();
		// console.log(div);
		var id_emp=$("#nom_emp_prob_pres_champ").val();

		var op=" ";

		
		$.ajax({
			type:'get',
			url:'{!!URL::to('/RH/TableauBord/chartPresence')!!}',
			data:{'annee':annee	,
					'id_emp':id_emp},

			success:function(data){
				console.log('success');
				var datas=data.data1;
				var y_data=data.valeur;
				console.log(data);
				var pieCanvas=$("#myPieChartProbPres");
				var pieChart=new Chart(pieCanvas,{
				type:'pie',
				data:{
					labels:['Jan: '+datas[0],'Feb: '+datas[1],'Mar: '+datas[2],'Avr: '+datas[3],'May: '+datas[4],'Jun: '+datas[5],'Jul: '+datas[6],'Aug: '+datas[7],'Sep: '+datas[8],'Oct: '+datas[9],'Nov: '+datas[10],'Dec: '+datas[11]],
					datasets:[
						{
							data:datas,
							backgroundColor:['brown','red','orange','violet','green','blue','salmon','yellow','purple','pink','gray','teal'],

						}
					]

				},
			
				
				})

				var barsCanvas=$("#myBarChart");
				var barsChart=new Chart(barsCanvas,{
					type:'bar',
					data:{
						labels:['Jan','Feb','Mar','Avr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
						datasets:[
							{
								data:datas,
								backgroundColor:['brown','red','orange','violet','green','blue','salmon','yellow','purple','pink','gray','teal'],

							}
						],
						datasets:[
							{
								data:datas,
								backgroundColor:['brown','red','orange','violet','green','blue','salmon','yellow','purple','pink','gray','teal'],

							}
						],
						datasets:[
							{
								data:datas,
								backgroundColor:['brown','red','orange','violet','green','blue','salmon','yellow','purple','pink','gray','teal'],

							}
						],
						datasets:[
							{
								data:datas,
								backgroundColor:['brown','red','orange','violet','green','blue','salmon','yellow','purple','pink','gray','teal'],

							}
						]
					
					},
					options:{
						scales:{
							xAxes: [{

							gridLines: {
								display: true
							},
							ticks: {
								maxTicksLimit: 20
							}
							}],
							yAxes: [{
							ticks: {
								beginAtZero:true
							},
							gridLines: {
								display: true
							}
							}],
						},
						legend: {
						display: false
						}
					}
		
					
					
				})
				
			},
			error:function(){

			}
		});
	});

});

$(document).ready(function(){
	$(document).on('change','#annee_ponct_pers_mens',function(){
	// console.log("hmm its change");

		var anneeval=$(this).val();
			//console.log(employe_id);

		var div=$('#champ_annee_ponct_pres_mens').parent();
		// console.log(div);
		var id_emp_ponct_mens=$("#id_emp_ponct_pres_mens").val();

		var op=" ";

		
		$.ajax({
			type:'get',
			url:'{!!URL::to('/RH/TableauBord/chartPonctMensPers')!!}',
			data:{'anneeval':anneeval	,
				  'id_emp_ponct_mens':id_emp_ponct_mens},

			success:function(data){
				console.log('success');
				var datas=data.data1;
				var y_data=data.valeur;
				console.log(data);
				var pieCanvas=$("#myPieChartPonctPersMens");
				var pieChart=new Chart(pieCanvas,{
				type:'pie',
				data:{
					labels:['Jan: '+datas[0],'Feb: '+datas[1],'Mar: '+datas[2],'Avr: '+datas[3],'May: '+datas[4],'Jun: '+datas[5],'Jul: '+datas[6],'Aug: '+datas[7],'Sep: '+datas[8],'Oct: '+datas[9],'Nov: '+datas[10],'Dec: '+datas[11]],
					datasets:[
						{
							data:datas,
							backgroundColor:['brown','red','orange','violet','green','blue','salmon','yellow','purple','pink','gray','teal'],

						}
					]

				},
			
				
				})

				var barsCanvas=$("#myBarChartPersMens");
				var barsChart=new Chart(barsCanvas,{
					type:'bar',
					data:{
						labels:['Jan','Feb','Mar','Avr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
						datasets:[
							{
								data:datas,
								backgroundColor:['brown','red','orange','violet','green','blue','salmon','yellow','purple','pink','gray','teal'],

							}
						],
						datasets:[
							{
								data:datas,
								backgroundColor:['brown','red','orange','violet','green','blue','salmon','yellow','purple','pink','gray','teal'],

							}
						],
						datasets:[
							{
								data:datas,
								backgroundColor:['brown','red','orange','violet','green','blue','salmon','yellow','purple','pink','gray','teal'],

							}
						],
						datasets:[
							{
								data:datas,
								backgroundColor:['brown','red','orange','violet','green','blue','salmon','yellow','purple','pink','gray','teal'],

							}
						]
					
					},
					options:{
						scales:{
							xAxes: [{

							gridLines: {
								display: true
							},
							ticks: {
								maxTicksLimit: 20
							}
							}],
							yAxes: [{
							ticks: {
								beginAtZero:true
							},
							gridLines: {
								display: true
							}
							}],
						},
						legend: {
						display: false
						}
					}
		
					
					
				})
				
			},
			error:function(){

			}
		});
	});
});






$(document).ready(function(){
	//document.getElementById(prix).disabled = true;

	$(document).on('change','#id_annee_Proba_Journa',function(){
	// console.log("hmm its change");

		var annee=$(this).val();
			// console.log(annee);

		var div=$('#champ_annee_Proba_Journa').parent();
		// console.log(div);
		var id_emp=$("#id_emp_Proba_Journa").val();
		// console.log(id_emp)
		var mois=$("#id_mois_Proba_Journa").val();
		console.log(mois)
		var op=" ";

		
		$.ajax({
			type:'get',
			url:'{!!URL::to('/RH/TableauBord/chartProbabiliteJournaliere')!!}',
			data:{'anneeJour':annee	,
				  'id_empJour':id_emp,
				  'moisJour':mois},

			success:function(data){
				console.log('success');
				var datas=data.data1;
				var y_data=data.note;
				var j=data.jours;
				console.log(datas);
				console.log(y_data);
				var pieCanvas=$("#myPieChartProbJourna");
				var pieChart=new Chart(pieCanvas,{
				type:'pie',
				data:{
					labels:['Lundi: '+datas[0],'Mardi: '+datas[1],'Mercredi: '+datas[2],'Jeudi: '+datas[3],'Vendredi: '+datas[4],'Samedi: '+datas[5],'Dimanche: '+datas[6]],
					datasets:[
						{
							data:datas,
							backgroundColor:['brown','red','orange','violet','green','blue','salmon'],

						}
					]

				},
			
				
				})

				var barsCanvas=$("#myBarChartProbJourna");
				var barsChart=new Chart(barsCanvas,{
					type:'bar',
					data:{
						labels:['Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche'],
						datasets:[
							{
								data:datas,
								backgroundColor:['brown','red','orange','violet','green','blue','salmon'],

							}
						],
						datasets:[
							{
								data:datas,
								backgroundColor:['brown','red','orange','violet','green','blue','salmon'],

							}
						],
						datasets:[
							{
								data:datas,
								backgroundColor:['brown','red','orange','violet','green','blue','salmon'],

							}
						],
						datasets:[
							{
								data:datas,
								backgroundColor:['brown','red','orange','violet','green','blue','salmon'],

							}
						]
					
					},
					options:{
						scales:{
							xAxes: [{

							gridLines: {
								display: true
							},
							ticks: {
								maxTicksLimit: 20
							}
							}],
							yAxes: [{
							ticks: {
								beginAtZero:true
							},
							gridLines: {
								display: true
							}
							}],
						},
						legend: {
						display: false
						}
					}
		
					
					
				})
				
			},
			error:function(){

			}
		});
	});

});

</script>
@endsection