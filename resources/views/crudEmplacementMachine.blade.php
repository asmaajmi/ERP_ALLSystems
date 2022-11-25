@extends("navbarsidebarParcMachine")
@section("contenu")
<meta name="csrf-token" content="{{ csrf_token() }}">

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
			<div class="rowempmachine">
				<div>
					<h2 class="listetitle">Liste <b>des emplacements des machines</b></h2>
				</div>
				<div class="champlist" id="selectmachine">
					<select name="id_machine" class="nommachine">
						<option selected>--choisir la machine--</option>
						@foreach ($machines as $machine)							
						<option value="{{$machine->DesMachine}}">{{$machine->nom_machine}}</option>
						@endforeach

					</select>
				</div>
				<div id="btncrudemp">
					<a href="{{route('EmpMachine.form')}}" id="titleadd" class="btn" data-toggle="modal"><i class="fas fa-plus-circle"></i> <span>Ajouter </span></a>
					<a href="#" id="titledelete" class="btn" data-toggle="modal"><i class="fas fa-minus-circle"></i> <span>Supprimer</span></a>
				</div>

			</div>
		</div>
	
				<table class="table  mt-4">
					<thead>
						<tr>
							<th scope="col "><span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							</span></th>
							<th scope="col ">Designation de l'emplacement</th>
							<th scope="col ">Largeur</th>
							<th scope="col ">Longueur</th>
							<th scope="col ">Hauteur</th>
							<th scope="col ">Actions</th>
						</tr>
					</thead>

					<tbody class="listemplacement">
						@foreach ($emp_machines as $emp_machine)
						<tr>
							<th><span class="custom-checkbox">
								<input type="checkbox" id="{{ $loop->index+ 1 }}" name="option[]" value="1">
								<label for="{{ $loop->index+ 1 }}"></label></th>
							<td>{{$emp_machine->des_emp}}</td>
							<td>{{$emp_machine->x_emp}}</td>
							<td>{{$emp_machine->y_emp}}</td>
							<td>{{$emp_machine->z_emp}}</td>
							
							<td>
								<form class="" action="get">
								<button  class="btn" id="edit"> @csrf <i class="fas fa-marker"></i></button>
							</form>
								<form class="formdeleteemp">
									
									<button  class="btn delete-confirm" id="delete">@csrf<i class="fas fa-trash"></i>
								</button></form>

							</td>
						</tr>
						@endforeach	
					</tbody>
				</table>
				{{--<div style="float: right">
					{{$bureau->links()}}
				</div>--}}
	</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		//document.getElementById(prix).disabled = true;
	
		$(document).on('change','.nommachine',function(){
		// console.log("hmm its change");
	
			var machine_id=$(this).val();
	
			var div=$('.table').parent();
			// console.log(div);
	
			var op=" ";
			
			$.ajax({
				type:'get',
				url:'{!!URL::to('/ParcMachine/empMachine/list')!!}',
				data:{'idmachine':machine_id},
				dataType: 'json',
	
				success:function(data){
					console.log('success');
					console.log(data);
					for(var i=0;i<data.data2.length;i++){
						console.log(data.data2[i])
						console.log(data.data1[i])
							
					op+='<tr>'+
							'<td scope="col ">'+
								'<input type="checkbox" aria-label="Checkbox for following text input">'+
							'</td>'+
							'<td>'+data.data2[i].des_emp_fk+'</td>'+
							'<td>'+data.data2[i].y_emp+'</td>'+
							'<td>'+data.data2[i].x_emp+'</td>'+
							'<td>'+data.data2[i].z_emp+'</td>'+
							'<td>'+data.data2[i].date_emp+'</td>'+

							'<td>'+
								'<form class="" action="get">'+
								'<button value="'+data.data1[i].id+'" class="btn" id="edit"> @csrf<i   class="fas fa-marker"></i></button>'+
							'</form>'+
								'<form class="formdeleteemp">'+
									
									'<button value="'+data.data1[i].id+'" class="btn delete-confirm" id="delete">@csrf<i  class="fas fa-trash"></i>'+
								'</button></form>'+

							'</td>'+

						'</tr>'
						
				}
	
				div.find('.listemplacement').html(" ");
				div.find('.listemplacement').append(op);
				},
				error:function(){
	
				}
				
			});
	
	
			//pour afficher l alerte quand on clique sur le bouton delete et faire appel a la route qui 
			//contient le fonction delete pour supprimer ligne selectionné
	
			
	
		});
		$(document).on('click','#delete',function(e){

			e.preventDefault();

			var emp_id=$(this).val();
			console.log(emp_id);
			var token = $("meta[name='csrf-token']").attr("content");

			var url = '{{ route("EmpMachine.supprimer", ":emplacement") }}';
			url = url.replace(':emplacement', emp_id );


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
		$(document).on('click','#edit',function(e){

			e.preventDefault();

			var emp_id=$(this).val();
			console.log(emp_id);
			var token = $("meta[name='csrf-token']").attr("content");

			var url = '{{ route("EmpMachine.edit", ":emplacement") }}';
			url = url.replace(':emplacement', emp_id );
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
	});
</script>
@endsection
