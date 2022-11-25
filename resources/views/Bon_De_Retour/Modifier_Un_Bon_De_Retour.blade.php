@extends("layouts.Navbar_Sidebar")
@section("contenu")
<link rel="stylesheet" href="{{ asset('css/Bon de sortie/Creer_Un_Bon_De_Sortie.css')}}">
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
{{-- modifier d'un bon de Retour --}}
<div class="container" id="modbonsortie">
<form action="{{route('AjoutUnBonDeRetour.Update',['id'=>$bonRetour])}}" method="post">
    {{ method_field('put')}}  
    @csrf
    <div class="ajout">
         @include('sweetalert::alert')
        <div class="titre_generale">
        <h2 class="titre_generale mb-5 ms-3 modbonsortietitle">Modifier<b> Un Bon De Retour</b></h2>
        </div>
        <div class="Bon_de_sortie">
            <div class="line">
                <div class="col">
                    <div class="titre mt-2">
                        <h5>Ordre de travail</h5>
                    </div>
                    <div class="champ">
                        <select name="IDBS" id="" class="IDBonSortie" >
                        <option  value="{{$BonRetour->IDBS}}">{{$BonRetour->IDBS}}</option>
                            @foreach($bs as $bs)
                            <option  value="{{$bs->id}}">{{$bs->id}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="titre mt-2">
                        <h5>Responsable</h5>
                    </div>
                    <div class="champ">
                        <select type="text" name="Responsable" class="IDResponsable" >
                        <option value="{{$BonRetour->IDResponsable}}">{{ $BonRetour->responsable_qualite->employe->nom_emp}} {{ $BonRetour->responsable_qualite->employe->prenom_emp}} </option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    
                </div>
            </div>
            <div class="line">
                <div class="col">
                    <div class="titre mt-2">
                        <h5>Type outil</h5>
                    </div>
                    <div class="champ">
                        <input name="DesTypeOutil" id="" class="DesTypeOutil" value="{{$BonRetour->outil_mesure->DesTypeOutil}}"  >
                    </div>
                </div>
                <div class="col">
                    <div class="titre mt-2">
                        <h5>Nom d'outil</h5>
                    </div>
                    <div class="champ">
                        <input name="OutilMesure" id="" class="DesOutil" value="{{$BonRetour->IDOutil}}">
                    </div>
                </div>
            </div>
            <div class="line">
                <div class="col">
                    <div class="titre mt-2">
                        <h5>Date retour</h5>
                    </div>
                    <div class="champ">
                        <input type="date" name="DateRetour" value="{{$BonRetour->DateRetour}}">
                    </div>
                </div>
                <div class="col">
                    <div class="titre mt-2">
                        <h5>Nom operateur</h5>
                    </div>
                    <div class="champ">
                        <select name="IDOperateur" id=""  class="operateur" >
                        <option value="{{$BonRetour->IDOperateurMesure}}">{{$BonRetour->operateur_qualite_mesure->employe->nom_emp}} {{$BonRetour->operateur_qualite_mesure->employe->prenom_emp}}</option>
                    </select>
                    </div>
                </div>
            </div>
        </div>             
        
    <div class="boutons mt-5 mb-4">
        <button type="submit" role="button" id="titleadd" class="btn" data-toggle="modal"><i class="bi bi-plus-circle-fill"></i><span> Modifier</span></button>
        <a href="{{route('ListeDesBonsDeRetour.affiche')}}" id="titledelete" class="btn " data-toggle="modal"><i class="bi bi-dash-circle-fill"></i><span> Annuler</span></a>
    </div>
</form>
</div>
{{-- ajout d'un bon de sortie --}}

<!-- *************************** les contorles ********************** -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript">

$(document).ready(function()
    {
/**************************************************dependance machine produit et parametre et précision ******************************************************************/
		
     
$(document).on('change','.IDBonSortie',function()
        {
			var id_ordre=$(this).val();
            console.log(id_ordre);
			var div=$(this).parent().parent().parent().parent().parent();
            console.log(div);
            var op='';
            var op1='';
			$.ajax(   
            {
				type:'get',
				url:'{{route("BR.findinformation")}}',
				data:{'id':id_ordre},
                dataType:"json",
				success:function(data)
                {
                    console.log(data.length);
                    for(var i=0;i<data.length;i++)

                        { 
                            op='<option value="'+data[i].IDResponsable+'"selected>'+data[i].IDResponsable+'</option>';
                            div.find('.IDResponsable').append(op);
                            div.find('.DesTypeOutil').val(data[i].DesTypeOutil);
                            div.find('.DesOutil').val(data[i].IDOutil);
                            op='<option value="'+data[i].IDOperateurMesure+'"selected>'+data[i].IDOperateurMesure+'</option>';
                            div.parent().find('.operateur').append(op);
                            
                        }
                    
				},
				error:function()
                {
                    console.log('error');
				}
			});
		});

    });
</script>
@endsection  