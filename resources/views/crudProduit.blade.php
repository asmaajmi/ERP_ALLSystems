@extends("navbarsidebarProduction")
@section("contenu")
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<div class="container">
	<div class="crudpoineff">
		
		<div class="table-title">
			<div class="rowProduit">
				<div>
					<h3 class="listetitle">Liste <b>des produits constructibles</b></h3>
				</div>
				<div >
					<a href="{{route('ProduitConstruisable.form')}}" id="titleadd" class="btn" data-toggle="modal"><i class="fas fa-plus-circle"></i> <span>Ajouter </span></a>
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
					<th scope="col ">Nom du produit</th>
					<th scope="col ">code à barre</th>
					<th scope="col ">Lot optimal</th>
					<th scope="col ">Type</th>
					{{--<th scope="col ">Temps unitaire de fabrication</th>
					<th scope="col ">Temps de reglage d'un lot</th>--}}
					<th scope="col ">Actions</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($produit_construisable as $item )

				<tr> 
					<td scope="col ">
						<input type="checkbox" aria-label="Checkbox for following text input">
					</td>
					<td>{{$item->nom_produit_const}}</td>
					<td>{{$item->code_barre}}</td>
					<td>{{$item->lot_optimal}}</td>
					<td>{{$item->type_produit}}</td>
					
					<td>
					
						<a href="{{route('pdf_produit',['DesProduitC'=>$item->DesProduitC])}}" class="btn eye" id="btnfichprod"><i  class="fas fa-eye"></i></a>
						<form id="form-{{$item->DesProduitC}}" action="{{route('ProduitConstruisable.supprimer', ['DesProduitC'=>$item->DesProduitC])}}" method="POST" class="formdelete">
						@csrf
						<a href="#" class="btn delete-confirm delete" id="deleteprodconst"><i  class="fas fa-trash"></i></a>
						<input type="hidden" name="_method" value="delete">
						</form>
					</td>


				</tr>
				@endforeach
				
			</tbody>
		</table>
		<div class="table-title produiachetable">
			<div class="rowProduit">
				<div>
					<h3 class="listetitle">Liste <b>des produits achetable</b></h3>
				</div>
				<div >
					<a href="{{route('ProduitAchetable.form')}}" id="titleadd" class="btn" data-toggle="modal"><i class="fas fa-plus-circle"></i> <span>Ajouter </span></a>
					<a href="#" id="titledelete" class="btn" data-toggle="modal"><i class="fas fa-minus-circle"></i> <span>Supprimer</span></a>
				</div>
			</div>
		</div>
		<table class="table listnoform mt-4 tabProduitAchet">
			<thead>
					
				<tr>
					<th scope="col ">
						<span class="custom-checkbox">
						<input type="checkbox" id="selectAll">
						<label for="selectAll"></label>
					</span>
				</th>
					<th scope="col ">Nom du produit</th>
					
					<th scope="col ">Actions</th>
				</tr>

			</thead>

			<tbody>
				@foreach ($produit_achetable as $prod )
				<tr>
					<td scope="col ">
						<input type="checkbox" aria-label="Checkbox for following text input">
					</td>					

					<td>{{$prod->nom_produit}}</td>
					<td>						
						<form id="form-{{$prod->DesProduitA}}" action="{{route('ProduitAchetable.supprimer', ['DesProduitA'=>$prod->DesProduitA])}}" method="POST" class="formdelete">
						@csrf
						<a href="#" class="btn delete-confirm-achet delete" id="deleteprodach"><i  class="fas fa-trash"></i></a>
						<input type="hidden" name="_method" value="delete">
						</form>
						
					</td>
				</tr>
				@endforeach
				
			</tbody>
		</table>
		

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

$('.delete-confirm-achet').click(function(event) {
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