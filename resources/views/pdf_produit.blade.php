<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<style>

.img_prod{
	width: 120px;
	height: 140px;
	margin-top: -10px;
	background-color: rgb(240, 239, 239);
	margin-left: -15px;
	border: 1px black solid;

	float: left;
}
.img_prod span{
	padding-left: 15px;
	text-align: center;
	font-size: 14px;
}

.nom_prod{
	margin-left: 135px;
	margin-top: -10px;
	width: 580px;
	height: 140px;

	}
.img_prod h1{
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


#info{
	padding-left: 20px;
	text-decoration: underline;
}
table tr td
	{
		width: 200px;
	}
#t_table_prod{
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
	@foreach ($prodconsts as $prodconst)
	<div class="img_prod">
		<span>Produit_image </span>
	</div>
	<div class="nom_prod">
		{{--  --}}
		<h1 id="produit">{{$prodconst->nom_produit_const}}</h1>
	</div>
	<div class="informations">
		<h3 id="info">Les informations du produit :</h3>
    <table>
		<tr id="line1">
			<td colspan="4"><span id="t_table_prod">ID : </span>{{$prodconst->DesProduitC}}</td>
			<td colspan="4"><span id="t_table_prod">Nom : </span>{{$prodconst->nom_produit_const}}</td>
			{{--  --}}
			
		</tr>
		<br>
		<tr id="line2">
		<td colspan="4"><span id="t_table_prod">Type : </span>{{$prodconst->type_produit}}</td>
		<td colspan="4"><span id="t_table_prod">Code à barre : </span>{{$prodconst->code_barre}}</td>
		</tr>
		<br>
		<tr id="line2">
			
			<td  colspan="4"><span id="t_table_prod">Nature : </span>{{$prodconst->Nature_produit}}</td>
			@if(isset($prodconst->Prix_unit_vente))
			<td  colspan="4"><span id="t_table_prod">Prix unitaire de vente : </span>{{$prodconst->Prix_unit_vente}}</td>
			@endif
		</tr>
		<br>
		<tr>
			<td  colspan="4"><span id="t_table_prod">Lot optimal  : </span>{{$prodconst->lot_optimal}}</td>
			@foreach ( $tmpFab as $tmpF)
			@foreach($machines as $machine)
			@if ($tmpF->id_produit_const == $prodconst->id && $machine->id == $tmpF->id_machine)
			<td  colspan="4"><span id="t_table_prod">Nom de machine de fabrication : </span>{{$machine->nom_machine}}</td>
			@endif
			@endforeach
			@endforeach
		</tr>
		<br>
		<tr>
		@foreach ( $tmpFab as $tmpF)
		@if ($tmpF->id_produit_const == $prodconst->id)
		<td colspan="4"><span id="t_table_prod">Temps unitaire de fabrication : </span>{{$tmpF->temps_unitaire}}</td>
		<td colspan="4"><span id="t_table_prod">Temps de réglage d'un lot : </span>{{$tmpF->temps_reglage_lot}}</td>
		@endif
		@endforeach	
		</tr>
	</table>
	</div>
	
	<div id="signature">
		Le {{$date}} à...............
		<br>
		<br>
		<center>Signature</center>

	</div>
	
    @endforeach
</body>
</html>