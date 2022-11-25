<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>{{$employe->nom_emp}}&nbsp;{{$employe->prenom_emp}}</title>
</head>
<style>

.img_emp{
	width: 120px;
	height: 140px;
	margin-top: -10px;
	background-color: rgb(240, 239, 239);
	margin-left: -15px;
	border: 1px black solid;

	float: left;
}
.img_emp span{
	padding-left: 15px;
	text-align: center;
	font-size: 14px;
}

.nom_emp{
	margin-left: 135px;
	margin-top: -10px;
	width: 580px;
	height: 140px;

	}
.nom_emp h1{
	font-size: 50px;
	font-weight: bold;
	padding-left: 170px;
	padding-top: -10px;
	color: rgb(55, 39, 146);
}
table{
	/* border: #000 solid 1px; */
	width: 95%;
	padding-right: 20px;
	padding-bottom: 25px;
	margin: 2.5%;
}
.informations{
	margin-left: -15px;
	width: 730px;
	height: 230px;
	margin-top: 20px;
}
.informations_prof{
	margin-left: -15px;
	width: 730px;
	height: 180px;
	margin-top: 20px;
}
.informations_acad{
	margin-left: -15px;
	width: 730px;
	height: 200px;
	margin-top: 20px;
}
#info_pers{
	padding-left: 20px;
	text-decoration: underline;
}
table tr td
	{
		width: 200px;
	}
#t_table_pers{
font-weight: bold;
}
#signature{
	margin-right: 15px;
	margin-top: 40px;
	float: right;
	font-weight: bold;
}

</style>
<body>
	<div class="img_emp">
		<span>Employe_image </span>
	</div>
	<div class="nom_emp">
		<h1 id="employe">{{$employe->nom_emp}}&nbsp;{{$employe->prenom_emp}}</h1>
	</div>
	<div class="informations">
		<h3 id="info_pers">Les informations personnelles :</h3>
    <table>
		<tr id="line1">
			<td colspan="3"><span id="t_table_pers">ID : </span>{{$employe->id}}</td>
			<td colspan="3"><span id="t_table_pers">Nom : </span>{{$employe->nom_emp}}</td>
			<td ><span id="t_table_pers">Prènom : </span>{{$employe->prenom_emp}}</td>
		</tr>
		<br>
		<tr id="line2">
			<td colspan="3"><span id="t_table_pers">CIN : </span>{{$employe->cin_emp}}</td>
			<td colspan="3"><span id="t_table_pers">Date Naissance : </span>{{$employe->date_naissance_emp}}</td>
			<td ><span id="t_table_pers">Etat civil : </span>{{$employe->etat_civil_emp}}</td>
		</tr>
		<br>
		<tr id="line2">
			<td colspan="3"><span id="t_table_pers">Télèphone N°1 : </span>{{$employe->tel1_emp}}</td>
			<td colspan="3"><span id="t_table_pers">Mobile N°1 : </span>{{$employe->mob1_emp}}</td>

			<td></td>
		</tr>
		<br>
		<tr>
			<td colspan="3"><span id="t_table_pers">Télèphone N°2 : </span>{{$employe->tel2_emp}}</td>
			<td colspan="3"><span id="t_table_pers">Mobile N°2 : </span>{{$employe->mob2_emp}}</td>
			<td></td>
		</tr>
	</table>
	</div>
	<div class="informations_prof">
		<h3 id="info_pers">Les informations professionnelles :</h3>
    <table>
		<tr id="line1">
			<td colspan="3"><span id="t_table_pers">Date recrutement : </span>{{$employe->date_recrutement_emp}}</td>
			<td colspan="3"><span id="t_table_pers">Salaire : </span>{{$employe->salaire_base_emp}} DT</td>
			<td><span id="t_table_pers">Rôle : </span>{{$employe->role_emp}}</td>
		</tr>
		<br>
		<tr id="line2">
			<td colspan="3"><span id="t_table_pers">Congé maladie : </span>{{$employe->seuil_conge_maladie}} Jours</td>
			<td colspan="3"><span id="t_table_pers">Congé accidentelle : </span>{{$employe->seuil_conge_accidentel}} Jours</td>
			<td ><span id="t_table_pers">Congé annuelle : </span>{{$employe->seuil_conge_annuel}} Jours</td>
		</tr>
		<br>
		<tr id="line2">
			
			<td colspan="3"><span id="t_table_pers">Date debut travail : </span>
				@foreach ( $travails as $travail)
				@if ($travail->id_emp == $employe->id)
				{{$travail->date_debut_tr}}
				@endif
				@endforeach
			</td>
			<td colspan="3"><span id="t_table_pers">Date fin travail : </span>
				@foreach ( $travails as $travail)
				@if ($travail->id_emp == $employe->id)
				{{$travail->date_fin_tr}}
				@endif
				@endforeach
			</td>
			<td><span id="t_table_pers">Service :</span>
				@foreach ( $travails as $travail)
				@foreach ($services as $service )
				@if ($travail->id_emp == $employe->id && $service->id == $travail->id_serv)
				{{$service->des_serv}}
				@endif
				@endforeach
				@endforeach
			</td>
		</tr>
		
	</table>
	</div>
	<div class="informations_acad">
		<h3 id="info_pers">Les informations Académiques :</h3>
    <table>
		@foreach ( $diplomes as $diplome )
		@if ($diplome->id_emp == $employe->id)			
		<tr id="line1">
			<td colspan="3"><span id="t_table_pers">Niveau : </span>{{$diplome->niveau}}</td>
			<td colspan="3"><span id="t_table_pers">Ecole : </span>{{$diplome->ecole}}</td>
			<td><span id="t_table_pers">Date obtention : </span>{{$diplome->dt_obtention}}</td>
		</tr>
		<br>
		@endif
		@endforeach		
	</table>
	</div>
	<div id="signature">
		Le {{$date}} à...............
		<br>
		<br>
		<center>Signature</center>

	</div>
	
    
</body>
</html>