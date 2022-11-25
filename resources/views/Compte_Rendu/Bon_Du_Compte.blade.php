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
    table{
        width: 95%;
        margin: 2.5%;
        border: #000 solid 1px;
        padding: 2.5%;
    }
    #titre{
        text-align: center;
        padding-bottom: 30px;
    }
    tr td{
        padding-bottom: 10px;
        padding-left: 40px;

    }
    body{
        margin-top: 30px;
    }
	</style>
</head>
<body>
    <div class="container">
        @foreach ($sr1s as $sr1)
        @foreach ($srs as $sr)
        @if ($sr1->DesParametreMesure == $sr->DesParametreMesure)
        <table>
            <tr class="titre">
                <th colspan="2">Suivie de rebut<h3 id="titre"></h3></th>
            </tr>
            <tr>
                <td><h4>Produit :</h4></td>
                <td><span>{{$CompteRendu->FicheControle->OrdreTravailMesureNonValide->ordre_de_travail_de_mesure->DesProduit}}</span></td>
            </tr>
            <tr>
                <td><h4>Machine:</h4></td>
                <td><span>{{$CompteRendu->FicheControle->OrdreTravailMesureNonValide->ordre_de_travail_de_mesure->IDMachine}}</span></td>
            </tr>
            <tr>
                <td><h4>Operateur Responsable :</h4></td>
                <td><span>{{$CompteRendu->FicheControle->OrdreTravailMesureNonValide->ordre_de_travail_de_mesure->operateur_qualite_mesure->employe->prenom_emp}} {{$CompteRendu->FicheControle->OrdreTravailMesureNonValide->ordre_de_travail_de_mesure->operateur_qualite_mesure->employe->nom_emp}}</span></td>
            </tr>
            
            <tr>
                <td><h4>N° Caisse :</h4></td>
                <td><span>{{$sr->Ncaisse}}</span></td>
            </tr>
            <tr>
                <td><h4>Date d'encaissement :</h4></td>
                <td><span>{{$sr1->Date_Encaissement}}</span></td>
            </tr>
            <tr>
                <td><h4>Parametre mesuré :</h4></td>
                <td><span>{{$sr->DesParametreMesure}}</span></td>
            </tr>
            <tr>
                <td><h4>Type de défaut :</h4></td>
                <td><span>{{$sr->Remarque}}</span></td>
            </tr>
            <tr>
                <td><h4>Nbr de pièces :</h4></td>
                <td><span>{{$sr->Nbr_Pieces}}</span></td>
            </tr>
          
        </table>
        <div class="page-break"></div> 
        @endif
        @endforeach
        @endforeach
    </div>
</body>
</html>