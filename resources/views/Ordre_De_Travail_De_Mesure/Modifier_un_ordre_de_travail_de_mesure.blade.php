@extends("layouts.Navbar_Sidebar")
@section("contenu")
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
<link rel="stylesheet" href="{{asset('css/ordre de travail de mesure/Modifier_un_ordre_de_travail_de_mesure.css')}}"/>
{{-- modifier Un Ordre De Travail De Mesure --}}
<div class="container" id="modordretravailmes">
    <form action="{{route('OrdereDeMesure.update',['IDOrdreTravailMesure'=>$OTM])}}" method="post">
    {{ method_field('put')}}
        @csrf
        <div class="ajout">
             <!-- @include('sweetalert::alert') -->
            <div class="titre">
                <h2 class="mb-4 modordretravailmestitle">Mdifier<b> Ordre De Travail De Mesure </b></h2>
            </div>

            <div class="info_Generale">
                <div class="line">
                    <div class="col">
                        <div class="titre mt-2">
                            <h6>N° OTM</h6>
                        </div>
                        <div class="champ">
                            <input type="text" name="OTM" value="{{$OTMesure->IDOrdreTravailMesure}}" id='OTM'>
                        </div>
                    </div>
                    <div class="col">
                        <div class="titre mt-2">
                            <h6>Date</h6>
                        </div>
                        <div class="champ">
                            <input type="date" name="date" value="{{$OTMesure->Date}}">                            
                        </div>
                    </div>
                </div>  
                <div class="line">
                    <div class="col">
                        <div class="titre mt-2">
                            <h6>Produit à contrôler</h6>
                        </div>
                        <div class="champ">
                            <input name="produit" id="" class="produit"  value="{{$OTMesure->DesProduit}}" disabled>
                        </div>
                    </div>
                    <div class="col">
                        @if($OTMesure->IDMachine != null )
                        <div class="titre mt-2">
                            <h6 id="machineT">Machine</h6>
                        </div>
                        <div class="champ">
                            <input name="IDMachine" class="machine" id='machineS' value="{{$OTMesure->IDMachine}}" disabled>
                        </div>
                        @endif
                    </div>
                </div> 
                @foreach ($typeMesures as $typeMesure)
                <div class="parametre">
                    <div class="line">
                        <div class="col">
                            @foreach ($avoirParametres as $avoirParametre)
                            <div class="titre mt-2">
                                <h6>Type de mesure</h6>
                            </div>
                            <div class="champ">
                                <input name="DesTypeMesure[]" id="" class="typeMesure"  value="{{$typeMesure->DesTypeMesure}}" disabled>
                            </div>
                            @endforeach
                        </div>
                        <div class="col">
                            <div class="titre mt-2">
                                <h6>Paramètre a mesuré</h6>
                            </div>
                            <div class="champ">
                                <input name="DesParametreMesure[]" class="parametremesure" id='parametre' value="{{$avoirParametre->DesParametreMesure}}" disabled>
                            </div>
                        </div>
                    </div> 
                    <div class="line">
                        <div class="col">
                            <div class="titre mt-2">
                                <h6>Précision</h6>
                            </div>
                            <div class="champ">
                                <input name="DesPrecision[]" class="Desprecision" value="{{$avoirParametre->DesPrecision}}" disabled>
                            </div>
                        </div>
                        <div class="col">
                            <div class="titre mt-2">
                                <h6>Type Outil</h6>
                            </div>
                            <div class="champ">
                                <input name="DesTypeOutil[]" id="" class="typeoutil" value="{{$avoirParametre->DesTypeOutil}}" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <hr>
            @foreach($MethodeValides as $MethodeValide)
            <div class="methodevalide mt-4">
                <div class="line">
                    <div class="col mb-4">
                        <div class="titre mt-2">
                            <h5>ID Bon De Travail :</h5>
                        </div>
                        <div class="champ">
                            <input type="text" name="idmethodevalide[]" value="{{$MethodeValide->IDBVV}}" id="IDBVV" >
                        </div>
                    </div>
                </div>
                <div class="line">
                    <div class="col">
                        <div class="titre">
                            <h6>Tolérance supérieure</h6>
                        </div>
                        <div class="champ">
                            <input type="number" name="TolérenceSup[]" value="{{$MethodeValide->TolérenceSup}}">
                        </div>
                    </div>
                    <div class="col">
                        <div class="titre mt-2">
                            <h6>Tolérance inférieure</h6>
                        </div>
                        <div class="champ">
                            <input type="number" name="TolérenceInf[]" value="{{$MethodeValide->TolérenceInf}}">
                        </div>
                    </div>
                </div>
                <div class="line">
                    <div class="col">
                        <div class="titre mt-2">
                            <h6 id="titre_nbr_p">Nbr prélèvement</h6>
                        </div>
                        <div class="champ">
                            <input type="number" id="champ_nbr_p" name="NbrPrelevement" value="{{$MethodeValide->NbrPrelevement}}">
                        </div>
                    </div>
                    <div class="col">
                    </div>
                </div> 
                <div class="line">
                    <div class="col">
                        <div class="titre mt-2">
                            <h6>Période prélèvement</h6>
                        </div>
                        <div class="champ">
                            <input type="number" name="PeriodePrelevement[]" value="{{$MethodeValide->PeriodePrelevement}}" id="periodevalide">
                            <br><span id="alertperiode" class="alertverif">La valeur du Periode Prelevement doit être <= <span id="valperiodebon"></span></span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="titre mt-2">
                            <h6>Taille d'échantillons</h6>
                        </div>
                        <div class="champ">
                            <input type="number" name="TailleEchantillon[]" value="{{$MethodeValide->TailleEchantillon}}" id="taillevalide">
                            <br><span id="alerttaille" class="alertverif">La valeur du taille echantillon doit être >= <span id="valtaillebon"></span></span>
                        </div>
                    </div>
                </div> 
            </div>
            <hr>
            @endforeach
            <div class="methodenonvalide mt-4">
                @foreach($MethodeNonValideQs as $MethodeNonValideQ)
                <div class="qualitative">
                    <div class="line">
                        <div class="col mb-4">
                            <div class="titre mt-2">
                                <h5>ID Bon De Travail :</h5>
                            </div>
                            <div class="champ">
                                <input type="text" name="idmethodeNVQ[]" value="{{$MethodeNonValideQ->IDBVNV}}" id='IDBVV'>
                            </div>
                        </div>
                    </div>
                    <div class="line">
                        <div class="col">
                            <div class="titre mt-2">
                                <h6 id="Nbr_prélèvementT">Nbr prélèvement</h6>
                            </div>
                            <div class="champ">
                                <input type="number" id="Nbr_prélèvementC" name=NbrPrelevementNVQ[] value="{{$MethodeNonValideQ->NbrPrelevement}}">
                            </div>
                        </div>
                        <div class="col">
                        </div>
                    </div>
                   @foreach($methodes as $methode)
                   @if($methode->IDBVNV == $MethodeNonValideQ->IDBVNV)
                    <div class="critere">
                        <div class="line">
                            <div class="col">
                                <div class="titre mt-2">
                                    <h6>Critére</h6>
                                </div>
                                <div class="champ">
                                    <input name="Critere[]" id="" class="valeurcritere" value="{{$methode->DPM}}" disabled>
                                </div>
                            </div>
                            <div class="col">
                                <div class="titre mt-2">
                                    <h6>Testeur</h6>
                                </div>
                                <div class="champ">
                                    <input name="Testeur[]" id="" value="{{$methode->DesT}}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="line">
                            <div class="col">
                                <div class="titre mt-2">
                                    <h6>Etalon</h6>
                                </div>
                                <div class="champ">
                                    <input name="Etalon[]" id="" class="etalon" value="{{$methode->DTO}}" disabled>
                                  
                                </div>
                            </div>
                            <div class="col">
                                <div class="titre mt-2">
                                    <h6>Précision</h6>
                                </div>
                                <div class="champ">
                                    <input name="DesPrecisionnv[]" class="Desprecisionnv" value="{{$methode->DP}}" disabled>
                                
                                </div>
                            </div> 
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
                <hr/>
                @endforeach
                @foreach( $MethodeNonValideQVs as  $MethodeNonValideQV)
                <div class="quantitativevariablephysique mt-4">
                    <div class="line">
                        <div class="col mb-4">
                            <div class="titre mt-2">
                                <h5>ID Bon De Travail :</h5>
                                </div>
                                <div class="champ">
                                <input type="text" name="idmethodeNVQV[]" value="{{$MethodeNonValideQV->IDBVNV}}" id='IDBVV'>
                            </div>
                        </div>
                    </div>
                    <div class="line">
                        <div class="col">
                            <div class="titre">
                                <h6>Tolérance supérieure</h6>
                            </div>
                            <div class="champ">
                            <input type="number" name="TolérenceSupNV[]" value="{{$MethodeNonValideQV->TolérenceSup}}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="titre mt-2">
                                <h6>Tolérance inférieure</h6>
                            </div>
                            <div class="champ">
                                <input type="number" name="TolérenceInfNV[]" value="{{$MethodeNonValideQV->TolérenceInf}}">
                            </div>
                        </div>
                    </div>
                    <div class="line mb-4">
                        <div class="col">
                            <div class="titre mt-2">
                                <h6 id="NBRT">Nbr prélèvement</h6>
                            </div>
                            <div class="champ">
                                <input type="number" id="NBRC" name="NbrPrelevementNV[]" value="{{$MethodeNonValideQV->NbrPrelevement}}">
                            </div>
                        </div>
                        <div class="col">
                        </div>
                    </div> 
                </div>
                <hr>
                @endforeach
            </div>
            <div class="operateur mt-4">
                <div class="line">
                    <div class="col">
                        <div class="titre mt-2">
                            <h5>Operateur Mesure</h5>
                        </div>
                        <div class="champ">
                            <select name="IDOperateurMesure" id="">
                                <option value="">{{$OTMesure->operateur_qualite_mesure->employe->nom_emp}} {{$OTMesure->operateur_qualite_mesure->employe->prenom_emp}}</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="description">
                    <div class="titre mt-2">
                        <h5>Description</h5>
                    </div>
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name="Description">{{$OTMesure->Description}}</textarea>
                        <label for="floatingTextarea2">Comments</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="boutons mt-5 mb-4"> 
            <button type="submit" role="button" id="titleadd" class="btn" data-toggle="modal"><i class="bi bi-plus-circle-fill"></i><span> Modifier </span></button>
            <a href="{{route('ListeDesOrdresDeTravailDeMesure')}}" id="titledelete" class="btn " data-toggle="modal"><i class="bi bi-dash-circle-fill"></i><span> Annuler</span></a>
        </div>
    </form>
</div>
{{-- Créer Un Ordre De Travail De Mesure --}}
<script  src="{{asset('js/ordre de travail de mesure/Creer_Un_Ordre_De_Travail_De_Mesure.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
<script type="text/javascript">
$(document).ready(function()
    {
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
    });
    </script>
@endsection
