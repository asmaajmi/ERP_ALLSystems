@extends("navbarsidebarRH")
@section("contenu")
<link rel="stylesheet" href="{{asset('css/pause.css')}}">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<div class="tables">
            <form action="{{route('pause.create')}}" method="post">
            @csrf
                <div class="ajout1">
                   <h2>Ajouter <b><span id="emp">Une Pause</span></h2>
                   <table class="tabpause">
                        <tr class="line">
                        <td class="lestitres">
                        <h3 class="line1">Designation De La Période</h3>
                        <h3 class="line1" id="dtdp">Année</h3>
                        <h3 id="jrs" class="line1">Jour</h3>
                        </td>  
                        </tr>
                        <tr class="line1">
                            <td>
                            <div class="champ">
                                <select name="desperiode" id="selectdesperiode">
                                <option value=" "></option>
								@foreach ($pointagessaeff as $pointageaeff)
								<option value="{{$pointageaeff->designation_periode}}">{{$pointageaeff->designation_periode}}</option>
								@endforeach
							</select>    
                      
                                <select name="dtdebp" class="selectdtdebut">						
							</select>                        
                                                                                                         
                           <select name="desj" id="selectdesj">
                                <option value="0" disabled="true" selected="true">-Jour-</option>	
							</select>
                                </div>
                                </div>
                            </td>
                        </tr>

                        <tr class="line">
                        <td class="lestitrespause">
                        <h3 class="line1">Designation De Pause</h3>
                        <h3 class="line1" id="hdebp">Heure Début De Pause</h3>
                        <h3 class="line1" id="hfinp">Heure Fin De Pause</h3></td>
                        </tr>

                        <tr class="line">
                            <td>
                                <div class="champ1">
                                    <input type="text" name="des_pause[]"> 
                                    <input type="time" name="heuredebutpause[]" class="heures" id="hdp">
                                    <input type="time" name="heurefinpause[]" class="heures" id="hfp">
                                </div>
                            </td>
                        </tr>

                        <tr class="line">
                               <td colspan="2">
                                    <div>
                                        <a href="javascript:;" class="button-22 btnpause">Ajouter Une Autre Pause</a>
                                    </div>
                                </td>
                            </tr> 
                   </table>  
                   <button class="button-82-pushable"  role="button"  id="btnc">
                        <span class="button-82-shadow"></span>
                        <span class="button-82-edgec"></span>
                        <span class="button-82-frontc text ">
                            <span class="fa fa-solid fa-plus"></span>
                         Ajouter
                        </span>
                      </button>

                      <button class="button-82-pushable " role="button"  id="btna">
                        <span class="button-82-shadow"></span>
                        <span class="button-82-edgea"></span>
                        <span class="button-82-fronta text ">
                            <span class="fa fa-solid fa-ban"></span>
                         Annuler
                        </span>
                      </button>
                </div>
            </form>
</div>
<script>
    $(document).ready(function(){
        $(document).on('change','#selectdesperiode',function(){
            console.log("its work good");

            var des_periode=$(this).val();
            // console.log(datedeb_id);
            var div = $(this).parent();
            console.log(div);
            var op=" ";
            $.ajax({
                type:'get',
                url:'{!!URL::to('/RH/pause/dtdeb')!!}',
                data:{'desperiode':des_periode},

                success:function(data){
                    // console.log('success');
                    // console.log(data);
                    // console.log(data.length);
                op+='<option value="0" disabled="true" selected="true">-Année-</option>';
				for(var i=0;i<data.length;i++){
				//console.log(op);
				op+='<option value="'+data[i].id+'">'+data[i].annee+'</option>';}
                console.log(op);
                div.find('.selectdtdebut').html(" ");
			    div.find('.selectdtdebut').append(op);
			},
            });
        });
    
       $(document).on('change','.selectdtdebut',function(){
            console.log("its work good");
            var dtdeb=$(this).val();
            var div = $(this).parent();
            console.log(div);
             var op=" ";
            $.ajax({
               type:'get',
               url:'{!!URL::to('/RH/pause/dtfin')!!}',
               data:{'datedeb':dtdeb},

                success:function(data){
                    // console.log('success');
                  // console.log(data);
                     // console.log(data.length);
               for(var i=0;i<data.length;i++){
				//console.log(op);
				div.find('#datefininput').val(data[i].date_fin_periode);
 			    }
            },
        });
    });

    $(document).on('change','.selectdtdebut',function(){
            console.log("its work good");
            var point_id=$(this).val();
            var div = $('#selectdesj').parent();
            console.log(div);
            var op=" ";
            $.ajax({
                type:'get',
                url:'{!!URL::to('/RH/pause/joursdes')!!}',
                data:{'idpoint':point_id},

                success:function(data){
                    // console.log('success');
                    // console.log(data);
                    // console.log(data.length);
                op+='<option value="0" disabled="true" selected="true">-Jours-</option>';
				for(var i=0;i<data.length;i++){
				console.log(op);
				op+='<option value="'+data[i].id+'">'+data[i].designation_j+'</option>';}
                console.log(op);
                div.find('#selectdesj').html(" ");
			    div.find('#selectdesj').append(op);
			    },
        });
    });

});
</script>
<script>
    $('.ajout1').on('click', '.btnpause', function() {
var tr1 = 
'<tr class="line">'+
                        '<td class="lestitrespause">'+
                        '<h3 class="line1">Designation De Pause</h3>'+
                        '<h3 class="line1" id="hdebp">Heure Début De Pause</h3>'+
                        '<h3 class="line1" id="hfinp">Heure Fin De Pause</h3>'+
                        '</td>'+
                        '</tr>';
                        $('.tabpause').append(tr1);
var tr2 = 
                        '<tr class="line">'+
                            '<td>'+
                                '<div class="champ1">'+
                                   '<input type="text" name="des_pause[]">'+
                                    '<input type="time" name="heuredebutpause[]" class="heures" id="hdp">'+
                                    '<input type="time" name="heurefinpause[]" class="heures" id="hfp">'+
                                '</div>'+
                            '</td>'+
                        '</tr>';
                        $('.tabpause').append(tr2);});
</script>
@endsection