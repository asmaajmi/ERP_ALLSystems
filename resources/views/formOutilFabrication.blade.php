@extends("navbarsidebarProduction")
@section("contenu")
<link rel="stylesheet" href="{{asset('css/outilfab.css')}}">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>

<!--Ajouter les heures supplémentaires a effectuer-->
<div class="tablesformoutilfabrication">
	<form action="{{route('outil.ajout')}}" method="post">
		@csrf
		<div class="ajoutoutilfab">
			@include('sweetalert::alert')
			<h2 class="titreoutilfab">Ajouter <span id="outil">Un Outil De Fabrication</span></h2>
			<table class="formoutilfab">
				<tr>
					<td class="txtoutilfab">
						<h3 class="formtxt" id="idoutil">Référence outil</h3>
					</td>
					<td>
						<div class="champoutilfab">
								<input type="text" name="idoutilfabrication" >					
						</div>
					</td>
				</tr>

				<tr>
					<td class="txtoutilfab">
						<h3 class="formtxt" id="nomoutilfab">Nom outil</h3>
					</td>
					<td>
						<div class="champoutilfab">
								<input type="text" name="nomoutilfabrication" >
						</div>
					</td>
				</tr>
				
				
			</table>
			<div class="btnconfannuler" >                                   
                        <button class="button-82-pushable"  role="button"  id="btnc">
                            <span class="button-82-shadow"></span>
                            <span class="button-82-edgec"></span>
                            <span class="button-82-frontc text ">
                                <span class="fa fa-solid fa-plus"></span>
                            Ajouter
                            </span>
                        </button>

                        <a  href="{{url()->previous()}}" class="btnannuler"  id="btna">
                            <span class="button-annuler-82-shadow"></span>
                            <span class="button-82-edgea"></span>
                            <span class="button-82-fronta text ">
                                <span class="fa fa-solid fa-ban"></span>
                            Annuler
                            </span>
                        </a>
                   
                    </div>
		</div>
	</form>
</div>

@endsection