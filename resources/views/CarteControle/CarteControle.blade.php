@extends("layouts.Navbar_Sidebar")
@section("contenu")

<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
<link rel="stylesheet" href="{{asset('css/CarteControle/CarteControle.css')}}"/>

<div class="container" id="carteCont">
    <form action="{{route('CarteControle.store')}}" method="post">
        @csrf
    <div class="titre">
        @include('sweetalert::alert') 
        <h3 class="mb-4"><b>Carte de contrôle Moyenne/Etendue</b></h3>
    </div>
    <div class="info">
        <div class="line">
            <div class="col">
                <div class="titre mt-2">
                    <h6>Ref OTM</h6>
                </div>
                <div class="champ">
                    <select id="IDOTMV" name="IDOTMV">
                        <option value="">-- choisir une ordre de travail de mesure  --</option>
                        @foreach ($OTMVs as $OTMV )
                        <option value="{{$OTMV->IDOTMesureValide}}">{{$OTMV->IDOTMesureValide}}</option>                                
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="titre mt-2">
                    <h6>Parametre</h6>
                </div>
                <div class="champ">
                    <select name="Parametre"  id="parametre" onchange="updateLabel(this)">
                        <option value=""></option>
                    </select>                         
                </div>
            </div>
        </div> 
    </div>
    <div class="moyenne_etendut">
        <div class="form">
            <div class="line">
                <div class="col">
                    <div class="titre mt-2">
                        <h6>Opérateur :</h6>
                    </div>
                    <div class="champ">
                        <select name="IDOperateurCalcul" id="IDOperateurCalcul">
                            <option value="">-- Choisir un opérateur --</option>
                            @foreach ($ops as $op )
                            <option value="{{$op->id}}">{{$op->employe->prenom_emp}} {{$op->employe->nom_emp}}</option>                                    
                            @endforeach
                        </select>                             
                    </div>
                </div>
            </div>
            <div class="line">
                <div class="col">
                    <div class="titre mt-2">
                        <h6>Tolérance supérieure :</h6>
                    </div>
                    <div class="champ">
                        <input type="text" id="Tolsup" name="Limite_Sup">
                    </div>
                </div>
                <div class="col">
                    <div class="titre mt-2">
                        <h6>Tolérance inférieure :</h6>
                    </div>
                    <div class="champ">
                        <input id="Tolinf" type="text" name="Limite_Inf">
                    </div>
                </div>
            </div>
            <div class="line">
                <div class="col">
                    <div class="titre mt-2">
                        <h6>A2 :</h6>
                    </div>
                    <div class="champ">
                        <input type="text" id="Aaa" name="CoefA2">
                    </div>
                </div>
                <div class="col">
                    <div class="titre mt-2">
                        <h6>D4 :</h6>
                    </div>
                    <div class="champ">
                        <input id="Ddd" type="text" name="CoefD4">
                    </div>
                </div>
            </div>
            <div class="line">
                <div class="col">
                    <div class="titre mt-2">
                        <h6>N° de lot :</h6>
                    </div>
                    <div class="champ">
                     <input type="text" id="lot">                          
                    </div>
                </div>
                <div class="col">
                    <div class="titre mt-2">
                        <h6>mésure(s):</h6>
                    </div>
                    <div class="champ">
                        <div class="input-group" id="inp"style="width: 340px;">
                            <a class="input-group-text" onclick="moyenne(this)"><i class="bi bi-arrow-right"></i></a>                            
                        </div>
                    </div>
                </div>
            </div>                
        </div>
        <div class="chartCard">
            <div class="chartBox">
              <canvas id="myChart"></canvas>
            </div>
        </div>
        <div class="chartCard mt-3">
            <div class="chartBox">
                <canvas id="myChart2"></canvas>
            </div>
        </div>
        <div class="tablemesure mb-4 ">
            <div class="line">
                <div class="col">
                    <div class="titre mt-2">
                        <h6>Tableau de mesure</h6>
                    </div>
                    <div class="champ1">
                    </div>
                </div>
            </div>
            <div class="scroller">
            <table class="tab table table-bordered border-dark table-hover" id="table">
                <tr>
                    <th rowspan="2">Date</th>
                    <th rowspan="2">Heure</th>
                    <th rowspan="2">Opérateur</th>
                    <th colspan="" id="mesureXI">Xi</th>
                    <th rowspan="2">X barre</th>
                    <th rowspan="2">R</th>
                    <th rowspan="2">X Double Barre</th>
                    <th rowspan="2">R Barre</th>
                    <th rowspan="2">N° de lot</th>
                    <th rowspan="2" width='150px'>Action</th>
                </tr>
                <tr id="XI">
          
                </tr>
            </table>
        </div>
        </div>
    </div> 
    <div class="boutons mt-5 mb-4">
        <button type="submit" role="button" id="titleadd" class="btn" data-toggle="modal"><i class="bi bi-plus-circle-fill"></i><span> Enregistrer </span></button>
        <a href="#"id="titledelete" class="btn " data-toggle="modal"><i class="bi bi-dash-circle-fill"></i><span> Annuler</span></a>
    </div>
</form> 
   
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>

<script type="text/javascript">
        $(document).on('change','#IDOTMV',function()
        {
			var IDOTMV=$(this).val();
		    console.log(IDOTMV);
			var div=$(this).parent().parent().parent();
            var div1=$(this).parent().parent().parent().parent().parent();
			var op=" ";
			$.ajax(
                { 
            
				type:'get',
				url:'{{route("findparametremesure")}}',
              
				data:{'id':IDOTMV},
                dataType:"json",
				success:function(data)
                {
					console.log(data.length);
                    
					op+='<option value="" selected disabled>-- choisir un parametre --</option>';
					for(var i=0;i<data.length;i++)
                    {
                        op+='<option value="'+data[i].DesParametreMesure+'">'+data[i].DesParametreMesure+'</option>';
				    }
				   div.find('#parametre').html(" ");
				   div.find('#parametre').append(op);
               
				},
				error:function()
                {

				}
			});
		});
        /*************************************************************/
        $(document).on('change','#parametre',function()
        {
			var parametre=$(this).val();
            var IDOTMV=$(this).parent().parent().parent().find('#IDOTMV').val();
            var Tolsup=$(this).parent().parent().parent().parent().parent().find('#Tolsup');
            var Tolinf=$(this).parent().parent().parent().parent().parent().find('#Tolinf');
            var heure=$(this).parent().parent().parent().parent().parent().find('#heure')

		    console.log(parametre);
			$.ajax(
                { 
				type:'get',
				url:'{{route("findtol")}}',
              
				data:{'DesParametre':parametre, 'IDOTMV':IDOTMV },
                dataType:"json",
				success:function(data)
                {
					console.log(data.length);
					for(var i=0;i<data.length;i++)
                    {
                        Tolsup.val(data[i].TolérenceSup);
                        Tolinf.val(data[i].TolérenceInf);
                        console.log('tolinf '+data[i].TolérenceInf);
                        console.log('tolsup '+data[i].TolérenceSup);
                        heure.val(data[i].PeriodePrelevement);
                        console.log('tolinf '+data[i].PeriodePrelevement);
				    }
				},
				error:function()
                {

				}
			});
		});
        /****************************************************************/
        $(document).on('change','#IDOTMV',function()
        {
			var IDOTMV=$(this).val();
		    console.log(IDOTMV);
            var div=$(this).parent().parent().parent().parent().parent().parent();
            var div1=$(this).parent().parent().parent().parent().parent().parent();
            var mesure=$(this).parent().parent().parent().parent().parent().parent().find('#mesureXI');
            var tab=" ";
            var inp=" ";
			$.ajax(
                { 
            
				type:'get',
				url:'{{route("findnbrmesure")}}',
              
				data:{'id':IDOTMV},
                dataType:"json",
				success:function(data)
                {
					
					for(var i=0;i<data.length;i++)
                    {   mesure.attr('colspan',data[i].TailleEchantillon);
                       for(var j=1;j<=data[i].TailleEchantillon;j++)
                         {
                             tab+='<td>X'+j+'</td>';  
                             inp+='<input type="text" aria-label="First name" class="form-control moyennes"  name="" id="">';
                                      
                         }
                           
				    }
                   div.find('#XI').html(" ");
                   div.find('#XI').append(tab);
                   div1.find('#inp').prepend(inp);
				},
				error:function()
                {

				}
			});
		});

</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js">   
</script>
<script> 
        var TS = document.getElementById('Tolsup').value;
        var TF = document.getElementById('Tolinf').value; 
        var S=parseFloat(TS);
        var F=parseFloat(TF);
 
    // setup 
    const data = {
      datasets: [{
        label: ' ',
        data: [],
        backgroundColor: 'rgba(255, 26, 104, 0.2)',
        borderColor: 'rgba(255, 26, 104, 1)',
        tension:0,
        pointStyle:'triangle',
        pointRadius: 5,
        pointHoverRadius: 10,
      },
      {
        label: 'TS',
        data: [],
        backgroundColor: 'rgba(54, 162, 235, 0.2)',
        borderColor: 'rgba(54, 162, 235, 1)',
        tension:0,
        pointStyle:'cross',
        pointRadius: 5,
        pointHoverRadius: 10,
      },
      {
        label: 'TI',
        data: [],
        backgroundColor: 'rgba(75, 192, 192, 0.2)',
        borderColor: 'rgba(75, 192, 192, 1)',
        tension:0,
        pointStyle:'cross',
        pointRadius: 5,
        pointHoverRadius: 10,
      },
      {
        label: 'Moyenne X barre',
        data: [],
        backgroundColor: 'rgba(153, 102, 255, 0.2)',
        borderColor: 'rgba(153, 102, 255, 1)',
        tension:0,
        pointStyle: 'star',
        borderDash: [5, 5],
        pointRadius: 5,
      pointHoverRadius: 10,
      },
      {
        label: 'LSC',
        data: [],
        backgroundColor: 'rgba(255, 206, 86, 0.2)',
        borderColor: 'rgba(255, 206, 86, 1)',
        tension:0,
        pointStyle:'crossRot',
        pointRadius: 5,
      pointHoverRadius: 10,
      },
      {
        label: 'LIC',
        data: [],
        backgroundColor: 'rgba(255, 159, 64, 0.2)',
        borderColor: 'rgba(255, 159, 64, 1)',
        tension:0,
        pointStyle:'crossRot',
        pointRadius: 5,
      pointHoverRadius: 10,
      
      },
    {
        label: 'M',
        data: [],
        backgroundColor: 'rgba(88, 214, 141, 0.2)',
        borderColor: 'rgba(88, 214, 141, 1)',
        tension:0,
        borderDash: [5, 5],
        pointStyle:'rectRounded',
        pointRadius: 5,
      pointHoverRadius: 10,
      },
      {
        label: '2/3 LSC',
        data: [],
        backgroundColor: 'rgba(179, 182, 183, 0.2)',
        borderColor: 'rgba(179, 182, 183, 1)',
        tension:0,
        borderDash: [5, 5],
        pointStyle:'rectRot',
        pointRadius: 5,
      pointHoverRadius: 10,
      },
      {
        label: '2/3 LIC',
        data: [],
        backgroundColor: 'rgba(205, 92, 92, 0.2)',
        borderColor: 'rgba(205, 92, 92, 1)',
        tension:0,
        borderDash: [5, 5],
        pointStyle:'rectRot',
        pointRadius: 5,
        pointHoverRadius: 10,
      },
    ]
    };
    // config 
    const config = {
        
      type: 'line',
      data,
      options: {
        responsive: true,
        plugins: {
            title: {
                display: true,
            },
            legend: {
                position:'bottom',
                // align:'start'
            }
            },
        scales: {
          y: {
            // beginAtZero: true
            suggestedMin: F,
            suggestedMax: S
          }
        },
        
    }
};
    // render init block
    var ctx = document.getElementById("myChart").getContext("2d");
        ctx.canvas.width = 300;
        ctx.canvas.height = 150;
    const myChart = new Chart(
      document.getElementById('myChart'),
      config
    );
    //Etendu
    const data2 = {
      datasets: [{
        label: ' ',
        data: [],
        backgroundColor: 'rgba(255, 26, 104, 0.2)',
        borderColor: 'rgba(255, 26, 104, 1)',
        tension:0,
      },
      {
        label: 'R barre',
        data: [],
        backgroundColor: 'rgba(153, 102, 255, 0.2)',
        borderColor: 'rgba(153, 102, 255, 1)',
        tension:0,
        pointStyle:'rectRounded',
        borderDash: [5, 5],
        pointRadius: 5,
        pointHoverRadius: 10,
      },
      {
        label: 'LSCR',
        data: [],
        backgroundColor: 'rgba(255, 206, 86, 0.2)',
        borderColor: 'rgba(255, 206, 86, 1)',
        tension:0,

        pointStyle:'rect',
        pointRadius: 5,
      pointHoverRadius: 10,
      },
      {
        label: 'LICR',
        data: [],
        backgroundColor: 'rgba(255, 159, 64, 0.2)',
        borderColor: 'rgba(255, 159, 64, 1)',
        tension:0,
        pointStyle:'rectRot',
        pointRadius: 5,
      pointHoverRadius: 10,
      },
      {
        label: '1/3 LSCR',
        data: [],
        backgroundColor: 'rgba(41, 128, 185, 0.2)',
        borderColor: 'rgba(41, 128, 185, 1)',
        tension:0,
        borderDash: [5, 5],
        pointStyle:'star',
        pointRadius: 5,
      pointHoverRadius: 10,
      },
      {
        label: '2/3 LSCR',
        data: [],
        backgroundColor: 'rgba(21, 108, 165, 0.2)',
        borderColor: 'rgba(21, 108, 165, 1)',
        tension:0,
        borderDash: [5, 5],
        pointStyle:'star',
        pointRadius: 5,
      pointHoverRadius: 10,
      }
    ]
    };
    // config 
    const config2 = {
        
        type: 'line',
        data: data2,
        options: {
            plugins: {
            title: {
                display: true,
            },
            legend: {
                position:'bottom',
            }
            },
          scales: {
            y: {
              suggestedMin: 0,
            }
          }
        }
      };
  
      // render init block
      var ctx = document.getElementById("myChart2").getContext("2d");
        ctx.canvas.width = 300;
        ctx.canvas.height = 90;
    const myChart2 = new Chart(
      document.getElementById('myChart2'),
      config2
    );
    function updateLabel(parametre)
    {
        myChart.config.data.datasets[0].label ='X barre:'+parametre.value;
        myChart2.config.data.datasets[0].label ='R: '+parametre.value;
        myChart.update();
        myChart2.update();
    }
    /*****************************************/
    
    // var h=0;
    var xbar=0;
    var n=0;
    var Rbar=0;
    function moyenne ()
    {   
        /******************************************/
        var currentHour = new Date().getHours()+':'+new Date().getMinutes();
        var currentDate = new Date().toLocaleDateString();
        /************************************************/
        var rIndex,
        table = document.getElementById("table");
        /************************************/
        var moyennes = document.querySelectorAll('.moyennes');
        var TS = document.getElementById('Tolsup').value;
        var TF = document.getElementById('Tolinf').value;
        var Aaa = document.getElementById('Aaa').value;
        var Daa = document.getElementById('Ddd').value;
        n=parseFloat(n)+1;
        var s=0;
        var max=parseFloat(moyennes[0].value);
        var min=parseFloat(moyennes[0].value);
        console.log('max',max);
        console.log('min',min);
        for(var i of moyennes)
        {
            s+=parseFloat(i.value); 
            if(max<parseFloat(i.value))
            {
                max=parseFloat(i.value);
            }
            if(min>parseFloat(i.value))
            {
                min=parseFloat(i.value);
            }  
        }
        var m=s/moyennes.length;
        xbar=parseFloat(xbar)+parseFloat(m);
        var R=max-min;
        console.log('max',max);
        console.log('min',min);
        var Tolsup=parseFloat(TS);
        var Tolinf=parseFloat(TF);
        var A= parseFloat(Aaa);
        var D= parseFloat(Daa);
        Rbar=parseFloat(Rbar)+R;
        console.log('R',R);
        console.log('n',n);
        console.log('xbar',xbar);
        console.log('xbar/n',xbar/n);
        console.log('Rbar',Rbar);
        console.log('Rbar/n',Rbar/n);
        var limitesup=(xbar/n)+(A*(Rbar/n));
        var limiteinf=xbar/n-(A*(Rbar/n));
        var LimiteSupR=(Rbar/n)*D;
        var LimiteINFR=0;
        var j=parseFloat(-1);
        var newRow = table.insertRow(table.length);          
        var IDOperateurCalcul = document.getElementById("IDOperateurCalcul")
        var text=IDOperateurCalcul.options[IDOperateurCalcul.selectedIndex].text;
        var text2=IDOperateurCalcul.options[IDOperateurCalcul.selectedIndex].value;
        var text1='<input id="tabv2" type="text" value="'+text2+'" name="operateur[]">';
        var lot=document.getElementById('lot').value;
        var lot1='<input id="tabv" type="text" value="'+lot+'" name="lot[]">';
        var R1='<input id="tabv" type="text" value="'+R+'" name="Etendue[]">';
        var m1='<input id="tabv" type="text" value="'+m+'" name="Moyenne[]">';
        var currentHour1='<input id="tabv" type="text" value="'+currentHour+'" name="heure[]">';
        var currentDate1='<input id="tabv1" type="text" value="'+currentDate+'" name="date[]">';
        var bouton =    '<a href="#" class="btn mx-2" id="edit"><i class="bi bi-pen-fill"></i></a>'+
                        '<a href="#" class="btn mx-2" id="delete"><i class="bi bi-trash-fill"></i></a>';
        var Xdbar= xbar/n;       

        var Rdbar= Rbar/n;        
        var Xdbar1='<input id="tabv" type="text" value="'+Xdbar+'" name="Xdbar[]">';
        var Rdbar1='<input id="tabv" type="text" value="'+Rdbar+'" name="Rbar[]">';
                    j = newRow.insertCell(j);
                    j.innerHTML = bouton;
                    j++;
                    j = newRow.insertCell(j);
                    j.innerHTML = lot1;
                    j++;
                    j = newRow.insertCell(j);
                    j.innerHTML = Rdbar1;
                    j++;
                    j = newRow.insertCell(j);
                    j.innerHTML = Xdbar1;
                    j++;
                    j = newRow.insertCell(j);
                    j.innerHTML = R1;
                    j++;
                    j = newRow.insertCell(j);
                    j.innerHTML = m1;
                    j++;
                        for(var k of moyennes)
                        {  
                            (j)= newRow.insertCell(j);
                            k='<input id="tabv" type="text" value="'+k.value+'"name="valeur_mesure[]">';
                            (j).innerHTML = k;
                            j++;
                        }
                    j = newRow.insertCell(j);
                    j.innerHTML = text1 ;
                    j++;
                    j = newRow.insertCell(j);
                    j.innerHTML = currentHour1;
                    j++;
                    j = newRow.insertCell(j);
                    j.innerHTML = currentDate1;
                    MOY=(Tolsup+Tolinf)/2;
        myChart.config.data.datasets[0].data.push(m);
        myChart.config.data.labels.push(currentHour);
        myChart.config.data.datasets[1].data.push(Tolsup);
        myChart.config.data.datasets[6].data.push(MOY);
        myChart.config.data.datasets[2].data.push(Tolinf);
        myChart.config.data.datasets[3].data.push(xbar/n);
        myChart.config.data.datasets[4].data = [limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,
                                                limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,
                                                limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,
                                                limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,
                                                limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,
                                                limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,
                                                limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,
                                                limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,
                                                limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,
                                                limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,
                                                limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,
                                                limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,
                                                limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,
                                                limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,
                                                limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,
                                                limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,
                                                limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,
                                                limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,
                                                limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,
                                                limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,
                                                limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,
                                                limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,
                                                limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,
                                                limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,
                                                limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,
                                                limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,
                                                limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,
                                                limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,
                                                limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,
                                                limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,
                                                limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,
                                                limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,
                                                limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,
                                                limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,
                                                limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,
                                                limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,
                                                limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,
                                                limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,
                                                limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,
                                                limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,
                                                limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,
                                                limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,
                                                limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,
                                                limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,
                                                limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,
                                                limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,
                                                limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,
                                                limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup,limitesup];
        myChart.config.data.datasets[5].data = [limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,
                                                limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,
                                                limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,
                                                limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,
                                                limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,
                                                limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,
                                                limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,
                                                limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,
                                                limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,
                                                limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,
                                                limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,
                                                limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,
                                                limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,
                                                limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,
                                                limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,
                                                limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,
                                                limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,
                                                limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,
                                                limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,
                                                limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,
                                                limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,
                                                limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,
                                                limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,
                                                limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,
                                                limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,
                                                limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,
                                                limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,
                                                limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,
                                                limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,
                                                limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,
                                                limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,
                                                limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,
                                                limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,
                                                limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,
                                                limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,
                                                limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,
                                                limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,
                                                limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,
                                                limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,
                                                limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,
                                                limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,
                                                limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,
                                                limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,
                                                limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,
                                                limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,
                                                limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,
                                                limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,
                                                limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,
                                                limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,
                                                limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,
                                                limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,
                                                limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,
                                                limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,
                                                limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,
                                                limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,
                                                limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf,limiteinf];
            var limitesup1_3=(((limitesup-MOY)/3)*2)+MOY;
            myChart.config.data.datasets[7].data = [limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,
                                                    limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,
                                                    limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,
                                                    limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,
                                                    limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,
                                                    limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,
                                                    limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,
                                                    limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,
                                                    limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,
                                                    limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,
                                                    limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,
                                                    limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,
                                                    limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,
                                                    limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,
                                                    limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,
                                                    limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,
                                                    limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,
                                                    limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,
                                                    limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,
                                                    limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,
                                                    limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,
                                                    limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,
                                                    limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,
                                                    limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,
                                                    limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,
                                                    limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,
                                                    limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,
                                                    limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,
                                                    limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,
                                                    limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,
                                                    limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,
                                                    limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,
                                                    limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,
                                                    limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,
                                                    limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,
                                                    limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,
                                                    limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,
                                                    limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,
                                                    limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,
                                                    limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,
                                                    limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,
                                                    limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,
                                                    limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,
                                                    limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,
                                                    limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,limitesup1_3,];
            var limiteinf1_3= MOY-(((MOY-limiteinf)/3)*2);
            myChart.config.data.datasets[8].data = [limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,
                                                    limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,
                                                    limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,
                                                    limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,
                                                    limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,
                                                    limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,
                                                    limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,
                                                    limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,
                                                    limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,
                                                    limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,
                                                    limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,
                                                    limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,
                                                    limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,
                                                    limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,
                                                    limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,
                                                    limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,
                                                    limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,
                                                    limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,
                                                    limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,
                                                    limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,
                                                    limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,
                                                    limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,
                                                    limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,
                                                    limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,
                                                    limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,
                                                    limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,
                                                    limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,
                                                    limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,
                                                    limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,
                                                    limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,
                                                    limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,
                                                    limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,
                                                    limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,
                                                    limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,
                                                    limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,
                                                    limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,limiteinf1_3,];
        /*****chart 2******/
        myChart2.config.data.datasets[0].data.push(R);
        myChart2.config.data.datasets[1].data.push(Rbar/n);
        myChart2.config.data.datasets[2].data=[LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,
                                                LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,LimiteSupR,];
        myChart2.config.data.datasets[3].data.push(LimiteINFR);
        myChart2.config.data.labels.push(currentHour);
        var limitesupR1_3=(LimiteSupR/3);
        myChart2.config.data.datasets[4].data=[limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,
                                                limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,
                                                limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,
                                                limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,
                                                limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,
                                                limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,
                                                limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,
                                                limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,
                                                limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,
                                                limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,
                                                limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,
                                                limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,
                                                limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,
                                                limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,
                                                limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,
                                                limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,
                                                limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,
                                                limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,
                                                limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,
                                                limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,
                                                limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,
                                                limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,
                                                limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,
                                                limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,
                                                limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,
                                                limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,
                                                limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,
                                                limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,
                                                limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,
                                                limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,
                                                limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,
                                                limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,
                                                limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,
                                                limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,
                                                limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,
                                                limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,
                                                limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,
                                                limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,
                                                limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,
                                                limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,
                                                limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,
                                                limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,
                                                limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,
                                                limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,
                                                limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,
                                                limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,
                                                limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,
                                                limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,
                                                limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,
                                                limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,
                                                limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,
                                                limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,
                                                limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,
                                                limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,
                                                limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,
                                                limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,
                                                limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,limitesupR1_3,];
        var limitesupR2_3=(LimiteSupR/3)*2;
        myChart2.config.data.datasets[5].data=[limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,
                                                limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,limitesupR2_3,];                                   

        myChart.update();
        myChart2.update();
    /********************************gestion d'alerte**********************/
/*******************************carte de moyenne****************/
    /************************point hors limite**********************/
        if(parseFloat(m)>limitesup)
        {   var mp3_url = 'https://media.geeksforgeeks.org/wp-content/uploads/20190531135120/beep.mp3';
            (new Audio(mp3_url)).play();
            if(parseFloat(m)>Tolsup){
                console.log('cas1');
                swal({
                    title:"Carte moyenne: Point hors tolérance",
                    text:"Le dernier point tracé: "+m+" à franchi la limite de contrôle supérieure et la tolérance supérieure. Vous devez vérifier tout le lot fabriqué. Et Régler le procédé. essayez après le réglage de minimiser la période de prélèvement de l'échantillon : période teste doit être inférieur à 5 minutes",
                    icon:"warning",
                    buttons: ["Ok", "Lien vers fiche de contrôle total"],
                });
            }
            else{
                console.log('cas2');
                swal({
                    title:"Carte moyenne: Point hors limite",
                    text:"Le dernier point tracé: "+m+" à franchi la limite de contrôle supérieure. Vous devez Régler le procédé. essayez après le réglage de minimiser la période de prélèvement de l'échantillon : période teste doit être inférieur à 5 minutes",
                    icon:"warning",
                });
            }
        }
        if(parseFloat(m)<limiteinf)
        {   var mp3_url = 'https://media.geeksforgeeks.org/wp-content/uploads/20190531135120/beep.mp3';
            (new Audio(mp3_url)).play();
            if(parseFloat(m)<Tolinf){
                console.log('cas3');
                swal({
                    title:"Carte moyenne: Point hors tolérance",
                    text:"Le dernier point tracé: "+m+" à franchi la limite de contrôle Inférieur et la tolérance Inférieur. Vous devez vérifier tout le lot fabriqué. Et Régler le procédé. essayez après le réglage de minimiser la période de prélèvement de l'échantillon : période teste doit être inférieur à 5 minutes",
                    icon:"warning",
                    buttons: ["Ok", "Lien vers fiche de contrôle total"],
                });
            }
            else{
                console.log('cas4');
                swal({
                    title:"Carte moyenne: Point hors limite",
                    text:"Le dernier point tracé: "+m+" à franchi la limite de contrôle Inférieur. Vous devez Régler le procédé. essayez après le réglage de minimiser la période de prélèvement de l'échantillon : période teste doit être inférieur à 5 minutes",
                    icon:"warning",
                });
            }
        }
        /************************1 point proche des limites**********************/
        var g=myChart.config.data.datasets[0].data.length;
        console.log('length',g);
        var gg=parseInt(g);
        var p2=myChart.config.data.datasets[0].data[g-1];
        var p1=myChart.config.data.datasets[0].data[g-2];
        var p3=myChart.config.data.datasets[0].data[g-3];
        var p4=myChart.config.data.datasets[0].data[g-4];
        var p5=myChart.config.data.datasets[0].data[g-5];
        var p6=myChart.config.data.datasets[0].data[g-6];
        var p7=myChart.config.data.datasets[0].data[g-7];
 
        console.log('p1',p1);
        console.log('p2',p2);
        console.log('p3',p3);
        console.log('p4',p4);
        console.log('p5',p5);
        console.log('p6',p6);
        console.log('p7',p7);
        if((p2>limitesup1_3)&&(p2<limitesup)){
            var mp3_url = 'https://media.geeksforgeeks.org/wp-content/uploads/20190531135120/beep.mp3';
            (new Audio(mp3_url)).play();
            console.log('cas5');
            swal({
                title:"Carte moyenne: 1 point proche de la limite supérieure",
                text:"prélevez immédiatement une autre échantillon",
                icon:"warning",
                });
        }
        else if((p2<limiteinf1_3)&&(p2>limiteinf))
        {
            var mp3_url = 'https://media.geeksforgeeks.org/wp-content/uploads/20190531135120/beep.mp3';
                    (new Audio(mp3_url)).play();
                    console.log('cas6');
                swal({
                    title:"Carte moyenne: 1 point proche de la limite inférieure",
                    text:"prélevez immédiatement une autre échantillon",
                    icon:"warning",
                    });
        }
       
        if((p1>limitesup1_3)&&(p1<limitesup))
        {  
            if((p2>limitesup1_3)&&(p2<limitesup))
            {   var mp3_url = 'https://media.geeksforgeeks.org/wp-content/uploads/20190531135120/beep.mp3';
                (new Audio(mp3_url)).play();
                console.log('cas7');
            swal({
                title:"Carte moyenne: Arrêter",
                text:"Les deux derniers points tracés Dépassent le 2/3 de la limite de contrôle Supérieure . Vous devez Régler le procédé. essayez après le réglage de minimiser la période de prélèvement de l'échantillon : période test doit être inférieur à 5 minutes",
                icon:"warning",
            });
            }
        }
        else if((p1<limiteinf1_3)&&(p1>limiteinf))
        {   


            if((p2<limiteinf1_3)&&(p2>limiteinf))
            {   var mp3_url = 'https://media.geeksforgeeks.org/wp-content/uploads/20190531135120/beep.mp3';
                (new Audio(mp3_url)).play();
                console.log('cas8');
            swal({
                title:"Carte moyenne: Arrêter",
                text:"Les deux derniers points tracés Dépassent le 2/3 de la limite de contrôle Inférieure . Vous devez Régler le procédé. essayez après le réglage de minimiser la période de prélèvement de l'échantillon : période test doit être inférieur à 5 minutes",
                icon:"warning",
            });
            }
        }
        /************************tendance supérieure ou inférieure**********************/
        if((p1>MOY)&&(p2>MOY)&&(p3>MOY)&&(p4>MOY)&&(p5>MOY)&&(p6>MOY)&&(p7>MOY))
        {
            var mp3_url = 'https://media.geeksforgeeks.org/wp-content/uploads/20190531135120/beep.mp3';
                (new Audio(mp3_url)).play();
                console.log('cas9');
            swal({
                title:"Carte moyenne: Tendance Supérieure",
                text:"7 points consécutifs sont supérieure à la moyenne. Vous devez Régler le procédé. essayez après le réglage de minimiser la période de prélèvement de l'échantillon : période test doit être inférieur à 5 minutes",
                icon:"warning",
            });
            
        }
        else if((p1<MOY)&&(p2<MOY)&&(p3<MOY)&&(p4<MOY)&&(p5<MOY)&&(p6<MOY)&&(p7<MOY))
        {
            var mp3_url = 'https://media.geeksforgeeks.org/wp-content/uploads/20190531135120/beep.mp3';
                (new Audio(mp3_url)).play();
                console.log('cas10');
            swal({
                title:"Carte moyenne: Tendance Inférieure",
                text:"7 points consécutifs sont inférieur à la moyenne. Vous devez Régler le procédé. essayez après le réglage de minimiser la période de prélèvement de l'échantillon : période test doit être inférieur à 5 minutes",
                icon:"warning",
            });
            
        }
        /************************tendance croissante ou décroissante**********************/
        if(p2>p1 && p1>p3 && p3>p4 && p4>p5 && p5>p6 && p6>p7)
        {
            var mp3_url = 'https://media.geeksforgeeks.org/wp-content/uploads/20190531135120/beep.mp3';
                (new Audio(mp3_url)).play();
                console.log('cas11');
            swal({
                title:"Carte moyenne: Tendance Croissante",
                text:"7 points consécutifs sont en augmentation régulière. Vous devez Régler le procédé. essayez après le réglage de minimiser la période de prélèvement de l'échantillon : période test doit être inférieur à 5 minutes",
                icon:"warning",
                buttons: ["Ok", "Contact de service maintenance"],
            });
            
        }
        else if(p7>p6 && p6>p5 && p5>p4 && p4>p3 && p3>p1 && p1>p2)
        {
            var mp3_url = 'https://media.geeksforgeeks.org/wp-content/uploads/20190531135120/beep.mp3';
                (new Audio(mp3_url)).play();
                console.log('cas12');
            swal({
                title:"Carte moyenne: Tendance Décroissante",
                text:"7 points consécutifs sont en diminution régulière. Vous devez Régler le procédé. essayez après le réglage de minimiser la période de prélèvement de l'échantillon : période test doit être inférieur à 5 minutes",
                icon:"warning",
                buttons: ["Ok", "Contact de service maintenance"],
            });
            
        }
/************************************Carte etendue**************************************/
var gg=myChart2.config.data.datasets[0].data.length;
        console.log('length',gg);
        var gg=parseInt(gg);
        var pp2=myChart2.config.data.datasets[0].data[gg-1];
        var pp1=myChart2.config.data.datasets[0].data[gg-2];
        var pp3=myChart2.config.data.datasets[0].data[gg-3];
        var pp4=myChart2.config.data.datasets[0].data[gg-4];
        var pp5=myChart2.config.data.datasets[0].data[gg-5];
        var pp6=myChart2.config.data.datasets[0].data[gg-6];
        var pp7=myChart2.config.data.datasets[0].data[gg-7];
        console.log('p1',pp1);
        console.log('p2',pp2);
        console.log('p3',pp3);
        console.log('p4',pp4);
        console.log('p5',pp5);
        console.log('p6',pp6);
        console.log('p7',pp7);
        /************************point hort limite**********************/
         if(parseFloat(R)>LimiteSupR)
        {   var mp3_url = 'https://media.geeksforgeeks.org/wp-content/uploads/20190531135120/beep.mp3';
            (new Audio(mp3_url)).play();
                console.log('cas13');
                swal({
                    title:"Carte Etendue: Point hors limite",
                    text:"Le dernier point tracé: "+R+" a franchi la limite de contrôle supérieure. contacté le service de maintenance pour intervenire. Et  Vous devez vérifier tout le lot fabriqué. Essayez après le réglage de minimiser la période de prélèvement de l'échantillon : période test doit être inférieur à 5 minutes",
                    icon:"warning",
                    buttons: ["Ok", "Contact de service maintenance","Lien vers fiche de contrôle total"],
                });
        };
        if(parseFloat(R)<=limitesupR1_3)
        {   var mp3_url = 'https://media.geeksforgeeks.org/wp-content/uploads/20190531135120/beep.mp3';
            (
                new Audio(mp3_url)).play();
                console.log('cas14');
                swal({
                    title:"Carte Etendue: Point hors 1/3 limite",
                    text:"prendre imméditement  un autre échantillon du même lot",
                    icon:"warning",
                });
                if((pp1<=limitesupR1_3)&&(pp2<=limitesupR1_3))
                {   var mp3_url = 'https://media.geeksforgeeks.org/wp-content/uploads/20190531135120/beep.mp3';
                    (new Audio(mp3_url)).play();
                    console.log('cas15');
                    swal({
                        title:"Carte Etendue: Arrêter",
                        text:" Vérifier outil de mesure et méthode de mesure",
                        icon:"warning",
                    });
                };
               
        }
        else if(parseFloat(R)>=limitesupR2_3)
        {   var mp3_url = 'https://media.geeksforgeeks.org/wp-content/uploads/20190531135120/beep.mp3';
            (
                new Audio(mp3_url)).play();
                console.log('cas16');
                swal({
                    title:"Carte Etendue: Point hors 2/3 limite",
                    text:"prendre imméditement  un autre échantillon du même lot",
                    icon:"warning",
                });
                if((pp1>=limitesupR2_3)&&(pp2>=limitesupR2_3))
                {   var mp3_url = 'https://media.geeksforgeeks.org/wp-content/uploads/20190531135120/beep.mp3';
                    (new Audio(mp3_url)).play();
                    console.log('cas17');
                    swal({
                        title:"Carte Etendue: Arrêter",
                        text:" Vérifier outil de mesure et méthode de mesure",
                        icon:"warning",
                    });
                };
               
        };
      
        /************************tendance croissante ou décroissante**********************/
        if(pp2>pp1 && pp1>pp3 && pp3>pp4 && pp4>pp5 && pp5>pp6 && pp6>pp7)
        {
            var mp3_url = 'https://media.geeksforgeeks.org/wp-content/uploads/20190531135120/beep.mp3';
                (new Audio(mp3_url)).play();
                console.log('cas18');
            swal({
                title:"Carte Etendue: Tendance Croissante",
                text:"7 points consécutifs sont en augmentation régulière. Vous devez consulter le service maintenance. essayez après le maintenance de minimiser la période de prélèvement de l'échantillon : période test doit être inférieur à 5 minutes",
                icon:"warning",
                buttons: ["Ok", "Contact de service maintenance"],
            });
        }
        else if(pp7>pp6 && pp6>pp5 && pp5>pp4 && pp4>pp3 && pp3>pp1 && pp1>pp2)
        {
            var mp3_url = 'https://media.geeksforgeeks.org/wp-content/uploads/20190531135120/beep.mp3';
                (new Audio(mp3_url)).play();
                console.log('cas19');
            swal({
                title:"Carte Etendue: Tendance Décroissante",
                text:"7 points consécutifs sont en diminution régulière. Vous devez consulter le service maintenance. essayez après le maintenance de minimiser la période de prélèvement de l'échantillon : période test doit être inférieur à 5 minutes",
                icon:"warning",
                buttons: ["Ok", "Contact de service maintenance"],
            });
            
        }

    }
</script>
@endsection