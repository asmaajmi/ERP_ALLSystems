@extends("navbarsidebarRH")
@section("contenu")
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="{{asset('css/PonctualiteJournaChart.css')}}">
<div class="container">

	<div class="PonctualitePersMens">
		<div>
			<h2 class="titrePonctperPars"><span id="emp_moy">-- Ponctualité Personnelle Partielle Journalière Évaluation--</span></h2>
		</div>
		<div class="input_select">
			<div class="champPonctualitePer" id="champ_emp">
				<select name="id_emp" id="nom_emp_champ" >
					<option value="" >--Nom Employé--</option>
					@foreach($employes as $employe)
					<option value="{{$employe->id}}" >{{ $employe->nom_emp }}&nbsp;{{ $employe->prenom_emp}}</option>
					@endforeach
				</select>
			</div>

			<div class="champPonctualitePer" id="champ_emp">
				<select name="name_annee" id="nom_annee_champ" >
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
					Lundi
				</div>
				<div class="canv"><canvas id="myAreaChartLundi"></canvas></div>
			</div>
		</div>
	
		<div class="col-xl-6">
			<div class="chart mb-4 ">
				<div class="">
					<i class="fas fa-chart-bar me-1"></i>
					Lundi
				</div>
				<div class="canv"><canvas id="myBarChartLundi"></canvas></div>
			</div>
		</div>
	</div>
	
	</div>


	<div class="chartcontainer">
	<div class="rowchart">
		<div class="col-xl-6">
			<div class="chart mb-4 ">
				<div class="">
					<i class="fas fa-chart-area me-1"></i>
					Mardi
				</div>
				<div class="canv"><canvas id="myAreaChartMardi"></canvas></div>
			</div>
		</div>
	
		<div class="col-xl-6">
			<div class="chart mb-4 ">
				<div class="">
					<i class="fas fa-chart-bar me-1"></i>
					Mardi
				</div>
				<div class="canv"><canvas id="myBarChartMardi"></canvas></div>
			</div>
		</div>
	</div>
	
	</div>


	<div class="chartcontainer">
	<div class="rowchart">
		<div class="col-xl-6">
			<div class="chart mb-4 ">
				<div class="">
					<i class="fas fa-chart-area me-1"></i>
					Mercredi
				</div>
				<div class="canv"><canvas id="myAreaChartMercredi"></canvas></div>
			</div>
		</div>
	
		<div class="col-xl-6">
			<div class="chart mb-4 ">
				<div class="">
					<i class="fas fa-chart-bar me-1"></i>
					Mercredi
				</div>
				<div class="canv"><canvas id="myBarChartMercredi"></canvas></div>
			</div>
		</div>
	</div>
	
	</div>


	<div class="chartcontainer">
	<div class="rowchart">
		<div class="col-xl-6">
			<div class="chart mb-4 ">
				<div class="">
					<i class="fas fa-chart-area me-1"></i>
					Jeudi
				</div>
				<div class="canv"><canvas id="myAreaChartJeudi"></canvas></div>
			</div>
		</div>
	
		<div class="col-xl-6">
			<div class="chart mb-4 ">
				<div class="">
					<i class="fas fa-chart-bar me-1"></i>
					Jeudi
				</div>
				<div class="canv"><canvas id="myBarChartJeudi"></canvas></div>
			</div>
		</div>
	</div>
	
	</div>


	<div class="chartcontainer">
	<div class="rowchart">
		<div class="col-xl-6">
			<div class="chart mb-4 ">
				<div class="">
					<i class="fas fa-chart-area me-1"></i>
					Vendredi
				</div>
				<div class="canv"><canvas id="myAreaChartVendredi"></canvas></div>
			</div>
		</div>
	
		<div class="col-xl-6">
			<div class="chart mb-4 ">
				<div class="">
					<i class="fas fa-chart-bar me-1"></i>
					Vendredi
				</div>
				<div class="canv"><canvas id="myBarChartVendredi"></canvas></div>
			</div>
		</div>
	</div>
	
	</div>

	<div class="chartcontainer">
	<div class="rowchart">
		<div class="col-xl-6">
			<div class="chart mb-4 ">
				<div class="">
					<i class="fas fa-chart-area me-1"></i>
					Samedi
				</div>
				<div class="canv"><canvas id="myAreaChartSamedi"></canvas></div>
			</div>
		</div>
	
		<div class="col-xl-6">
			<div class="chart mb-4 ">
				<div class="">
					<i class="fas fa-chart-bar me-1"></i>
					Samedi
				</div>
				<div class="canv"><canvas id="myBarChartSamedi"></canvas></div>
			</div>
		</div>
	</div>
	
	</div>


	<div class="chartcontainer">
	<div class="rowchart">
		<div class="col-xl-6">
			<div class="chart mb-4 ">
				<div class="">
					<i class="fas fa-chart-area me-1"></i>
					Dimanche
				</div>
				<div class="canv"><canvas id="myAreaChartDimanche"></canvas></div>
			</div>
		</div>
	
		<div class="col-xl-6">
			<div class="chart mb-4 ">
				<div class="">
					<i class="fas fa-chart-bar me-1"></i>
					Dimanche
				</div>
				<div class="canv"><canvas id="myBarChartDimanche"></canvas></div>
			</div>
		</div>
	</div>
	
	</div>


</div>


<script>
    $(document).ready(function(){
        $(document).on('change','#nom_emp_champ',function(){
            console.log("its work good");

            var emp_id=$(this).val();
            
            var div = $("#champ_emp").parent();
            console.log(div);
            var op=" ";
            $.ajax({
                type:'get',
                url:'{!!URL::to('/RH/Ponctualite/PersonnellePartielleJourFindAnnee')!!}',
                data:{'idemp':emp_id},

                success:function(data){
                    // console.log('success');
                    // console.log(data);
                    // console.log(data.length);
                op+='<option value="0" disabled="true" selected="true">--Année--</option>';
				for(var i=0;i<data.length;i++){
				//console.log(op);
				op+='<option value="'+data[i].annee+'">'+data[i].annee+'</option>';}
                console.log(op);
                div.find('#nom_annee_champ').html(" ");
			    div.find('#nom_annee_champ').append(op);
			},
            });
        });



		$(document).on('change','#nom_annee_champ',function(){
	// console.log("hmm its change");
		var annee=$(this).val();
		var id_emp=$("#nom_emp_champ").val();
		console.log(id_emp);


		$.ajax({
			type:'get',
			url:'{!!URL::to('/RH/NotePenctualite/PersonnellePartielle/findchartJourLundi')!!}',
			data:{'annee':annee,
			      'id_emp':id_emp},
			success:function(data){
				var datas=data;
				var barCanvas=$("#myAreaChartLundi");
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
			var barCanvas=$("#myBarChartLundi");
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





		$.ajax({
			type:'get',
			url:'{!!URL::to('/RH/NotePenctualite/PersonnellePartielle/findchartJourMardi')!!}',
			data:{'annee':annee,
			      'id_emp':id_emp},
			success:function(data){
				var datas=data;
				var barCanvas=$("#myAreaChartMardi");
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
			var barCanvas=$("#myBarChartMardi");
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





		$.ajax({
			type:'get',
			url:'{!!URL::to('/RH/NotePenctualite/PersonnellePartielle/findchartJourMercredi')!!}',
			data:{'annee':annee,
			      'id_emp':id_emp},
			success:function(data){
				var datas=data;
				var barCanvas=$("#myAreaChartMercredi");
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
			var barCanvas=$("#myBarChartMercredi");
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





		$.ajax({
			type:'get',
			url:'{!!URL::to('/RH/NotePenctualite/PersonnellePartielle/findchartJourJeudi')!!}',
			data:{'annee':annee,
			      'id_emp':id_emp},
			success:function(data){
				var datas=data;
				var barCanvas=$("#myAreaChartJeudi");
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
			var barCanvas=$("#myBarChartJeudi");
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






		$.ajax({
			type:'get',
			url:'{!!URL::to('/RH/NotePenctualite/PersonnellePartielle/findchartJourVend')!!}',
			data:{'annee':annee,
			      'id_emp':id_emp},
			success:function(data){
				var datas=data;
				var barCanvas=$("#myAreaChartVendredi");
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
			var barCanvas=$("#myBarChartVendredi");
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







		$.ajax({
			type:'get',
			url:'{!!URL::to('/RH/NotePenctualite/PersonnellePartielle/findchartJourSamedi')!!}',
			data:{'annee':annee,
			      'id_emp':id_emp},
			success:function(data){
				var datas=data;
				var barCanvas=$("#myAreaChartSamedi");
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
			var barCanvas=$("#myBarChartSamedi");
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





		
		$.ajax({
			type:'get',
			url:'{!!URL::to('/RH/NotePenctualite/PersonnellePartielle/findchartJourDimanche')!!}',
			data:{'annee':annee,
			      'id_emp':id_emp},
			success:function(data){
				var datas=data;
				var barCanvas=$("#myAreaChartDimanche");
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
			var barCanvas=$("#myBarChartDimanche");
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
