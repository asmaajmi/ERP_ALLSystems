@extends("layouts.Navbar_Sidebar")
@section("contenu")
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
<link rel="stylesheet" href="{{asset('css/Compte_Rendu/Modifier_un_Compte_Rendu.css')}}"/>
{{-- Modifier un compte-rendu --}}
<div class="container" id="modcompterendu">
    <form action="{{route('CompteRendu.update',['IDCR'=>$CR])}}" method="post">
        {{ method_field('put')}}   
        @csrf
        <div class="ajout">
            {{-- @include('sweetalert::alert') --}}
            <div class="titre">
                <h2 class="mb-4 modcompterendutitle">Modifier<b> Un Compte Rendu </b></h2>
            </div>
            <div class="info_Generale">
                <div class="line">
                    <div class="col">
                        <div class="titre mt-2">
                            <h6>ID Compte-Rendu</h6>
                        </div>
                        <div class="champ">
                            <input type="text" value="{{$Compte->IDCR}}" name="IDCR" id="idcr">
                        </div>
                    </div>
                    <div class="col">
                        <div class="titre mt-2">
                            <h6>Date </h6>
                        </div>
                        <div class="champ">
                            <input type="date" name="DateCR" value="{{$Compte->DateCR}}">                            
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
                            @if ($op->id == $Compte->IDOperateurCalcul)
                            <option value="{{$op->id}}" selected>{{$op->employe->prenom_emp}} {{$op->employe->nom_emp}}</option>  
                            @else
                            <option value="{{$op->id}}">{{$op->employe->prenom_emp}} {{$op->employe->nom_emp}}</option>  
                            @endif                                  
                            @endforeach
                        </select>                          
                    </div>
                </div>
                <div class="col">
                    <div class="titre mt-2">
                        <h6>Ref Fiche de Contrôle</h6>
                    </div>
                    <div class="champ">
                        <input type="text" value="{{$Compte->IDFC}}" name="IDFC" disabled>
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
                                <input type="text" name="" id="OTM" value="{{$Compte->FicheControle->IDOTMNV}}" disabled>                            
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="titre mt-2">
                            <h6>Totale contrôlé</h6>
                        </div>
                        <div class="champ">
                            <input type="number" name="TotaleControler" id="TC" value="{{$Compte->TotaleControler}}">                            
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
                            <input type="number" name="SommeDefautsTotale" id="SD" value="{{$Compte->SommeDefautsTotale}}">                            
                        </div>
                    </div>
                    <div class="col">
                        <div class="titre mt-2">
                            <h6>% défaut réel</h6>
                        </div>
                        <div class="champ">
                            <input type="number" name="Pourcentage_defaut_reel" id="PDR" value="{{$Compte->Pourcentage_defaut_reel}}">                            
                        </div>
                    </div>
                </div>  
                <div class="line">
                    <div class="col">
                        <div class="titre mt-2">
                            <h6>Cm Mesuré</h6>
                        </div>
                        <div class="champ">
                            <input type="test" name="Cm_mesure" id="Cm" value="{{$Compte->Cm_mesure}}">                            
                        </div>
                    </div>
                    <div class="col">
                        <div class="titre mt-2">
                            <h6>Cmk Mesuré</h6>
                        </div>
                        <div class="champ">
                            <input type="test" name="Cmk_mesure" id="Cmk" value="{{$Compte->Cmk_mesure}}">                            
                        </div>
                    </div>
                </div>
                <hr>  
                @foreach ($SRs as $SR)
                <div class="par">
                    <div class="line" id="lineotm">
                        <div class="col">
                        <div class="titre mt-3">
                        <h6>Parametre à mesurer :</h6>
                        </div>
                        <div class="champOTM mt-1">
                        <input type="text" name="DesParametreMesure[]" value="{{$SR->DesParametreMesure}}" id="parametre">                            
                        </div>
                        </div>
                        <div class="col">
                        </div>
                        </div>
                        <div class="line">
                        <div class="col">
                        <div class="titre mt-2">
                        <h6>Pourcentage parctiel:</h6>
                        </div>
                        <div class="champ">
                        <input type="text" name="PourcentagePartielle[]" value="{{$SR->PourcentagePartielle}}" id="">
                        </div>
                        </div>
                        <div class="col">
                        <div class="titre mt-2">
                        <h6>Date d'encaissement:</h6>
                        </div>
                        <div class="champ mt-1">
                        <input type="date" name="date[]" value="{{$SR->Date_Encaissement}}" id="">                        
                        </div>            
                        </div>
                        </div>
                        @foreach ($SR1s as $SR1)
                        @if ($SR1->DesParametreMesure==$SR->DesParametreMesure)
                        <div class="rebut{{$SR1->DesParametreMesure}}">
                         <div class="line">
                            <div class="col">
                                <div class="titre mt-2">
                                    <h6>Caisse :</h6>
                                </div>
                                <div class="champ">
                                    <div class="input-group" style="width: 340px;">
                                        <input type="number" aria-label="First name" class="form-control" placeholder="N° Caisse" name="{{$SR1->DesParametreMesure}}Ncaisse[]" value="{{$SR1->Ncaisse}}">
                                        <input type="number" aria-label="Last name" class="form-control" placeholder="Nbr Pieces"  name="{{$SR1->DesParametreMesure}}Nbr_Pieces[]" value="{{$SR1->Nbr_Pieces}}">
                                    </div> 
                                </div>                         
                            </div>
                            <div class="col">
                                <div class="titre mt-2">
                                    <h6>Remarque:</h6>
                                </div>
                                <div class="champ">
                                    <input type="text" name="{{$SR1->DesParametreMesure}}Remarque[]" value="{{$SR1->Remarque}}" id="parametre">
                                </div>            
                            </div>
                        </div>
                        </div>
                        @endif
                        @endforeach
                        <hr>
                </div> 
                @endforeach       
                <div class="description">
                    <div class="titre mt-2 mx-3">
                        <h5>Description</h5>
                    </div>
                    <div class="form-floating mx-3">
                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name="Description">{{$Compte->Description}}</textarea>
                        <label for="floatingTextarea2">Comments</label>
                    </div>
                </div>
            </div> 
            <div class="boutons mt-5 mb-4">
                <button type="submit" role="button" id="titleadd" class="btn" data-toggle="modal"><i class="bi bi-plus-circle-fill"></i><span> Modifier</span></button>
                <a href="{{route('ListeDeCompteRendu.affiche')}}" id="titledelete" class="btn " data-toggle="modal"><i class="bi bi-dash-circle-fill"></i><span> Annuler</span></a>
            </div>
        </div>
    </form>
</div>             
@endsection
