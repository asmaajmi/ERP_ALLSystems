@extends("navbarsidebarRH")
@section("contenu")
<link rel="stylesheet" href="{{asset('css/crudpausepoint.css')}}">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<div class="container">
	<div class="crudpointaeff">
		<div class="cards">
			<div class="card" id="c1">
				<div class="card-content">
					<div class="card-name">Nombre des pointages<br> à effectuer</div>
					<div class="number">67</div>
				</div>
				<div class="icon-box">
					<i class="fas fa-hand-pointer"></i>
				</div>
			</div>
			<div class="card" id="c2">
				<div class="card-content">
					<div class="card-name">Nombre des empolyés</div>
					<div class="number">67</div>

				</div>
				<div class="icon-box">
					<i class="fas fa-users"></i>
				</div>
			</div>
			<div class="card" id="c3">
				<div class="card-content">
					<div class="card-name">Nombre des pauses<br> à effectuer</div>
					<div class="number">67</div>
				</div>
				<div class="icon-box">
					<i class="fas fa-pause-circle"></i>
				</div>
			</div>
		</div>
		<div class="table-title">
			<div class="rowbtn">
				<div>
					<h2 class="listetitle">Liste <b>Des pointages à effectuer</b></h2>
				</div>

				<div>
					<a href="{{route('pointaeff.create')}}" id="titleaddpa" class="btn" data-toggle="modal"><i class="fas fa-plus-circle"></i> <span>Ajouter Un Pointage</span></a>
					<a href="{{route('pause.form')}}" id="titleaddpa" class="btn" data-toggle="modal"><i class="fas fa-plus-circle"></i> <span>Ajouter Une Pause</span></a>
					<a href="#" id="titledeletepa" class="btn" data-toggle="modal"><i class="fas fa-minus-circle"></i> <span>Supprimer</span></a>
				</div>

			</div>
		</div>
	
		<div>
		<div class="" id="ligneselect">
				<table>
					<tr class="txt">
						<div class="placetit">
						<td>Nom & Prenom </td>
						<td>Designation</td>
						<td>Année</td>
						</div>
					</tr>
					
					<tr class="input">
						<td>
							<div class="champlistpa">
							<select name="id_emp" id="empselect">
							<option value="0"></option>
								@foreach ($employes as $employe)
								<option value="{{$employe->id}}">{{$employe->prenom_emp}}&nbsp;{{$employe->nom_emp}}</option>
								@endforeach
							</select>
							</div>
						</td>
						<td>
							<div class="champlistpa" id="seldes">
								<select id="selectdes" name="designation">
								</select>
							</div>
						</td>
						<td>
							<div class="champlistpa" id="seldtdeb">
							<select id="selectdtdeb" name="datedebut">
								</select>
							</div>
							
						</td>
						
					</tr>
					</div>
					<tr>
						<td>
					
					<a href="javascript:;" class="button-22"  id="pausebtn" >Liste Des Pauses</a>
				</td>
</div>
			</tr>
					
				</table>
				</div>
				<table class="table  mt-4 table1">
					
					<thead>
						<tr>
							<th scope="col "><span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							</span></th>
							<th scope="col " id="jour">Jour</th>
							<th scope="col " id="heureentree">Heure Entrée</th>
							<th scope="col " id="heuresortie">Heure Sortie</th>
							<th scope="col " id="action">Action
							</th>
						</tr>
					</thead>

					<tbody id="tablignes1">
                        
                        
					</tbody>
				</table>
		</div>


		<div id="pause-modal">
    <div class="model">
        <div class="top-form">
            <div class="close-modal">
                &#10006;
            </div>
        </div>              
            <div class="pause-form">
                <h2 id="listepausetit">Liste des pauses</h2>
				<div class="champjourpauses">                    
                           
                           <select name="desj" id="selectdesj">
							
							</select>
                                </div>
                
				<table class="table  mt-4 table2">
					
					<thead>
						<tr>
							<th scope="col "><span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							</span></th>
							<th scope="col " id="desp">Designation De Pause</th>
							<th scope="col " id="heuredeb">Heure Début</th>
							<th scope="col " id="heurefin">Heure Fin</th>
							<th scope="col " id="action">Action
							</th>
						</tr>
					</thead>

					<tbody id="tablignes2">
                        
                        
					</tbody>
				</table>
             
                
            </div>        
    </div>
</div>


					
         </div>
<meta name="csrf-token" content="{{ csrf_token() }}">
<script>
    $(document).ready(function(){
        $(document).on('change','#empselect',function(){
            console.log("its work good");

            var emp_id=$(this).val();
            
            var div = $("#seldes").parent();
            console.log(div);
            var op=" ";
            $.ajax({
                type:'get',
                url:'{!!URL::to('/RH/crudpointageaeff/des')!!}',
                data:{'idemp':emp_id},

                success:function(data){
                    // console.log('success');
                    // console.log(data);
                    // console.log(data.length);
                op+='<option value="0" disabled="true" selected="true">-La Designation-</option>';
				for(var i=0;i<data.length;i++){
				//console.log(op);
				op+='<option value="'+data[i].designation_periode+'">'+data[i].designation_periode+'</option>';}
                console.log(op);
                div.find('#selectdes').html(" ");
			    div.find('#selectdes').append(op);
			},
            });
        });

		$(document).on('change','#selectdes',function(){
            console.log("its work good");

            var despoint=$(this).val();
            // console.log(datedeb_id);
            var div = $("#seldtdeb").parent();
            console.log(div);
            var op=" ";
            $.ajax({
                type:'get',
                url:'{!!URL::to('/RH/crudpointageaeff/datedeb')!!}',
                data:{'des':despoint},
                success:function(data){
                    // console.log('success');
                    // console.log(data);
                    // console.log(data.length);
                op+='<option value="0" disabled="true" selected="true">-Année-</option>';
				for(var i=0;i<data.length;i++){
				//console.log(op);
				op+='<option value="'+data[i].id+'">'+data[i].annee+'</option>';}
                console.log(op);
                div.find('#selectdtdeb').html(" ");
			    div.find('#selectdtdeb').append(op);

			},
            });
		   });

		$(document).on('change','#selectdtdeb',function(){
            console.log("its work good");

            var dtfin=$(this).val();
			var id_p=$("#selectdtdeb").val();
            // console.log(datedeb_id);
            var div = $(".table1").parent();
            console.log(div);
            var op=" ";
            $.ajax({
                type:'get',
                url:'{!!URL::to('/RH/crudpointageaeff/lignes')!!}',
                data:{'dtfinpause':dtfin, 'idpoint':id_p},
                success:function(data){
                    console.log('success');
                    console.log(data);
                    console.log(data.length);
					for(var i=0;i<data.length;i++){
				//console.log(op);
				op+='<tr>'+'<th>'+'<span class="custom-checkbox">'
						  +'<input type="checkbox"" name="option[]" value="1">'
						  +'</th>'
						  +'<td>'+data[i].designation_j+'</td>'
					      +'<td>'+data[i].heure_entree_j+'</td>'
						  +'<td>'+data[i].heure_sortie_j+'</td>'
						  +'<td>'+'<a href="# " class="btn edit">'+'<i   class="fas fa-marker">'+'</i>'+'</a>'
								 +'<form class="jourdelete">'+
								  '<button value="'+data[i].id+'" class="btn deletejour" id="delete">@csrf<i class="fas fa-trash"></i>'+
							      '</button>'+'</form>'
						 +'</td>'												
						 +'</tr>';}
                console.log(op);
                div.find('#tablignes1').html(" ");
			    div.find('#tablignes1').append(op);
            
			},
            });
			$(document).on('click','#delete',function(e){

				e.preventDefault();

			var jour_id=$(this).val();
			console.log(jour_id);

			var token = $("meta[name='csrf-token']").attr("content");

			var url = '{{ route("jour.supprimer", ":jour") }}';
			url = url.replace(':jour', jour_id );


			swal({
				title: `Voulez-vous vraiment supprimer cet enregistrement ?`,
				text: "Si vous le supprimez, il disparaîtra pour toujours.",
				icon: "warning",
				buttons: ["Annuler", "Confirmer!"],
				dangerMode: true,
				closeOnConfirm: false 
			})


			.then((willDelete) => {

				location.reload();

       			if (willDelete) {

					$.ajaxSetup({

						headers: {
							'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
						}

					});

           			$.ajax({

						url:url,
						type: 'delete',
						data:{
						'_token': token},
						dataType: 'json',
						success: function (data){

					},

						error: function (data, textStatus, errorThrown) {
							console.log(data);

						}

					});

				}
			});
			
		});		


		$(document).on('click','.pausecrud',function(e){

		e.preventDefault();
		$('#pause-modal').fadeIn().css("display", "flex");
	  
       });

	});

		$(document).on('change','#selectdtdeb',function(){
            console.log("its work good");
            var point_id=$(this).val();
            var div = $('.champjourpauses').parent();
            console.log(div);
            var op=" ";
            $.ajax({
                type:'get',
                url:'{!!URL::to('/RH/crudpointageaeff/jourpause')!!}',
                data:{'idpoint':point_id},

                success:function(data){
                    console.log('success');
                    console.log(data);
                    console.log(data.length);
				var des = $('#selectdes').val();
				$('#listepausetit').text("Liste des pauses pour "+des);
                op+='<option value="0" disabled="true" selected="true">-Jours-</option>';
				for(var i=0;i<data.length;i++){
				console.log(op);
				op+='<option value="'+data[i].id+'">'+data[i].designation_j+'</option>';}
                console.log(op);
                div.find('#selectdesj').html(" ");
			    div.find('#selectdesj').append(op);

			    },
        });
    });





	$(document).on('change','#selectdesj',function(){
            console.log("its work good");

            var jourp=$(this).val();
            // console.log(datedeb_id);
            var div = $(".table2").parent();
            console.log(div);
            var op=" ";
            $.ajax({
                type:'get',
                url:'{!!URL::to('/RH/crudpointageaeff/pausedepointage')!!}',
                data:{'jour_pause':jourp},
                success:function(data){
                    console.log('success');
                    console.log(data);
                    console.log(data.length);
					for(var i=0;i<data.length;i++){
				//console.log(op);
				op+='<tr>'+'<th>'+'<span class="custom-checkbox">'
						  +'<input type="checkbox"" name="option[]" value="1">'
						  +'</th>'
						  +'<td>'+data[i].designation_pause+'</td>'
					      +'<td>'+data[i].heure_deb_pause+'</td>'
						  +'<td>'+data[i].heure_fin_pause+'</td>'
						  +'<td>'+'<a href="# " class="btn edit">'+'<i   class="fas fa-marker">'+'</i>'+'</a>'
						  +'<form class="pausedelete">'+
								  '<button value="'+data[i].id+'" class="btn delete" id="deletepause">@csrf<i class="fas fa-trash"></i>'+
							      '</button>'+'</form>'	
								  +'</td>'
								  +'</tr>';}
                console.log(op);
                div.find('#tablignes2').html(" ");
			    div.find('#tablignes2').append(op);
            
			},
            });

		$(document).on('click','#deletepause',function(e){

			e.preventDefault();

			var pause_id=$(this).val();
			console.log(pause_id);

			var token = $("meta[name='csrf-token']").attr("content");

			var url = '{{ route("pause.supprimer", ":pause") }}';
			url = url.replace(':pause', pause_id );


			swal({
			title: `Voulez-vous vraiment supprimer cet enregistrement ?`,
			text: "Si vous le supprimez, il disparaîtra pour toujours.",
			icon: "warning",
			buttons: ["Annuler", "Confirmer!"],
			dangerMode: true,
			closeOnConfirm: false 
			})


			.then((willDelete) => {

			location.reload();

   			if (willDelete) {

			$.ajaxSetup({

			headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}

			});

	   $.ajax({

		url:url,
		type: 'delete',
		data:{
		'_token': token},
		dataType: 'json',
		success: function (data){

	},

		error: function (data, textStatus, errorThrown) {
			console.log(data);

		}

	});

}
});

});		

        });

	});
</script>


<script>
$(function(){
   $('#pausebtn').click(function(){
      $('#pause-modal').fadeIn().css("display", "flex");
	  
   });

   $('.close-modal').click(function(){
      $('#pause-modal').fadeOut();
    });

});
</script> 
@endsection