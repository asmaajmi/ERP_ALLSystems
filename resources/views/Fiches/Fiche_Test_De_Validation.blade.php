<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiche de test de validation</title>
<style>
	*{
		margin: 0 0;
		padding: 0 0;
	}
	table{
		/* border: #000 solid 1px; */
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
	.titre{
		text-align: center;
	}
	#titre{
		font-size: 28px;
	}
	h3{
		padding-bottom: 50px;
	}
	#ligne{
		border-top: #000 solid 1px;
		width: 80%;
		margin-left: 10%;
		padding-bottom: 15px;
	}
	#echantillon{
		padding-left: 15px;
	}
	#soustitre
	{
		font-size: larger;
	}
	.description
	{
		border: #000 solid 1px;
		padding: 10px 10px ;
		}
    .Signature{
        max-width: 120px;
    }
	#Signature{
		padding-top: 20px;
	
		padding-right: 40px;
	}
   
</style>
</head>
<body>
    <div class="container">
        @foreach ($ordretravailtestvalidations as $ordretravailtestvalidation)
        <table>
            <tr class="line1">
                <td colspan="3" >
                    <h4>N°OT :</h4>
                    <span>{{$ordretravailtestvalidation->IDOTTV}}</span>
                </td>
                <td class="date">
                    <h4>Date :</h4>
                    <span>{{$ordretravailtestvalidation->DateOrdreTestValidation}}</span>
                </td>
            </tr>
            <tr class="titre">
                <td colspan="4"><h3 id="titre">Fiche de test de validation</h3></td>
            </tr>
            <tr>
                <td><h4>Produit à contrôler :</h4></td>
                <td colspan="3"><span>{{$ordretravailtestvalidation->DesProduit}}</span></td>
            </tr>
            <tr>
                <td><h4>Machine :</h4></td>
                <td colspan="3"><span>{{$ordretravailtestvalidation->IDMachine}}</span></td>
            </tr>
            <tr>DesTypeMesure
                <td><h4>Type de mesure :</h4></td>
                <td colspan="3"><span>{{$ordretravailtestvalidation->DesTypeMesure}}</span></td>
            </tr>
            <tr>
                <td><h4>Paramétre à mesurer :</h4></td>
                <td colspan="3"><span>{{$ordretravailtestvalidation->DesParametreMesure}}</span></td>
            </tr>
            <tr>
                <td><h4>Préçision :</h4></td>
                <td colspan="3"><span>{{$ordretravailtestvalidation->DesPrecision}}</span></td>
            </tr>
            <tr>
                <td><h4>Type d'outil à utiliser :</h4></td>
                <td colspan="3"><span>{{$ordretravailtestvalidation->DesTypeOutil}}</span></td>
            </tr>
            <tr>
                <td><h4>Responsable Qualité :</h4></td>
                <td colspan="3"><span >{{$ordretravailtestvalidation->responsable_qualite->employe->nom_emp}} {{$ordretravailtestvalidation->responsable_qualite->employe->prenom_emp}}</span></td>
            </tr>
            <tr>
                <td colspan="4"><div id="ligne"></div></td>
            </tr>
            <tr>
                <td><h4 id="soustitre">Objectif(s) :</h4></td>
                <td colspan="3"><span>{{$ordretravailtestvalidation->Objectif}}</span></td>
            </tr>
            @foreach($capabilites as $capabilite)
            <tr>
                <td><h4>Capabilité minimale :</h4></td>
                <td colspan="3">
                    <span>{{$capabilite->CapabiliteMinimale}} </span>
                </td>
            </tr>
            @endforeach
            @foreach($normalites as $normalite)
            <tr>
                <td><h4>Valeur de la normalité :</h4></td>
                <td colspan="3"> 
                    <span>{{$normalite->ValeurNormalite}} </span>
                </td>
            </tr>
            @endforeach
            @foreach($taille_periodes as $taille_periode)
                <tr>
                    <td colspan="4"><h4 id="soustitre">Taille d'échantillon :</h4></td>
                </tr>
                <tr>
                    <td><h4 id="echantillon">Taille-min-échantillon :</h4></td>
                    <td colspan="3">
                        <span>{{$taille_periode->TailleMinimale}} </span>
                    </td>
                </tr>
                <tr>
                    <td><h4 id="echantillon">Taille-max-échantillon :</h4></td>
                    <td colspan="3">
                        <span>{{$taille_periode->TailleMaximale}} </span>
                    </td>
                </tr>
                <tr>
                    <td colspan="4"><h4 id="soustitre">Période d'échantillonnage :</h4></td>
                </tr>
                <tr>
                    <td><h4 id="echantillon">Période-min-échantillonnage :</h4></td>
                    <td colspan="3">
                        <span>{{$taille_periode->PeriodeMinimale}} </span>
                    </td>
                </tr>
                <tr>
                    <td><h4 id="echantillon">Période-max-échantillonnage :</h4></td>
                    <td colspan="3">
                        <span>{{$taille_periode->PeriodeMaximale}} </span>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="4"><h4 id="soustitre">Description :</h4></td>
            </tr>
            <tr>
                <td colspan="4">
				<div class="description">
                    <span>{{$ordretravailtestvalidation->Description}}</span>
				</div>
				</td>
            </tr>
            <tr>
                <td colspan="3"><span></span></td>
                <td class="Signature"><h4 id="Signature">Signature</h4></td>
            </tr>
        </table>
        @endforeach
    </div>
</body>
</html>