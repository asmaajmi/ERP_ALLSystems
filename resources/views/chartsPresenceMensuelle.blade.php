@extends("navbarsidebarRH")
@section("contenu")
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="{{asset('css/PonctualiteMensChart.css')}}">
<div class="container">

	<div class="PonctualitePersMens">
		<div>
			<h2 class="titrepresMens"><span id="emp_moy">-- Note De Présence Mensuelle Evaluation--</span></h2>
		</div>
		<div class="input_select">
			<div class="champPonctualitePer" id="champ_emp">
				<select name="id_emp" id="nom_emp_champ" >
					<option value="" >--Nom Employé--</option>
					@foreach ($note as $n)
						<option value="{{$n->id_emp}}" >{{$n->employe->nom_emp}}&nbsp;{{$n->employe->prenom_emp}}</option>				
					@endforeach
				</select>
			</div>
			<div class="champPonctualitePer" id="annee_debut_champ">
				<select name="annee_debut" id="annee_debut" >
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
					<i class="fas fa-chart-area me-1"></i>
					Area Chart Example
				</div>
				<div class="canv"><canvas id="myAreaChart" ></canvas></div>
			</div>
		</div>
		<div class="col-xl-6">
			<div class="chart mb-4 ">
				<div class="">
					<i class="fas fa-chart-bar me-1"></i>
					Bar Chart Example
				</div>
				<div class="canv"><canvas id="myBarChart"></canvas></div>
			</div>
		</div>
	</div>
</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script type="text/javascript">
$(document).ready(function(){
	//document.getElementById(prix).disabled = true;

	$(document).on('change','#nom_emp_champ',function(){
	// console.log("hmm its change");

		var id_emp=$(this).val();
			//console.log(id_emp);

		var div=$('#annee_debut_champ').parent();
		// console.log(div);

		var op=" ";

		
		$.ajax({
			type:'get',
			url:'{!!URL::to('/RH/NoteAssiduite/notePresenceEvaluer/findAnneeDebut')!!}',
			data:{'id':id_emp},
			success:function(data){
				console.log('success');

				console.log(data);

				op+='<option  value="" >--Année--</option>';
				for(var i=0;i<data.length;i++){
				//console.log(op);
				op+='<option value="'+data[i].annee+'">'+data[i].annee+'</option>';
				}
				
			

				div.find('#annee_debut').html(" ");
				div.find('#annee_debut').append(op);

			},
			error:function(){

			}
		});
	});
		$(document).on('change','#annee_debut',function(){
	// console.log("hmm its change");
		var annee_debut=$(this).val();
		var id_emp=$("#nom_emp_champ").val();

		$.ajax({
			type:'get',
			url:'{!!URL::to('/RH/NoteAssiduite/notePresenceEvaluer/findchart')!!}',
			data:{'annee_debut':annee_debut,
					'id_emp':id_emp},
			success:function(data){
				var datas=data;
				var barCanvas=$("#myAreaChart");
				var barChart=new Chart(barCanvas,{
			type:'line',
			data:{
				labels:['Jan','Feb','Mar','Avr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
				datasets:[
					{
						label:'Valeur',
						data:datas,
						lineTension: 0.3,
						backgroundColor: "rgba(35,117,216,0.2)",
						borderColor: "rgba(35,117,216,1)",
						pointRadius: 5,
						pointBackgroundColor: "rgba(35,117,216,1)",
						pointBorderColor: "rgba(255,255,255,0.8)",
						pointHoverRadius: 5,
						pointHoverBackgroundColor: "rgba(190,117,216,1)",
						pointHitRadius: 50,
						pointBorderWidth: 2
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
						display: true,
						color: "rgba(0, 0, 0, .125)"

					}
					}],
				},
				legend: {
				display: false
				}
			}
        
    	})
			var barCanvas=$("#myBarChart");
				var barChart=new Chart(barCanvas,{
			type:'bar',
			data:{
				labels:['Jan','Feb','Mar','Avr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
				datasets:[
					{
						label:'Valeur',
						data:datas,
						backgroundColor:['silver','red','orange','yellow','green','blue','indigo','violet','purple','pink','silver','purple','brown'],

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
