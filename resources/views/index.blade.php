<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
    <title>Authentification_creation</title>
</head>

<body>
    <div class="container">
        <div class="Authentification_creation">
            <form action="{{route('accueil.affiche')}}" id="authentification">
                <h2 class="title">Authentification</h2>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="Nom d'utilisateur" required>
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="Mot de passe" required>
                </div>
                <input type="submit" value="Connexion" class="btn">
                <p class="account-text">vous n'avez pas un compte !?<a href="#" id="creat-btn2">créer un compte</a></p>
            </form>
            <form action="" id="creation">
                <h2 class="title">Créer Un Compte</h2>
                <div class="input-field">
                    <i class="fas fa-user-alt"></i>
                    <input type="text" placeholder="Nom de l'utilisateur" required>
                </div>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="Entrer mot de passe" required id="mdp">
                </div>

                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="Confirmer mot de passe" required id="cmdp">
                </div>
                <input type="submit" value="Confirmer" class="btn" onclick=" verif_pass()">

                <p class="account-text">vous avez déja un compte !?<a href="#" id="authen-btn2">Authentification</a></p>
            </form>

        </div>
        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>InnovGate</h3>
                    <p>La seule plateforme dont vous aurez besoin pour gérer votre entreprise: des modules simples à gérer </p>
                    <button class="btn" id="authen-btn">Authentification</button>
                </div>
                <img src="{{asset('image/authentification.svg')}}" alt="" class="image">
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>InnovGate</h3>
                    <p>La seule plateforme dont vous aurez besoin pour gérer votre entreprise: des modules simples à gérer</p>
                    <button class="btn" id="creat-btn">Créer un compte</button>
                </div>
                <img src="{{asset('image/create.svg')}}" alt="" class="image">
            </div>
        </div>
    </div>
    <script src="{{asset('js/index.js')}}"></script>
</body>

</html>