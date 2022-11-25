@extends("navbarsidebarRH")
@section("contenu")
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<div class="container">
	<div class="crudpoineff">
		<div class="cards">
			<div class="card" id="c1">
				<div class="card-content">
					<div class="card-name">Nombre des congés planifié</div>
					<div class="number">52</div>

				</div>
				<div class="icon-box">
					<i class="fas fa-bells"></i>
				</div>
			</div>
			<div class="card" id="c2">
				<div class="card-content">
					<div class="card-name">Nombre des Directeurs</div>
					<div class="number">67</div>

				</div>
				<div class="icon-box">
					<i class="fas fa-user-tie"></i>
				</div>
			</div>
			<div class="card" id="c3">
				<div class="card-content">
					<div class="card-name">Nombre des Employés</div>
					<div class="number">67</div>
				</div>
				<div class="icon-box">
					<i class="fas fa-users"></i>
				</div>
			</div>
		</div>
		<div class="table-title">
			<div class="rowcongenonplanifie">
				<div>
					<h2 class="listetitle">Liste <b>Des Congés non planifiés</b></h2>
				</div>
				<div class="champlistConNonPlanifier">
					<select name="idemp" class="employename" id="id_emp">
						<option selected>--choisir l'employe--</option>
						@foreach ($employes as $employe)
						<option value="{{$employe->id}}">{{$employe->prenom_emp}}&nbsp;{{$employe->nom_emp}}</option>
						@endforeach

					</select>
				</div>
				<div class="boutonconge">
					<a href="{{route('congenonplanifie.form')}}" id="titleadd" class="btn" data-toggle="modal"><i class="fas fa-plus-circle"></i> <span>Ajouter </span></a>
					<a href="#" id="titledelete" class="btn" data-toggle="modal"><i class="fas fa-minus-circle"></i> <span>Supprimer</span></a>
				</div>

			</div>
		</div>

		<table class="table listnoform mt-4">
			<thead>
				<tr>
					<th scope="col ">
						<span class="custom-checkbox">
						<input type="checkbox" id="selectAll">
						<label for="selectAll"></label>
					</span>
				</th>
					<th scope="col ">Designation congé</th>
					<th scope="col ">Date debut</th>
					<th scope="col ">Date fin</th>
					<th scope="col ">Nombre des jours non payés</th>
					<th scope="col ">Nombre des jours payés</th>
					<th scope="col ">Actions</th>
				</tr>
			</thead>

			<tbody class="listconge">
			</tbody>
		</table>
	</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

<script type="text/javascript">
$(document).ready(function(){
	//document.getElementById(prix).disabled = true;

	$(document).on('change','.employename',function(){
	// console.log("hmm its change");

		var employe_id=$(this).val();
		//console.log(employe_id);

		var div=$('.table').parent();
		// console.log(div);

		var op=" ";
		
		$.ajax({
			type:'get',
			url:'{!!URL::to('/RH/conge/Nonplanifie/list')!!}',
			data:{'idemp':employe_id},
			dataType: 'json',

			success:function(data){
				console.log('success');
				for(var i=0;i<data.length;i++){
				
				op+='<tr>'+
						'<td scope="col ">'+
							'<input type="checkbox" aria-label="Checkbox for following text input">'+
						'</td>'+
						'<td>'+data[i].designation_conge+'</td>'+
						'<td>'+data[i].date_debut_conge+'</td>'+
						'<td>'+data[i].date_fin_conge+'</td>'+
						'<td style="text-align:center;">'+data[i].nbre_jours_nonpayés+'</td>'+
						'<td style="text-align:center;">'+data[i].nbre_jours_payés+'</td>'+
						'<td>'+
							//'<a href="# " class="btn" id="eye"><i  class="fas fa-eye"></i></a>'+
							'<a href="# " class="btn" id="edit"><i   class="fas fa-marker"></i></a>'+
							'<form class="congedelete">'+
							'<button value="'+data[i].id+'" class="btn delete_conge" id="delete">@csrf<i class="fas fa-trash"></i>'+
							'</button></form>'+
			
						'</td>'+

					'</tr>';
				
			}

			div.find('.listconge').html(" ");
			div.find('.listconge').append(op);
			},
			error:function(){

			}
			
		});


		//pour afficher l alerte quand on clique sur le bouton delete et faire appel a la route qui 
		//contient le fonction delete pour supprimer ligne selectionné

		$(document).on('click','#delete',function(e){

			e.preventDefault();

			var conge_id=$(this).val();

			var token = $("meta[name='csrf-token']").attr("content");

			var url = '{{ route("congenonp.supprimer", ":conge") }}';
			url = url.replace(':conge', conge_id );


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

});

</script>
@endsection