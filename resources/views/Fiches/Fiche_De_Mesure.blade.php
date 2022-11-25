<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="FicheDeTestDeValidation.css"> -->
    <title>Document</title>
	<style>
	*{
		margin: 0 0;
		padding: 0 0;
	}
	table {
	
		width: 95%;
		padding-left: 20px;
		padding-right: 20px;
		margin: 2.5%;
	}
    table tr td,table tr th{
        width: 230px;
	    padding-top: 15px;
    }
  
    .tab1 tr td,.tab1 tr th{
        border:1px #000  solid;
        padding-top: 0px;
        width: 150px;
	}
    .tab1 {
    width: 90%;
    border-collapse: collapse;
    margin-left: 5%;
    margin-right: 5%;
    }   
    .mar{
        padding-left: 5px;
        padding-right: 5px;
    }
	.line1 h4{
	 display: inline;
	}
	.date{
        width: 100px;
	}
	.titre{
		text-align: center;
	}
	#titre{
		font-size: 28px;
	}
	h3{
        padding-bottom: 10px;
	}
	#ligne{
		border-top: #000 solid 1px;
		width: 80%;
		margin-left: 10%;
		padding-bottom: 15px;
	}
	.description
	{
		border: #000 solid 1px;
		padding: 30px 30px ;
		}
	
	#Signature{
		padding-top: 50px;
		padding-bottom: 60px;
		padding-right: 40px;
        width: 40px;
        margin-left:150px;
	}
	</style>
</head>
<body>
    <div class="container">
        <table>
            <tr class="line1">
                <td>
                    <h4>N°OTM :</h4>
                    <span>{{$OTMesure->IDOrdreTravailMesure}}</span>
                </td>
                <td></td>
                <td class="date">
                    <h4>Date :</h4>
                    <span>{{$OTMesure->Date}}</span>
                </td>
            </tr>
            <tr class="titre">
                <td colspan="3"><h3 id="titre">Ordre de travail de mésure</h3></td>
            </tr>
            <tr>
                <td><h4>Produit :</h4></td>
                <td colspan="2"><span>{{$OTMesure->DesProduit}}</span></td>
            </tr>
            <tr>
                <td><h4>Machine :</h4></td>
                <td colspan="2"><span>{{$OTMesure->IDMachine}}</span></td>
            </tr>
            <tr>
                <td><h4>Opérateur Mesure :</h4></td>
                <td colspan="2"><span>{{$OTMesure->operateur_qualite_mesure->employe->nom_emp}} {{$OTMesure->operateur_qualite_mesure->employe->prenom_emp}}</span></td>
            </tr>
        </table>
        <table class="tab1">
            <tr>
                <th>Type mesure</th>
                <th>Paramètre</th>
                <th>Précision</th>
                <th>Type outil</th>
            </tr>
            @foreach($avoirParametres as $avoirParametre)
            <tr>
             @foreach($parametreMesures as $parametre)
                @if($parametre->DesParametreMesure == $avoirParametre->DesParametreMesure )
                <td class="mar">{{$parametre->DesTypeMesure}}</td>
               @endif
            @endforeach
                <td class="mar">{{$avoirParametre->DesParametreMesure}}</td>
                <td class="mar">{{$avoirParametre->DesPrecision}}</td>
                <td class="mar">{{$avoirParametre->DesTypeOutil}}</td>
            </tr>
            @endforeach
        </table>
        <table>
            @foreach($MethodeValides as $MethodeValide)
            <tr>
                <td colspan="3"><h3>Methode valide</h3></td>
            </tr>
            <tr>
                <td>
                    <h4>N°Bon de validation :</h4>
                </td>
                <td colspan="2">
                    <span>{{$MethodeValide->IDBVV}}</span>
                </td>
            </tr>
            
            <tr>
                <td><h4>Tolérence-Sup :</h4></td>
                <td colspan="2"><span>{{$MethodeValide->TolérenceSup}}</span></td>
            </tr>
            <tr>
                <td><h4>Tolérence-Inf :</h4></td>
                <td colspan="2"><span>{{$MethodeValide->TolérenceInf}}</span></td>
            </tr>
            <tr>
                <td><h4>Genre-prélévement :</h4></td>
                <td colspan="2"><span>{{$MethodeValide->GenrePrelevement}}</span></td>
            </tr>
            <tr>
                <td><h4>Nbr-prélévement :</h4></td>
                <td colspan="2"><span>{{$MethodeValide->NbrPrelevement}}</span></td>
            </tr>
            <tr>
                <td><h4>Période-prélévement :</h4></td>
                <td colspan="2"><span>{{$MethodeValide->PeriodePrelevement}}</span></td>
            </tr>
            <tr>
                <td><h4>Taille-d'échantillont :</h4></td>
                <td colspan="2"><span>{{$MethodeValide->TailleEchantillon}}</span></td>
            </tr>
            @endforeach
            @foreach( $MethodeNonValideQVs as  $MethodeNonValideQV)
            <tr>
                <td colspan="3"><h3>Methode non valide: Variable-Physique/Quantitative</h3></td>
            </tr>
            <tr>
                <td>
                    <h4>N°Bon de validation :</h4>
                </td>
                <td colspan="2">
                    <span>{{$MethodeNonValideQV->IDBVNV}}</span>
                </td>
            </tr>
            <tr>
                <td><h4>Tolérence-Sup :</h4></td>
                <td colspan="2"><span>{{$MethodeNonValideQV->TolérenceSup}}</span></td>
            </tr>
            <tr>
                <td><h4>Tolérence-Inf :</h4></td>
                <td colspan="2"><span>{{$MethodeNonValideQV->TolérenceInf}}</span></td>
            </tr>
            <tr>
                <td><h4>Genre-prélévement :</h4></td>
                <td colspan="2"><span>{{$MethodeNonValideQV->GenrePrelevement}}</span></td>
            </tr>
            <tr>
                <td><h4>Nbr-prélévement :</h4></td>
                <td colspan="2"><span>{{$MethodeNonValideQV->NbrPrelevement}}</span></td>
            </tr>
            @endforeach
            @foreach($MethodeNonValideQs as $MethodeNonValideQ)
            <tr>
                <td colspan="3"><h3>Methode non valide: Qualitative</h3></td>
            </tr>
            <tr>
                <td>
                    <h4>N°Bon de validation :</h4>
                </td>
                <td colspan="2">
                    <span>{{$MethodeNonValideQ->IDBVNV}}</span>
                </td>
            </tr>
            <tr>
                <td><h4>Genre-prélévement :</h4></td>
                <td colspan="2"><span> {{$MethodeNonValideQ->GenrePrelevement}}</span></td>
            </tr>
            <tr>
                <td><h4>Nbr-prélévement :</h4></td>
                <td colspan="2"><span>{{$MethodeNonValideQ->NbrPrelevement}}</span></td>
            </tr>
        </table>
        
        <table class="tab1">
            <tr>
                
                <th>Critère</th>
                <th>Etalon</th>
                <th>Précision</th>
                <th>Testeur</th>
            </tr>
            @foreach($methodes as $methode)
            @if($methode->IDBVNV == $MethodeNonValideQ->IDBVNV)
            <tr>
             
                <td class="mar">{{$methode->DPM}}</td>
                <td class="mar">{{$methode->DTO}}</td>
                <td class="mar">{{$methode->DP}}</td>
                <td class="mar">{{$methode->DesT}}</td>
            </tr>
            @endif
             @endforeach
        @endforeach
        </table>
        <table>
            <tr>
                <td colspan="3"><h4>Description :</h4></td>
            </tr>
            <tr>
                <td colspan="3">
				<div class="description">
				<span>
                {{$OTMesure->Description}}
				</span>
				</div>
				</td>
            </tr>
            <tr class="Signature">
                <td colspan="2"></td>
                <td><h4 id="Signature">Signature</h4></td>
            </tr>
        </table>
    </div>
</body>
</html>