@extends("navbarsidebarRH")
@section("contenu")
<link rel="stylesheet" href="{{asset('css/crudemp.css')}}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
<link rel="stylesheet" href="{{asset('css/chart.css')}}">

<div class="crudemp">
<div class="cards">
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
</div>
<!--<div class="d-flex justify-content mb-2">
</div>-->
<div class="table-title">
    <div class="row">
        <div class="">
            <h2 class="listetitle">Liste <b>Des Employés</b></h2>
        </div>
        
        <div class="colemp">
            <a href="{{route('emp.form')}}" id="addempbtn" class="btn" data-toggle="modal"><i class="fas fa-plus-circle"></i> <span>Ajouter Un Employé</span></a>
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
            <th scope="col ">Cin</th>
            <th scope="col ">Nom Et Prénom</th>
            <th scope="col ">Date De Naissance</th>
            <th scope="col ">Télèphone</th>
            <th scope="col ">Date Recrutement</th>
            <th scope="col ">Rôle</th>
            <th scope="col ">Action</th>
        </tr>
    </thead>
        
    <tbody>
    @foreach($employes as $employe)            
        <tr>
        <th><span class="custom-checkbox">
                <input type="checkbox" id="{{ $loop->index+ 1 }}" name="option[]" value="1">
                <label for="{{ $loop->index+ 1 }}"></label></th>
            <td>{{ $employe->cin_emp }}</td>
            <td>{{ $employe->nom_emp }}&nbsp;{{ $employe->prenom_emp}}</td>
            <td>{{ $employe->date_naissance_emp}}</td>
            <td>{{ $employe->tel1_emp}}</td>
            <td>{{ $employe->date_recrutement_emp}}</td>
            <td>{{ $employe->role_emp}}</td>                                                              
            <td>
            <a href="{{route('pdf_emp',['employe'=>$employe->id])}}" class="btn eye"><i  class="fas fa-eye"></i></a>
            <a href="{{route('employe.edit', ['employe'=>$employe->id])}}" class="btn edit"><i   class="fas fa-marker"></i></a>
                
                
                <form id="form-{{$employe->id}}" action="{{route('employe.supprimer', ['employe'=>$employe->id])}}" method="POST" class="formdelete">
                @csrf
                <a href="# " class="btn show_confirm" id="delete" ><i  class="fas fa-trash"></i></a>   
                <input type="hidden" name="_method" value="delete">
                </form>
            </td> 
        </tr>         
@endforeach
        </tbody>                                                                                                
        </table>
    <div style="float: right">
{{$employes->links()}}
    </div>  

    </div>         
</div>                                          
 
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>

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