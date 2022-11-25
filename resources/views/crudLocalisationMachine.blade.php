@extends("navbarsidebarParcMachine")
@section("contenu")
<div class="container">
	<div class="crudpointaeff">
		{{--<div class="cards">
			<div class="card" id="c1">
				<div class="card-content">
					<div class="card-name">Nombre des bureaux</div>
					<div class="number">67</div>

				</div>
				<div class="icon-box">
					<i class="fas fa-building"></i>
				</div>
			</div>
			<div class="card" id="c2">
				<div class="card-content">
					<div class="card-name">Nombre des services</div>
					<div class="number">67</div>

				</div>
				<div class="icon-box">
					<i class="fas fa-sigma"></i>
				</div>
			</div>
			<div class="card" id="c3">
				<div class="card-content">
					<div class="card-name">Nombre des directeurs</div>
					<div class="number">67</div>
				</div>
				<div class="icon-box">
					<i class="fas fa-user-tie"></i>
				</div>
			</div>
		</div>--}}
		<div class="table-title">
			<div class="rowlocmachine">
				<div>
					<h2 class="listetitle">Liste <b>des ateliers</b></h2>
				</div>
				<div class="champlistloc" id="selectmachineloc">
					<select name="id_machine" class="nom_machine">
						<option selected>--choisir la machine--</option>
						@foreach ($machines as $machine)							
						<option value="{{$machine->DesMachine}}">{{$machine->nom_machine}}</option>
						@endforeach

					</select>
				</div>
				<div class="champlistloc" id="emp_machine">
					<select name="emp_machine" class="emplacement">
						
					</select>
				</div>
				<div>
					<a href="{{route('LocMachine.form')}}" id="titleadd" class="btn" data-toggle="modal"><i class="fas fa-plus-circle"></i> <span>Ajouter </span></a>
					<a href="#" id="titledelete" class="btn" data-toggle="modal"><i class="fas fa-minus-circle"></i> <span>Supprimer</span></a>
				</div>

			</div>
		</div>
	
				<table class="table tablelocMachine  mt-5">
					<thead>
						<tr>
							<th scope="col "><span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							</span></th>
							<th scope="col ">Designation de l'atelier</th>
							<th scope="col ">Adresse</th>
							<th scope="col ">Actions</th>
						</tr>
					</thead>

					<tbody class="listatelier">
			

					</tbody>
				</table>

	</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
	$(document).ready(function(){
	//document.getElementById(prix).disabled = true;

	$(document).on('change','.nom_machine',function(){
	// console.log("hmm its change");

		var emp_id=$(this).val();
			//console.log(employe_id);

		var div=$('#emp_machine').parent();
		// console.log(div);

		var op=" ";
		
		$.ajax({
			type:'get',
			url:'{!!URL::to('/ParcMachine/LocalisationMachine/findemp')!!}',
			data:{'id':emp_id},
			success:function(data){
				console.log('success');
				//console.log(data.length);
				op+='<option  value="0" disabled="true" selected="true">Lemplacement</option>';
				for(var i=0;i<data.length;i++){

				//console.log(data.data2[i].id);
					{op+='<option value="'+data[i].id_emplacement+'">'+data[i].des_emp_fk+'</option>';}
				
				
				
			}

			div.find('.emplacement').html(" ");
			div.find('.emplacement').append(op);
			},
			error:function(){

			}
		});
	});
	$(document).on('change','.emplacement',function(){
		// console.log("hmm its change");
	
			var machine_id=$(this).val();
			console.log(machine_id);
	
			var div=$('.table').parent();
			// console.log(div);
	
			var op=" ";
			
			$.ajax({
				type:'get',
				url:'{!!URL::to('/ParcMachine/LocalisationMachine/list')!!}',
				data:{'id':machine_id},
				dataType: 'json',
	
				success:function(data){
					console.log('success');
					console.log(data);
					for(var i=0;i<data.length;i++){	
					op+='<tr>'+
							'<td scope="col ">'+
								'<input type="checkbox" aria-label="Checkbox for following text input">'+
							'</td>'+
							'<td>'+data[i].des_atelier+'</td>'+
							'<td>'+data[i].adr_atelier+'</td>'+
							'<td>'+
								'<button value="'+data[i].id+'" class="btn" id="edit"><i   class="fas fa-marker"></i></button>'+
								
								'<form class="formdeleteatelier">'+
									
									'<button value="'+data[i].id+'" class="btn delete-confirm" id="delete">@csrf<i  class="fas fa-trash"></i>'+
								'</button></form>'+

							'</td>'+
						'</tr>';
						
				}
	
				div.find('.listatelier').html(" ");
				div.find('.listatelier').append(op);
				},
				error:function(){
	
				}
				
			});
	
	
			//pour afficher l alerte quand on clique sur le bouton delete et faire appel a la route qui 
			//contient le fonction delete pour supprimer ligne selectionné
	
			
	
		});
	$(document).on('click','#edit',function(e){

		e.preventDefault();

		var atelier_id=$(this).val();
		console.log(atelier_id);
		var token = $("meta[name='csrf-token']").attr("content");

		var url = '{{ route("LocMachine.edit", ":atelier") }}';
		url = url.replace(':atelier', atelier_id );
			$.ajax({
			url:url,
			type: 'get'})
			.done( 

			function(data) 

			{

				$('.container').html(data.html);

			}
		);

	
	});

	$(document).on('click','#delete',function(e){

		e.preventDefault();

		var atelier_id=$(this).val();
		console.log(atelier_id);
		var token = $("meta[name='csrf-token']").attr("content");

		var url = '{{ route("LocMachine.supprimer", ":atelier") }}';
		url = url.replace(':atelier', atelier_id );


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
}); 

</script>
@endsection
