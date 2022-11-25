@extends("navbarsidebarMRP2")
@section("contenu")
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<div class="container">
	<div class="crudpoineff">
		<div class="table-title">
			<div class="rowheureeff">
				<div>
					<h2 class="listetitle">Liste <b>des prévisions de vente</b></h2>
				</div>
				<div >
					<a href="{{route('Previson_Vente.create')}}" id="titleadd" class="btn" data-toggle="modal"><i class="fas fa-plus-circle"></i> <span>Ajouter </span></a>
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
					<th scope="col ">Produit</th>
					<th scope="col ">Unité</th>
					<th scope="col ">Type</th>
					<th scope="col ">N°semaine/jour</th>
					<th scope="col ">Prévision</th>
					<th scope="col ">Actions</th>
				</tr>
			</thead>

			<tbody>
				<tr>
					<td scope="col ">
						<input type="checkbox" aria-label="Checkbox for following text input">
					</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td>
						<a href="" class="btn" id="edit"><i   class="fas fa-marker"></i></a>
						<a href="" class="btn" id="eye"><i   class="fas fa-user-check"></i></a>
						<form id="" action="" method="POST" class="formdelete">
						@csrf
						<a href="#" class="btn delete-confirm" id="delete"><i  class="fas fa-trash"></i></a>
						<input type="hidden" name="_method" value="delete">
						</form>
					</td>
				</tr>
				
				
			</tbody>
		</table>
		<div style="float: right">
			
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