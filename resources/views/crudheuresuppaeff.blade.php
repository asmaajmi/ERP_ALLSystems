@extends("navbarsidebarRH")
@section("contenu")
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<div class="container">
	<div class="crudpoineff">
		<div class="cards">
			<div class="card" id="c1">
				<div class="card-content">
					<div class="card-name">Nombre des heures <br>supplémentaires à effectuer</div>
					<div class="number">67</div>

				</div>
				<div class="icon-box">
					<i class="fas fa-alarm-clock"></i>
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
			<div class="rowheureeff">
				<div>
					<h2 class="listetitle">Liste <b>des heures supplémentaires à effectuer</b></h2>
				</div>
				<div >
					<a href="{{route('heureaeff.form')}}" id="titleadd" class="btn" data-toggle="modal"><i class="fas fa-plus-circle"></i> <span>Ajouter </span></a>
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
					<th scope="col ">Nom&prenom</th>
					<th scope="col ">Date</th>
					<th scope="col ">Heure debut</th>
					<th scope="col ">Heure fin</th>
					<th scope="col ">Prix</th>
					<th scope="col ">Validation</th>
					<th scope="col ">Actions</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($heureaeffs as $heureaeff)
				<tr>
					<td scope="col ">
						<input type="checkbox" aria-label="Checkbox for following text input">
					</td>
					<td>{{$heureaeff->employe['nom_emp']}}&nbsp;{{$heureaeff->employe['prenom_emp']}}</td>
					<td>{{$heureaeff->dt_heure_supp}}</td>
					<td>{{$heureaeff->hr_debut}}</td>
					<td>{{$heureaeff->hr_fin}}</td>
					<td>{{$heureaeff->prix}}</td>

					<td>
						@if ($heureaeff['validation']==NULL)
						En Attente 
						@else
						{{$heureaeff->validation}}
						@endif
					</td>
					<td>
						<a href="{{ route('heureaeff.edit' ,['heureaeff'=>$heureaeff->id])}}" class="btn" id="edit"><i   class="fas fa-marker"></i></a>
						<a href="{{ route('validation.edit' ,['heureaeff'=>$heureaeff->id])}}" class="btn" id="eye"><i   class="fas fa-user-check"></i></a>
						<form id="form.{{$heureaeff->id}}" action="{{route('heureaeff.supprimer',['heureaeff'=>$heureaeff->id])}}" method="POST" class="formdelete">
						@csrf
						<a href="#" class="btn delete-confirm" id="delete"><i  class="fas fa-trash"></i></a>
						<input type="hidden" name="_method" value="delete">
						</form>
					</td>
				</tr>
				@endforeach
				
			</tbody>
		</table>
		<div style="float: right">
			{{$heureaeffs->links()}}
		</div>

	</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script>
$('.delete-confirm').click(function(event) {
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