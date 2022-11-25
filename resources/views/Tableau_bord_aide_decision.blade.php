@extends("navbarsidebarRH")
@section("contenu")
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="{{asset('css/tableauBordAideDecision.css')}}">
<div class="container">
    <div class="TableauBord">
		<h2 class="titreTableauBord"><span id="emp_max">-- Tableau de bord d'aide à la décision--</span></h2>
	</div>
    <div class="PonctualitePersMens">
		<div>
			<h2 class="titrePonctperMens"><span id="emp_moy">--Note de ponctualité personnelle mensuelle--</span></h2>
		</div>
		<div class="input_select">
            <div>
                <select name="name_annee_ponct_mens" id="id_annee_ponct_mens" >
                    <option value="" >--Année--</option>
                    @foreach ($anneesPonctPersMens as $anneePonctMens)
                    <option value="{{$anneePonctMens->annee}}" >{{$anneePonctMens->annee}}</option>
                    @endforeach
                </select>
            </div>
		</div>
	</div>
   

    <div class="tabBord2">
        <div class="legend2">
            <table class="table tableg2 tablelegend2 mt-4">
                <thead>
                    <tr>
                        <th scope="col">Mois</th>
                        <th scope="col">Employe</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="legendtbody2">
                  

                </tbody>
                
            </table>
        </div>
        <div class="chartCard2">
            <div class="chartBox2">
                <canvas id="myChart2"></canvas>
            </div>
        </div>

    </div>


    <div class="PonctualitePersMens">
		<div>
			<h2 class="titrePonctperMens"><span id="emp_moy">--Note de probabilité de présence mensuelle--</span></h2>
		</div>
		<div class="input_select">
            <div class="champPonctualitePer" id="champ_annee_prob_pres">
				<select name="annee_prob_presence" id="annee_prob_presence" >
                    <option value="" >--Année--</option>
                    @foreach ($anneesProbPres as $anneeProbPres)
                    <option value="{{$anneeProbPres->annee}}" >{{$anneeProbPres->annee}}</option>
                    @endforeach
                </select>
            </div>
		</div>
	</div>
    <div class="tabBord1">
        <div class="legend1">
            <table class="table tableg1 tablelegend mt-4">
                <thead>
                    <tr>
                        <th scope="col">Mois</th>
                        <th scope="col">Employe</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="legendtbody">
                  

                </tbody>
                
            </table>
        </div>
        <div class="chartCard">
            <div class="chartBox">
                <canvas id="myChart"></canvas>
            </div>
        </div>

    </div>
    <div class="PonctualitePersMens">
		<div>
			<h2 class="titrePonctperMens"><span id="emp_moy">-- Note de probabilité journalière mensuelle --</span></h2>
		</div>
		<div class="input_selectJourna">

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

            <div class="champPonctualiteJournaliere" id="champ_emp_Proba_Journa">
                <select name="name_annee_prob_jour_mens" id="id_annee_prob_jour_mens" >
                    <option value="" >--Année--</option>
                    @foreach ($anneesProbJournMens as $anneeProbJournMens)
                    <option value="{{$anneeProbJournMens->annee}}" >{{$anneeProbJournMens->annee}}</option>
                    @endforeach
                </select>
            </div>

		</div>
	</div>
    <div class="tabBord3">
        <div class="legend3">
            <table class="table tableg3 tablelegend3 mt-4">
                <thead>
                    <tr>
                        <th scope="col">Mois</th>
                        <th scope="col">Employe</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="legendtbody3">
                  

                </tbody>
                
            </table>
        </div>
        <div class="chartCard">
            <div class="chartBox">
                <canvas id="myChart3"></canvas>
            </div>
        </div>

    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.0.0/chartjs-plugin-datalabels.min.js" integrity="sha512-R/QOHLpV1Ggq22vfDAWYOaMd5RopHrJNMxi8/lJu8Oihwi4Ho4BRFeiMiCefn9rasajKjnx9/fTQ/xkWnkDACg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
    $(document).ready(function(){
            //document.getElementById(prix).disabled = true;
        
        $(document).on('change','#annee_prob_presence',function(){
            // console.log("hmm its change");
        
                var annee=$(this).val();
                    //console.log(employe_id);
        
                // console.log(div);
                var div=$('.tableg1').parent();
                var op=" ";
        
                
            $.ajax({
                    type:'get',
                    url:'{!!URL::to('RH/TableauBordAideDecision/findChart1')!!}',
                    data:{'annee':annee	},
        
                    success:function(data){
                        console.log('success');
                        var data1=data.data1;
                        var data2=data.data2 ;
                        var data3=data.data3;
                        var data4=data.data4;
                        var data5=data.data5;
                        var mois=data.mois;
                        var nomEmp=data.nomEmp;
                        var employenom=data.employenom;
                        var mentions=data.mentions;
                        var mentionExcellents=data.mentionExcellents;
                        var mentionBons=data.mentionBons;
                        var mentionMoyens=data.mentionMoyens;
                        var mentionFaibles=data.mentionFaibles;
                        var mentionMediocres=data.mentionMediocres;
                        var mois;
                    for(var i=0;i<mois.length;i++){
                        if(mois[i].mois == 1)
                            {
                                mois_string="Janvier";
                            }
                        else if(mois[i].mois == 2)
                        {
                            mois_string="Février";

                        }
                        else if(mois[i].mois == 3)
                        {
                            mois_string="Mars";

                        }
                        else if(mois[i].mois == 4)
                        {
                            mois_string="Avril";

                        }
                        else if(mois[i].mois == 5)
                        {
                            mois_string="Mai";

                        }
                        else if(mois[i].mois == 6)
                        {
                            mois_string="Juin";

                        }
                        else if(mois[i].mois == 7)
                        {
                            mois_string="Juillet";

                        }
                        else if(mois[i].mois == 8)
                        {
                            mois_string="Aout";

                        }
                        else if(mois[i].mois == 9)
                        {
                            mois_string="Septembre";

                        }
                        else if(mois[i].mois == 10)
                        {
                            mois_string="Octobre";

                        }
                        else if(mois[i].mois == 11)
                        {
                            mois_string="Novembre";

                        }
                        else if(mois[i].mois == 12)
                        {
                            mois_string="Décembre";

                        }
                        var employe=" ";
                        for(var j=0;j<nomEmp.length;j++){

                            for(var k=0;k<employenom.length;k++){
                                    
                                if (nomEmp[j].mois == mois[i].mois && employenom[k].id == nomEmp[j].id_emp)
                                {
                                    employe += employenom[k].prenom_emp+' '+employenom[k].nom_emp+'<br>';
                                    console.log(employe);

                                }
                            }
                        }
                        var label="";
                        for(var l=0;l<mentionExcellents.length;l++){
                            if (mois[i].mois == mentionExcellents[l].mois)
                            {
                                label+='<label id="excellent"><i class="fas fa-circle"></i></label><br>';

                            }
                        }
                        for(var m=0;m<mentionBons.length;m++){
                            if (mois[i].mois == mentionBons[m].mois)
                            {
                                label+='<label id="bon"><i class="fas fa-circle"></i></label><br>';

                            }
                        }
                        for(var n=0;n<mentionMoyens.length;n++){
                            if (mois[i].mois == mentionMoyens[n].mois)
                            {
                                label+='<label id="moyen"><i class="fas fa-circle"></i></label><br>';

                            }
                        }
                        for(var o=0;o<mentionFaibles.length;o++){
                            if (mois[i].mois == mentionFaibles[o].mois)
                            {
                                label+='<label id="faible"><i class="fas fa-circle"></i></label><br>';

                            }
                        }
                        for(var p=0;p<mentionMediocres.length;p++){
                            if (mois[i].mois == mentionMediocres[p].mois)
                            {
                                label+='<label id="mediocre"><i class="fas fa-circle"></i></label><br>';
                            }
                        }
                            console.log(mois[i].mois)
                        op+='<tr>'+
                        '<td scope="col">'+
                            '<span>'+mois_string+'<span>'+
                        '</td>'+
                        '<td scope="col">'+
                            '<span>'+employe+'<span>'+
                        '</td>'+
                        '<td scope="col">'+
                            label
                        +'</td>'+
                        
                       
                        

                    '</tr>';
                    div.find('.legendtbody').html(" ");
			        div.find('.legendtbody').append(op);
                    }
				

                    // config 
                    const config = {
                        type: 'bar',
                        data:{
                        labels: ['Jan','Feb','Mar','Avr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
                        datasets: [{
                            label: 'Excelent',
                            data: data1,
                            backgroundColor: 'rgba(255, 26, 104, 1)',

                            borderColor: 'rgba(255, 26, 104, 1)',

                            borderWidth: 1
                        }, {
                            label: 'Bon',
                            data: data2,
                            backgroundColor: 'rgba(100, 0, 100, 1)',

                            borderColor:

                                'rgba(100, 0, 100, 1)',

                            borderWidth: 1
                        }, 
                        {
                            label: 'Moyen',
                            data:data3,
                            backgroundColor: 'rgba(250, 192, 192,1)',

                            borderColor:

                                'rgba(250, 192, 192, 1)',

                            borderWidth: 1
                        },
                        {
                            label: 'Faible',
                            data:data4,
                            backgroundColor: 'rgba(75, 192, 20,1)',

                            borderColor:

                                'rgba(75, 192,20, 1)',

                            borderWidth: 1
                        },
                        {
                            label: 'Mediocre',
                            data:data5,
                            backgroundColor: 'rgba(58, 89, 192, 1)',

                            borderColor:

                                'rgba(58, 89, 192, 1)',

                            borderWidth: 1
                        }
                    ]
                    },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero:true
                                    },
                                    scaleLabel: {
                                        display: true,
                                        labelString: 'Pourcentage des opérateurs'
                                    },
                                    
                                    afterTickToLabelConversion : function(q){
                                        for(var tick in q.ticks){
                                            q.ticks[tick] += '%';
                                        }
                                    }
                                }],
                                xAxes: [{
                                    
                                    scaleLabel: {
                                        display: true,
                                        labelString: 'Mois'
                                    }
                                }]
                        

                            }
                            
                        }
                    };

                    // render init block
                    const myChart = new Chart(
                        document.getElementById('myChart'),
                        config
                    );
                    },
			        error:function(){

			        }
		    });
	    });


















        $(document).on('change','#id_annee_ponct_mens',function(){
            // console.log("hmm its change");
        
                var annee=$(this).val();
                    //console.log(employe_id);
        
                // console.log(div);
                var div=$('.tableg2').parent();
                var op=" ";
        
                
            $.ajax({
                    type:'get',
                    url:'{!!URL::to('RH/TableauBordAideDecision/findChart2')!!}',
                    data:{'annee':annee	},
        
                    success:function(data){
                        console.log('success');
                        var data1=data.data1;
                        var data2=data.data2 ;
                        var data3=data.data3;
                        var data4=data.data4;
                        var data5=data.data5;
                        var mois=data.mois;
                        var nomEmp=data.nomEmp;
                        var employenom=data.employenom;
                        var mentions=data.mentions;
                        var mentionExcellents=data.mentionExcellents;
                        var mentionBons=data.mentionBons;
                        var mentionMoyens=data.mentionMoyens;
                        var mentionFaibles=data.mentionFaibles;
                        var mentionMediocres=data.mentionMediocres;
                        var mois;
                    for(var i=0;i<mois.length;i++){
                        if(mois[i].mois == 1)
                            {
                                mois_string="Janvier";
                            }
                        else if(mois[i].mois == 2)
                        {
                            mois_string="Février";

                        }
                        else if(mois[i].mois == 3)
                        {
                            mois_string="Mars";

                        }
                        else if(mois[i].mois == 4)
                        {
                            mois_string="Avril";

                        }
                        else if(mois[i].mois == 5)
                        {
                            mois_string="Mai";

                        }
                        else if(mois[i].mois == 6)
                        {
                            mois_string="Juin";

                        }
                        else if(mois[i].mois == 7)
                        {
                            mois_string="Juillet";

                        }
                        else if(mois[i].mois == 8)
                        {
                            mois_string="Aout";

                        }
                        else if(mois[i].mois == 9)
                        {
                            mois_string="Septembre";

                        }
                        else if(mois[i].mois == 10)
                        {
                            mois_string="Octobre";

                        }
                        else if(mois[i].mois == 11)
                        {
                            mois_string="Novembre";

                        }
                        else if(mois[i].mois == 12)
                        {
                            mois_string="Décembre";

                        }
                        var employe=" ";
                        for(var j=0;j<nomEmp.length;j++){

                            for(var k=0;k<employenom.length;k++){
                                    
                                if (nomEmp[j].mois == mois[i].mois && employenom[k].id == nomEmp[j].id_emp)
                                {
                                    employe += employenom[k].prenom_emp+' '+employenom[k].nom_emp+'<br>';
                                    console.log(employe);

                                }
                            }
                        }
                        var label="";
                        for(var l=0;l<mentionExcellents.length;l++){
                            if (mois[i].mois == mentionExcellents[l].mois)
                            {
                                label+='<label id="excellent"><i class="fas fa-circle"></i></label><br>';

                            }
                        }
                        for(var m=0;m<mentionBons.length;m++){
                            if (mois[i].mois == mentionBons[m].mois)
                            {
                                label+='<label id="bon"><i class="fas fa-circle"></i></label><br>';

                            }
                        }
                        for(var n=0;n<mentionMoyens.length;n++){
                            if (mois[i].mois == mentionMoyens[n].mois)
                            {
                                label+='<label id="moyen"><i class="fas fa-circle"></i></label><br>';

                            }
                        }
                        for(var o=0;o<mentionFaibles.length;o++){
                            if (mois[i].mois == mentionFaibles[o].mois)
                            {
                                label+='<label id="faible"><i class="fas fa-circle"></i></label><br>';

                            }
                        }
                        for(var p=0;p<mentionMediocres.length;p++){
                            if (mois[i].mois == mentionMediocres[p].mois)
                            {
                                label+='<label id="mediocre"><i class="fas fa-circle"></i></label><br>';
                            }
                        }
                            console.log(mois[i].mois)
                        op+='<tr>'+
                        '<td scope="col">'+
                            '<span>'+mois_string+'<span>'+
                        '</td>'+
                        '<td scope="col">'+
                            '<span>'+employe+'<span>'+
                        '</td>'+
                        '<td scope="col">'+
                            label
                        +'</td>'+
                        
                       
                        

                    '</tr>';
                    div.find('.legendtbody2').html(" ");
			        div.find('.legendtbody2').append(op);
                    }
				

                    // config 
                    const config = {
                        type: 'bar',
                        data:{
                        labels: ['Jan','Feb','Mar','Avr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
                        datasets: [{
                            label: 'Excelent',
                            data: data1,
                            backgroundColor: 'rgba(255, 26, 104, 1)',

                            borderColor: 'rgba(255, 26, 104, 1)',

                            borderWidth: 1
                        }, {
                            label: 'Bon',
                            data: data2,
                            backgroundColor: 'rgba(100, 0, 100, 1)',

                            borderColor:

                                'rgba(100, 0, 100, 1)',

                            borderWidth: 1
                        }, 
                        {
                            label: 'Moyen',
                            data:data3,
                            backgroundColor: 'rgba(250, 192, 192,1)',

                            borderColor:

                                'rgba(250, 192, 192, 1)',

                            borderWidth: 1
                        },
                        {
                            label: 'Faible',
                            data:data4,
                            backgroundColor: 'rgba(75, 192, 20,1)',

                            borderColor:

                                'rgba(75, 192,20, 1)',

                            borderWidth: 1
                        },
                        {
                            label: 'Mediocre',
                            data:data5,
                            backgroundColor: 'rgba(58, 89, 192, 1)',

                            borderColor:

                                'rgba(58, 89, 192, 1)',

                            borderWidth: 1
                        }
                    ]
                    },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero:true
                                    },
                                    scaleLabel: {
                                        display: true,
                                        labelString: 'Pourcentage des opérateurs'
                                    },
                                    
                                    afterTickToLabelConversion : function(q){
                                        for(var tick in q.ticks){
                                            q.ticks[tick] += '%';
                                        }
                                    }
                                }],
                                xAxes: [{
                                    
                                    scaleLabel: {
                                        display: true,
                                        labelString: 'Mois'
                                    }
                                }]
                        

                            }
                            
                        }
                    };

                    // render init block
                    const myChart = new Chart(
                        document.getElementById('myChart2'),
                        config
                    );
                    },
			        error:function(){

			        }
		    });
	    });






















        $(document).on('change','#id_annee_prob_jour_mens',function(){
            // console.log("hmm its change");
        
                var annee=$(this).val();
        
                var mois=$("#id_mois_Proba_Journa").val();
                console.log(mois);
               
                var div=$('.tableg3').parent();
                 // console.log(div);
                var op=" ";
        
                
            $.ajax({
                    type:'get',
                    url:'{!!URL::to('RH/TableauBordAideDecision/findChart3')!!}',
                    data:{'annee':annee,	
                          'mois':mois},
        
                    success:function(data){
                        console.log('success');
                        var data1=data.data1;
                        var data2=data.data2 ;
                        var data3=data.data3;
                        var data4=data.data4;
                        var data5=data.data5;
                        var jour=data.jour;
                        var nomEmp=data.nomEmp;
                        var employenom=data.employenom;
                        var mentions=data.mentions;
                        var mentionExcellents=data.mentionExcellents;
                        var mentionBons=data.mentionBons;
                        var mentionMoyens=data.mentionMoyens;
                        var mentionFaibles=data.mentionFaibles;
                        var mentionMediocres=data.mentionMediocres;
                     
                        console.log(jour);
                    for(var i=0;i<jour.length;i++){
                        console.log(jour[i].numj);
                        if(jour[i].numj == 1)
                            {
                                jour_string="Lundi";
                            }
                        else if(jour[i].numj == 2)
                        {
                            jour_string="Mardi";

                        }
                        else if(jour[i].numj == 3)
                        {
                            jour_string="Mercredi";

                        }
                        else if(jour[i].numj == 4)
                        {
                            jour_string="Jeudi";

                        }
                        else if(jour[i].numj == 5)
                        {
                            jour_string="Vendredi";

                        }
                        else if(jour[i].numj == 6)
                        {
                            jour_string="Samedi";

                        }
                        else if(jour[i].numj == 7)
                        {
                            jour_string="Dimanche";

                        }
                        
                        var employe=" ";
                        for(var j=0;j<nomEmp.length;j++){

                            for(var k=0;k<employenom.length;k++){
                                    
                                if (nomEmp[j].numj == jour[i].numj && employenom[k].id == nomEmp[j].id_emp)
                                {
                                    employe += employenom[k].prenom_emp+' '+employenom[k].nom_emp+'<br>';
                                    console.log(employe);

                                }
                            }
                        }
                        var label="";
                        for(var l=0;l<mentionExcellents.length;l++){
                            if (jour[i].numj == mentionExcellents[l].numj)
                            {
                                label+='<label id="excellent"><i class="fas fa-circle"></i></label><br>';

                            }
                        }
                        for(var m=0;m<mentionBons.length;m++){
                            if (jour[i].numj == mentionBons[m].numj)
                            {
                                label+='<label id="bon"><i class="fas fa-circle"></i></label><br>';

                            }
                        }
                        for(var n=0;n<mentionMoyens.length;n++){
                            if (jour[i].numj == mentionMoyens[n].numj)
                            {
                                label+='<label id="moyen"><i class="fas fa-circle"></i></label><br>';

                            }
                        }
                        for(var o=0;o<mentionFaibles.length;o++){
                            if (jour[i].numj == mentionFaibles[o].numj)
                            {
                                label+='<label id="faible"><i class="fas fa-circle"></i></label><br>';

                            }
                        }
                        for(var p=0;p<mentionMediocres.length;p++){
                            if (jour[i].numj == mentionMediocres[p].numj)
                            {
                                label+='<label id="mediocre"><i class="fas fa-circle"></i></label><br>';
                            }
                        }
                            console.log(jour[i].numj)
                        op+='<tr>'+
                        '<td scope="col">'+
                            '<span>'+jour_string+'<span>'+
                        '</td>'+
                        '<td scope="col">'+
                            '<span>'+employe+'<span>'+
                        '</td>'+
                        '<td scope="col">'+
                            label
                        +'</td>'+
                        
                       
                        

                    '</tr>';
                    div.find('.legendtbody3').html(" ");
			        div.find('.legendtbody3').append(op);
                    }
				

                    // config 
                    const config = {
                        type: 'bar',
                        data:{
                        labels: ['Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche'],
                        datasets: [{
                            label: 'Excelent',
                            data: data1,
                            backgroundColor: 'rgba(255, 26, 104, 1)',

                            borderColor: 'rgba(255, 26, 104, 1)',

                            borderWidth: 1
                        }, {
                            label: 'Bon',
                            data: data2,
                            backgroundColor: 'rgba(100, 0, 100, 1)',

                            borderColor:

                                'rgba(100, 0, 100, 1)',

                            borderWidth: 1
                        }, 
                        {
                            label: 'Moyen',
                            data:data3,
                            backgroundColor: 'rgba(250, 192, 192,1)',

                            borderColor:

                                'rgba(250, 192, 192, 1)',

                            borderWidth: 1
                        },
                        {
                            label: 'Faible',
                            data:data4,
                            backgroundColor: 'rgba(75, 192, 20,1)',

                            borderColor:

                                'rgba(75, 192,20, 1)',

                            borderWidth: 1
                        },
                        {
                            label: 'Mediocre',
                            data:data5,
                            backgroundColor: 'rgba(58, 89, 192, 1)',

                            borderColor:

                                'rgba(58, 89, 192, 1)',

                            borderWidth: 1
                        }
                    ]
                    },
                        options: {
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero:true
                                    },
                                    scaleLabel: {
                                        display: true,
                                        labelString: 'Pourcentage des opérateurs'
                                    },
                                    
                                    afterTickToLabelConversion : function(q){
                                        for(var tick in q.ticks){
                                            q.ticks[tick] += '%';
                                        }
                                    }
                                }],
                                xAxes: [{
                                    
                                    scaleLabel: {
                                        display: true,
                                        labelString: 'Jour'
                                    }
                                }]
                        

                            }
                            
                        }
                    };

                    // render init block
                    const myChart = new Chart(
                        document.getElementById('myChart3'),
                        config
                    );
                    },
			        error:function(){

			        }
		    });
	    });
    });
</script>    
<script>
    
</script>

</div>
@endsection