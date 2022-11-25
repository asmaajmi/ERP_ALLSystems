@extends("navbarsidebarRH")
@section("contenu")
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>


<div class="crudemp">
    <div class="table-title">
        <div class="rowprob">
            <div class="">
                <h2 class="listetitle">Liste <b>des notes de probabilité de présence mensuelle</b></h2>
            </div>
        </div>
    </div>

    <table class="table table-hover mt-4 listeProbConge">
        <thead>
            <tr>
                <th scope="col "><span class="custom-checkbox">
                    <input type="checkbox" id="selectAll">
                    <label for="selectAll"></label>
                </span></th>
                <th scope="col ">Nom de l'employé</th>
                <th scope="col ">Année</th>
				<th scope="col ">Mois</th>
                <th scope="col ">Note</th>
                <th scope="col ">Mention</th>
            </tr>
        </thead>

        <tbody>  
            @foreach ($noteProbPresence as $presence)
                 
            <tr>
                <td scope="col ">
                    <input type="checkbox" aria-label="Checkbox for following text input">
                </td>
                <td>{{$presence->employe->prenom_emp}}&nbsp;{{$presence->employe->nom_emp}}</td>
                <td>{{$presence->annee}}</td>
				<td>{{$presence->mois}}</td>
                <td>{{$presence->valeur}}</td>
				<td>{{$presence->mention}}</td>

            </tr>
            @endforeach   


        </tbody>
    </table>
    {{--<div style="float: right">
        {{$presence->links()}}
    </div>--}}

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