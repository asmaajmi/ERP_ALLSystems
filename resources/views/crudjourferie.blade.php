@extends("navbarsidebarRH")
@section("contenu")
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>


<div class="crudemp">
    {{--<div class="cards">
        <div class="card" id="c1">
            <div class="card-content">
                <div class="card-name">Nombre Totale</div>
                <div class="number">67</div>

            </div>
            <div class="icon-box">
                <i class="fas fa-sigma"></i>
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
    </div>--}}
    <!--<div class="d-flex justify-content mb-2">
    </div>-->
    <div class="table-title">
        <div class="row">
            <div class="">
                <h2 class="listetitle">Liste <b>Des Jours feriés</b></h2>
            </div>
            <div class="col">
                <a href="{{route('jourferie.form')}}" id="titleadd" class="btn" data-toggle="modal"><i class="fas fa-plus-circle"></i> <span>Ajouter un jour férié</span></a>
                <a href="#" id="titledelete" class="btn" data-toggle="modal"><i class="fas fa-minus-circle"></i> <span>Supprimer</span></a>
            </div>

        </div>
    </div>

    <table class="table table-hover mt-4">
        <thead>
            <tr>
                <th scope="col "><span class="custom-checkbox">
                    <input type="checkbox" id="selectAll">
                    <label for="selectAll"></label>
                </span></th>
                <th scope="col ">Date debut de jour ferié </th>
                <th scope="col ">Date fin de jour ferié </th>
                <th scope="col ">Designation de jour ferié </th>
                <th scope="col ">Actions</th>
            </tr>
        </thead>

        <tbody>  
            @foreach ($jours as $item )
                
            <tr>
                <td scope="col ">
                    <input type="checkbox" aria-label="Checkbox for following text input">
                </td>
                <td>{{$item->des_jourferie}}</td>
                <td>{{$item->dt_debut_jourferie}}</td>
                <td>{{$item->dt_fin_jourferie}}</td>
                <td>
                    {{--<a href="" class="btn" id="eye"><i  class="fas fa-eye"></i></a>--}}
                    <a href="{{route('jourferie.edit',['jourferie'=>$item->id])}}" class="btn" id="edit"><i   class="fas fa-marker"></i></a>
                    <form id="form.{{$item->id}}" action="{{route('jourferie.supprimer',['jourferie'=>$item->id])}}" method="POST" class="formdeletejour">
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
        {{$jours->links()}}
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