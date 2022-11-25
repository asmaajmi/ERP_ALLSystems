<link rel="stylesheet" href="{{asset('css/afficheemp.css')}}">
<script src="https://code.jquery.com/jquery-3.6.0.js" ></script>
<div class="model-container">
    <div class="model">
        <div class="societe">
            <h1>Innovation Gate</h1>
        </div>
        <i id="close" class="fas fa-times"></i>
        <div class="sp">
            <div class="save">
                <i class="fas fa-save"></i>
            </div>
            <div class="print">
                <i class="fas fa-print"></i>
            </div>
        </div>
        <div class="info">
            <div class="image">
                <input type="image" alt="insérer img">
            </div>
            <div class="nom">
                <div class="info1">
                    <h2>Nom</h2>
                    <h2>Prénom</h2>
                    <h2>Rôle</h2>
                </div>
                <div class="info3">
                    <h2>:</h2>
                    <h2>:</h2>
                    <h2>:</h2>
                </div>
                <div class="info2">
                    <h2>Nour Elhouda</h2>
                    <h2>Moussa</h2>
                    <h2>Directrice</h2>
                </div>
            </div>
            <div class="service">
                <div class="info1">
                    <h2>Nom du service</h2>
                    <h2>Num Bureau</h2>
                    <h2>Note de ponctualité</h2>
                </div>
                <div class="info3">
                    <h2>:</h2>
                    <h2>:</h2>
                    <h2>:</h2>
                </div>
                <div class="info2">
                    <h2>Production</h2>
                    <h2>1254</h2>
                    <h2>5/10</h2>
                </div>
            </div>
        </div>
        <div class="infosup">
            <div class="information">
                <div class="info1">
                    <h2>CIN</h2>
                    <h2>Date de naissance</h2>
                    <h2>Genre</h2>
                    <h2>Etat Civil</h2>
                    <h2>Adresse</h2>
                    <h2>E-mail</h2>
                    <h2>Télèphone</h2>
                </div>
                <div class="info3">
                    <h2>:</h2>
                    <h2>:</h2>
                    <h2>:</h2>
                    <h2>:</h2>
                    <h2>:</h2>
                    <h2>:</h2>
                    <h2>:</h2>
                </div>
                <div class="info2">
                    <h2>128460</h2>
                    <h2>05/12/1998</h2>
                    <h2>Femme</h2>
                    <h2>Celebataire</h2>
                    <h2>37 rue bachir sfar M'saken 4070</h2>
                    <h2>exemple@gmail.com</h2>
                    <h2>73284173</h2>
                </div>
            </div>
            <div class="information">
                <div class="info1">
                    <h2>Mobile</h2>
                    <h2>Date Recrutement</h2>
                    <h2>Date Decision</h2>
                    <h2>Ecole</h2>
                    <h2>Diplome</h2>
                    <h2>Date Obtention</h2>
                    <h2>Nombres des congés</h2>
                </div>
                <div class="info3">
                    <h2>:</h2>
                    <h2>:</h2>
                    <h2>:</h2>
                    <h2>:</h2>
                    <h2>:</h2>
                    <h2>:</h2>
                    <h2>:</h2>
                </div>
                <div class="info2">

                    <h2>29721205</h2>
                    <h2>05/12/2001</h2>
                    <h2>01/02/2022</h2>
                    <h2>ISSAT Sousse</h2>
                    <h2>Licence en science informatique</h2>
                    <h2>06/06/2022</h2>
                    <h2>5</h2>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
<script>
$(document).ready(function() {
    $('#eye').click(function() {
        $('.model-container').css('transform', 'scale(1)');

    });
    $('#close').click(function() {
        $('.model-container').css('transform', 'scale(0)');

    });
});
</script>