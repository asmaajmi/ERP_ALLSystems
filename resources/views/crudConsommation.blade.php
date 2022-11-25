@extends("navbarsidebarProduction")
@section("contenu")

<div class="container">
	<div class="crudcons">
		<div class="table-title">
			<div class="rowservice">
				<div>
					<h2 class="listetitle">Liste <b>des conommations </b></h2>
				</div>

				<div>
					<a href="{{route('Cons.create')}}" id="titleaddcons" class="btn" data-toggle="modal"><i class="fas fa-plus-circle"></i> <span>Ajouter une consommation</span></a>
				</div>

			</div>
		</div>
				<table class="table  mt-4">
					<thead>
						<tr>
							<th scope="col ">Nom machine</th>

							<th scope="col ">Nom produit</th>
							<th scope="col ">Quantité produit</th>
							<th scope="col ">Unité</th>

							<th scope="col ">Nom outil</th>
							<th scope="col ">Quantité outil</th>
							<th scope="col ">Unité</th>

							<th scope="col ">Action</th>
						</tr>
					</thead>

					<tbody>
						@foreach ($consommers as $consommer )	
						<tr>
						@foreach($machines as $machine)
							<td>
								@if($consommer->id_machine == $machine->id)
								{{$machine->nom_machine}}
								@endif
							</td>
							@endforeach
							@foreach($produits as $produit)
							<td>
								@if($consommer->id_produit == $produit->id)
								{{$produit->nom_produit_const}}
								@endif
							</td>
							<td>
								{{$consommer->quantiteproduit}}
							</td>
							<td>
								{{$consommer->uniteproduit}}
							</td>
							@endforeach

							@foreach ($outils as $outil)
							@if($outil->id == $consommer->ref_outil) 
							<td>	
								{{$outil->nom}}
								<br>
								<br>
							</td>
							
							<td>	
								{{$consommer->quantiteoutil}}
								<br>
								<br>
							</td>
							<td>	
								{{$consommer->uniteoutil}}
								<br>
								<br>
							</td>
							@endif
							@endforeach
							

							<td>
								<form id="form-{{$consommer->id}}" action="{{route('cons.supprimer', ['consommer'=>$consommer->id])}}" method="POST" class="formdelete">
								@csrf
								<a href="# " class="btn show_confirm delete" id="deleteCons" ><i  class="fas fa-trash"></i></a>   
								<input type="hidden" name="_method" value="delete">
								</form>
							</td>
						</tr>
						@endforeach

					</tbody>
				</table>
				
	</div>
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
