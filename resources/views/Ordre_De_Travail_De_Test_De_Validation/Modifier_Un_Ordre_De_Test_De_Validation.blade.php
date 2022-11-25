@extends("layouts.Navbar_Sidebar")
@section("contenu")
<link rel="stylesheet" href="{{asset('css/ordre de travail de test de validation/Modifier_Un_Ordre_De_Test_De_Validation.css')}}"/>
{{-- Créer Un Ordre De Test De Validation --}}
<div class="container" id="modordretestval">
    <form action="{{route('UnOrdreDeTravailDeTestDeValidation.update',['IDOTTV'=>$ordretravailtestvalidation])}}" method="post">
        {{ method_field('put')}}
        @csrf
        <div class="Modifier">
            @include('sweetalert::alert')
            @foreach ($ordretravailtestvalidations as $ordretravailtestvalidation)
                <div class="titre">
                    <h2 class="mb-4 modordretestvaltitle">Modifier<b> Order De Test De Validation</b></h2>
                </div>
                <div class="info_Generale">
                    <h4 class="mb-3 mt-4">Information Générale</h4>
                    <div class="line ms-2">
                    <div class="col">
                        <div class="titre mt-2">
                            <h5>N°OT</h5>
                        </div>
                        <div class="champ">
                            <input type="text" name="IDOTTV" id="" value="{{$ordretravailtestvalidation->IDOTTV}}">
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
                                    @foreach ($responsablequalites as $responsablequalite)
                                        @if ($ordretravailtestvalidation->IDResponsable == $responsablequalite->id)
                                            <option value="{{$responsablequalite->id}}" selected>
                                                {{$responsablequalite->employe->nom_emp}} {{$responsablequalite->employe->prenom_emp}}
                                            </option>
                                        @else
                                            <option value="{{$responsablequalite->id}}">
                                                {{$responsablequalite->employe->nom_emp}} {{$responsablequalite->employe->prenom_emp}}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="titre mt-2">
                                <h5>Date </h5>
                            </div>
                            <div class="champ">
                            <input type="date" name="DateOrdreTestValidation" id="" value="{{$ordretravailtestvalidation->DateOrdreTestValidation}}">
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
                                <select name="DesProduit" class="produit" disabled>       
                                    @foreach ($produits as $produit)
                                        @if ($ordretravailtestvalidation->DesProduit ==  $produit->DesProduit)
                                            <option value="{{$produit->DesProduit}}" selected>
                                            {{$produit->DesProduit}}
                                            </option>
                                        @else
                                        <option value="{{$produit->DesProduit}}" >
                                            {{$produit->DesProduit}}
                                            </option>
                                        @endif
                                    @endforeach   
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            
                                <div class="titre mt-2">
                                    <h5 id="machineT">Machine</h5>
                                </div>
                                <div class="champ">
                                    <select name="IDMachine" class='machine'id="machineS" disabled>
                                        @foreach ($machines as $machine)
                                            @if ($ordretravailtestvalidation->IDMachine == $machine->DesMachine)
                                                 <option value="{{$machine->DesMachine}}" selected>
                                                     {{$machine->DesMachine}}
                                                </option>     
                                            @endif
                                        @endforeach 
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
                                <select name="DesTypeOutil" class="typeOutil" disabled>
                                   
                                @foreach ( $type_outils as  $type_outil )
                                    @if ($ordretravailtestvalidation->DesTypeOutil == $type_outil->DesTypeOutil)
                                    <option value="{{ $type_outil->DesTypeOutil}}" selected>
                                        {{ $type_outil->DesTypeOutil}}
                                    </option>
                                    @else
                                        <option value="{{ $type_outil->DesTypeOutil}}">
                                            {{ $type_outil->DesTypeOutil}}
                                        </option>
                                     @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="titre mt-2">
                                <h5 class="line1">Paramétre</h5>
                            </div>
                            <div class="champ">
                                <select name="DesParametreMesure" class="parametre" disabled>
                                    @foreach ($parametre_mesures as $parametre_mesure)
                                        @if ($ordretravailtestvalidation->DesParametreMesure ==$parametre_mesure->DesParametreMesure)
                                            <option value="{{$parametre_mesure->DesParametreMesure}}" selected>
                                                 {{$parametre_mesure->DesParametreMesure}}
                                            </option>
                                        @endif
                                    @endforeach
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
                                <select name="DesTypeMesure" class="typeMesure" disabled>
                                @foreach ($type_mesures as $type_mesure)
                                    @if ($ordretravailtestvalidation->DesTypeMesure == $type_mesure->DesTypeMesure)
                                        <option value="{{$type_mesure->DesTypeMesure}}">
                                        {{$type_mesure->DesTypeMesure}}
                                        </option>
                                    @endif
                                 @endforeach
                                </select>
                            </div> 
                        </div>
                        <div class="col">
                            <div class="titre mt-2">
                                <h5 class="line2">Préçision</h5>
                            </div>
                            <div class="champ">
                                <select name="DesPrecision" class="Desprecision" disabled>
                                @foreach ($precisions as $precision)
                                @if ($ordretravailtestvalidation->DesPrecision == $precision->DesPrecision)
                                    <option value=" {{$precision->DesPrecision}}" selected>
                                        {{$precision->DesPrecision}}
                                    </option>
                                @endif
                                 @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>  
            
                <div class="Objectif">
                    <h4 class="champobj mb-3 mt-4">Objectif </h4>
                    
                </div>  
                    @if(strstr( $objectif, 'Capabilite')==true)
                    <div class="Test_Capabilité" id="Capabilite">
                        <h4 class="mb-3 mt-4">Test Capabilité</h4>
                        <div class="line ms-2">
                            <div class="col">
                                <div class="titre mt-2">
                                    <h5>valeur minimale</h5>
                                </div>
                                <div class="champ">
                                        @foreach ($capabiltes as $capabilte )
                                        <input type="text" name="CapabiliteMinimale" id="nom" class="place1" value="{{$capabilte->CapabiliteMinimale}}">
                                        @endforeach
                                </div>
                            </div>
                        </div>
                    </div>  
                    @endif
                    @if(strstr( $objectif, 'Normalite')==true)
                    <div class="Test_Normalité" id="Normalite">
                        <h4 class="mb-3 mt-4">Test Normalité</h4>
                        <div class="line ms-2">
                            <div class="col">
                                <div class="titre mt-2">
                                    <h5>Valeur</h5>
                                </div>
                                <div class="champ">
                                    
                                        @foreach ($normalites as $normalite)
                                        <input type="text" name="ValeurNormalite" id="nom" class="place1" value="{{$normalite->ValeurNormalite}}">
                                        @endforeach
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                 @if(strstr( $objectif, 'Taille_Periode')==true)
                 @foreach ($taille_periodes as $taille_periode)
                <div class="Taille_Periode" id="Taille_Periode">  
                    <div class="periode">
                        <h4 class="mb-3 mt-4">Periode d'echentillonage</h4>
                        <div class="line ms-2">
                            <div class="col">
                                <div class="titre mt-2">
                                    <h5>minimale</h5>
                                </div>
                                <div class="champ">
                                    
                                        <input type="text" name="PeriodeMinimale" id="nom" class="place1"value="{{$taille_periode->PeriodeMinimale}}">
                                       
                                </div>
                            </div>
                            <div class="col">
                                <div class="titre mt-2">
                                    <h5>maximale</h5>
                                </div>
                                <div class="champ">
                                    
                                        <input type="text" name="PeriodeMaximale" id="nom" class="place1" value="{{$taille_periode->PeriodeMaximale}}">
                                     
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="Taille">
                        <h4 class="mb-3 mt-4">Taille d'echentillion</h4>
                        <div class="line ms-2">
                            <div class="col">
                                <div class="titre mt-2">
                                    <h5>minimale</h5>
                                </div>
                                <div class="champ">
                                   
                                        <input type="text" name="TailleMinimale" id="nom" class="place1"value="{{$taille_periode->TailleMinimale}}">
                                    
                                </div>
                            </div>
                            <div class="col">
                                <div class="titre mt-2">
                                    <h5>maximale</h5>
                                </div>
                                <div class="champ">
                                 
                                      
                                        <input type="text" name="TailleMaximale" id="nom" class="place1" value="{{$taille_periode->TailleMaximale}}">
                                      
                                    
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
                @endforeach
                @endif
                <div class="Description">
                    <h4 class="mb-3 mt-4">Description</h4>
                    <div class="line_des ms-2">
                        <div class="form-floating">
                                <textarea class="form-control" name="Description" id="floatingTextarea2" style="height: 100px">
                                    {{$ordretravailtestvalidation->Description}}
                                </textarea>
                        </div>
                    </div>
                </div>                    
            </div>
        @endforeach
        <div class="boutons mt-5 mb-4">
            <button type="submit" role="button" id="titleadd" class="btn" data-toggle="modal"><i class="bi bi-plus-circle-fill"></i><span> Modifier</span></button>
            <a href="{{route('ListeDesOrdresDeTestDeValidation')}}" id="titledelete" class="btn " data-toggle="modal"><i class="bi bi-dash-circle-fill"></i><span> Annuler</span></a>
        </div>
    </form>
</div>
{{-- Créer Un Ordre De Test De Validation --}}
<script  src="{{asset('js/ordre de travail de test de validation/Modifier_Un_Ordre_De_Test_De_Validation.js')}}"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

 <script type="text/javascript">

	$(document).ready(function()
    {

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

       
       
    });
</script>

@endsection
