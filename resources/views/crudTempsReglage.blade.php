@extends("navbarsidebarProduction")
@section("contenu")
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
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
                            <h2 class="listetitle">Liste <b>Des Temps De réglages</b></h2>
                        </div>
                       
                        <div class="col btnreg">
                            <a href="{{route('tempsReglage.form')}}" id="addempbtn" class="btn" data-toggle="modal"><i class="fas fa-plus-circle"></i> <span>Ajouter Un Temps De Réglage</span></a>
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
                            <th scope="col ">Produit 1</th>
                            <th scope="col ">Produit 2</th>
                            <th scope="col ">Machine</th>
                            <th scope="col ">Temps réglage</th>
                            <th scope="col ">Actions</th>
                        </tr>
                    </thead>
                     
                    <tbody>
                    @foreach($tmpsRegs as $tempsreglage)            
                        <tr>
                        <th><span class="custom-checkbox">
							 <input type="checkbox" id="{{ $loop->index+ 1 }}" name="option[]" value="1">
							 <label for="{{ $loop->index+ 1 }}"></label></th>
                             @foreach($produit_construisables as $produit_construisable) 
                             @if($produit_construisable->id == $tempsreglage->id_produit_const1)
                            <td>{{ $produit_construisable->nom_produit_const }}</td>
                            @endif
                            @endforeach

                            @foreach($produit_construisables as $produit_construisable) 
                            @if($produit_construisable->id == $tempsreglage->id_produit_const2)
                            <td>{{ $produit_construisable->nom_produit_const }}</td>
                            @endif
                            @endforeach

                            @foreach($machines as $machine) 
                             @if($machine->id == $tempsreglage->id_machine)
                            <td>{{ $machine->nom_machine}}</td>
                            @endif
                            @endforeach
                            <td>{{ $tempsreglage->temps_reglage}}</td>
                                                                                        
                            <td>
                                <a href="{{route('tempsreglage.edit' , ['tempsreglage'=>$tempsreglage->id])}}" class="btn edit"><i   class="fas fa-marker"></i></a> 
                                <form id="form-{{$tempsreglage->id}}" action="{{route('tempsreglage.supprimer', ['tempsreglage'=>$tempsreglage->id])}}" method="POST" class="formdelete">
                                @csrf
                                <a href="# " class="btn show_confirm delete" id="deletetmpreg" ><i  class="fas fa-trash"></i></a>   
                                <input type="hidden" name="_method" value="delete">
                                </form>
                            </td> 
                        </tr>         
                @endforeach
                        </tbody>                                                                                                
                </table>
                   
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