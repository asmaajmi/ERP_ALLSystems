<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>{{$machine->nom_machine}}</title>
</head>
<style>

.img_mach{
	width: 120px;
	height: 140px;
	margin-top: -10px;
	background-color: rgb(240, 239, 239);
	margin-left: -15px;
	border: 1px black solid;

	float: left;
}
.img_mach span{
	padding-left: 15px;
	text-align: center;
	font-size: 14px;
}

.nom_mach{
	margin-left: 135px;
	margin-top: -10px;
	width: 580px;
	height: 140px;

	}
.nom_mach h1{
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

.info_mach{
	padding-left: 20px;
	text-decoration: underline;
}
table tr td
	{
		width: 200px;
	}
.t_table_mach{
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
	<div class="img_mach">
		<span>Machine_image </span>
	</div>
	<div class="nom_mach">
		<h1 id="machine">{{$machine->nom_machine}}</h1>
	</div>
	<div class="informations">
		<h3 class="info_mach">Les informations du machine :</h3>
    <table>
		<tr id="line1">
			<td><span class="t_table_mach colonne1">ID : </span>{{$machine->DesMachine}}</td>
			<td><span class="t_table_mach">Nom : </span>{{$machine->nom_machine}}</td>
			<td ><span class="t_table_mach">Capacité : </span>{{$machine->Capacite}}</td>
		</tr>
		<br>
		<tr id="line2">
			<td><span class="t_table_mach colonne1">MTBF : </span>{{$machine->MTBF}}</td>
			<td><span class="t_table_mach">MTTR : </span>{{$machine->MTTR}}</td>
			<td></td>
		</tr>
		<br>
		<tr id="line2">
			<td><span class="t_table_mach colonne1">Prix d'achat : </span>{{$machine->PrixAchat}}</td>
			<td><span class="t_table_mach">Date d'achat : </span>{{$machine->DateAchat}}</td>
			<td></td>
		</tr>
		<br>
		<tr id="line2">
			<td colspan="3"><span class="t_table_mach colonne1">Description: </span>{{$machine->Description}}</td>
			<td></td>
			<td></td>
		</tr>
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