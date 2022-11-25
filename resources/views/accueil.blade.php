<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <title>Home</title>
    <link rel="stylesheet" href="{{asset('css/accueil.css')}}">
</head>

<body>
    <div class="top-bar">
        <div class="name">
            <h2>InnovGate</h2>
        </div>
        <div class="profil-area">
            <div class="profil">
                <div class="profile-photo">
                    <i class="fas fa-user-circle" id="usercon"></i>
                </div>
                <i class="fas fa-sign-out" id="logout"></i>
                <a href="{{route('dec.affiche')}}" id="decon">Se déconnecter</a>
            </div>
        </div>
    </div>

<div class="titre">
  <svg xmlns="http://www.w3.org/2000/svg" style="display: none">
    <symbol id="star" viewBox="0 0 26 28">
      <path d="M26 10.109c0 .281-.203.547-.406.75l-5.672 5.531 1.344 7.812c.016.109.016.203.016.313 0 .406-.187.781-.641.781a1.27 1.27 0 0 1-.625-.187L13 21.422l-7.016 3.687c-.203.109-.406.187-.625.187-.453 0-.656-.375-.656-.781 0-.109.016-.203.031-.313l1.344-7.812L.39 10.859c-.187-.203-.391-.469-.391-.75 0-.469.484-.656.875-.719l7.844-1.141 3.516-7.109c.141-.297.406-.641.766-.641s.625.344.766.641l3.516 7.109 7.844 1.141c.375.063.875.25.875.719z"/>
    </symbol>
  </svg>
 <div class="fn">

 

      <div class="fn3">
        <div class="card card2">
          <i class="fas fa-users icone icone5" id="user"></i>
          </div>
          <div class="texte">
            <a href="{{route('emp.list')}}" class="tx">Gestion de ressources humaines</a>
            <div class="page__group">
              <div class="rating">
                  <input type="radio" name="rating-star" class="rating__control screen-reader" id="rc1">
                  <input type="radio" name="rating-star" class="rating__control screen-reader" id="rc2">
                  <input type="radio" name="rating-star" class="rating__control screen-reader" id="rc3">
                  <input type="radio" name="rating-star" class="rating__control screen-reader" id="rc4">
                  <input type="radio" name="rating-star" class="rating__control screen-reader" id="rc5">
                  <label for="rc1" class="rating__item">
                      <svg class="rating__star">
                      <use xlink:href="#star"></use>
                      </svg>
                      <span class="screen-reader">1</span>
                  </label>
                  <label for="rc2" class="rating__item">
                      <svg class="rating__star">
                      <use xlink:href="#star"></use>
                      </svg>
                      <span class="screen-reader">2</span>
                  </label>
                  <label for="rc3" class="rating__item">
                      <svg class="rating__star">
                      <use xlink:href="#star"></use>
                      </svg>
                      <span class="screen-reader">3</span>
                  </label>
                  <label for="rc4" class="rating__item">
                      <svg class="rating__star">
                      <use xlink:href="#star"></use>
                      </svg>
                      <span class="screen-reader">4</span>
                  </label>
                  <label for="rc5" class="rating__item">
                      <svg class="rating__star">
                      <use xlink:href="#star"></use>
                      </svg>
                      <span class="screen-reader">5</span>
                  </label>
              </div>
          </div>
          </div>
          
        </div>

        <div class="fn3">
            <div class="card card1">
              <i class="fas fa-inventory icone" id="parametre"></i>
              </div>
              <div class="texte">
                <a href="{{route('machine.list')}}" class="tx">Parc machine</a>
                <div class="page__group">
                  <div class="rating">
                      <input type="radio" name="rating-star" class="rating__control screen-reader" id="rc1">
                      <input type="radio" name="rating-star" class="rating__control screen-reader" id="rc2">
                      <input type="radio" name="rating-star" class="rating__control screen-reader" id="rc3">
                      <input type="radio" name="rating-star" class="rating__control screen-reader" id="rc4">
                      <input type="radio" name="rating-star" class="rating__control screen-reader" id="rc5">
                      <label for="rc1" class="rating__item">
                          <svg class="rating__star">
                          <use xlink:href="#star"></use>
                          </svg>
                          <span class="screen-reader">1</span>
                      </label>
                      <label for="rc2" class="rating__item">
                          <svg class="rating__star">
                          <use xlink:href="#star"></use>
                          </svg>
                          <span class="screen-reader">2</span>
                      </label>
                      <label for="rc3" class="rating__item">
                          <svg class="rating__star">
                          <use xlink:href="#star"></use>
                          </svg>
                          <span class="screen-reader">3</span>
                      </label>
                      <label for="rc4" class="rating__item">
                          <svg class="rating__star">
                          <use xlink:href="#star"></use>
                          </svg>
                          <span class="screen-reader">4</span>
                      </label>
                      <label for="rc5" class="rating__item">
                          <svg class="rating__star">
                          <use xlink:href="#star"></use>
                          </svg>
                          <span class="screen-reader">5</span>
                      </label>
                  </div>
              </div>
              </div>
            </div>

        <div class="fn3">
          <div class="card card3">
            <i class="fas fa-conveyor-belt icone icone5"></i>
            </div>
            <div class="texte">
              <a href="{{route('Produit.list')}}" class="tx">Gestion de production</a>
              <div class="page__group">
                <div class="rating">
                    <input type="radio" name="rating-star" class="rating__control screen-reader" id="rc1">
                    <input type="radio" name="rating-star" class="rating__control screen-reader" id="rc2">
                    <input type="radio" name="rating-star" class="rating__control screen-reader" id="rc3">
                    <input type="radio" name="rating-star" class="rating__control screen-reader" id="rc4">
                    <input type="radio" name="rating-star" class="rating__control screen-reader" id="rc5">
                    <label for="rc1" class="rating__item">
                        <svg class="rating__star">
                        <use xlink:href="#star"></use>
                        </svg>
                        <span class="screen-reader">1</span>
                    </label>
                    <label for="rc2" class="rating__item">
                        <svg class="rating__star">
                        <use xlink:href="#star"></use>
                        </svg>
                        <span class="screen-reader">2</span>
                    </label>
                    <label for="rc3" class="rating__item">
                        <svg class="rating__star">
                        <use xlink:href="#star"></use>
                        </svg>
                        <span class="screen-reader">3</span>
                    </label>
                    <label for="rc4" class="rating__item">
                        <svg class="rating__star">
                        <use xlink:href="#star"></use>
                        </svg>
                        <span class="screen-reader">4</span>
                    </label>
                    <label for="rc5" class="rating__item">
                        <svg class="rating__star">
                        <use xlink:href="#star"></use>
                        </svg>
                        <span class="screen-reader">5</span>
                    </label>
                </div>
            </div>
            </div>
          </div>
    </div>

  <div class="fn">

    <div class="fn3">
      <div class="card card4">
        <i class="fas fa-shopping-cart icone icone3"></i>
        </div>
        <div class="texte">
          <label class="tx">Gestion des achats</label>
          <div class="page__group">
            <div class="rating">
                <input type="radio" name="rating-star" class="rating__control screen-reader" id="rc1">
                <input type="radio" name="rating-star" class="rating__control screen-reader" id="rc2">
                <input type="radio" name="rating-star" class="rating__control screen-reader" id="rc3">
                <input type="radio" name="rating-star" class="rating__control screen-reader" id="rc4">
                <input type="radio" name="rating-star" class="rating__control screen-reader" id="rc5">
                <label for="rc1" class="rating__item">
                    <svg class="rating__star">
                    <use xlink:href="#star"></use>
                    </svg>
                    <span class="screen-reader">1</span>
                </label>
                <label for="rc2" class="rating__item">
                    <svg class="rating__star">
                    <use xlink:href="#star"></use>
                    </svg>
                    <span class="screen-reader">2</span>
                </label>
                <label for="rc3" class="rating__item">
                    <svg class="rating__star">
                    <use xlink:href="#star"></use>
                    </svg>
                    <span class="screen-reader">3</span>
                </label>
                <label for="rc4" class="rating__item">
                    <svg class="rating__star">
                    <use xlink:href="#star"></use>
                    </svg>
                    <span class="screen-reader">4</span>
                </label>
                <label for="rc5" class="rating__item">
                    <svg class="rating__star">
                    <use xlink:href="#star"></use>
                    </svg>
                    <span class="screen-reader">5</span>
                </label>
            </div>
        </div>
        </div>
      </div>
  
        <div class="fn3">
          <div class="card card5">
            <i class="fas fa-dolly-flatbed-alt icone icone3"></i>
            </div>
            <div class="texte">
              <label class="tx">Gestion de stock</label>
              <div class="page__group">
                <div class="rating">
                    <input type="radio" name="rating-star" class="rating__control screen-reader" id="rc1">
                    <input type="radio" name="rating-star" class="rating__control screen-reader" id="rc2">
                    <input type="radio" name="rating-star" class="rating__control screen-reader" id="rc3">
                    <input type="radio" name="rating-star" class="rating__control screen-reader" id="rc4">
                    <input type="radio" name="rating-star" class="rating__control screen-reader" id="rc5">
                    <label for="rc1" class="rating__item">
                        <svg class="rating__star">
                        <use xlink:href="#star"></use>
                        </svg>
                        <span class="screen-reader">1</span>
                    </label>
                    <label for="rc2" class="rating__item">
                        <svg class="rating__star">
                        <use xlink:href="#star"></use>
                        </svg>
                        <span class="screen-reader">2</span>
                    </label>
                    <label for="rc3" class="rating__item">
                        <svg class="rating__star">
                        <use xlink:href="#star"></use>
                        </svg>
                        <span class="screen-reader">3</span>
                    </label>
                    <label for="rc4" class="rating__item">
                        <svg class="rating__star">
                        <use xlink:href="#star"></use>
                        </svg>
                        <span class="screen-reader">4</span>
                    </label>
                    <label for="rc5" class="rating__item">
                        <svg class="rating__star">
                        <use xlink:href="#star"></use>
                        </svg>
                        <span class="screen-reader">5</span>
                    </label>
                </div>
            </div>
            </div>
          </div>
  
  
  
          <div class="fn3">
            <div class="card card6">
              <i class="fas fa-cogs icone icone5"></i>
              </div>
              <div class="texte">
              <a href="{{route('Previson_Vente.list')}}" class="tx">MRP2</a>
                <div class="page__group">
                  <div class="rating">
                      <input type="radio" name="rating-star" class="rating__control screen-reader" id="rc1">
                      <input type="radio" name="rating-star" class="rating__control screen-reader" id="rc2">
                      <input type="radio" name="rating-star" class="rating__control screen-reader" id="rc3">
                      <input type="radio" name="rating-star" class="rating__control screen-reader" id="rc4">
                      <input type="radio" name="rating-star" class="rating__control screen-reader" id="rc5">
                      <label for="rc1" class="rating__item">
                          <svg class="rating__star">
                          <use xlink:href="#star"></use>
                          </svg>
                          <span class="screen-reader">1</span>
                      </label>
                      <label for="rc2" class="rating__item">
                          <svg class="rating__star">
                          <use xlink:href="#star"></use>
                          </svg>
                          <span class="screen-reader">2</span>
                      </label>
                      <label for="rc3" class="rating__item">
                          <svg class="rating__star">
                          <use xlink:href="#star"></use>
                          </svg>
                          <span class="screen-reader">3</span>
                      </label>
                      <label for="rc4" class="rating__item">
                          <svg class="rating__star">
                          <use xlink:href="#star"></use>
                          </svg>
                          <span class="screen-reader">4</span>
                      </label>
                      <label for="rc5" class="rating__item">
                          <svg class="rating__star">
                          <use xlink:href="#star"></use>
                          </svg>
                          <span class="screen-reader">5</span>
                      </label>
                  </div>
              </div>
              </div>
            </div>
      </div>

<div class="fn">

  <div class="fn3">
    <div class="card card7">
      <i class="fas fa-chart-line icone icone7"></i>
      </div>
      <div class="texte">
        <a href="{{route('ListeDesOrdresDeTravailDeMesure')}}" class="tx">Gestion de qualité</a>  
        <div class="page__group">
          <div class="rating">
              <input type="radio" name="rating-star" class="rating__control screen-reader" id="rc1">
              <input type="radio" name="rating-star" class="rating__control screen-reader" id="rc2">
              <input type="radio" name="rating-star" class="rating__control screen-reader" id="rc3">
              <input type="radio" name="rating-star" class="rating__control screen-reader" id="rc4">
              <input type="radio" name="rating-star" class="rating__control screen-reader" id="rc5">
              <label for="rc1" class="rating__item">
                  <svg class="rating__star">
                  <use xlink:href="#star"></use>
                  </svg>
                  <span class="screen-reader">1</span>
              </label>
              <label for="rc2" class="rating__item">
                  <svg class="rating__star">
                  <use xlink:href="#star"></use>
                  </svg>
                  <span class="screen-reader">2</span>
              </label>
              <label for="rc3" class="rating__item">
                  <svg class="rating__star">
                  <use xlink:href="#star"></use>
                  </svg>
                  <span class="screen-reader">3</span>
              </label>
              <label for="rc4" class="rating__item">
                  <svg class="rating__star">
                  <use xlink:href="#star"></use>
                  </svg>
                  <span class="screen-reader">4</span>
              </label>
              <label for="rc5" class="rating__item">
                  <svg class="rating__star">
                  <use xlink:href="#star"></use>
                  </svg>
                  <span class="screen-reader">5</span>
              </label>
          </div>
      </div>
      </div>
    </div>

      <div class="fn3">
        <div class="card card8">
          <i class="fas fa-coins icone icone7"></i>
          </div>
          <div class="texte">
            <label class="tx">Gestion de ventes</label>
            <div class="page__group">
              <div class="rating">
                  <input type="radio" name="rating-star" class="rating__control screen-reader" id="rc1">
                  <input type="radio" name="rating-star" class="rating__control screen-reader" id="rc2">
                  <input type="radio" name="rating-star" class="rating__control screen-reader" id="rc3">
                  <input type="radio" name="rating-star" class="rating__control screen-reader" id="rc4">
                  <input type="radio" name="rating-star" class="rating__control screen-reader" id="rc5">
                  <label for="rc1" class="rating__item">
                      <svg class="rating__star">
                      <use xlink:href="#star"></use>
                      </svg>
                      <span class="screen-reader">1</span>
                  </label>
                  <label for="rc2" class="rating__item">
                      <svg class="rating__star">
                      <use xlink:href="#star"></use>
                      </svg>
                      <span class="screen-reader">2</span>
                  </label>
                  <label for="rc3" class="rating__item">
                      <svg class="rating__star">
                      <use xlink:href="#star"></use>
                      </svg>
                      <span class="screen-reader">3</span>
                  </label>
                  <label for="rc4" class="rating__item">
                      <svg class="rating__star">
                      <use xlink:href="#star"></use>
                      </svg>
                      <span class="screen-reader">4</span>
                  </label>
                  <label for="rc5" class="rating__item">
                      <svg class="rating__star">
                      <use xlink:href="#star"></use>
                      </svg>
                      <span class="screen-reader">5</span>
                  </label>
              </div>
          </div>
          </div>
        </div>



        <div class="fn3">
          <div class="card card9">
            <i class="fas fa-tools icone icone7"></i>
            </div>
            <div class="texte">
              <label class="tx">Gestion de maintenance</label>
              <div class="page__group">
                <div class="rating">
                    <input type="radio" name="rating-star" class="rating__control screen-reader" id="rc1">
                    <input type="radio" name="rating-star" class="rating__control screen-reader" id="rc2">
                    <input type="radio" name="rating-star" class="rating__control screen-reader" id="rc3">
                    <input type="radio" name="rating-star" class="rating__control screen-reader" id="rc4">
                    <input type="radio" name="rating-star" class="rating__control screen-reader" id="rc5">
                    <label for="rc1" class="rating__item">
                        <svg class="rating__star">
                        <use xlink:href="#star"></use>
                        </svg>
                        <span class="screen-reader">1</span>
                    </label>
                    <label for="rc2" class="rating__item">
                        <svg class="rating__star">
                        <use xlink:href="#star"></use>
                        </svg>
                        <span class="screen-reader">2</span>
                    </label>
                    <label for="rc3" class="rating__item">
                        <svg class="rating__star">
                        <use xlink:href="#star"></use>
                        </svg>
                        <span class="screen-reader">3</span>
                    </label>
                    <label for="rc4" class="rating__item">
                        <svg class="rating__star">
                        <use xlink:href="#star"></use>
                        </svg>
                        <span class="screen-reader">4</span>
                    </label>
                    <label for="rc5" class="rating__item">
                        <svg class="rating__star">
                        <use xlink:href="#star"></use>
                        </svg>
                        <span class="screen-reader">5</span>
                    </label>
                </div>
            </div>
            </div>
          </div>
    </div>
  
  </div>    
</body>

</html>