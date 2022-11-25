@extends("navbarsidebarProduction")
@section("contenu")
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

<div class="container">
	<div class="crudpoineff">
		<div class="table-title">
			<div class="rowProduit">
				<div>
					<h3 class="listetitle">Liste <b>des nomenclatures</b></h3>
				</div>
				<div >
					<a href="{{route('Nomenclature.form')}}" id="titleadd" class="btn" data-toggle="modal"><i class="fas fa-plus-circle"></i> <span>Ajouter </span></a>
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
					<th scope="col ">Nomenclature</th>
					<th scope="col ">Quantité</th>
					<th scope="col ">Nom de produit</th>
					<th scope="col ">Quantité</th>
					<th scope="col ">Arrondi</th>
					<th scope="col ">Unité</th>
					<th scope="col ">Actions</th>
				</tr>
			</thead>

			<tbody>
				@foreach ($nomenclatures as $nomenclature)
					
				<tr>
					<td scope="col ">
						<input type="checkbox" aria-label="Checkbox for following text input">
					</td>
					<td>{{$nomenclature->designation}}</td>
					<td>{{$nomenclature->quantite}}</td>
					
					<td>
						@foreach ($produit_const as $prod_const ) 
						{{$prod_const->nom_produit_const}}
						<br>
						<br>
						@endforeach
					    @foreach ($produit_achetable as $prod_achet )
						{{$prod_achet->nom_produit}}
						 <br>
						<br>
						@endforeach 

					</td>

					 <td>
						@foreach ($produit_const as $prod_const ) 
						@foreach ($constituers as $item)
								@if ($prod_const->DesProduitC== $item->id_prodconstruisable && $nomenclature->id == $item->id_nomenclature)	
									{{$item->quantite}}
									<br>
									<br>
								@endif
						@endforeach
						@endforeach
						
						@foreach ($produit_achetable as $prod_achet )
						@foreach ($constituers as $item)
								@if ($prod_achet->DesProduitA == $item->id_prodachetable && $nomenclature->id == $item->id_nomenclature)	
									{{$item->quantite}}
									<br>
									<br>
								@endif
						@endforeach
						@endforeach
					</td>
					
					<td>
						@foreach ($produit_const as $prod_const ) 
						@foreach ($constituers as $item)
								@if ($prod_const->DesProduitC == $item->id_prodconstruisable && $nomenclature->id == $item->id_nomenclature)	
									{{$item->arrondi}}
									<br>
									<br>
								@endif
						@endforeach
						@endforeach
						
						@foreach ($produit_achetable as $prod_achet )
						@foreach ($constituers as $item)
								@if ($prod_achet->DesProduitA == $item->id_prodachetable && $nomenclature->id == $item->id_nomenclature)	
									{{$item->arrondi}}
									<br>
									<br>
								@endif
						@endforeach
						@endforeach
					</td>
					<td>
						{{-- @foreach ($produit_const as $prod_const )  --}}
						@foreach ($constituers as $item)
								{{-- @if ($prod_const->DesProduitC == $item->id_prodconstruisable && $nomenclature->id == $item->id_nomenclature)	 --}}
									{{$item->unite}}
									<br>
									<br>
								{{-- @endif --}}
						@endforeach
						{{-- @endforeach --}}
						
						@foreach ($produit_achetable as $prod_achet )
						@foreach ($constituers as $item)
								@if ($prod_achet->DesProduitA == $item->id_prodachetable && $nomenclature->id == $item->id_nomenclature)	
									{{$item->unite}}
									<br>
									<br>
								@endif
						@endforeach
						@endforeach
					</td>
					<td>
						<a href="{{route('AddComposantNomenclature.form',['nomenclature'=>$nomenclature->id])}}" class="btn" id="eye"><i  class="fas fa-plus"></i></a>
						<a href="{{route('Nomenclature.edit',['nomenclature'=>$nomenclature->id])}}" class="btn" id="edit"><i   class="fas fa-marker"></i></a>
						
						@foreach ($constituers as $item)
								
						<form id="form.{{$item->id}}" action="{{route('ConstituerPar.supprimer',['const'=>$item->id])}}" method="POST" class="formdelete">
							@csrf
							<input type="hidden" name="_method" value="delete">
						@endforeach

							<a href="#" class="btn delete-confirm-const"id="delete"><i  class="fas fa-trash"></i></a>
						</form>


						<form id="form.{{$nomenclature->id}}" action="{{route('Nomenclature.supprimer',['nomenclature'=>$nomenclature->id])}}" method="POST" class="formdeleteall">
							@csrf
							<a href="#" class="btn delete-confirm" id="deleteserv"><i  class="fas fa-ban"></i></a>
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
$('.delete-confirm-const').click(function(event) {
	var form =  $(this).closest("form");
	var name = $(this).data("name");
	event.preventDefault();
	swal({
		title: `Voulez-vous vraiment supprimer ces produits de la nomenclature ?`,
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
$('.delete-confirm').click(function(event) {
	var form =  $(this).closest("form");
	var name = $(this).data("name");
	event.preventDefault();
	swal({
		title: `Voulez-vous vraiment supprimer cet Nomenclature ?`,
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