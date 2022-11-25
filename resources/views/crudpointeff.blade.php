@extends("navbarsidebarRH")
@section("contenu")
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
<div class="container">
	<div class="crudpoineff">
		<div class="cards">
			<div class="card" id="c1">
				<div class="card-content">
					<div class="card-name">Nombre des pointage <br>effectué</div>
					<div class="number">67</div>

				</div>
				<div class="icon-box">
					<i class="fas fa-hand-pointer"></i>
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
			<div class="row">
				<div>
					<h2 class="listetitle">Liste <b>Des pointages effectués</b></h2>
				</div>

				<!--<form class="d-flex col-sm-3">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Rechercher" aria-label="Recipient's username" aria-describedby="button-addon2">
					<button class="btn" type="button" id="button-addon2"><i class="bi bi-search"></i></button>
				</div>
			</form>-->
				<div >
					<a href="{{route('pointeff.form')}}" id="titleadd" class="btn" data-toggle="modal"><i class="fas fa-plus-circle"></i> <span>Ajouter un pointage</span></a>
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
					<th scope="col ">Date pointage</th>
					<th scope="col ">Heure entrée</th>
					<th scope="col ">Heure Sortie</th>
					<th scope="col ">Action</th>
				</tr>
			</thead>

			<tbody>
			@foreach($pointages as $pointageeff)
				<tr>
				<th><span class="custom-checkbox">
				<input type="checkbox" id="{{ $loop->index+ 1 }}" name="option[]" value="1">
				<label for="{{ $loop->index+ 1 }}"></label></th>
					<td>{{$pointageeff->employe['prenom_emp']}}&nbsp;{{$pointageeff->employe['nom_emp']}}</td>
					<td>{{$pointageeff->datepe}}</td>
					<td>{{$pointageeff->heure_entree}}</td>
					<td>{{$pointageeff->heure_sortie}}</td>
					<td>
						
						<a href="{{route('pointageeff.edit', ['pointageeff'=>$pointageeff->id])}}" class="btn edit"><i   class="fas fa-marker"></i></a>
						
						<form id="form-{{$pointageeff->id}}" action="{{route('pointageeff.supprimer', ['pointageeff'=>$pointageeff->id])}}" method="POST" class="formdeletepoineff">
                                @csrf
                                <a href="# " class="btn show_confirm" id="delete" ><i  class="fas fa-trash"></i></a>   
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
<script type="text/javascript">
 
     $('.show_confirm').click(function(event) {
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