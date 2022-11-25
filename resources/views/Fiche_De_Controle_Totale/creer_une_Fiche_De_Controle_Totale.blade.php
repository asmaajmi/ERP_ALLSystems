@extends("layouts.Navbar_Sidebar")
@section("contenu")
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
<link rel="stylesheet" href="{{asset('css/fiche de controle totale/creer_une_Fiche_De_Controle_Totale.css')}}"/>
{{-- Créer Une fiche de controle --}}
<div class="container" id="addFicheConTot">
    <form action="{{route('FicheControle.Ajouter')}}" method="post">
        @csrf
        <div class="ajout">
            @include('sweetalert::alert') 
            <div class="titre">
                <h2 class="mb-4 addtitle">Créer<b> Une fiche de contrôle totale</b></h2>
            </div>
            <div class="info_Generale">
                <div class="line">
                    <div class="col">
                        <div class="titre mt-2">
                            <h6>Ref Fiche</h6>
                        </div>
                        <div class="champ">
                            <input type="text" name="IDFC">
                        </div>
                    </div>
                    <div class="col">
                        <div class="titre mt-2">
                            <h6>Date de creation</h6>
                        </div>
                        <div class="champ">
                            <input type="date" name="DateFC">                            
                        </div>
                    </div>
                 </div> 
            </div>
            <div class="OTmesure">
                <div class="line">
                    <div class="col">
                        <div class="titre mt-2">
                            <h6>N° OT Mesure</h6>
                        </div>
                        <div class="champ">
                            <select name="IDOTM" id="OTM">
                                <option value="">-- Choisir OT Mesure --</option>
                                @foreach ($OTMs as $OTM)
                                <option value="{{$OTM->IDOTMesureNonValide}}">
                                {{$OTM->IDOTMesureNonValide}}
                                </option>
                                @endforeach
                            </select>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="titre mt-2">
                            <h6>Nom Operateur :</h6>
                        </div>
                        <div class="champ">
                            <input type="test" name="" id="Nomop" value="">                            
                        </div>
                    </div>
                </div>
                <div class="line">
                    <div class="col">
                        <div class="titre mt-2">
                            <h6>Produit à contrôler :</h6>
                        </div>
                        <div class="champ">
                            <input type="text" name="" id="produit">                            
                        </div>
                    </div>
                    <div class="col">
                        <div class="titre mt-2">
                            <h6>Machine :</h6>
                        </div>
                        <div class="champ">
                            <input type="text" name="" id="machine">                            
                        </div>
                    </div>
                </div> 
                <div class="line">
                    <div class="col">
                        <div class="titre mt-2">
                            <h6>Totale à contrôler</h6>
                        </div>
                        <div class="champ">
                            <input type="text" name="Totale_a_Controler" id="Totale_a_Controler">                            
                        </div>
                    </div>
                    <div class="col">
                        <div class="titre mt-2">
                            <h6>Taille d'échantillon</h6>
                        </div>
                        <div class="champ">
                            <input type="text" name="Taille_Echantillon" id="Taille_Echantillon"> 
                            <br><span id="alerttail">Taille d'échantillon doit être = à Totale à contrôler</span>                             
                        </div>
                    </div>
                </div>  
                <div class="line">
                    <div class="col">
                        <div class="titre mt-2">
                            <h6>Pourcentage défaut</h6>
                        </div>
                        <div class="champ">
                            <input type="text" name="Pourcentage_defaut_estime">                            
                        </div>
                    </div>
                    <div class="col">
                        <div class="titre mt-2">
                            <h6>Nbr de mesure</h6>
                        </div>
                        <div class="champ">
                            <input type="text" name="NombreDeMesure" id="NombreDeMesure">   
                            <br><span id="alert">Le nombre de mesure doit être > 1</span>                         
                        </div>
                    </div>
                </div>
                <div class="line">
                    <div class="col">
                        <div class="titre mt-2">
                            <h6>Cm Proposé</h6>
                        </div>
                        <div class="champ">
                            <input type="text" name="Cm_propose">                            
                        </div>
                    </div>
                    <div class="col">
                        <div class="titre mt-2">
                            <h6>Cmk Proposé</h6>
                        </div>
                        <div class="champ">
                            <input type="text" name="Cmk_propose">                            
                        </div>
                    </div>
                </div>
                <hr>
                <div class="par">

                </div>
            <div class="boutons mt-5 mb-4">
                <button type="submit" role="button" id="titleadd" class="btn" data-toggle="modal"><i class="bi bi-plus-circle-fill"></i><span> Ajouter</span></button>
                <a href="{{route('ListeDeFicheDeControleTotale.affiche')}}" id="titledelete" class="btn " data-toggle="modal"><i class="bi bi-dash-circle-fill"></i><span> Annuler</span></a>
            </div>
        </div>
    </form>
</div>             
{{-- Créer Une fiche de controle --}}
<!-- **************************************************************************************************************** -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
<script type="text/javascript">
/***********************************find nom employee /produit /machine ********************* */
        $(document).on('change','#OTM',function()
        {   var IDotm=$(this).val();
			var Nomop=$(this).parent().parent().parent().find("#Nomop");
            var produit=$(this).parent().parent().parent().parent().find("#produit");
            var machine=$(this).parent().parent().parent().parent().find("#machine");
            console.log(IDotm);
            console.log(Nomop);
            console.log(produit);
            console.log(machine);
			$.ajax(
                { 
				type:'get',
				url:'{{route("FindInformationFicheControle")}}',
				data:{'IDotm':IDotm},
                dataType:"json",
				success:function(data)
                {
                    console.log('success');
                    for(var i=0;i<data.length;i++)
                    {
                        Nomop.val(data[i].prenom_emp+' '+data[i].nom_emp);
                        produit.val(data[i].DesProduit);
                        machine.val(data[i].IDMachine);
                    }
				},
				error:function()
                {
                    console.log('error');
				}
			});
		});
/*find parametre/precision/outil/typemesure/tolerenceinf/tolerencesup/enregistrement dans le cas de  methode_non_valide_quantitative_variable_physiques*/
        $(document).on('change','#OTM',function()
        {   var IDotm=$(this).val();
            var parametre=$(this).parent().parent().parent().parent().parent().find("#parametre");
            var precision=$(this).parent().parent().parent().parent().parent().find("#precision"); 
            var outil=$(this).parent().parent().parent().parent().parent().find("#outil");
            var par=$(this).parent().parent().parent().parent().parent().find(".par");
            var div=" ";
            var b=1000;
            par.html(' ');
            console.log(parametre);
            console.log(precision);
            console.log(outil);
			$.ajax(
                { 
				type:'get',
				url:'{{route("FindInformationPPO")}}',
				data:{'IDotm':IDotm},
                dataType:"json",
				success:function(data)
                {
                    for(var i=0;i<data.length;i++)
                    { b++;
            div+=
                '<div class="line" id="lineotm">'+
                    '<div class="col">'+
                        '<div class="titre mt-2">'+
                            '<h6>Parametre à mesurer :</h6>'+
                        '</div>'+
                        '<div class="champOTM">'+
                            '<input type="test" name="DesParametreMesure[]" value="'+data[i].DesParametreMesure+'" id="parametre">'+                            
                        '</div>'+
                    '</div>'+
                    '<div class="col">'+
                        '<div class="titre mt-2">'+
                            '<h6>Précision :</h6>'+
                        '</div>'+
                        '<div class="champOTM">'+
                            '<input type="test" name="DesPrecision[]" value="'+data[i].DesPrecision+'" id="precision">'+                            
                        '</div>'+
                    '</div>'+
                '</div>'+
                '<div class="line" id="lineotm">'+
                    '<div class="col">'+
                        '<div class="titre mt-2">'+
                            '<h6>Outil a utiliser :</h6>'+
                        '</div>'+
                        '<div class="champOTM">'+
                            '<input type="test" name="DesTypeOutil[]" value="'+data[i].DesTypeOutil+'" id="outil">'+                            
                        '</div>'+
                    '</div>'+
                    '<div class="col">'+
                        '<div class="titre mt-2">'+
                            '<h6>Type de mesure :</h6>'+
                        '</div>'+
                        '<div class="champOTM">'+
                            '<input type="test" name="DesTypeMesure[]" value="'+data[i].DesTypeMesure+'" id="typemesure">'+                            
                        '</div>'+
                    '</div>'+
                '</div>'+
                '<div class="line" id="lineotm">'+
                    '<div class="col">'+
                        '<div class="titre mt-2">'+
                            '<h6>Tolérance Inférieure :</h6>'+
                        '</div>'+
                        '<div class="champOTM">'+
                            '<input type="number" name="TolérenceInf[]" value="'+data[i].TolérenceInf+'" id="tolerenceinf">'+                            
                        '</div>'+
                    '</div>'+
                    '<div class="col">'+
                        '<div class="titre mt-2">'+
                            '<h6>Tolérance Superieure:</h6>'+
                        '</div>'+
                        '<div class="champOTM">'+
                            '<input type="number" name="TolérenceSup[]" value="'+data[i].TolérenceSup+'" id="tolerencesup">'+                            
                        '</div>'+
                    '</div>'+
                '</div>'+
            '</div>'+
            '<div class="line">'+
                '<div class="col">'+
                    '<div class="titre mt-2">'+
                        '<h6>Enregistrement</h6>'+
                    '</div>'+
                    '<div class="champ">'+
                        '<select name="enregistrement[]" id="enregistrement">'+
                            '<option value="">-- Choisir OT Mesure --</option>'+
                            '<option value="Valeur Moyenne">Valeur Moyenne</option>'+
                            '<option value="Barre">Barre</option>'+
                            '<option value="Croix">Croix</option>'+
                            '<option value="Valeur Moyenne + Barre">Valeur Moyenne + Barre</option>'+
                            '<option value="Valeur Moyenne + Croix">Valeur Moyenne + Croix</option>'+
                        '</select>'+
                    '</div>'+
                '</div>'+
                '<div class="col">'+
                '</div>'+
            '</div>'+
            '<hr>';
                        }
                        console.log('b='+b);
                    console.log('success2');
                    console.log(data.length);
                
                  par.append(div);  
				},
				error:function()
                {
                    console.log('error');
				}
			});
		});
/*find parametre/precision/outil/typemesure/tolerenceinf/tolerencesup/enregistrement dans le cas de  methode_valides*/
        $(document).on('change','#OTM',function()
        {   var IDotm=$(this).val();
                var parametre=$(this).parent().parent().parent().parent().parent().find("#parametre");
                var precision=$(this).parent().parent().parent().parent().parent().find("#precision"); 
                var outil=$(this).parent().parent().parent().parent().parent().find("#outil");
                var par=$(this).parent().parent().parent().parent().parent().find(".par");
                var div=" ";
                console.log(parametre);
                console.log(precision);
                console.log(outil);
                $.ajax(
                    { 
                    type:'get',
                    url:'{{route("FindInformationPPO_MValide")}}',
                    data:{'IDotm':IDotm},
                    dataType:"json",
                    success:function(data)
                    {
                        for(var i=0;i<data.length;i++)
                        {
            div+=
                    '<div class="line" id="lineotm">'+
                        '<div class="col">'+
                            '<div class="titre mt-2">'+
                                '<h6>Parametre à mesurer :</h6>'+
                            '</div>'+
                            '<div class="champOTM">'+
                                '<input type="text" name="DesParametreMesure[]" value="'+data[i].DesParametreMesure+'" id="parametre">'+                            
                            '</div>'+
                        '</div>'+
                        '<div class="col">'+
                            '<div class="titre mt-2">'+
                                '<h6>Précision :</h6>'+
                            '</div>'+
                            '<div class="champOTM">'+
                                '<input type="text" name="DesPrecision[]" value="'+data[i].DesPrecision+'" id="precision">'+                            
                            '</div>'+
                        '</div>'+
                    '</div>'+

                    '<div class="line" id="lineotm">'+
                        '<div class="col">'+
                            '<div class="titre mt-2">'+
                                '<h6>Outil a utiliser :</h6>'+
                            '</div>'+
                            '<div class="champOTM">'+
                                '<input type="text" name="DesTypeOutil[]" value="'+data[i].DesTypeOutil+'" id="outil">'+                            
                            '</div>'+
                        '</div>'+
                        '<div class="col">'+
                            '<div class="titre mt-2">'+
                                '<h6>Type de mesure :</h6>'+
                            '</div>'+
                            '<div class="champOTM">'+
                                '<input type="text" name="DesTypeMesure[]" value="'+data[i].DesTypeMesure+'" id="typemesure">'+                            
                            '</div>'+
                        '</div>'+
                    '</div>'+

                    '<div class="line" id="lineotm">'+
                        '<div class="col">'+
                            '<div class="titre mt-2">'+
                                '<h6>Tolérance Inférieure :</h6>'+
                            '</div>'+
                            '<div class="champOTM">'+
                                '<input type="number" name="TolérenceInf[]" value="'+data[i].TolérenceInf+'" id="tolerenceinf">'+                            
                            '</div>'+
                        '</div>'+
                        '<div class="col">'+
                            '<div class="titre mt-2">'+
                                '<h6>Tolérance Superieure:</h6>'+
                            '</div>'+
                            '<div class="champOTM">'+
                                '<input type="number" name="TolérenceSup[]" value="'+data[i].TolérenceSup+'" id="tolerencesup">'+                            
                            '</div>'+
                        '</div>'+
                    '</div>'+

                    '<div class="line">'+
                        '<div class="col">'+
                            '<div class="titre mt-2">'+
                            '<h6>Enregistrement</h6>'+
                            '</div>'+
                            '<div class="champ">'+
                                '<select name="enregistrement[]" id="enregistrement">'+
                                    '<option value="">-- Choisir OT Mesure --</option>'+
                                    '<option value="Valeur Moyenne">Valeur Moyenne</option>'+
                                    '<option value="Barre">Barre</option>'+
                                    '<option value="Croix">Croix</option>'+
                                    '<option value="Valeur Moyenne + Barre">Valeur Moyenne + Barre</option>'+
                                    '<option value="Valeur Moyenne + Croix">Valeur Moyenne + Croix</option>'+
                                '</select>'+
                            '</div>'+
                        '</div>'+
                        '<div class="col">'+
                        '</div>'+
                    '</div>'+
                    '<hr>';
                            }
                            console.log('i='+i);
                        console.log('success2');
                        console.log(data.length);
                        
                    par.append(div);  
                    },
                    error:function()
                    {
                        console.log('error');
                    }
                });
        });
/*find parametre/precision/outil/typemesure/enregistrement dans le cas de  methode_non_valide_qualitatives*/
        $(document).on('change','#OTM',function()
        {   var IDotm=$(this).val();
                var parametre=$(this).parent().parent().parent().parent().parent().find("#parametre");
                var precision=$(this).parent().parent().parent().parent().parent().find("#precision"); 
                var outil=$(this).parent().parent().parent().parent().parent().find("#outil");
                var par=$(this).parent().parent().parent().parent().parent().find(".par");
                var div=" ";
                var c=5000;
                console.log(parametre);
                console.log(precision);
                console.log(outil);
                $.ajax(
                    { 
                    type:'get',
                    url:'{{route("FindInformationPPO_MNQ")}}',
                    data:{'IDotm':IDotm},
                    dataType:"json",
                    success:function(data)
                    {
                        for(var i=0;i<data.length;i++)
                        {
                            c++;
            div+=
                    '<div class="line" id="lineotm">'+
                        '<div class="col">'+
                            '<div class="titre mt-2">'+
                                '<h6>Parametre à mesurer :</h6>'+
                            '</div>'+
                            '<div class="champOTM">'+
                                '<input type="text" name="DesParametreMesure[]" value="'+data[i].DesParametreMesure+'" id="parametre">'+                            
                            '</div>'+
                        '</div>'+
                        '<div class="col">'+
                            '<div class="titre mt-2">'+
                                '<h6>Précision :</h6>'+
                            '</div>'+
                            '<div class="champOTM">'+
                                '<input type="text" name="DesPrecision[]" value="'+data[i].DesPrecision+'" id="precision">'+                            
                            '</div>'+
                        '</div>'+
                    '</div>'+

                    '<div class="line" id="lineotm">'+
                        '<div class="col">'+
                            '<div class="titre mt-2">'+
                                '<h6>Outil a utiliser :</h6>'+
                            '</div>'+
                            '<div class="champOTM">'+
                                '<input type="text" name="DesTypeOutil[]" value="'+data[i].DesTypeOutil+'" id="outil">'+                            
                            '</div>'+
                        '</div>'+
                        '<div class="col">'+
                            '<div class="titre mt-2">'+
                                '<h6>Type de mesure :</h6>'+
                            '</div>'+
                            '<div class="champOTM">'+
                                '<input type="text" name="DesTypeMesure[]" value="'+data[i].DesTypeMesure+'" id="typemesure">'+                            
                            '</div>'+
                        '</div>'+
                    '</div>'+
                    '<div class="line" id="lineotm">'+
                        '<div class="col">'+
                            '<div class="titre mt-2">'+
                                '<h6>Tolérance Inférieure :</h6>'+
                            '</div>'+
                            '<div class="champOTM">'+
                                '<input type="number" name="TolérenceInf[]" value="0" id="tolerenceinf">'+                            
                            '</div>'+
                        '</div>'+
                        '<div class="col">'+
                            '<div class="titre mt-2">'+
                                '<h6>Tolérance Superieure:</h6>'+
                            '</div>'+
                            '<div class="champOTM">'+
                                '<input type="number" name="TolérenceSup[]" value="0" id="tolerencesup">'+                            
                            '</div>'+
                        '</div>'+
                    '</div>'+
                    '<div class="line">'+
                        '<div class="col">'+
                            '<div class="titre mt-2">'+
                                '<h6>Enregistrement</h6>'+
                            '</div>'+
                            '<div class="champ">'+
                                '<select name="enregistrement[]" id="enregistrement">'+
                                    '<option value="">-- Choisir OT Mesure --</option>'+
                                    '<option value="Valeur Moyenne">Valeur Moyenne</option>'+
                                    '<option value="Barre">Barre</option>'+
                                    '<option value="Croix">Croix</option>'+
                                    '<option value="Valeur Moyenne + Barre">Valeur Moyenne + Barre</option>'+
                                    '<option value="Valeur Moyenne + Croix">Valeur Moyenne + Croix</option>'+
                                '</select>'+
                            '</div>'+
                        '</div>'+
                        '<div class="col">'+
                        '</div>'+
                    '</div>'+
                    '<hr>';
                            }
                        console.log('success2');
                        console.log(data.length);
                        console.log('c'+c);
                    par.append(div);  
                    },
                    error:function()
                    {
                        console.log('error');
                    }
                });
        });  
/********************find test capabilité valide dans le cas de methode_non_valide_qualitatives **************************************************/
        $(document).on('change','#NombreDeMesure',function()
        {   var Nbrmesure=$(this);
            var NombreDeMesure=Nbrmesure.val();
            var otm=$(this).parent().parent().parent().parent().parent().find("#OTM");
            var alert =$(this).parent().find("#alert");
            var btn=$(this).parent().parent().parent().parent().parent().parent().find("#titleadd");
            var IDotm=otm.val();
            console.log(NombreDeMesure);
            console.log(IDotm);
			$.ajax(
                { 
				type:'get',
				url:'{{route("Find_Test_CapabiliteNVQ")}}',
				data:{'IDotm':IDotm},
                dataType:"json",
				success:function(data)
                {
                    for(var i=0;i<data.length;i++)
                    {
                        if(data[i].Validation == 0)
                        {
                            if( NombreDeMesure < 2 )
                           {
                               Nbrmesure.css("border-color","red");
                               alert.css('display','block');
                               btn.prop("disabled",true);  
                           }
                           else
                           {
                            Nbrmesure.css("border-color","rgb(80, 79, 79)");
                            alert.css('display','none');
                            btn.prop( "disabled", false ); 
                           }
                            
                        }
                        else
                        {
                        }
       
                        }
                    console.log('success7');
                    console.log(data.length); 
				},
				error:function()
                {
                    console.log('error');
				}
			});
		});      
/****************************find test capabilité valide dans le cas de methode valide *******************************************/
        $(document).on('change','#NombreDeMesure',function()
        {   var Nbrmesure=$(this);
            var NombreDeMesure=Nbrmesure.val();
            var otm=$(this).parent().parent().parent().parent().parent().find("#OTM");
            var btn=$(this).parent().parent().parent().parent().parent().parent().find("#titleadd");
            var alert =$(this).parent().find("#alert");
            var IDotm=otm.val();
            console.log(NombreDeMesure);
            console.log(IDotm);
			$.ajax(
                { 
				type:'get',
				url:'{{route("Find_Test_CapabiliteV")}}',
				data:{'IDotm':IDotm},
                dataType:"json",
				success:function(data)
                {
                    for(var i=0;i<data.length;i++)
                    {  
                        if(data[i].Validation == 0)
                        {
                            
                            if( NombreDeMesure < 2 )
                           {
                               Nbrmesure.css("border-color","red");
                               alert.css('display','block');
                               btn.prop("disabled",true); 
                           }
                           else
                           {
                            Nbrmesure.css("border-color","rgb(80, 79, 79)");
                            alert.css('display','none');
                            btn.prop( "disabled", false ); 
                           }
                        }
                        else
                        {     
                        }
                    }
                    console.log('success5');
                    console.log(data.length); 
				},
				error:function()
                {
                    console.log('error');
				}
			});
		}); 
/*************************find test capabilité valide dans le cas de methode_non_valide_quantitative_variable_physiques*********************************************/
        $(document).on('change','#NombreDeMesure',function()  
        {   var Nbrmesure=$(this);
            var NombreDeMesure=Nbrmesure.val();
            var otm=$(this).parent().parent().parent().parent().parent().find("#OTM");
            var btn=$(this).parent().parent().parent().parent().parent().parent().find("#titleadd");
            var alert =$(this).parent().find("#alert");
            var IDotm=otm.val();
            console.log(NombreDeMesure);
            console.log(IDotm);
			$.ajax(
                { 
				type:'get',
				url:'{{route("Find_Test_CapabiliteNVQV")}}',
				data:{'IDotm':IDotm},
                dataType:"json",
				success:function(data)
                {
                    for(var i=0;i<data.length;i++)
                    {
                        if(data[i].Validation == 0)
                        {
                            if( NombreDeMesure < 2 )
                           {
                               Nbrmesure.css("border-color","red");
                               alert.css('display','block');
                               btn.prop("disabled",true); 
                           }
                           else
                           {
                            Nbrmesure.css("border-color","rgb(80, 79, 79)");
                            alert.css('display','none');
                            btn.prop( "disabled", false ); 
                           }
                        }
                        else
                        {
                        } 
                     }
                    console.log('success6');
                    console.log(data.length); 
				},
				error:function()
                {
                    console.log('error');
				}
			});
		});
/***********************find test Normalité valide dans le cas de methode valide******************************************/   
        $(document).on('change','#Taille_Echantillon',function()
        {   var taille=$(this);
            var Taille_Echantillon=taille.val();
            var Totale_a_Controler=$(this).parent().parent().parent().parent().parent().find("#Totale_a_Controler");
            var otm=$(this).parent().parent().parent().parent().parent().find("#OTM");
            var alert =$(this).parent().find("#alerttail");
            var btn=$(this).parent().parent().parent().parent().parent().parent().find("#titleadd");
            var IDotm=otm.val();
            console.log(Taille_Echantillon);
            console.log(IDotm);
			$.ajax(
                { 
				type:'get',
				url:'{{route("Find_Test_NormaliteV")}}',
				data:{'IDotm':IDotm},
                dataType:"json",
				success:function(data)
            {
                        for(var i=0;i<data.length;i++)
                    {
                        if(data[i].Validation == 0)
                        {
                            if( Taille_Echantillon != Totale_a_Controler.val() )
                                {
                                    taille.css("border-color","red");
                                    alert.css('display','block');
                                    btn.prop("disabled",true);  
                                }
                            else
                                {
                                    taille.css("border-color","rgb(80, 79, 79)");
                                    alert.css('display','none');
                                    btn.prop( "disabled", false ); 
                                }  
                        }
                        else
                        {
                        }
       
                    }
                    console.log('success7');
                    console.log(data.length); 
				},
				error:function()
                {
                    console.log('error');
				}
			});
		});      
/**********************find test Normalité valide dans le cas de methode_non_valide_quantitative_variable_physiques******************************/
        $(document).on('change','#Taille_Echantillon',function()
        {   var taille=$(this);
            var Taille_Echantillon=taille.val();
            var Totale_a_Controler=$(this).parent().parent().parent().parent().parent().find("#Totale_a_Controler");
            var otm=$(this).parent().parent().parent().parent().parent().find("#OTM");
            var alert =$(this).parent().find("#alerttail");
            var btn=$(this).parent().parent().parent().parent().parent().parent().find("#titleadd");
            var IDotm=otm.val();
            console.log(Taille_Echantillon);
            console.log(IDotm);
			$.ajax(
                { 
				type:'get',
				url:'{{route("Find_Test_NormaliteNVQV")}}',
				data:{'IDotm':IDotm},
                dataType:"json",
				success:function(data)
                {
            
                        for(var i=0;i<data.length;i++)
                    {
                        if(data[i].Validation == 0)
                        {
                            if( Taille_Echantillon != Totale_a_Controler.val() )
                                {
                                    taille.css("border-color","red");
                                    alert.css('display','block');
                                    btn.prop("disabled",true);  
                                }
                            else
                                {
                                    taille.css("border-color","rgb(80, 79, 79)");
                                    alert.css('display','none');
                                    btn.prop( "disabled", false ); 
                                }  
                        }
                        else
                        {
                        }
       
                    }
                    console.log('success7');
                    console.log(data.length); 
				},
				error:function()
                {
                    console.log('error');
				}
			});
		});     
/********************************find test Normalité valide dans le cas de methode_non_valide_qualitatives ********************************************************************/
            $(document).on('change','#Taille_Echantillon',function()
        {   var taille=$(this);
            var Taille_Echantillon=taille.val();
            var Totale_a_Controler=$(this).parent().parent().parent().parent().parent().find("#Totale_a_Controler");
            var otm=$(this).parent().parent().parent().parent().parent().find("#OTM");
            var alert =$(this).parent().find("#alerttail");
            var btn=$(this).parent().parent().parent().parent().parent().parent().find("#titleadd");
            var IDotm=otm.val();
            console.log(Taille_Echantillon);
            console.log(IDotm);
			$.ajax(
                { 
				type:'get',
				url:'{{route("Find_Test_NormaliteNVQ")}}',
				data:{'IDotm':IDotm},
                dataType:"json",
				success:function(data)
                {
            
                        for(var i=0;i<data.length;i++)
                    {
                        if(data[i].Validation == 0)
                        {
                            if( Taille_Echantillon != Totale_a_Controler.val() )
                                {
                                    taille.css("border-color","red");
                                    alert.css('display','block');
                                    btn.prop("disabled",true);  
                                }
                            else
                                {
                                    taille.css("border-color","rgb(80, 79, 79)");
                                    alert.css('display','none');
                                    btn.prop( "disabled", false ); 
                                }  
                        }
                        else
                        {
                        }
       
                    }
                    console.log('success7');
                    console.log(data.length); 
				},
				error:function()
                {
                    console.log('error');
				}
			});
		}); 

</script> 
@endsection
