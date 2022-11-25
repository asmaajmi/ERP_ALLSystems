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
        <table>
            <tr class="titre">
                <th colspan="2"><h3 id="titre">Bon De Sortie</h3></th>
            </tr>
            <tr>
                <td><h4>ID bon sortie :</h4></td>
                <td><span>{{$BonSortie->id}}</span></td>
            </tr>
            <tr>
                <td><h4>N°Ordre de travail :</h4></td>
                <td><span>{{$BonSortie->IDOT}}</span></td>
            </tr>
            <tr>
                <td><h4>Responsable :</h4></td>
                <td><span>{{$BonSortie->responsable_qualite->employe->nom_emp}} {{$BonSortie->responsable_qualite->employe->prenom_emp}}</span></td>
            </tr>
            <tr>
                <td><h4>Opérateur mesure :</h4></td>
                <td><span>{{$BonSortie->operateur_qualite_mesure->employe->nom_emp}} {{$BonSortie->operateur_qualite_mesure->employe->prenom_emp}}</span></td>
            </tr>
            <tr>
                <td><h4>Type d'outil :</h4></td>
                <td><span>{{$BonSortie->outil_mesure->DesTypeOutil}}</span></td>
            </tr>
            <tr>
                <td><h4>Nom outil :</h4></td>
                <td><span>{{$BonSortie->IDOutil}}</span></td>
            </tr>
            <tr>
                <td><h4>Date sortie :</h4></td>
                <td><span>{{$BonSortie->DateSortie}}</span></td>
            </tr>
        </table>
    </div>
</body>
</html>