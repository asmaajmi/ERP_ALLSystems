@extends("navbarsidebarRH")
@section("contenu")

<div class="container">
	<div class="crudpointaeff">
		<div class="cards">
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
		</div>
		<div class="table-title">
			<div class="rowserviceextra">
				<div>
					<h2 class="listetitle">Liste <b>des inter_extra_services</b></h2>
				</div>
				<div id="btninter">
					<a href="{{route('Interservice.form')}}" id="titleadd" class="btn" data-toggle="modal"><i class="fas fa-plus-circle"></i> <span>Ajouter Un Inter Service</span></a>
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
							<th scope="col ">Nom&prenom</th>
							<th scope="col ">Date debut</th>
							<th scope="col ">Date fin</th>
							<th scope="col ">Cout</th>
							<th scope="col ">Missions</th>
							<th scope="col ">Prime</th>
							<th scope="col ">Prime Total</th>
							<th scope="col ">Actions</th>
						</tr>
					</thead>

					<tbody>
						@foreach ($inter_services as $item )
							
						<tr>
							<td scope="col ">
								<input type="checkbox" aria-label="Checkbox for following text input">
							</td>
							<td>{{$item->employes['nom_emp']}}&nbsp;{{$item->employes['prenom_emp']}}</td>
							<td>{{$item->dt_debut_ex_serv}}</td>
							<td>{{$item->dt_fin_ex_serv}}</td>
							<td>{{$item->cout_par_utilisation}}</td>
							<td>
								@foreach ($item->missions  as $miss )
									{{$miss->des_mission}}
									<br>
									<br>
								@endforeach
							</td>
							<td>
								@foreach ($prime as $miss)
								@if ($item->id == $miss->id_inter_serv)	

									{{$miss->prime}}
									<br>
									<br>
								@endif

								@endforeach
							</td>
							<td>{{$item->prime_total_a_payer}}</td>
							<td>
								<a href="{{route('mission.form',['interservice'=>$item->id])}}" class="btn" id="eye"><i  class="fas fa-plus"></i></a>
								<a href="{{route('Interservice.edit',['interservice'=>$item->id])}}" class="btn" id="edit"><i   class="fas fa-marker"></i></a>
								
								@foreach ($item->missions  as $miss )								
								<form id="form.{{$miss->id}}{{$item->id}}" action="{{route('mission.supprimer',['missions'=>$miss->id,'inter_Service'=>$item->id])}}" method="POST" class="formdelete">
									@csrf
									<input type="hidden" name="_method" value="delete">
								@endforeach

									<a href="#" class="btn delete-confirm"id="delete"><i  class="fas fa-trash"></i></a>
								</form>


								<form id="form.{{$item->id}}" action="{{route('interservice.supprimer',['interserv'=>$item->id])}}" method="POST" class="formdeleteall">
									@csrf
									<a href="#" class="btn delete-confirm" id="deleteserv"><i  class="fas fa-ban"></i></a>
									<input type="hidden" name="_method" value="delete">

								</form>

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
<script>
$('.formdelete').click(function(event) {
	var form =  $(this).closest("form");
	var name = $(this).data("name");
	event.preventDefault();
	swal({
		title: `Voulez-vous vraiment supprimer cet enregistrement ?`,
		text: "Si vous le supprimez, il disparaîtra pour toujours.",
		icon: "warning",
		buttons: ["Annuler", "Confirmer!"],
		dangerMode: true,
	})
	.then((willDelete) => {
	  if (willDelete) {
		form.submit();
	  }
	});
});
$('.formdeleteall').click(function(event) {
	var form =  $(this).closest("form");
	var name = $(this).data("name");
	event.preventDefault();
	swal({
		title: `Voulez-vous vraiment supprimer cet enregistrement ?`,
		text: "Si vous le supprimez, il disparaîtra pour toujours.",
		icon: "warning",
		buttons: ["Annuler", "Confirmer!"],
		dangerMode: true,
	})
	.then((willDelete) => {
	  if (willDelete) {
		form.submit();
	  }
	});
});
</script>
@endsection
