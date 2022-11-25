@extends("navbarsidebarParcMachine")
@section("contenu")
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
            <div class="crudemp">

                <!--<div class="d-flex justify-content mb-2">
                </div>-->
                <div class="table-title">
                    <div class="row">
                        <div class="">
                            <h2 class="listetitle">Liste <b>Des Machines</b></h2>
                        </div>
                        {{--<form class="d-flex col-sm-3">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Rechercher" aria-label="Recipient's username" aria-describedby="button-addon2">
                                <button class="btn" type="button" id="button-addon2"><i class="bi bi-search"></i></button>
                            </div>
                        </form>--}}
                        <div class="colmach">
                            <a href="{{route('machine.create')}}" id="addempbtn" class="btn" data-toggle="modal"><i class="fas fa-plus-circle"></i> <span>Ajouter Une Machine</span></a>
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
                            <th scope="col ">ID</th>
                            <th scope="col ">Nom</th>
                            <th scope="col ">MTBF</th>
                            <th scope="col ">MTTR</th>
                            <th scope="col ">Prix d'achat</th>
                            <th scope="col ">Date d'achat</th>
                            <th scope="col ">Capacité</th>
                            <th scope="col ">Action</th>
                        </tr>
                    </thead>
                     
                    <tbody>   
                    @foreach($machines as $machine)
                        <tr>
                        <th><span class="custom-checkbox">
							 <input type="checkbox" id="#" name="option[]" value="1">
							 <label for="#"></label></th>
                             <td>{{$machine->DesMachine}}</td>
                            <td>{{$machine->nom_machine}}</td>
                            <td>{{$machine->MTBF}}</td>
                            <td>{{$machine->MTTR}}</td>
                            <td>{{$machine->PrixAchat}}</td>
                            <td>{{$machine->DateAchat}}</td>
                            <td>{{$machine->Capacite}}</td>                                                              
                        
                                <td class="action">
                                    <a href="{{route('pdf_machine',['DesMachine'=>$machine->DesMachine])}}" class="btn eye"><i  class="fas fa-eye"></i></a>
                                    <a href="{{route('machine.edit',['DesMachine'=>$machine->DesMachine])}}" class="btn" id="edit"><i class="bi bi-pen-fill"></i></a>     
                                    <a href="#" class="btn" id="delete" onclick="if(confirm('voulez-vous vraiment supprimer cet machine?')){document.getElementById('form-{{$machine->DesMachine}}').submit()}">
                                        <i class="bi bi-trash-fill"></i>
                                    </a>
                                   
                                         <form id="form-{{$machine->DesMachine}}" action="{{route('machine.supprimer',['DesMachine'=>$machine->DesMachine])}}" method="POST">  
                                            @csrf
                                            <input type="hidden" name="_method" value='delete'>
                                         </form>         
                                </td>
                                {{-- **************************** --}}
                                {{-- <td>
                            <a href="{{route('pdf_machine',['machine'=>$machine->DesMachine])}}" class="btn eye"><i  class="fas fa-eye"></i></a>
                               
                                <a href="{{route('machine.edit', ['machine'=>$machine->DesMachine])}}" class="btn edit"><i   class="fas fa-marker"></i></a>

                                <form id="form-{{$machine->DesMachine}}" action="{{route('machine.supprimer', ['DesMachine'=>$machine->DesMachine])}}" method="POST" class="formdelete">
                                @csrf
                                <a href="# " class="btn show_confirm" id="delete" ><i  class="fas fa-trash"></i></a>   
                                <input type="hidden" name="_method" value="delete">
                                </form>
                            </td>  --}}
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