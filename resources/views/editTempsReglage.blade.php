@extends("navbarsidebarProduction")
@section("contenu")
<link rel="stylesheet" href="{{asset('css/formTempsReg.css')}}">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>

<!--Ajouter les heures supplémentaires a effectuer-->
<div class="tablesformTempsReg">
<form action="{{ route('tempsreglage.update', ['tempsreglage'=>$tempsreglage->id]) }}" method="post">
            @csrf
            <input type="hidden" name="_method" value="put">
		<div class="ajoutTempsReg">
			@include('sweetalert::alert')
			<h2 class="titreTempsReg">Modifier <span id="emp">Temps réglages inter-produit</span></h2>
			<table class="formTempsReg">
				<tr>
					<td class="txtTempsReg">
						<h3 class="formtxt" id="nomproduit1">Nom de produit N°1</h3>
					</td>
					<td>
						<div class="champTempsReg" >
							<select name="nom_prod1" id="" class="nom_prod1">
							@foreach($produit_construisables as $produit_construisable) 
                             @if($produit_construisable->id == $tempsreglage->id_produit_const1)
								<option value="{{$tempsreglage->id_produit_const1}}" selected>{{$produit_construisable->nom_produit_const}}</option>
							 @endif
								@endforeach
							</select>
						</div>
					</td>
					<td class="txtTempsReg">
						<h3 class="formtxt" id="nomproduit2">Nom de produit N°2</h3>
					</td>
					<td>
						<div class="champTempsReg">
							<select name="nom_prod2" id="prod2" class="nom_prod2">
							@foreach($produit_construisables as $produit_construisable) 
                             @if($produit_construisable->id == $tempsreglage->id_produit_const2)
								<option value="{{$tempsreglage->id_produit_const2}}" selected>{{$produit_construisable->nom_produit_const}}</option>
							 @endif
								@endforeach
							</select>
						</div>
					</td>
					
				</tr>
				
				<tr>
					<td class="txtTempsReg">
						<h3 class="formtxt" id="nommachine">Nom de machine</h3>
					</td>
					<td>
						<div class="champTempsReg">
							<select name="id_machine" id="">
							@foreach($machines as $machine) 
                            @if($machine->id == $tempsreglage->id_machine)
								<option value="{{$machine->id}}" selected>{{$machine->nom_machine}}</option>
							@endif
							@endforeach
							</select>
						</div>
					</td>
					
					<td class="txtTempsReg">
						<h3 class="formtxt" id="tempsreg">Temps de réglage</h3>
					</td>
					<td>
						<div class="champTempsReg">
							<input type="number" name="temps_reg" value="{{$tempsreglage->temps_reglage}}">
						</div>
					</td>
					
					
				</tr>
				
				
			</table>
			<div class="btnTempsReg">
				<div>
					<button class="buttonTempsReg"  role="button"  id="btncpointeff">
						{{--<span class="button-82-shadow"></span>--}}
						<span class="button-82-edgec"></span>
						<span class="button-82-frontc text ">
							<span class="fa fa-solid fa-plus"></span>
						Modifier
						</span>
					</button>
				</div>
				<div>
					<a href="{{url()->previous()}}"  class="buttonTempsReg" role="button"  id="btnapointeff">
						<span class="button-82-edgea"></span>
						<span class="button-82-fronta text ">
							<span class="fa fa-solid fa-ban"></span>
						Annuler
						</span>
					</a>
				</div>
		  </div>
		</div>
	</form>
</div>
@endsection