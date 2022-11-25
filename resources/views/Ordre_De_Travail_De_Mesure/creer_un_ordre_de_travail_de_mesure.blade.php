@extends("layouts.Navbar_Sidebar")
@section("contenu")
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
<link rel="stylesheet" href="{{asset('css/ordre de travail de mesure/creer_un_ordre_de_travail_de_mesure.css')}}"/>
{{-- Créer Un Ordre De Travail De Mesure --}}
<div class="container" id="addordretravailmes">
    <form action="{{route('UnOrdreDeTravailDeMesure.Ajouter')}}" method="post">
        @csrf
        <div class="ajout">
            
            <div class="titre">
                <h2 class="mb-4 addordretravailmestitle">Créer<b> Ordre De Travail De Mesure </b></h2>
            </div>
            <div class="info_Generale">
                <div class="line">
                    <div class="col">
                        <div class="titre mt-2">
                            <h6>N° OTM</h6>
                        </div>
                        <div class="champ">
                            <input type="text" name="OTM">
                        </div>
                    </div>
                    <div class="col">
                        <div class="titre mt-2">
                            <h6>Date</h6>
                        </div>
                        <div class="champ">
                            <input type="date" name="date">                            
                        </div>
                    </div>
                </div>  
                <div class="line">
                    <div class="col">
                        <div class="titre mt-2">
                            <h6>Produit à contrôler</h6>
                        </div>
                        <div class="champ">
                            <select name="produit" id="" class="produit">
                                <option value="">-- Choisir un produit --</option>
                                @foreach ($produits as $produit)
                                <option value="{{$produit->DesProduit}}">
                                {{$produit->DesProduit}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="titre mt-2">
                            <h6 id="machineT">Machine</h6>
                        </div>
                        <div class="champ">
                                <select name="IDMachine" class="machine" id='machineS'>
                                    <option value="0" disabled="true" selected="true">-- Choisir une machine--</option>
                                </select>
                        </div>
                    </div>
                </div> 
                <div class="parametre">
                    <div class="line">
                        <div class="col">
                            <div class="titre mt-2">
                                <h6>Type de mesure</h6>
                            </div>
                            <div class="champ">
                                <select name="DesTypeMesure[]" id="" class="typeMesure">
                                    <option value="">-- Choisir un type mesure --</option>
                                    @foreach($type_mesures as $type_mesure)
                                    <option value="{{$type_mesure->DesTypeMesure}}">
                                        {{$type_mesure->DesTypeMesure}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="titre mt-2">
                                <h6>Paramètre a mesuré</h6>
                            </div>
                            <div class="champ">
                                <select name="DesParametreMesure[]" class="parametremesure" id='parametre'>
                                </select>
                            </div>
                        </div>
                    </div> 
                    <div class="line">
                        <div class="col">
                            <div class="titre mt-2">
                                <h6>Précision</h6>
                            </div>
                            <div class="champ">
                                <select name="DesPrecision[]" class="Desprecision">
                                    
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="titre mt-2">
                                <h6>Type Outil</h6>
                            </div>
                            <div class="champ">
                                <select name="DesTypeOutil[]" id="" class="typeoutil">
                                    
                                </select>
                               
                            </div>
                        </div>
                    </div>
                </div>
                <div class="boutonsparametre">
                    <div class="parametrebtn">
                    <a href="javascript:;" class="btnparametre"><i class="bi bi-plus"></i></a>
                        <!-- <a href="#" class=""><i class="bi bi-arrow-bar-down"></i></a> -->
                    </div>
                </div> 
            </div>
            <hr>
            <div class="BV">
                <div class="BVvalide">

                </div>
                
                <div class="methodenonvalide mt-4">
                    <div class="BVNVqualitative">
                
                </div>
                    <div class="BVNVqv">
                    
                    </div>
                </div>
            </div>
            <div class="operateur mt-4">
                <div class="line">
                    <div class="col">
                        <div class="titre mt-2">
                            <h5>Operateur Mesure</h5>
                        </div>
                        <div class="champ">
                            <select name="IDOperateurMesure" id="" calss="operateurMesure">
                                <option>-- Choisir Un Operateur--</option>
                                @foreach($operateurs as $operateur )
                                <option value="{{$operateur->id}}">{{$operateur->employe->nom_emp}} {{$operateur->employe->prenom_emp}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="description">
                    <div class="titre mt-2">
                        <h5>Description</h5>
                    </div>
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name="Description"></textarea>
                        <label for="floatingTextarea2">Comments</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="boutons mt-5 mb-4">
            <button type="submit" role="button" id="titleadd" class="btn" data-toggle="modal"><i class="bi bi-plus-circle-fill"></i><span> Créer </span></button>
            <a href="{{route('ListeDesOrdresDeTravailDeMesure')}}" id="titledelete" class="btn " data-toggle="modal"><i class="bi bi-dash-circle-fill"></i><span> Annuler</span></a>
        </div>
    </form>
</div>
{{-- Créer Un Ordre De Travail De Mesure --}}
<script  src="{{asset('js/ordre de travail de mesure/Creer_Un_Ordre_De_Travail_De_Mesure.js')}}"></script>
<script>
    // ****************************************
    $('.info_Generale').on('click','.btnparametre',function() {
    var line =  '<div>'+
                '<div class="parametre">'+
                   ' <div class="line">'+
                       ' <div class="col">'+
                            '<div class="titre mt-2">'+
                                '<h6>Type de mesure</h6>'+
                            '</div>'+
                           ' <div class="champ">'+
                               ' <select name="DesTypeMesure[]" id="" class="typeMesure">'+
                                    '<option value="">-- Choisir un type mesure --</option>'+
                                   ' @foreach($type_mesures as $type_mesure)'+
                                   ' <option value="{{$type_mesure->DesTypeMesure}}">'+
                                       ' {{$type_mesure->DesTypeMesure}}'+
                                   ' </option>'+
                                   ' @endforeach'+
                               ' </select>'+
                            '</div>'+
                        '</div>'+
                        '<div class="col">'+
                           ' <div class="titre mt-2">'+
                               ' <h6>Paramètre a mesuré</h6>'+
                            '</div>'+
                            '<div class="champ">'+
                                '<select name="DesParametreMesure[]" class="parametremesure" id="parametre">'+
                                '</select>'+
                                '<a href="javascript:;" class="parametredel"><i class="bi bi-dash"></i></a> '+
                            '</div>'+
                        '</div>'+
                   ' </div> '+
                    '<div class="line">'+
                        '<div class="col">'+
                            '<div class="titre mt-2">'+
                                '<h6>Précision</h6>'+
                            '</div>'+
                           ' <div class="champ">'+
                                '<select name="DesPrecision[]" class="Desprecision">'+
                                    
                                '</select>'+
                           ' </div>'+
                        '</div>'+
                        '<div class="col">'+
                            '<div class="titre mt-2">'+
                                '<h6>Type Outil</h6>'+
                            '</div>'+
                            '<div class="champ">'+
                                '<select name="DesTypeOutil[]" id="" class="typeoutil">'+
                                    
                               ' </select>'+
                               
                           ' </div>'+
                       ' </div>'+
                    '</div>'+
               ' </div> '+
               ' </div> ';
      $('.parametre').append(line);
    });

    $('.info_Generale').on('click','.parametredel',function(){
        $(this).parent().parent().parent().parent().remove();
    });

    
</script>
<!-- ******************************************find machine********************************************************************** -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
<script type="text/javascript">
$(document).ready(function()
    {

		$(document).on('change','.produit',function()
        {
			var prod_id=$(this).val();
			var div=$(this).parent().parent().parent();
			var op=" ";
			$.ajax(
                { 
            
				type:'get',
				url:'{{route("find.Machine")}}',
              
				data:{'id':prod_id},
                dataType:"json",
				success:function(data)
                {
                    if(data.length==0)
                    {
                            div.find('#machineS').css('display','none');
                            div.find('#machineT').css('display','none');
                    }
                    else{
                            div.find('#machineS').css('display','block');
                            div.find('#machineT').css('display','block');
                            op+='<option value="" selected disabled>-- Choisir une machine --</option>';
                            for(var i=0;i<data.length;i++)
                            {
                                op+='<option value="'+data[i].IDMachine+'">'+data[i].IDMachine+'</option>';
                            }
                        div.find('.machine').html(" ");
                        div.find('.machine').append(op);
                    }
				},
				error:function()
                {

				}
			});
		});
/**********************************************find parametre************************************************ */ 
        $(document).on('change','.typeMesure',function()
        {
			var type_mesure=$(this).val();
			var div=$(this).parent().parent().parent();
			var op=" ";
			$.ajax(
                { 
            
				type:'get',
				url:'{{route("find.Parametre")}}',
              
				data:{'id':type_mesure},
                dataType:"json",
				success:function(data)
                {
					
					op+='<option value="" selected disabled>-- Choisir un parametre --</option>';
					for(var i=0;i<data.length;i++)
                    {
                        op+='<option value="'+data[i].DesParametreMesure+'">'+data[i].DesParametreMesure+'</option>';
				    }
				   div.find('.parametremesure').html(" ");
				   div.find('.parametremesure').append(op);
				},
				error:function()
                {

				}
			});
		});
        /************************************************************choisir precision************************************************************ */
        $(document).on('change','.parametremesure',function()
        {
			var parametre=$(this).val();
            console.log(parametre);
			var div=$(this).parent().parent().parent().parent();
			var op=" ";
			$.ajax(
                { 
            
				type:'get',
				url:'{{route("find.Precision")}}',
				data:{'id':parametre},
                dataType:"json",
				success:function(data)
                {
                    console.log(data.length);
					op+='<option value="" selected disabled>-- Choisir une précision --</option>';
					for(var i=0;i<data.length;i++)
                    {
                        op+='<option value="'+data[i].DesPrecision+'">'+data[i].DesPrecision+'</option>';
				    }
				   div.find('.Desprecision').html(" ");
				   div.find('.Desprecision').append(op);
				},
				error:function()
                {

				}
			});
		});
/**************************************************************choisir type outil****************************************************** */
        $(document).on('change','.parametremesure',function()
        {
			var parametre=$(this).val();
		     console.log(parametre);
			var div=$(this).parent().parent().parent().parent();
			var op=" ";
			$.ajax(
                { 
            
				type:'get',
				url:'{{route("find.TypeOutil")}}',
              
				data:{'id':parametre},
                dataType:"json",
				success:function(data)
                {
					console.log(data.length);

					op+='<option value="" selected disabled>-- choisir un type outil --</option>';
					for(var i=0;i<data.length;i++)
                    {
                        op+='<option value="'+data[i].DesTypeOutil+'">'+data[i].DesTypeOutil+'</option>';
				    }
				   div.find('.typeoutil').html(" ");
				   div.find('.typeoutil').append(op);
				},
				error:function()
                {

				}
			});
		});


        //*************************************find bon de validation ******************* */

        $(document).on('change','.parametremesure',function()
        {
			var parametre=$(this).val();
		   
			var div=$(this).parent().parent().parent().parent().parent();
            var machine= div.parent().parent().find('.machine').val();
            var typemesure= div.find('.typeMesure').val();
            var produit= div.parent().parent().find('.produit').val();
            var div1= $(this).parent().parent().parent().parent().parent().parent().parent().parent();
           
            console.log(machine);
            console.log(produit);
            var exbv =div1.find(".BV");
            console.log(exbv);
			var op=" ";
			$.ajax(
                { 
            
				type:'get',
				url:'{{route("find.BonValidation")}}',
				data:{'parametre':parametre , 'machine':machine , 'typemesure':typemesure ,'produit':produit},
                dataType:"json",
				success:function(data)
                {
					console.log(data.length);
                    console.log(parametre);
                    console.log('success');
                    if (data.length!=0) {
                       var c=0;
                       var a=1000;
                       var b=9999;
                        for(var i=0;i<data.length;i++) 
                        { console.log(i);
                            /*****************************bon validation valide*******************************************************/
                                 if(data[i].ValidationBonValidation==true)
                                 { c++;
                                     console.log('if1');
                                    op+='<div class="methodevalide mt-4">'+
                                    '<div class="line">'+
                                    '<div class="col mb-4">'+
                                        '<div class="titre mt-2">'+
                                            '<h5>ID Bon De Travail :</h5>'+
                                        '</div>'+
                                        '<div class="champ">'+
                                            '<input type="text" id="IDBVV" name="idmethodevalide[]" value="'+data[i].IDBV+'">'+
                                        '</div>'+
                                    '</div>'+
                                    '</div>'+
                                    '<div class="line">'+
                                        '<div class="col">'+
                                            '<div class="titre">'+
                                                '<h6>Tolérance supérieure</h6>'+
                                            '</div>'+
                                            '<div class="champ">'+
                                                '<input type="number" name="TolérenceSup[]">'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="col">'+
                                            '<div class="titre mt-2">'+
                                                '<h6>Tolérance inférieure</h6>'+
                                            '</div>'+
                                            '<div class="champ">'+
                                                '<input type="number" name="TolérenceInf[]">'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+ 
                                    '<div class="line">'+
                                        '<div class="col">'+
                                            '<div class="titre mt-2">'+
                                                '<h6 id="titre_nbr_p">Nbr prélèvement</h6>'+
                                            '</div>'+
                                            '<div class="champ">'+
                                                '<input type="number" id="champ_nbr_p" name="NbrPrelevement">'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="col">'+
                                        '</div>'+
                                    '</div> '+
                                    '<div class="line">'+
                                        '<div class="col">'+
                                            '<div class="titre mt-2">'+
                                                '<h6>Période prélèvement</h6>'+
                                            '</div>'+
                                            '<div class="champ">'+
                                                '<input type="number" name="PeriodePrelevement[]" id="periodevalide">'+
                                                '<br><span id="alertperiode" class="alertverif">La valeur du Periode Prelevement doit être <= <span id="valperiodebon"></span></span>'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="col">'+
                                            '<div class="titre mt-2">'+
                                                '<h6>Taille d\'échantillons</h6>'+
                                            '</div>'+
                                            '<div class="champ">'+
                                                '<input type="number" name="TailleEchantillon[]" id="taillevalide">'+
                                                '<br><span id="alerttaille" class="alertverif">La valeur du taille echantillon doit être >= <span id="valtaillebon"></span></span>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div> '+
                                '</div>'+
                                '<hr>';    
                            }
                                else{
                                          /*****************************bon validation non valide qualitative*******************************************************/
                                    if(typemesure == 'Qualitative')
                                    {console.log('if2');
                                     a++;
                                        op+='<div class="qualitative">'+
                                            '<div class="line">'+
                                                '<div class="col mb-4">'+
                                                    '<div class="titre mt-2">'+
                                                        '<h5>ID Bon De Travail :</h5>'+
                                                    '</div>'+
                                                    '<div class="champ">'+
                                                        '<input type="text" name="idmethodeNVQ[]" id="IDBVNVQ" value="'+data[i].IDBV+'">'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                            '<div class="line">'+
                                                '<div class="col">'+
                                                    '<div class="titre mt-2">'+
                                                        '<h6 id="Nbr_prélèvementT">Nbr prélèvement</h6>'+
                                                    '</div>'+
                                                    '<div class="champ">'+
                                                        '<input type="number" id="Nbr_prélèvementC" name=NbrPrelevementNVQ[]>'+
                                                    '</div>'+
                                                '</div>'+
                                                '<div class="col">'+
                                                '</div>'+
                                            '</div>'+
                                            '<div class="critere" id="critere">'+
                                                '<div class="line">'+
                                                    '<div class="col">'+
                                                        '<div class="titre mt-2">'+
                                                            '<h6>Critére</h6>'+
                                                        '</div>'+
                                                        '<div class="champ">'+
                                                            '<select name="Critere[]" id="" class="valeurcritere">'+
                                                                '<option value="">--Choisir un critére--</option>'+
                                                                '@foreach($criteres as $critere)'+
                                                                    '<option value="{{$critere->DesParametreMesure}}">{{$critere->DesParametreMesure}}</option>'+
                                                                '@endforeach'+
                                                            '</select>'+
                                                        '</div>'+
                                                    '</div>'+
                                                    '<div class="col">'+
                                                        '<div class="titre mt-2">'+
                                                            '<h6>Testeur</h6>'+
                                                        '</div>'+
                                                        '<div class="champ">'+
                                                            '<select name="Testeur[]" id="" class="testeur">'+
                                                                '<option value="">--Choisir un testeur--</option>'+
                                                                '@foreach($testeurs as $testeur)'+
                                                                    '<option value="{{$testeur->DesTesteur}}">{{$testeur->DesTesteur}}</option>'+
                                                                '@endforeach'+
                                                            '</select>'+
                                                        '</div>'+
                                                    '</div>'+
                                                '</div>'+ 
                                                '<div class="line">'+
                                                    '<div class="col">'+
                                                        '<div class="titre mt-2">'+
                                                            '<h6>Etalon</h6>'+
                                                        '</div>'+
                                                        '<div class="champ">'+
                                                            '<select name="Etalon[]" id="" class="etalon">'+
                                                              
                                                            '</select>'+
                                                        '</div>'+
                                                    '</div>'+
                                                    '<div class="col">'+
                                                        '<div class="titre mt-2">'+
                                                            '<h6>Précision</h6>'+
                                                        '</div>'+
                                                        '<div class="champ">'+
                                                            '<select name="DesPrecisionnv[]" class="Desprecisionnv">'+
                                                            
                                                            '</select>'+
                                                        '</div>'+
                                                    '</div> '+
                                                '</div>'+
                                            '</div>'+
                                            '<div class="boutonsparametre">'+
                                                '<div class="parametrebtn">'+
                                                    '<a href="javascript:;"   class="btncritere"><i class="bi bi-plus"></i></a>'+
                                                '</div>'+
                                            '</div>'+ 
                                        '</div>'+
                                        '<hr> '; 
                                     
                                    }
                                else{
                                    b++;
                                    console.log('if3');
                                    /*****************************bon validation non valide quantitative variable physique******************************************************/
                                    op+= '<div class="quantitativevariablephysique mt-4">'+
                                    '<div class="line">'+
                                '<div class="col mb-4">'+
                                    '<div class="titre mt-2">'+
                                        '<h5>ID Bon De Travail :</h5>'+
                                        '</div>'+
                                        '<div class="champ">'+
                                        '<input type="text" name="idmethodeNVQV[]" id="IDBVNVQV" value="'+data[i].IDBV+'">'+
                                    '</div>'+
                                '</div>'+
                                '</div>'+
                                '<div class="line">'+
                                    '<div class="col">'+
                                        '<div class="titre">'+
                                            '<h6>Tolérance supérieure</h6>'+
                                        '</div>'+
                                        '<div class="champ">'+
                                        '<input type="number" name="TolérenceSupNV[]">'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="col">'+
                                        '<div class="titre mt-2">'+
                                            '<h6>Tolérance inférieure</h6>'+
                                        '</div>'+
                                        '<div class="champ">'+
                                            '<input type="number" name="TolérenceInfNV[]">'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="line mb-4">'+
                                    '<div class="col">'+
                                        '<div class="titre mt-2">'+
                                            '<h6 id="NBRT">Nbr prélèvement</h6>'+
                                        '</div>'+
                                        '<div class="champ">'+
                                            '<input type="number" id="NBRC" name="NbrPrelevementNV[]">'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="col">'+
                                    '</div>'+
                                '</div>'+ 
                            '</div>'+
                            '<hr> ';
                                    
                                 }
                             }
                            
                            
                            
                        }
                     
                        exbv.append(op);
                             console.log('ok');
                     }
                         else
                        {   
                           console.log('hello');  
                           exbv.html(' ');
                        }
                
                    },
                    error:function()
                    {
                        console.log('error');
                    }
			});
		}); 
//***********************************validation de taille de echantillons dans methode valide********************* */

        $(document).on('change','#taillevalide',function()
        {
			var id=$(this).parent().parent().parent().parent().find("#IDBVV").val();
            var tailleValeur= parseFloat($(this).val());
            var tailleDiv=$(this);
            var btn=$(this).parent().parent().parent().parent().parent().parent().parent().parent().find("#titleadd");
            var alert =$(this).parent().find("#alerttaille");
            var val=$(this).parent().find("#valtaillebon");
            console.log(id);
            console.log(tailleValeur);

			$.ajax(
                { 
				type:'get',
				url:'{{route("ordereMesure.TaillePeriode")}}',
				data:{'id':id },
                dataType:"json",
				success:function(data)
                {
                    for(var i=0;i<data.length;i++)
                    {
                     console.log(data.length);
                    var taillebon = parseFloat(data[i].Taille);
                   console.log(taillebon);
                   console.log(data[i].Periode);
                    if (tailleValeur < taillebon)
                    {
                        console.log('hello');
                        tailleDiv.css("border-color","red");
                        alert.css('display','block');
                        btn.prop("disabled",true);  
                        val.html(taillebon);
                        
                    }
                    else
                    {
                        console.log('else');
                        tailleDiv.css("border-color","rgb(80, 79, 79)");
                        alert.css('display','none');
                        btn.prop( "disabled", false ); 
                          
                    }
                }
				},
				error:function()
                {
                    console.log('error')
				}
			});
		});
//***********************************validation de periode  dans methode valide********************* */
        $(document).on('change','#periodevalide',function()
        {
			var id=$(this).parent().parent().parent().parent().find("#IDBVV").val();
            var periodeValeur= parseFloat($(this).val());
            var periodeDiv=$(this);
            var btn=$(this).parent().parent().parent().parent().parent().parent().parent().parent().find("#titleadd");
            var alert =$(this).parent().find("#alertperiode");
            var val=$(this).parent().find("#valperiodebon");
            console.log(id);
            console.log(periodeValeur);

			$.ajax(
                { 
				type:'get',
				url:'{{route("ordereMesure.TaillePeriode")}}',
				data:{'id':id },
                dataType:"json",
				success:function(data)
                {
                    for(var i=0;i<data.length;i++)
                    {
                     console.log(data.length);
                    var periodebon = parseFloat(data[i].Periode);
                  
                    if (periodeValeur >  periodebon)
                    {
                        
                        alert.css('display','block');
                        btn.prop("disabled",true);  
                        val.html(periodebon);
                        console.log('hello');
                        periodeDiv.css("border-color","red");
                        
                    }
                    else
                    {
                        alert.css('display','none');
                        btn.prop( "disabled", false ); 
                        console.log('else');
                        periodeDiv.css("border-color","rgb(80, 79, 79)");
                          
                    }
                }
				},
				error:function()
                {
                    console.log('error')
				}
			});
		});
        /*********************************************ajout un critére **********************************************/
        $(document).on('click','.btncritere',function()
        {
			var parametre=$(this).parent().parent().parent().parent().val();
		     console.log(parametre);
			var div=$(this).parent().parent().parent().parent().parent().find('.critere');
			var line=" ";
			$.ajax(
                { 
            
				type:'get',
				url:'{{route("find.AppendLine")}}',
              
				data:{'id':parametre},
                dataType:"json",
				success:function(data)
                {
					console.log(data.length);
                    if(data.length>0)
                    {
                        line ='<div>'+
                            '<div class="line">'+
                                '<div class="col">'+
                                    '<div class="titre mt-2">'+
                                        '<h6>Critére</h6>'+
                                    '</div>'+
                                    '<div class="champ">'+
                                        '<select name="Critere[]" id="" class="valeurcritere">'+
                                            '<option value="">--Choisir un critére--</option>'+
                                            '@foreach($criteres as $critere)'+
                                                '<option value="{{$critere->DesParametreMesure}}">{{$critere->DesParametreMesure}}</option>'+
                                            '@endforeach'+
                                        '</select>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="col">'+
                                    '<div class="titre mt-2">'+
                                        '<h6>Testeur</h6>'+
                                    '</div>'+
                                    '<div class="champ">'+
                                        '<select name="Testeur[]" id="">'+
                                            '<option value="">--Choisir un testeur--</option>'+
                                            '@foreach($testeurs as $testeur)'+
                                                '<option value="{{$testeur->DesTesteur}}">{{$testeur->DesTesteur}}</option>'+
                                            '@endforeach'+
                                        '</select>'+
                                        '<a href="javascript:;" class="criteredel"><i class="bi bi-dash"></i></a> '+
                                    '</div>'+
                                '</div>'+
                            '</div>'+ 
                            '<div class="line">'+
                                '<div class="col">'+
                                    '<div class="titre mt-2">'+
                                        '<h6>Etalon</h6>'+
                                    '</div>'+
                                    '<div class="champ">'+
                                        '<select name="Etalon[]" id="" class="etalon">'+
                                           
                                        '</select>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="col">'+
                                    '<div class="titre mt-2">'+
                                        '<h6>Précision</h6>'+
                                    '</div>'+
                                    '<div class="champ">'+
                                        '<select name="DesPrecisionnv[]" class="Desprecisionnv">'+
                                            
                                        '</select>'+
                                    '</div>'+
                                '</div> '+
                            '</div>'+
                        '</div>';
                   div.append(line);
                 }  
				},
				error:function()
                {

				}
			});
		});
    });
    $('.qualitative').on('click','.criteredel',function(){
        $(this).parent().parent().parent().parent().parent().remove();
    });

    /**************************************************************etalon****************************************************** */
    $(document).on('change','.valeurcritere',function()
        {
			var valeurcritere=$(this).val();
		     console.log(valeurcritere);
			var div=$(this).parent().parent().parent().parent();
			var op=" ";
			$.ajax(
                { 
            
				type:'get',
				url:'{{route("find.Etalon")}}',
              
				data:{'id':valeurcritere},
                dataType:"json",
				success:function(data)
                {
					console.log(data.length);
                    op+='<option value="">--Choisir un etalon--</option>';
					for(var i=0;i<data.length;i++)
                    {
                        op+='<option value="'+data[i].DesTypeOutil+'">'+data[i].DesTypeOutil+'</option>';
				    }
				   div.find('.etalon').html(" ");
				   div.find('.etalon').append(op);
					
				},
				error:function()
                {

				}
			});
		});
    /**************************************************************precision d' etalon****************************************************** */
    $(document).on('change','.valeurcritere',function()
        {
			var valeurcritere=$(this).val();
		     console.log(valeurcritere);
			var div=$(this).parent().parent().parent().parent();
			var op=" ";
			$.ajax(
                { 
            
				type:'get',
				url:'{{route("find.precisionetalon")}}',
              
				data:{'id':valeurcritere},
                dataType:"json",
				success:function(data)
                {
					console.log(data.length);
                    op+='<option value="">--Choisir une precision--</option>';
					for(var i=0;i<data.length;i++)
                    {
                        op+='<option value="'+data[i].DesPrecision+'">'+data[i].DesPrecision+'</option>';
				    }
				   div.find('.Desprecisionnv').html(" ");
				   div.find('.Desprecisionnv').append(op);
					
				},
				error:function()
                {

				}
			});
		});
</script>
@endsection
