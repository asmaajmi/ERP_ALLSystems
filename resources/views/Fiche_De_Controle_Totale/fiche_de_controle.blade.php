<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            width: 20px;
            font-size: 12px;
            text-align: center;
        }
        .tab1 {
        border-collapse: collapse;
        width: 100%;
        margin-left: 10px;
        }   
        .mar{
            padding-left: 5px;
        }
        .line1 h4{
         display: inline;
        }
        .date{
         width: 120px;
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
  
        .Signature{
            width: 80px;
        }
        .page-break {
        page-break-after: always;
        }
        #obs{
            border:#000 solid 1px;
        }
        .np{
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        @foreach ( $FCs as $FC )
            
       
        <table>
            <tr class="line1">
                <td colspan="2" >
                    <h4>Ref de le fiche:</h4>
                    <span>{{$FC->IDFC}}</span>
                </td>
                <td class="date">
                    <h4>Date :</h4>
                    <span>{{$FC->DateFC}}</span>
                </td>
            </tr>
            <tr class="titre">
                <td colspan="3"><h3 id="titre">Fiche de contrôle totale</h3></td>
            </tr>
            <tr>
                <td><h4>N° OTM :</h4></td>
                <td colspan="2"><span>{{$FC->IDOTMNV}}</span></td>
            </tr>
            <tr>
                <td><h4>Opérateur Mesure :</h4></td>
                <td colspan="2"><span>{{$FC->OrdreTravailMesureNonValide->ordre_de_travail_de_mesure->operateur_qualite_mesure->employe->prenom_emp}} {{$FC->OrdreTravailMesureNonValide->ordre_de_travail_de_mesure->operateur_qualite_mesure->employe->nom_emp}}</span></td>
            </tr>
            <tr>
                <td><h4>Produit :</h4></td>
                <td colspan="2"><span>{{$FC->OrdreTravailMesureNonValide->ordre_de_travail_de_mesure->DesProduit}}</span></td>
            </tr>
            <tr>
                <td><h4>Machine :</h4></td>
                <td colspan="2"><span>{{$FC->OrdreTravailMesureNonValide->ordre_de_travail_de_mesure->IDMachine}}</span></td>
            </tr>
            <tr>
                <td><h4>Phase :</h4></td>
                <td colspan="2"><span></span></td>
            </tr>
            <tr>
                <td><h4>Lot à contrôler :</h4></td>
                <td colspan="2"><span></span></td>
            </tr>
            <tr>
                <td><h4>Total à contrôler :</h4></td>
                <td colspan="2"><span>{{$FC->Totale_a_Controler}}</span></td>
            </tr>
            <tr>
                <td><h4>Taille d'échantillont :</h4></td>
                <td colspan="2"><span>{{$FC->Taille_Echantillon}}</span></td>
            </tr>
            {{-- <tr>
                <td><h4>Enregistrement :</h4></td>
                <td colspan="2"><span>{{$FC->enregistrement}}</span></td>
            </tr> --}}
            <tr>
                <td><h4>pourcentage défaut estime:</h4></td>
                <td colspan="2"><span>{{$FC->Pourcentage_defaut_estime}}%</span></td>
            </tr>
            <tr>
                <td><h4>Nbr de mesure :</h4></td>
                <td colspan="2"><span>{{$FC->NombreDeMesure}}</span></td>
            </tr>
            <tr>
                <td><h4>Cm Proposé:</h4></td>
                <td colspan="2"><span>{{$FC->Cm_propose}}</span></td>
            </tr>
            <tr>
                <td><h4>Cmk Proposée :</h4></td>
                <td colspan="2"><span>{{$FC->Cmk_propose}}</span></td>
            </tr>
        </table>
        <table class="tab1">
            <tr>
                <th>Type mesure</th>
                <th>Type outil</th>
                <th>Paramètre</th>
                <th>Enregistrement</th>
                <th>Précision</th>
                <th>Tolérence-Sup</th>
                <th>Tolérence-Inf</th>
				<th>N°Caisse</th>
                <th>Nbr Pièces</th>
                <th>Date d'encaissement</th>
                <th>Description Caisse</th>
            </tr>
            @foreach ($data as $data )
            <tr> 
                <td class="mar">{{$data->TypeMesure}}</td>
                <td class="mar">{{$data->TypeOutil}}</td>
                <td class="mar">{{$data->DesParametreMesure}}</td>
                <td class="mar">{{$data->enregistrement}}</td>
                <td class="mar">{{$data->DesPrecision}}</td>
                <td class="mar">{{$data->tolinf}}</td>
                <td class="mar">{{$data->tolsup}}</td>
				<td class="mar">
                     ................
				<br> ................
                <br> ................
                <br> ................</td>
                <td class="mar">
                ................
                <br> ................
                <br> ................
                <br> ................</td>
                <td class="mar">
                ................
                <br> ................
                <br> ................
                <br> ................</td>

                <td class="mar">
                ................
                <br> ................
                <br> ................
           
                    <br> ................</td>
            </tr>
           
          
            @endforeach
        </table>  
        <div class="page-break"></div>  
        <table>
            <tr>
                <td  colspan="3"><h4>Observation :</h4></td>
            </tr>
            <tr style='margin: 50px; width: 90%;'>
                <td id="obs" colspan="3" style='height: 80%;'><h4></h4></td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td  class="Signature"><h4 id="Signature" style=" width: 50px;">Signature</h4></td>
            </tr>
        </table> 
    @foreach ($donnees as $donnee )
        
        @if (($donnee->enregistrement =='Valeur Moyenne')or($donnee->enregistrement =='Valeur Moyenne + Barre')or ($donnee->enregistrement =='Valeur Moyenne + Croix'))
            <h3 class="mt-4" style="margin-left: 50px; margin-top:50px;">{{$donnee->DesParametreMesure}}</h3>
            @php($count=($FC->Pourcentage_defaut_estime * $FC->Taille_Echantillon)/100)
            @php($w=1)
            @php($a=($count / 10))
            @php($b=($a*10)%10)
            @php($n=0)
            @php($m=$FC->NombreDeMesure)
            @for ($j=1;$j<=$a;$j++)
            @php($w++)
            <table class="tab1 np">
                <tr>
                    <th>N° Piece</th>
                    @for($i=0;$i<10;$i++)
                    @php($n++)
                    <th>P{{$n}}</th>
                    @endfor
                </tr>
                @for ($k=0;$k<$m;$k++)
                <tr>
                    <th>mesure {{$k+1}}</th>
                    @for($i=0;$i<10;$i++)
                    <td></td>
                    @endfor                        
                </tr>   
                @endfor
                <tr>
                    <th>valeur moyenne</th>
                    @for($i=0;$i<10;$i++)
                    <td></td>
                    @endfor 
                </tr>
                <tr>
                    <th>déçision</th>
                    @for($i=0;$i<10;$i++)
                    <td></td>
                    @endfor 
                </tr>
            </table> 
            @if ($w%7==0)
            <div class="page-break"></div>  
            @endif  
            @endfor
            @for ($i=0;$i<$b;$i++)
            <table class="tab1 np">
                <tr>
                    <th>N° Piece</th>
                    @for($i=0;$i<$b;$i++)
                    @php($n++)
                    <th>P{{$n}}</th>
                    @endfor
                </tr>
                @for ($k=0;$k<$m;$k++)
                <tr>
                    <th>mesure {{$k+1}}</th>
                    @for($i=0;$i<$b;$i++)
                    <td></td>
                    @endfor                        
                </tr>   
                @endfor
                <tr>
                    <th>valeur moyenne</th>
                    @for($i=0;$i<$b;$i++)
                    <td></td>
                    @endfor 
                </tr>
                <tr>
                    <th>déçision</th>
                    @for($i=0;$i<$b;$i++)
                    <td></td>
                    @endfor 
                </tr>
            </table>   
            @endfor 
        @endif  
        @php($barre=($FC->Pourcentage_defaut_estime * $FC->Taille_Echantillon)/(100*20))
        @php($f=$barre/5)
        @if (($donnee->enregistrement =='Barre')or($donnee->enregistrement =='Valeur Moyenne + Barre'))
            <h3 style="margin-left: 50px; margin-top:50px;">{{$donnee->DesParametreMesure}}</h3>
            <h3 class="np" style="margin-left: 50px;">barre :</h3>
            <table class="tab1">
                @for($k=0;$k<$f;$k++)
                <tr>
                    <td style="height: 70px; "></td>
                    <td style="height: 70px; "></td>
                    <td style="height: 70px; "></td>
                    <td style="height: 70px; "></td>
                    <td style="height: 70px; "></td>
                </tr>
                @endfor
            </table> 
        @endif 
        @if (($donnee->enregistrement =='Croix')or($donnee->enregistrement =='Valeur Moyenne + Croix'))
                <h3 style="margin-left: 50px; margin-top:50px;">{{$donnee->DesParametreMesure}}</h3>
                <h3 class="np" style="margin-left: 50px;">Croix :</h3>
                <table class="tab1">
                    @for($k=0;$k<$f;$k++)
                    <tr>
                        <td height="100px"><img src="croix.png" width="130px" height="90px"></td>
                        <td height="100px"><img src="croix.png" width="130px" height="90px"></td>
                        <td height="100px"><img src="croix.png" width="130px" height="90px"></td>
                        <td height="100px"><img src="croix.png" width="130px" height="90px"></td>
                        <td height="100px"><img src="croix.png" width="130px" height="90px"></td>
                    </tr>
                    @endfor
                </table> 
        @endif 
        @endforeach
    @endforeach
    </div>            
    
    
</body>
</html>