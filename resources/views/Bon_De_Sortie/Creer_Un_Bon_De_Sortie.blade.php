@extends("layouts.Navbar_Sidebar")
@section("contenu")
<link rel="stylesheet" href="{{ asset('css/Bon de sortie/Creer_Un_Bon_De_Sortie.css')}}">
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
{{-- ajout d'un bon de sortie --}}
<div class="container" id="addbonsortie">
<form action="{{route('AjoutUnBonDeSortie.Ajouter')}}" method="post">
    @csrf
    <div class="ajout">
         @include('sweetalert::alert')
        <div class="titre_generale">
            <h2 class="titre_generale mb-5 ms-3 addbonsortietitle">Créer<b> Un Bon De Sortie</b></h2>
        </div>
        <div class="Bon_de_sortie">
            <div class="line">
                <div class="col">
                    <div class="titre mt-2">
                        <h5>Ordre de travail</h5>
                    </div>
                    <div class="champ">
                        <select name="Ordre" id="" class="IDOrdre">
                        <option value="">--Choisir un ordre du travail--</option>
                            @foreach($ordres as $ordre)
                            <option value="{{$ordre->IDOT}}">{{$ordre->IDOT}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="titre mt-2">
                        <h5>Responsable</h5>
                    </div>
                    <div class="champ">
                        <select type="text" name="Responsable" class="IDResponsable">
                        @foreach($responsables as $responsable)   
                        <option value="{{$responsable->id}}">{{$responsable->employe->nom_emp}} {{$responsable->employe->prenom_emp}} </option>
                        @endforeach
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
                        <select name="DesTypeOutil" id="" class="DesTypeOutil">
                            <option value="">--Choisir Un Type Outil--</option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="titre mt-2">
                        <h5>Nom d'outil</h5>
                    </div>
                    <div class="champ">
                        <select name="OutilMesure" id="" class="DesOutil">
                            <option value="">--Choisir Un Outil--</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="line">
                <div class="col">
                    <div class="titre mt-2">
                        <h5>Date sortie</h5>
                    </div>
                    <div class="champ">
                        <input type="date" name="DateSortie">
                    </div>
                </div>
                <div class="col">
                    <div class="titre mt-2">
                        <h5>Nom operateur</h5>
                    </div>
                    <div class="champ">
                        <select name="IDOperateur" id="">
                            @foreach( $operateurs as $operateur)
                            <option value="{{$operateur->id}}">{{$operateur->employe->nom_emp}} {{$operateur->employe->prenom_emp}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>             
        
    <div class="boutons mt-5 mb-4">
        <button type="submit" role="button" id="titleadd" class="btn" data-toggle="modal"><i class="bi bi-plus-circle-fill"></i><span> Créer</span></button>
        <a href="{{route('ListeDesBonsDeSortie.affiche')}}" id="titledelete" class="btn " data-toggle="modal"><i class="bi bi-dash-circle-fill"></i><span> Annuler</span></a>
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
		$(document).on('change','.IDOrdre',function()
        {
			var id_ordre=$(this).val();
			var div=$(this).parent().parent().parent().parent();
            console.log(div);
            var op='';
			$.ajax(   
            {
				type:'get',
				url:'{{route("BS.findinformation")}}',
				data:{'id':id_ordre},
                dataType:"json",
				success:function(data)
                {
                    console.log(data.length);
                    op+='<option value="">--Choisir Un Type Outil--</option>'
                    for(var i=0;i<data.length;i++)
                    {
                     
                        op+='<option value="'+data[i].DesTypeOutil+'">'+data[i].DesTypeOutil+'</option>';
				    }
                    div.find('.DesTypeOutil').html(' ');
                    div.find('.DesTypeOutil').append(op);
				},
				error:function()
                {
                    console.log('error');
				}
			});
		});

        $(document).on('change','.DesTypeOutil',function()
        {
			var id_ordre=$(this).val();
			var div=$(this).parent().parent().parent();
            console.log(id_ordre);
            console.log(div);
            var op='';
			$.ajax(   
            {
				type:'get',
				url:'{{route("BS.findOutil")}}',
				data:{'id':id_ordre},
                dataType:"json",
				success:function(data)
                {
                    console.log(data.length);
                    op+='<option value="">--Choisir Un Outil--</option>'
                    if(data.length==0)
                    {
                        op='<option value="">--Aucun Outil Disponible--</option>'
                    }
                    else{
                        for(var i=0;i<data.length;i++)
                    {
                        op+='<option value="'+data[i].DesOutilMesure+'">'+data[i].DesOutilMesure+'</option>';
				    }
                    }
                    
                    div.find('.DesOutil').html(' ');
                    div.find('.DesOutil').append(op);
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