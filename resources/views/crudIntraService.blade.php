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
					<h2 class="listetitle">Liste <b>des intra_extra_services</b></h2>
				</div>

				<!--<form class="d-flex col-sm-3">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Rechercher" aria-label="Recipient's username" aria-describedby="button-addon2">
					<button class="btn" type="button" id="button-addon2"><i class="bi bi-search"></i></button>
				</div>
			</form>-->

				<div>
					<a href="{{route('Intraservice.form')}}" id="titleaddintraservice" class="btn" data-toggle="modal"><i class="fas fa-plus-circle"></i> <span>Ajouter Un Intra Service </span></a>
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
							<th scope="col ">Opérateur</th>
							<th scope="col ">Superviseur</th>
							<th scope="col ">Service</th>
							<th scope="col ">Date debut</th>
							<th scope="col ">Date fin</th>
							<th scope="col ">Heure debut</th>
							<th scope="col ">Heure fin</th>
							<th scope="col ">Prime</th>
							<th scope="col ">Actions</th>
						</tr>
					</thead>

					<tbody>
							@foreach($intraservs as $intraservice)
							
							  
						<tr>
							<td scope="col ">
								<input type="checkbox" aria-label="Checkbox for following text input">
							</td>
							@foreach($employes as $employe)
							@if($intraservice->id_emp_op == $employe->id)
							<td>{{ $employe->nom_emp }}&nbsp;{{ $employe->prenom_emp}}</td>
							@endif
							@endforeach
							@foreach($employes as $employe)
							@if($intraservice->id_emp_sup == $employe->id)
							<td>{{ $employe->nom_emp }}&nbsp;{{ $employe->prenom_emp}}</td>
							@endif
							@endforeach
							
							@foreach($services as $service)
							@if($intraservice->id_serv == $service->id)
							<td>{{$service->des_serv}}</td>
							@endif
							@endforeach
							<td>{{$intraservice->dte_deb_ex_ser}}</td>
							<td>{{$intraservice->dte_fin_ex_ser}}</td>
							<td>{{$intraservice->hr_deb_ex_ser}}</td>
							<td>{{$intraservice->hr_fin_ex_ser}}</td>
							<td>{{$intraservice->prime_sup}}</td>
							<td>
								
								<a href="{{route('intraservice.edit', ['intraservice'=>$intraservice->id])}}" class="btn edit"><i   class="fas fa-marker"></i></a>

								<form id="form-{{$intraservice->id}}" action="{{route('intraservice.supprimer', ['intraservice'=>$intraservice->id])}}" method="POST" class="formdeleteintraserv">
									@csrf
								<input type="hidden" name="_method" value="delete">

									<a href="#" class="btn delete-confirm" id="delete"><i  class="fas fa-trash"></i></a>
								</form>

							</td>

						</tr>
							@endforeach
					</tbody>
				</table>
				{{--<div style="float: right">
					{{$intraserv->links()}}
				</div>--}}
	</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script>
$('.formdeleteintraserv').click(function(event) {
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
