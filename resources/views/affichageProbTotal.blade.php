@extends("navbarsidebarRH")
@section("contenu")
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>


<div class="crudemp">
    <div class="table-title">
        <div class="rowprob">
            <div class="">
                <h2 class="listetitle">Liste <b>des probabilités de présence total</b></h2>
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
                <th scope="col ">Total</th>
            </tr>
        </thead>

        <tbody>  
            @foreach ($probPresence as $presence)
                 
            <tr>
                <td scope="col ">
                    <input type="checkbox" aria-label="Checkbox for following text input">
                </td>
                <td>{{$presence->employe->prenom_emp}}&nbsp;{{$presence->employe->nom_emp}}</td>
                <td>{{$presence->Total}}</td>    
            </tr>
            @endforeach   


        </tbody>
    </table>
    {{--<div style="float: right">
        {{$presence->links()}}
    </div>--}}

</div>
<div class="crudemp">
    <div class="table-title">
        <div class="rowprobCon">
            <div class="">
                <h2 class="listetitle">Liste <b>des probabilités de congé total</b></h2>
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
                <th scope="col ">Total</th>
            </tr>
        </thead>

        <tbody>  
            @foreach ($probconge as $conge)
                 
            <tr>
                <td scope="col ">
                    <input type="checkbox" aria-label="Checkbox for following text input">
                </td>
                <td>{{$conge->employe->prenom_emp}}&nbsp;{{$conge->employe->nom_emp}}</td>
                <td>{{$conge->Total}}</td>
           
            </tr>
            @endforeach   


        </tbody>
    </table>
    {{--<div style="float: right">
        {{$presence->links()}}
    </div>--}}

</div>



@endsection