@extends("layouts.Navbar_Sidebar")
@section("contenu")
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
<link rel="stylesheet" href="{{asset('css/Compte_Rendu/creer_Un_Compte_Rendu.css')}}"/>
{{-- Créer Une fiche de controle --}}
<div class="container" id="addcompterendu">
    <form action="{{route('CompteRendu.Ajouter')}}" method="post">
        @csrf
        <div class="ajout">
            @include('sweetalert::alert')
            <div class="titre">
                <h2 class="mb-4 addcompterendutitle">Créer<b> Un Compte Rendu </b></h2>
            </div>
            <div class="info_Generale">
                <div class="line">
                    <div class="col">
                        <div class="titre mt-2">
                            <h6>ID Compte-Rendu</h6>
                        </div>
                        <div class="champ">
                            <input type="text" value="" name="IDCR">
                        </div>
                    </div>
                    <div class="col">
                        <div class="titre mt-2">
                            <h6>Date </h6>
                        </div>
                        <div class="champ">
                            <input type="date" name="DateCR">                            
                        </div>
                    </div>
                 </div> 
            </div>
            <div class="line">
                <div class="col">
                    <div class="titre mt-2">
                        <h6>Operateur Calcul</h6>
                    </div>
                    <div class="champ">
                        <select name="IDOperateurCalcul" id="">
                            <option value="">-- Choisir un operateur --</option>
                            @foreach ($ops as $op )
                            <option value="{{$op->id}}">{{$op->employe->prenom_emp}} {{$op->employe->nom_emp}}</option>                                    
                            @endforeach
                        </select>                          
                    </div>
                </div>
                <div class="col">
                    <div class="titre mt-2">
                        <h6>Ref Fiche de Contrôle</h6>
                    </div>
                    <div class="champ">
                        <select id="FC" name="IDFC">
                            <option value="">-- Choisir une fiche de contrôle totale --</option>
                            @foreach ($FCs as $fc )
                                <option value="{{$fc->IDFC}}">{{$fc->IDFC}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="OTmesure">
                <div class="line">
                    <div class="col">
                        <div class="titre mt-2">
                            <h6>N° OT Mesure</h6>
                        </div>
                        <div class="champ">
                            <div class="champ">
                                <input type="text" name="" id="OTM" value="">                            
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="titre mt-2">
                            <h6>Totale contrôlé</h6>
                        </div>
                        <div class="champ">
                            <input type="number" name="TotaleControler" id="TC" value="">                            
                        </div>
                    </div>
                </div>
            <div class="fiche">
                <div class="line">
                    <div class="col">
                        <div class="titre mt-2">
                            <h6>Somme défauts</h6>
                        </div>
                        <div class="champ">
                            <input type="number" name="SommeDefautsTotale" id="SD" value="">                            
                        </div>
                    </div>
                    <div class="col">
                        <div class="titre mt-2">
                            <h6>% défaut réel</h6>
                        </div>
                        <div class="champ">
                            <input type="number" name="Pourcentage_defaut_reel" id="PDR" value="">                            
                        </div>
                    </div>
                </div>  
                <div class="line">
                    <div class="col">
                        <div class="titre mt-2">
                            <h6>Cm Mesuré</h6>
                        </div>
                        <div class="champ">
                            <input type="test" name="Cm_mesure" id="Cm" value="">                            
                        </div>
                    </div>
                    <div class="col">
                        <div class="titre mt-2">
                            <h6>Cmk Mesuré</h6>
                        </div>
                        <div class="champ">
                            <input type="test" name="Cmk_mesure" id="Cmk" value="">                            
                        </div>
                    </div>
                </div>
                <hr>  
                <div class="par"></div>        
                <div class="description">
                    <div class="titre mt-2 mx-3">
                        <h5>Description</h5>
                    </div>
                    <div class="form-floating mx-3">
                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name="Description"></textarea>
                        <label for="floatingTextarea2">Comments</label>
                    </div>
                </div>
            </div> 
            <div class="boutons mt-5 mb-4">
                <button type="submit" role="button" id="titleadd" class="btn" data-toggle="modal"><i class="bi bi-plus-circle-fill"></i><span> Ajouter</span></button>
                <a href="{{route('ListeDeCompteRendu.affiche')}}" id="titledelete" class="btn " data-toggle="modal"><i class="bi bi-dash-circle-fill"></i><span> Annuler</span></a>
            </div>
        </div>
    </form>
</div>             
{{-- Créer Un COMPTE RENDU --}}
<!-- **************************************************************************************************************** -->
<script>
    $('.ajout').on('click','.btncaissedel',function(){
        $(this).parent().parent().parent().remove();
    });
</script> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
<script type="text/javascript">
//******************************************************** */
var plus = [];
$(document).ready(function()
    { 
            $(document).on('change','#FC',function()
            {           var FC=$(this).val();
                        var OTM=$(this).parent().parent().parent().parent().parent().find("#OTM");
                        var TC=$(this).parent().parent().parent().parent().parent().find("#TC");
                        var PDR=$(this).parent().parent().parent().parent().parent().find("#PDR");
                        var Cm=$(this).parent().parent().parent().parent().parent().find("#Cm");
                        var Cmk=$(this).parent().parent().parent().parent().parent().find("#Cmk");
                        var par=$(this).parent().parent().parent().parent().parent().find(".par");
                        var parametre=$(this).parent().parent().parent().parent().parent().find("#parametre");
                        var plus = [];
                        var div=" ";
                        console.log(FC);
                        console.log(OTM);
                        $.ajax({ 
                        type:'get',
                        url:'{{route("FindInformationFC_OTM")}}',
                        data:{'FC':FC},
                        dataType:"json",
                                success:function(data)
                                {
                                    console.log('success');
                                            for(var i=0;i<data.length;i++)
                                            {
                                                    OTM.val(data[i].IDOTMNV);
                                                    TC.val(data[i].Totale_a_Controler);
                                                    PDR.val(data[i].Pourcentage_defaut_estime);
                                                    Cm.val(data[i].Cm_propose);
                                                    Cmk.val(data[i].Cmk_propose);
                                                    plus[i]=data[i].DesParametreMesure;

                                                    console.log('SA');
                                                    div+=
                                                    '<div class="line" id="lineotm">'+
                                                    '<div class="col">'+
                                                    '<div class="titre mt-3">'+
                                                    '<h6>Parametre à mesurer :</h6>'+
                                                    '</div>'+
                                                    '<div class="champOTM mt-1">'+
                                                    '<input type="text" name="DesParametreMesure[]" value="'+data[i].DesParametreMesure+'" id="parametre">'+                            
                                                    '</div>'+
                                                    '</div>'+
                                                    '<div class="col">'+

                                                    '</div>'+
                                                    '</div>'+ 
                                                    '<div class="line">'+
                                                    '<div class="col">'+
                                                    '<div class="titre mt-2">'+
                                                    '<h6>Pourcentage parctiel:</h6>'+
                                                    '</div>'+
                                                    '<div class="champ">'+
                                                    '<input type="text" name="PourcentagePartielle[]" value="" id="">'+
                                                    '</div>'+
                                                    '</div>'+
                                                    '<div class="col">'+
                                                    '<div class="titre mt-2">'+
                                                    "<h6>Date d'encaissement:</h6>"+
                                                    '</div>'+
                                                    '<div class="champ mt-1">'+
                                                    '<input type="date" name="date[]" value="" id="">'+                        
                                                    '</div>'+            
                                                    '</div>'+
                                                    '</div>'+
                                                    '<div class="rebut'+data[i].DesParametreMesure+'">'+
                                                    ' <div class="line">'+
                                                    '<div class="col">'+
                                                    '<div class="titre mt-2">'+
                                                    '<h6>Caisse :</h6>'+
                                                    '</div>'+
                                                    '<div class="champ">'+
                                                    '<div class="input-group" style="width: 340px;">'+
                                                    '<input type="number" aria-label="First name" class="form-control" placeholder="N° Caisse" name="'+data[i].DesParametreMesure+'Ncaisse[]">'+
                                                    '<input type="number" aria-label="Last name" class="form-control" placeholder="Nbr Pieces"  name="'+data[i].DesParametreMesure+'Nbr_Pieces[]">'+
                                                    '</div>'+                         
                                                    '</div>'+
                                                    '</div>'+
                                                    '<div class="col">'+
                                                    '<div class="titre mt-2">'+
                                                    '<h6>Remarque:</h6>'+
                                                    '</div>'+
                                                    '<div class="champ">'+
                                                    '<input type="text" name="'+data[i].DesParametreMesure+'Remarque[]" value="" id="parametre">'+
                                                    '</div>'+            
                                                    '</div>'+
                                                    '</div>'+
                                                    '</div>'+
                                                    '<div class="boutonscaisse'+data[i].DesParametreMesure+' boutonscaisse">'+
                                                    '<div class="caissebtn'+data[i].DesParametreMesure+' boutonscaisse">'+
                                                    '<a href="javascript:;" class="btncaisse'+data[i].DesParametreMesure+'" ><i class="bi bi-plus"></i></a>'+
                                                    '</div>'+
                                                    '</div>'+
                                                    '<hr>';
                                                    console.log(data[i].DesParametreMesure)      
                                                    
                                                    

                                                                           
                        $(document).on('click','.btncaisse'+data[i].DesParametreMesure,function()
            {           var FC=$(this).val();
                        var OTM=$(this).parent().parent().parent().parent().parent().find("#OTM");
                        var TC=$(this).parent().parent().parent().parent().parent().find("#TC");
                        var PDR=$(this).parent().parent().parent().parent().parent().find("#PDR");
                        var Cm=$(this).parent().parent().parent().parent().parent().find("#Cm");
                        var Cmk=$(this).parent().parent().parent().parent().parent().find("#Cmk");
                        var par=$(this).parent().parent().parent().parent().parent().find(".par");
                        var parametre=$(this).parent().parent().parent().parent().parent().find("#parametre");
                        var div=" ";
                        console.log(FC);
                        console.log(OTM);
                        $.ajax({ 
                        type:'get',
                        url:'{{route("plus")}}',
                        data:{'FC':FC},
                        dataType:"json",
                                success:function(data)
                                {
                                    console.log('success');
                                            for(var i=0;i<plus.length;i++)
                                            {
                                                console.log(plus[i]);
                                          
                                                rebut='.rebut'+plus[i];

                                                console.log(rebut);
                                                var line =
                                                ' <div class="line">'+
                                                '<div class="col">'+
                                                '<div class="titre mt-2">'+
                                                '<h6>Caisse :</h6>'+
                                                '</div>'+
                                                '<div class="champ">'+
                                                '<div class="input-group" style="width: 340px;">'+
                                                '<input type="number" aria-label="First name" class="form-control" placeholder="N° Caisse" name="'+plus[i]+'Ncaisse[]">'+
                                                '<input type="number" aria-label="Last name" class="form-control" placeholder="Nbr Pieces"  name="'+plus[i]+'Nbr_Pieces[]">'+
                                                '</div>'+                         
                                                '</div>'+
                                                '</div>'+
                                                '<div class="col">'+
                                                '<div class="titre mt-2">'+
                                                '<h6>Remarque:</h6>'+
                                                '</div>'+
                                                '<div class="champ">'+
                                                '<input type="text" name="'+plus[i]+'Remarque[]" value="" id="parametre">'+
                                                '<a href="javascript:;" class="btncaissedel"><i class="bi bi-dash"></i></a> '+   
                                                '</div>'+            
                                                '</div>'+
                                                '</div>';

                                                $(rebut).append(line);
                                              
                   
                                            }
                                    console.log(plus);
                                },
                                error:function()
                                {
                                    console.log('error');
                                }
                        });
            });
                                            }
                                    console.log(plus);
                                    par.append(div);

                                },
                                error:function()
                                {
                                    console.log('error');
                                }
                        });
 
            
            });

          // ****************************************************************************************//
         
    });

</script>
@endsection
