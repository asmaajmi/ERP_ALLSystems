<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bon de validation</title>
    <style>
        *{
            margin: 0 0;
            padding: 0 0;
        }
        table{
            width: 95%;
            padding-left: 20px;
            padding-right: 20px;
            padding-top: 25px;
            padding-bottom: 25px;
            margin: 2.5%;
        }
        table tr td{
            width: 230px;
            padding-top: 10px;
        }
    
        .line1 h4{
         display: inline;
        }
        .date{
            max-width: 120px;
        }
        .VOT{
            max-width: 150px;
        }
        .titre{
            text-align: center;
        }
        #titre{
            font-size: 28px;
        }
        h3{
            padding-bottom: 20px;
        }
        h5{
            margin-left:25px;
            font-size: 16px;
        }
        .couleur{
            color:#3F1F2A;
        }
        #operateur{
            margin-left:230px;
        }
        #ligne{
            border-top: #000 solid 1px;
            width: 80%;
            margin-left: 10%;
            padding-bottom: 15px;
        }
        #stitre{
            padding-left: 15px;
        }
        #soustitre
        {
            font-size: larger;
        }
        .cause
        {
            margin-left: 15px;
            border: #000 solid 1px;
            padding: 5px 5px ;
            }
        .Signature{
            max-width: 120px;
        }
        #Signature{
            padding-top: 10px;
        
            padding-right: 40px;
        }
       
    </style>
</head>
<body>
    <div class="container">
        @foreach ($BonDeValidations as $BonDeValidation)
        <table>
            <tr class="line1">
                <td colspan="3">
                    <h4>N°BV :</h4>
                    <span>{{$BonDeValidation->IDBV}}</span>
                </td>
                <td class="date">
                    <h4>Date :</h4>
                    <span>{{$BonDeValidation->DateValidation}}</span>
                </td>
            </tr>
            <tr class="titre">
                <td colspan="4"><h3 id="titre">Bon de validation</h3></td>
            </tr>
            <tr class="line1">
                <td colspan="3">
                    <h4>N°OT :</h4>
                    <span>{{$BonDeValidation->IDOrdreTravailTestValidation}}</span>
                </td>
                <td class="VOT">
                    <h4>Validité OT :</h4>
                        @if($BonDeValidation->ValidationOrdreTravail == 1) <span>Valide</span>
                        @else <span>Non valide</span>
                        @endif
                </td>
            </tr>
            <tr>
                <td><h4>Produit :</h4></td>
                <td colspan="3"><span>{{$BonDeValidation->ordre_travail_test_validation->DesProduit}}</span></td>
            </tr>
            <tr>
                <td><h4>Machine :</h4></td>
                <td colspan="3"><span>{{$BonDeValidation->ordre_travail_test_validation->IDMachine}}</span></td>
            </tr>
            <tr>
                <td><h4>Paramêtre mesuré :</h4></td>
                <td colspan="3"><span>{{$BonDeValidation->ordre_travail_test_validation->DesParametreMesure}}</span></td>
            </tr>
            <tr>
                <td colspan="4"><h4 id="soustitre">Type de test :</h4></td>
            </tr>
            @if(strstr( $BonDeValidation->TypeDuTest, 'Capabilite')==true)
                <tr>
                    <td><h4 id="stitre">Capabilité :</h4></td>
                    <td colspan="3">
                        @foreach ($capabilites as $capabilite)
                            @if($capabilite->Validation == 1) <span>Valide</span>
                                @else <span>Non valide</span>
                            @endif
                        @endforeach
                    </td>
                </tr>
            @endif
            @if(strstr( $BonDeValidation->TypeDuTest, 'Normalite')==true)
            <tr>
                <td><h4 id="stitre">Normalité :</h4></td>
                <td colspan="3">
                    @foreach ($normalites as $normalite)
                        @if($normalite->Validation == 1) <span>Valide</span>
                            @else <span>Non valide</span>
                        @endif
                    @endforeach
                </td>
            </tr>
            @endif
            @if(strstr( $BonDeValidation->TypeDuTest, 'Echantillonnage')==true)
                <tr>
                    <td><h4 id="stitre">Echantillonnage :</h4></td>
                    <td colspan="3">
                        @foreach ($taille_periodes as $taille_periode)
                            @if($taille_periode->Validation == 1) <span>Valide</span>
                                @else <span>Non valide</span>
                            @endif
                        @endforeach
                    </td>
                </tr>
            @endif
            {{--  --}}
            {{-- <tr>
                <td><h4 id="soustitre">ID Bon Validée :</h4></td>
                <td colspan="3"><span>1236</span></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="3"><span>1472</span></td>
            </tr> --}}
            {{--  --}}
            <tr>
                <td colspan="4"><div id="ligne"></div></td>
            </tr>
            @if(strstr( $BonDeValidation->TypeDuTest, 'Capabilite')==true)
            <tr>
                <td colspan="4"><h4 id="soustitre">Capabilité :</h4></td>
            </tr>
            <tr>
                <td colspan="4"><h4 id="stitre" class="couleur">Opérateurs Confirmés :</h4></td>
            </tr>
            <tr>
                <td colspan="4">
                    @foreach ($capabilites as $capabilite)
                        @foreach ($capabilite->test_capabilite_operateur_mesures as $test_capabilite_operateur_mesure)
                            <span id="operateur">{{$test_capabilite_operateur_mesure->operateur_qualite_mesure->employe->nom_emp}} 
                                {{$test_capabilite_operateur_mesure->operateur_qualite_mesure->employe->prenom_emp}}
                                <br>
                            </span>
                        @endforeach
                    @endforeach
                </td>
            </tr>
            <tr>
                <td colspan="4"><h4 id="stitre" class="couleur">Outil Confirmé :</h4></td>
            </tr>
            <tr>
                <td>
                    <h5 id="stitre">Type_Outil :</h5>
                </td>
                <td colspan="3">
                    @foreach ($capabilites as $capabilite)
                    <span>
                        {{$capabilite->DesTypeOutil}}
                    </span>
                    @endforeach
                </td>
            </tr>
            <tr>
                <td><h5 id="stitre">Préçision :</h5></td>
                <td colspan="3">
                    @foreach ($capabilites as $capabilite)
                    <span>
                        {{$capabilite->DesPrecision}}
                    </span>
                    @endforeach
                </td>
            </tr>
            <tr>
                <td><h4 id="stitre" class="couleur">Capabilité mesuré :</h4></td>

                <td colspan="3">
                    @foreach ($capabilites as $capabilite)
                    <span>
                        {{$capabilite->CapabiliteMesure}}
                    </span>
                    @endforeach
                </td>
            </tr>
            @endif
            @if(strstr( $BonDeValidation->TypeDuTest, 'Normalite')==true)
            <tr>
                <td colspan="4"><h4 id="soustitre">Normalité :</h4></td>
            </tr>
            <tr>
                <td><h4 id="stitre" class="couleur">Normalité mesuré :</h4></td>
                <td colspan="3">
                    @foreach ($normalites as $normalite)
                    <span> {{$normalite->NormaliteMesure}}</span>
                    @endforeach
                </td>
            </tr>
            @endif
            @if(strstr( $BonDeValidation->TypeDuTest, 'Echantillonnage')==true)
            <tr>
                <td colspan="4"><h4 id="soustitre">Echantillonnage :</h4></td>
            </tr>
            <tr>
                <td><h4 id="stitre" class="couleur">Taille mesuré :</h4></td>
                <td colspan="3">
                    @foreach ($taille_periodes as $taille_periode)
                    <span>
                        @if($taille_periode->Validation ==1) 
                        @foreach ($taille_periodes_valides as $taille_periodes_valide)
                            {{$taille_periodes_valide->Taille}}
                        @endforeach
                        @else
                        @foreach ($taille_periodes_non_valides as $taille_periodes_non_valide)
                            {{$taille_periodes_non_valide->TailleMaxTeste}}
                        @endforeach
                        @endif
                    </span>
                    @endforeach
                </td>
            </tr>
            <tr>
                <td><h4 id="stitre" class="couleur">Période mesuré :</h4></td>
                <td colspan="3">
                    @foreach ($taille_periodes as $taille_periodes)
                    <span>
                        @if($taille_periodes->Validation ==1) 
                        @foreach ($taille_periodes_valides as $taille_periodes_valide)
                            {{$taille_periodes_valide->Periode}}
                        @endforeach
                        @else
                        @foreach ($taille_periodes_non_valides as $taille_periodes_non_valide)
                            {{$taille_periodes_non_valide->PeriodeMinTeste}}
                        @endforeach
                        @endif
                    </span>
                    @endforeach
                </td>
            </tr>
            @if($taille_periode->Validation == 0) 
            <tr>
                <td colspan="4"><h4 id="stitre" class="couleur">Cause de la non Validité :</h4></td>
            </tr>
            <tr>
                <td colspan="4">
				<div class="cause">
				<span>
                    @foreach ($taille_periodes_non_valides as $taille_periodes_non_valide)
                    {{$taille_periodes_non_valide->Cause}}
                @endforeach
				</span>
				</div>
				</td>
            </tr>
            @endif
            @endif
            <tr>
                <td colspan="3"><span></span></td>
                <td class="Signature"><h4 id="Signature">Signature</h4></td>
            </tr>
        </table>
        @endforeach
    </div>
</body>
</html>