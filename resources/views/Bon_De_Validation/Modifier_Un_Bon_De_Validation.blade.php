@extends("layouts.Navbar_Sidebar")
@section("contenu")
<link rel="stylesheet" href="{{asset('css/bon de validation/Modifier_Un_Bon_De_Validation.css')}}"/>
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
{{-- Modifier Un Ordre De Test De Validation --}}
<div class="container" id="modbonval">
    <form action="{{route('BonValidation.update',['IDBV'=>$BonDeValidation])}}" method="post">
    {{ method_field('put')}}   
    @csrf
        <div class="modifier">
             <!-- @include('sweetalert::alert') -->
            <div class="titre_generale">
                <h2 class="titre_generale mb-4 modbonvaltitle">Modifier<b> Un Bon De Validation</b></h2>
            </div>
            <div class="info_Generale">
                <h3>Information Générale</h3>
                <div class="line">
                    <div class="col">
                        <div class="titre mt-2">
                            <h6>N°Bon validation </h6>
                        </div>
                        <div class="champ">
                            <input type="text" class=""  name='IDBV' value="{{$BonValidations->IDBV}}">
                        </div>
                    </div>
                    <div class="col">
                        <div class="titre mt-2">
                            <h6>Date </h6>
                        </div>
                        <div class="champ">
                            <input type="date" name="Date" value="{{$BonValidations->DateValidation}}">
                        </div>
                    </div>
                </div>
                
                <div class="line">
                    <div class="col">
                        <div class="titre mt-2">
                            <h6>N°Ordre de travail</h6>
                        </div>
                        <div class="champ">
                            <input type="text" name="IDOrdreTravailTestValidation" class="IDOrdre" value="{{$BonValidations->IDOrdreTravailTestValidation}}" disabled>
                            
                        </div>
                    </div>
                    <div class="col">
                        <div class="titre mt-2">
                            <h6>Execution OT </h6>
                        </div>
                        <div class="radiobox mt-1 ms-2">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input mt-1" type="radio" name="ValidationOrdreTravail" id="inlineRadio1" value=true  {{ ($BonValidations->ValidationBonValidation ? 'checked' : '')}}>
                                <label class="form-check-label " for="inlineRadio1">Oui</label>
                            </div>
                            <div class="form-check form-check-inline ms-5">
                                <input class="form-check-input mt-1" type="radio" name="ValidationOrdreTravail" id="inlineRadio2" value=false {{ (($BonValidations->ValidationBonValidation )== false ? 'checked' : '')}}>
                                <label class="form-check-label " for="inlineRadio2">Non</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="line">
                    <div class="col">
                        <div class="titre mt-2">
                            <h6>Produit </h6>
                        </div>
                        <div class="champ">
                            <input type="text" class="produit" value="{{$BonValidations->ordre_travail_test_validation->DesProduit}}" disabled>
                        </div>
                    </div>
                    <div class="col">
                        <div class="titre mt-2">
                            <h6>Paramétre Mesuré </h6>
                        </div>
                        <div class="champ">
                            <input type="text" name="DesParametreMesure" class="parametre" value="{{$BonValidations->ordre_travail_test_validation->DesParametreMesure}}" disabled>
                        </div>
                    </div>
                </div>
                <div class="line">
                    <div class="col">
                        @if($BonValidations->ordre_travail_test_validation->IDMachine != null)
                        <div class="titre mt-2" >
                            <h6 id="machineT">Machine </h6>
                        </div>
                        <div class="champ">
                           <input type="text" class="machine" id="machineS" value="{{$BonValidations->ordre_travail_test_validation->IDMachine}}" disabled >
                        </div>
                        @endif
                    </div>
                </div>
            </div>             
            <div class="Type_de_test">
                <h3>Type du test</h3>
                @if(strstr( $BonValidations->TypeDuTest, 'Capabilite')==true)
                    <div class="line">
                        <div class="form-check form-check-inline">
                            <a href="#" class="btn mt-1" id="eye"><span>Capabilité&nbsp;&nbsp;</span> </a>
                        </div>
                    <div class="col">
                            <div class="titre mt-2">
                                <h6>Validité </h6>
                            </div>
                            <div class="radiobox mt-1 ms-2">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input mt-1" type="radio" name="ValiditeCapabilite" id="inlineRadio1" disabled value=true {{ ($TestCapabilite->Validation ? 'checked' : '')}} >
                                    <label class="form-check-label " for="inlineRadio1">Oui</label>
                                </div>
                                <div class="form-check form-check-inline ms-5">
                                    <input class="form-check-input mt-1" type="radio" name="ValiditeCapabilite" id="inlineRadio2"  disabled value=false  {{ (($TestCapabilite->Validation)== false ? 'checked' : '')}}>
                                    <label class="form-check-label " for="inlineRadio2">Non</label>
                                </div>
                            </div>
                    </div>
                    </div>
                @endif
                @if(strstr( $BonValidations->TypeDuTest, 'Normalite')==true)
                    <div class="line">
                        <div class="form-check form-check-inline">
                            <a href="#" class="btn mt-1" id="eye"><span>Normalité &nbsp;&nbsp;</span> </a>
                        </div>
                        <div class="col">
                            <div class="titre mt-2">
                                <h6>Validité </h6>
                            </div>
                            <div class="radiobox mt-1 ms-2">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input mt-1 valNormalite" type="radio" name="ValiditeNormalite"  disabled id="inlineRadio1" value=true   {{ ($TestNormalite->Validation ? 'checked' : '')}}>
                                    <label class="form-check-label " for="inlineRadio1">Oui</label>
                                </div>
                                <div class="form-check form-check-inline ms-5">
                                    <input class="form-check-input mt-1 valNormalite" type="radio" name="ValiditeNormalite" disabled id="inlineRadio2" value=false   {{ (($TestNormalite->Validation)== false ? 'checked' : '')}}>
                                    <label class="form-check-label " for="inlineRadio2">Non</label>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif 
                @if(strstr( $BonValidations->TypeDuTest, 'Echantillonnage')==true)
                    <div class="line">
                        <div class="form-check form-check-inline">
                            <a href="#" class="btn mt-1" id="eye"><span>Echantillonnage </span> </a>
                        </div>
                        <div class="col">
                            <div class="titre mt-2">
                                <h6>Validité </h6>
                            </div>
                            <div class="radiobox mt-1 ms-2">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input  mt-1 valEchantillonnage" type="radio" name="ValiditeEchantillonnage" disabled id="inlineRadio1 oui" value=true onclick="Validite(1)"  {{ ($TestTaille->Validation ? 'checked' : '')}}>
                                    <label class="form-check-label " for="inlineRadio1">Oui</label>
                                </div>
                                <div class="form-check form-check-inline ms-5">
                                    <input class="form-check-input rodioButton cause mt-1 valEchantillonnage" type="radio" disabled name="ValiditeEchantillonnage" id="inlineRadio2 non" value=false onclick="Validite(0)"  {{ (($TestTaille->Validation)==false ? 'checked' : '')}}>
                                    <label class="form-check-label " for="inlineRadio2">Non</label>
                                </div>
                            </div>
                        </div>
                    </div>   
                </div> 
            @endif
            @if(strstr( $BonValidations->TypeDuTest, 'Capabilite')==true) 
          
                    <div class="Capabilite" id="Capabilite">
                        <h4 class="mb-3">Capabilité</h4>
                        <h5 class="ms-3 mb-4">Opérateurs Confirmés :</h5>
                            <div class="line operateurs">
                            @foreach ($tests as $test)
                            @if($test->IDTestCapabilite == $TestCapabilite->id) 
                                <div class="col">
                                    <div class="titre mt-2">
                                        <h6 id="operateur">Operateur </h6>
                                    </div>
                                    <div class="champ" id="selectoperateur">
                                        <select name="IDOperateurMesure[]" id="sel_operateur" disabled>
                                                <option value="{{$test->IDOperateurMesure}}" selected >
                                                    {{$test->operateur_qualite_mesure->employe->nom_emp}} {{$test->operateur_qualite_mesure->employe->prenom_emp}} 
                                                </option>
                                                
                                        </select>
                                    </div>
                                </div>
                            @endif
                            @endforeach
                                
                            </div>
                        <div class="boutonoperateur">
                            <a href="javascript:;"  class="btnoperateur"><i class="bi bi-plus"></i></a>
                        </div>
                        <h5 class="ms-3 mb-4">Outil Confirmé </h5>
                        <div class="line">
                            <div class="col">
                                <div class="titre mt-2">
                                    <h6>Type Outil </h6>
                                </div>
                                <div class="champ">
                                    <select name="DesTypeOutil" id="" class="type_outil"  disabled>
                                    
                                        <option value="{{$TestCapabilite->DesTypeOutil}}" selected> {{$TestCapabilite->DesTypeOutil}} </option>
                                     
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="titre mt-2">
                                    <h6>Préçision </h6>
                                </div>
                                <div class="champ">
                                    <select name="DesPrecision" id="" class="precision" disabled>
                                        <option value=" {{$TestCapabilite->DesPrecision}}" selected>
                                            {{$TestCapabilite->DesPrecision}}
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <h5 class="ms-3 mb-4">Capabilité mesurée </h5>
                        <div class="line">
                            <div class="col">
                                <div class="titre mt-2">
                                    <h6>Valeur </h6>
                                </div>
                                <div class="champ">
                                    <input type="number" step="any" name="CapabiliteMesure" id="capabilite" class="place1" class="Capabilte"  value="{{$TestCapabilite->CapabiliteMesure}}"onchange="verifCap()">
                                    <br><span id="alert">La valeur du capabilité doit être <= 0.4</span>
                                </div>
                            </div>
                        </div>
                    </div> 
              
            @endif
            @if(strstr( $BonValidations->TypeDuTest, 'Normalite')==true)   
                <div class="Normalite" id="Normalite">
                    <h4 class="mb-3">Normalité</h4>
                    <div class="line">
                        <div class="col">
                            <div class="titre mt-2">
                                <h6>Normalité mesurée </h6>
                            </div>
                            <div class="champ">
                                <input type="number" step="any" name="NormaliteMesure" id="NormaliteMesurer" class="ValeurNormalite" value="{{$TestNormalite->NormaliteMesure}}">
                                <br><span id="alertnormalite">La valeur de la Normalité doit être > <span id="valnormin"></span></span>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
           
            <div class="Echantillonnage" id="Echantillonnage">  
                <h4 class="mb-3">Echantillonnage</h4> 
                <div id="valide">
             @if(strstr( $BonValidations->TypeDuTest, 'Echantillonnage')==true)
                @if($TestTaille->Validation== true)
                    @foreach( $TestTaillePeriodeValides as $TestTaillePeriodeValide )
                        @if($TestTaillePeriodeValide->IDTestTaillePeriode == $TestTaille->id)
                                    <div class="line">
                                        <div class="col">
                                            <div class="titre mt-2">
                                                <h6>Taille </h6>
                                            </div>
                                            <div class="champ">
                                                <input type="number"  step="any" name="Taille" id="nom" class="place1" value="{{$TestTaillePeriodeValide->Taille}}">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="titre mt-2">
                                                <h6>Période </h6>
                                            </div>
                                            <div class="champ">
                                                <input type="number" step="any" name="Periode" id="nom" class="place1" value="{{$TestTaillePeriodeValide->Periode}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif    
                        @endforeach
                @else
                     @foreach( $TestTaillePeriodeNonValides as $TestTaillePeriodeNonValide )
                        @if($TestTaillePeriodeNonValide->IDTestTaillePeriode == $TestTaille->id)                   
                            <div id="nonValide">
                                <div class="line">
                                    <div class="col">
                                        <div class="titre mt-2">
                                            <h6>Taille-max-testé</h6>
                                        </div>
                                        <div class="champ">
                                            <input type="number"  step="any" name="TailleMaxTeste" id="nom" class="place1" value="{{$TestTaillePeriodeNonValide->TailleMaxTeste}}">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="titre mt-2">
                                            <h6>Période-min-testé</h6>
                                        </div>
                                        <div class="champ">
                                            <input type="number" step="any" name="PeriodeMinTeste" id="nom" class="place1" value="{{$TestTaillePeriodeNonValide->PeriodeMinTeste}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="cause non ms-4 mt-4" id="cause">
                                    <h6>Cause de la non validité </h6>
                                    <div class="form-floating">
                                        <textarea class="form-control" name="Cause" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" >{{$TestTaillePeriodeNonValide->Cause}}</textarea>
                                    </div>
                                </div> 
                            </div>  
                      
                        @endif
                    @endforeach    
                @endif
            @endif
            </div>               
        </div>
        <div class="boutons mt-5 mb-4">
            <button type="submit" role="button" id="titleadd" class="btn" data-toggle="modal"><i class="bi bi-plus-circle-fill"></i><span> Modifier</span></button>
            <a href="{{route('ListeDesBonsDeValidation.affiche')}}" id="titledelete" class="btn " data-toggle="modal"><i class="bi bi-dash-circle-fill"></i><span> Annuler</span></a>
        </div>
    </form>
</div>
{{-- Modifier Un Ordre De Test De Validation --}}
<script>
    $('.modifier').on('click','.btnoperateur',function() {
    var line =
                    '<div class="col mt-3">'+
                        '<div class="titre mt-2">'+
                            '<h6 id="operateur">Operateur </h6>'+
                        '</div>'+
                        '<div class="champ" id="selectoperateur">'+
                           ' <select name="IDOperateurMesure[]" id="sel_operateur">'+
                                    '@foreach ($operateurmesures as $operateurmesure)'+
                                    '<option value="{{$operateurmesure->id}}">'+
                                        '{{$operateurmesure->employe->nom_emp}} {{$operateurmesure->employe->prenom_emp}}'+
                                    '</option>'+
                                   '@endforeach'+
                                '</select>'+
                            '<a href="javascript:;" class="btnoperateurdel"><i class="bi bi-dash"></i></a>'+
                        '</div>'+
                    '</div>'; 
      $('.operateurs').append(line);
  });
      $('.modifier').on('click','.btnoperateurdel',function(){
         $(this).parent().parent().remove();
     });
</script>
<script  src="{{asset('js/bon de validation/Modifier_Un_Bon_De_Validation.js')}}"></script>
{{-- *********************************les contrôles avec ajax************************************************* --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function()
    {
/**************************************************dependance machine produit et parametre et précision ******************************************************************/
		$(document).on('change','.IDOrdre',function()
        {
			var id_ordre=$(this).val();
			var div=$(this).parent().parent().parent().parent();
            var div1=$(this).parent().parent().parent().parent().parent();
            var op='';
            var op1='';
			$.ajax(   
            {
				type:'get',
				url:'{{route("Cree.findinformation")}}',
				data:{'id':id_ordre},
                dataType:"json",
				success:function(data)
                {
                    div.find('.produit').val(data.DesProduit);
                   
                    div.find('.parametre').val(data.DesParametreMesure);
                    op='<option value="'+data.DesTypeOutil+'"selected>'+data.DesTypeOutil+'</option>';
                    op1='<option value="'+data.DesPrecision+'"selected>'+data.DesPrecision+'</option>';
                    div1.find('.type_outil').append(op);
                    div1.find('.precision').append(op1);
                    if(data.IDMachine != null)
                    {
                        div.find('.machine').val(data.IDMachine);
                    }
                    else
                    {
                        div.find('#machineS').css('display','none');
                         div.find('#machineT').css('display','none');
                    }
				},
				error:function()
                {
                    console.log('error');
				}
			});
		});
/**************************************************dependance type outil******************************************************************/
        $(document).on('change','.IDOrdre',function()
        {
			var id_ordre=$(this).val();
            var div=$(this).parent().parent().parent().parent().parent();
            var op='';
			$.ajax(   
            {
				type:'get',
				url:'{{route("Cree.findTypeOutil")}}',
				data:{'id':id_ordre},
                dataType:"json",
				success:function(data)
                {
                    for(var i=0;i<data.length;i++)
                    {
                        op+='<option value="'+data[i].DesTypeOutil+'">'+data[i].DesTypeOutil+'</option>';
				    }
                    div.find('.type_outil').append(op);
				},
				error:function()
                {
                    console.log('error');
				}
			});
		});
 /********************************************dependance precision***************************************************/
        $(document).on('change','.type_outil',function()
        {
			var type_outil=$(this).val();
            var parametre=$(this).parent().parent().parent().parent().parent().find('.parametre').val();
			var div=$(this).parent().parent().parent();
            var op=' ';
			$.ajax(   
            {
				type:'get',
				url:'{{route("Cree.findprecision")}}',
				data:{'id':type_outil,'par':parametre},
                dataType:"json",
				success:function(data)
                { 
					for(var i=0;i<data.length;i++){
					op+='<option value="'+data[i].DesPrecision+'">'+data[i].DesPrecision+'</option>';
				   }
                   div.find('.precision').html(" ");
				   div.find('.precision').append(op);
				},
				error:function()
                {
                    console.log('error');
				}
			});
		});
        /********************************************contrôle sur checkbox normalite***************************************************/
        $(document).on('change','.IDOrdre',function()
        {
			var id=$(this).val();
            var Normalite=$(this).parent().parent().parent().parent().parent().find('#ValeurNormalite');
            var ValiditeNormalite=$(this).parent().parent().parent().parent().parent().find('.valNormalite');
			$.ajax(
                { 
				type:'get',
				url:'{{route("cree.NormaliteOT")}}',
				data:{'id':id },
                dataType:"json",
				success:function(data)
                {
                    if(data.length == 0) 
                    { 
                        Normalite.prop( "checked", false );
                        Normalite.prop( "disabled", true ); 
                        ValiditeNormalite.prop( "checked", false );
                        ValiditeNormalite.prop( "disabled", true ); 
                    }
				},
				error:function()
                {
                    console.log('error');
				}
			});
		});
        /********************************************contrôle sur checkbox Echantillonnage ***************************************************/
        $(document).on('change','.IDOrdre',function()
        {
			var id=$(this).val();
            var Echantillonnage=$(this).parent().parent().parent().parent().parent().find('#ValeurEchantillonnage');
            var ValiditeEchantillonnage=$(this).parent().parent().parent().parent().parent().find('.valEchantillonnage');
			$.ajax(
                { 
				type:'get',
				url:'{{route("cree.EchantillonnageOT")}}',
				data:{'id':id },
                dataType:"json",
				success:function(data)
                {
                    if(data.length == 0) 
                    { 
                        Echantillonnage.prop( "checked", false );
                        Echantillonnage.prop( "disabled", true ); 
                        ValiditeEchantillonnage.prop( "checked", false );
                        ValiditeEchantillonnage.prop( "disabled", true ); 
                    }
				},
				error:function()
                {
                    console.log('error')
				}
			});
		});

// *************************************************contrôle sur normalité*************************************************************/
        $(document).on('change','#NormaliteMesurer',function()
        {
			var id=$(this).parent().parent().parent().parent().parent().find(".IDOrdre").val();
            var normalite= parseFloat($(this).val());
            var normalite_mesure=$(this);
            var btn=$(this).parent().parent().parent().parent().parent().parent().find("#titleadd");
            var alert =$(this).parent().find("#alertnormalite");
            var val=$(this).parent().find("#valnormin");

			$.ajax(
                { 
				type:'get',
				url:'{{route("cree.FindNormaliteMinimale")}}',
				data:{'id':id },
                dataType:"json",
				success:function(data)
                {
                    var valnormalitemin = parseFloat(data.ValeurNormalite);
                   
                    if (normalite < valnormalitemin)
                    {
                        normalite_mesure.css("border-color","red");
                        alert.css('display','block');
                        btn.prop("disabled",true);  
                        val.html(valnormalitemin);
                    }
                    else
                    {
                        normalite_mesure.css("border-color","rgb(80, 79, 79)");
                        alert.css('display','none');
                        btn.prop( "disabled", false );   
                    }
				},
				error:function()
                {
                    console.log('error')
				}
			});
		});
       
    });
</script>


@endsection