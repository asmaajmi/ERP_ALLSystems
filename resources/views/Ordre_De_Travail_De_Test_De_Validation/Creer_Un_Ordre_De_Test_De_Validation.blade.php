@extends("layouts.Navbar_Sidebar")
@section("contenu")

<link rel="stylesheet" href="{{asset('css/ordre de travail de test de validation/Creer_Un_Ordre_De_Test_De_Validation.css')}}"/>
{{-- Créer Un Ordre De Test De Validation --}}
<div class="container" id="addordretestval">
    <form action="{{route('CreerUnOrdreDeTestDeValidation.creer')}}" method="post">
        @csrf
        <div class="ajout">
             @include('sweetalert::alert')
            <div class="titre">
                <h2 class="mb-4 addordretestvaltitle">Créer<b> Ordre De Test De Validation</b></h2>
            </div>
            <div class="info_Generale">
                <h4 class="mb-3 mt-4">Information Générale</h4>

                <div class="line ms-2">
                    <div class="col">
                        <div class="titre mt-2">
                            <h5>N°OT</h5>
                        </div>
                        <div class="champ">
                            <input type="text" name="IDOTTV" id="">
                        </div>
                    </div>
                </div>  

                <div class="line ms-2">
                    <div class="col">
                        <div class="titre mt-2">
                            <h5>Responsable</h5>
                        </div>
                        <div class="champ">
                            <select name="IDResponsable">
                                <option value="">Choisir le Resonsable</option>
                                @foreach ($responsablequalites as $responsablequalite)
                                <option value="{{$responsablequalite->id}}">
                                    {{$responsablequalite->employe->nom_emp}} {{$responsablequalite->employe->prenom_emp}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="titre mt-2">
                            <h5>Date </h5>
                        </div>
                        <div class="champ">
                           <input type="date" name="DateOrdreTestValidation" id="">
                        </div>
                    </div>
                </div>
            </div>  
            <div class="info_sur_produit">
                <h4 class="mb-3">Information sur le produit</h4>
                <div class="line ms-2">
                    <div class="col">
                        <div class="titre mt-2">
                            <h5>Produit</h5>
                        </div>
                        <div class="champ">
                            <select name="DesProduit" class="produit" id='produit'>       
                                <option value="">Choisir un produit</option>

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
                                <h5 id='machineT'>Machine</h5>
                            </div>
                            <div class="champ">
                                <select name="IDMachine" class="machine" id='machineS'>
                                    <option value="0" disabled="true" selected="true">Machine</option>
                                  
                                </select>
                            </div>             
                    </div>         
                </div>
            </div>
            <div class="info_sur_outil">
                <h4 class="mb-3 mt-4">Informations sur l'outil</h4>
                <div class="line ms-2">
                    <div class="col">
                        <div class="titre mt-2">
                            <h5 class="line2">Type Outil</h5>
                        </div>
                        <div class="champ">
                            <select name="DesTypeOutil" class="typeOutil">
                                <option value="">Choisir un type d'outil</option>
                               @foreach ( $type_outils as  $type_outil )
                                <option value="{{ $type_outil->DesTypeOutil}}">
                                    {{ $type_outil->DesTypeOutil}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="titre mt-2">
                            <h5 class="line1">Paramétre</h5>
                        </div>
                        <div class="champ">
                            <select name="DesParametreMesure" class="parametre" id='parametre'>
                                <option value="">Paramétre</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="line ms-2">
                    <div class="col">
                        <div class="titre mt-2">
                            <h5 class="line" id="parametre">Type_Mesure </h5>
                        </div>
                        <div class="champ ">
                            <select name="DesTypeMesure" class="typeMesure">
                                <option value=""> Type de mesure</option>
                               
                            </select>
                        </div> 
                    </div>
                    <div class="col">
                        <div class="titre mt-2">
                            <h5 class="line2">Préçision</h5>
                        </div>
                        <div class="champ">
                            <select name="DesPrecision" class="Desprecision">
                                <option value="" >préçision</option>
                               
                            </select>
                        </div>
                    </div>
                </div>
            </div>  
           
            <div class="Objectif">
                <h4 class="champobj mb-3 mt-4">Objectif</h4>
                <div class="lineobj">
                    <div class="colobj">
                        <div class="ms-3">
                              <div class="form-check form-check-inline me-5">
                                <input class="form-check-input checkbox" type="checkbox" value="Capabilite" name="Objectif[]" id="capabilite" >
                                <a href="#" class="btn" id="eye"><span>Capabilité </span></a>
                              </div>
                              <div class="form-check form-check-inline mx-5">
                                <input class="form-check-input checkbox" type="checkbox" value="Normalite" name="Objectif[]" id="normalite">
                                <a href="#" class="btn" id="eye"><span>Normalité </span></a>
                              </div>
                              <div class="form-check form-check-inline mx-5">
                                <input class="form-check-input checkbox" type="checkbox" value="Taille_Periode" name="Objectif[]" id="taille_Periode">
                                <a href="#" class="btn" id="eye"><span>Taille/Periode </span></a>
                              </div>
                        </div>
                    </div>
                </div>
            </div>  
            <div class="Test_Capabilité" id="Capabilite">
                <h4 class="mb-3 mt-4">Test Capabilité</h4>
                <div class="line ms-2">
                    <div class="col">
                        <div class="titre mt-2">
                            <h5>valeur minimale</h5>
                        </div>
                        <div class="champ">
                            <input type="text" name="CapabiliteMinimale" id="nom" class="place1">
                        </div>
                    </div>
                </div>
            </div>    
            <div class="Test_Normalité" id="Normalite">
                <h4 class="mb-3 mt-4">Test Normalité</h4>
                <div class="line ms-2">
                    <div class="col">
                        <div class="titre mt-2">
                            <h5>Valeur</h5>
                        </div>
                        <div class="champ">
                            <input type="text" name="ValeurNormalite" id="nom" class="place1">
                        </div>
                    </div>
                </div>
            </div>
            <div class="Taille_Periode" id="Taille_Periode">  
                <div class="periode">
                    <h4 class="mb-3 mt-4">Periode d'échantillonage</h4>
                    <div class="line ms-2">
                        <div class="col">
                            <div class="titre mt-2">
                                <h5>minimale</h5>
                            </div>
                            <div class="champ">
                                <input type="text" name="PeriodeMinimale" id="nom" class="place1">
                            </div>
                        </div>
                        <div class="col">
                            <div class="titre mt-2">
                                <h5>maximale</h5>
                            </div>
                            <div class="champ">
                                <input type="text" name="PeriodeMaximale" id="nom" class="place1">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="Taille">
                    <h4 class="mb-3 mt-4">Taille d'échantillion</h4>
                    <div class="line ms-2">
                        <div class="col">
                            <div class="titre mt-2">
                                <h5>minimale</h5>
                            </div>
                            <div class="champ">
                                <input type="text" name="TailleMinimale" id="nom" class="place1">
                            </div>
                        </div>
                        <div class="col">
                            <div class="titre mt-2">
                                <h5>maximale</h5>
                            </div>
                            <div class="champ">
                                <input type="text" name="TailleMaximale" id="nom" class="place1">
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
            <div class="Description">
                <h4 class="mb-3 mt-4">Description</h4>
                <div class="line_des ms-2">
                    <div class="form-floating">
                            <textarea class="form-control" name="Description" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                    </div>
                </div>
            </div>                    
        </div>
        <div class="boutons mt-5 mb-4">
            <button type="submit" role="button" id="titleadd" class="btn" data-toggle="modal"><i class="bi bi-plus-circle-fill"></i><span> Ajouter</span></button>
            <a href="{{route('ListeDesOrdresDeTestDeValidation')}}" id="titledelete" class="btn " data-toggle="modal"><i class="bi bi-dash-circle-fill"></i><span> Annuler</span></a>
        </div>
    </form>
</div>
{{-- Créer Un Ordre De Test De Validation --}}
<script  src="{{asset('js/ordre de travail de test de validation/Creer_Un_Ordre_De_Test_De_Validation.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
 <script type="text/javascript">

	$(document).ready(function()
    {

		
        $(document).on('change','.typeOutil',function()
        {
			var type_outil=$(this).val();
		     console.log(type_outil);
			var div=$(this).parent().parent().parent();
			var op=" ";
			$.ajax(
                { 
            
				type:'get',
				url:'{{route("Cree.findParametreOTV")}}',
              
				data:{'id':type_outil},
                dataType:"json",
				success:function(data)
                {
					console.log(data.length);
					op+='<option value="" selected disabled>choisir un parametre </option>';
					for(var i=0;i<data.length;i++)
                    {
                        op+='<option value="'+data[i].DesParametreMesure+'">'+data[i].DesParametreMesure+'</option>';
				    }
				   div.find('.parametre').html(" ");
				   div.find('.parametre').append(op);
				},
				error:function()
                {

				}
			});
		});

        $(document).on('change','.parametre',function()
        {
			var parametre=$(this).val();
		     console.log(parametre);
			var div=$(this).parent().parent().parent().parent();
			var op=" ";
			$.ajax(
                { 
            
				type:'get',
				url:'{{route("Cree.findTypeMesureOTV")}}',
              
				data:{'id':parametre},
                dataType:"json",
				success:function(data)
                {
					console.log(data.length);

					op+='<option value="" selected disabled>choisir un type mesure </option>';
					for(var i=0;i<data.length;i++)
                    {
                        op+='<option value="'+data[i].DesTypeMesure+'">'+data[i].DesTypeMesure+'</option>';
				    }
				   div.find('.typeMesure').html(" ");
				   div.find('.typeMesure').append(op);
				},
				error:function()
                {

				}
			});
		});

        $(document).on('change','.produit',function()
        {
			var prod_id=$(this).val();
		     console.log(prod_id);
			var div=$(this).parent().parent().parent();
			var op=" ";
			$.ajax(
                { 
            
				type:'get',
				url:'{{route("Cree.findMachineOTV")}}',
              
				data:{'id':prod_id},
                dataType:"json",
				success:function(data)
                {
					console.log(data.length);
                    if(data.length==0)
                    {
                            div.find('#machineS').css('display','none');
                            div.find('#machineT').css('display','none');
                    }
                    else{
                            div.find('#machineS').css('display','block');
                            div.find('#machineT').css('display','block');
                            op+='<option value="" selected disabled>choisir une machine</option>';
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

        $(document).on('change','.parametre',function()
        {
			var parametre=$(this).val();
            console.log(parametre);
			var div=$(this).parent().parent().parent().parent();
			var op=" ";
			$.ajax(
                { 
            
				type:'get',
				url:'{{route("Cree.findDesPrecisionOTV")}}',
				data:{'id':parametre},
                dataType:"json",
				success:function(data)
                {
                    console.log(data.length);
					op+='<option value="" selected disabled>choisir une precision </option>';
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

        $(document).on('change','.parametre',function()
        {
			var parametre=$(this).val();
            var produit=$(this).parent().parent().parent().parent().parent().find('.produit').val();
            var machine=$(this).parent().parent().parent().parent().parent().find('.machine').val();
            var Taille=$(this).parent().parent().parent().parent().parent().find('#taille_Periode');
            console.log(parametre);
			console.log(produit);
            console.log(machine);
			$.ajax(
                { 
				type:'get',
				url:'{{route("cree.Normalite")}}',
				data:{'DesParametre':parametre, 'IDMachine':machine, 'DesProduit':produit },
                dataType:"json",
				success:function(data)
                {
                    console.log(data.length);
                    console.log('seccess');
                    
                    if(data.length == 0) 
                    { console.log(Taille);
                        Taille.prop( "checked", false );
                        Taille.prop( "disabled", true ); 
                    }
                   
                    

				},
				error:function()
                {
                    console.log('error')
				}
			});
		});
      
        $(document).on('click','#normalite',function()
        {
            var normalite = $(this).is(':checked');
            var Taille=e=$(this).parent().parent().find('#taille_Periode');
            console.log(normalite);
            if (normalite == true)
                    {
                        console.log(normalite);
                        Taille.prop( "disabled", false ); 
                    }
            else {
                         console.log(normalite);
                         Taille.prop( "checked", false );
                        Taille.prop( "disabled", true ); 
            }
        });
      
        $(document).on('change','.parametre',function()
        {
			var parametre=$(this).val();
            var produit=$(this).parent().parent().parent().parent().parent().find('.produit').val();
            var machine=$(this).parent().parent().parent().parent().parent().find('.machine').val();
            var normalite=$(this).parent().parent().parent().parent().parent().find('#normalite');
            console.log(parametre);
			console.log(produit);
            console.log(machine);
           
			$.ajax(
                { 
				type:'get',
				url:'{{route("cree.Capabilite")}}',
				data:{'DesParametre':parametre, 'IDMachine':machine, 'DesProduit':produit },
                dataType:"json",
				success:function(data)
                {
                    // console.log(data.length);
                    // console.log('seccess')
                    if(data.length == 0) 
                    { console.log(normalite);
                        normalite.prop( "checked", false );
                        normalite.prop( "disabled", true ); 
                    }
				},
				error:function()
                {
                    console.log('error')
				}
			});
		});


        $(document).on('click','#capabilite',function()
        {
            var capabilite = $(this).is(':checked');
            var normalite=$(this).parent().parent().find('#normalite');
            console.log(capabilite);
            console.log(normalite);
            if (capabilite == true)
                    {
                        console.log(capabilite);
                        
                        normalite.prop( "disabled", false ); 
                    }
            else {
                         console.log(capabilite);
                         normalite.prop( "checked", false ); 
                         normalite.prop( "disabled", true ); 

            }
        });
    });
</script>

@endsection
