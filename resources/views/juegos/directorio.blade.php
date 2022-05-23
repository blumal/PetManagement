<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/facturas/directorio.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans%3A400%2C400italic%2C600%2C700%2C700italic%7COswald%3A400%2C300%7CVollkorn%3A400%2C400italic'>
<link rel="stylesheet" href="./css/juegos/directorio.css">  
<link rel="stylesheet" href="{{asset('css/style-home.css')}}">  
<title>Directorio Juegos</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" id="token">
</head>
<body>
  @include('comun.navegacion')
    
    <main class="main-content">
        <section class="slideshow">
          <div class="slideshow-inner">
            <div class="slides">
              <div class="slide is-active ">
                <div class="slide-content">
                  <div class="caption">
                    <div class="title">Pet Guesser</div>
                    <div class="text">
                      <p></p>
                    </div> 
                    <a href="{{url("geoguesser-game")}}" class="btn">
                      <span class="btn-inner">¡JUEGA!</span>
                    </a>
                  </div>
                </div>
                <div class="image-container"> 
                  <img src="https://images.unsplash.com/photo-1578403881967-084f9885be74?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1188&q=80" alt="" class="image" />
                </div>
              </div>
              <div class="slide">
                <div class="slide-content">
                  <div class="caption">
                    <div class="title">RANITA</div>
                    <div class="text">
                      <p>El Frogger de toda la vidat</p>
                    </div> 
                    <a href="{{url("juegos/ranita")}}" class="btn">
                      <span class="btn-inner">¡JUEGA!</span>
                    </a>
                  </div>
                </div>
                <div class="image-container">
                  <img src="https://images.unsplash.com/photo-1559253664-ca249d4608c6?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2937&q=80" alt="" class="image" />
                </div>
              </div>
              <div class="slide">
                <div class="slide-content">
                  <div class="caption">
                    <div class="title">Spiderweb</div>
                    <div class="text">
                      <p>Atrapa las presa</p>
                    </div> 
                    <a href="{{url("juegos/spiderweb")}}" class="btn disabled">
                      <span class="btn-inner">PRÓXIMAMENTE...</span>
                    </a>
                  </div>
                </div>
                <div class="image-container">
                  <img src="https://images.unsplash.com/photo-1614461216444-e4d757e5dc3f?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2787&q=80" alt="" class="image" />
                </div>
              </div>
              <div class="slide">
                <div class="slide-content">
                  <div class="caption">
                    <div class="title">Quizz del zorro</div>
                    <div class="text">
                      <p>Acierta todas las preguntas</p>
                    </div> 
                    <a href="{{url("juegos/quizz")}}" class="btn disabled">
                      <span class="btn-inner">PRÓXIMAMENTE...</span>
                    </a>
                  </div>
                </div>
                <div class="image-container"> 
                  <img src="https://images.unsplash.com/photo-1462953491269-9aff00919695?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2265&q=80" alt="" class="image" />
                </div>
              </div>
            </div>
            <div class="pagination">
              <div class="item is-active"> 
                <span class="icon">1</span>
              </div>
              <div class="item">
                <span class="icon">2</span>
              </div>
              <div class="item">
                <span class="icon">3</span>
              </div>
              <div class="item">
                <span class="icon">4</span>
              </div>
            </div>
            <div class="arrows">
              <div class="arrow prev">
                <span class="svg svg-arrow-left">
                  <svg version="1.1" id="svg4-Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="14px" height="26px" viewBox="0 0 14 26" enable-background="new 0 0 14 26" xml:space="preserve"> <path d="M13,26c-0.256,0-0.512-0.098-0.707-0.293l-12-12c-0.391-0.391-0.391-1.023,0-1.414l12-12c0.391-0.391,1.023-0.391,1.414,0s0.391,1.023,0,1.414L2.414,13l11.293,11.293c0.391,0.391,0.391,1.023,0,1.414C13.512,25.902,13.256,26,13,26z"/> </svg>
                  <span class="alt sr-only"></span>
                </span>
              </div>
              <div class="arrow next">
                <span class="svg svg-arrow-right">
                  <svg version="1.1" id="svg5-Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="14px" height="26px" viewBox="0 0 14 26" enable-background="new 0 0 14 26" xml:space="preserve"> <path d="M1,0c0.256,0,0.512,0.098,0.707,0.293l12,12c0.391,0.391,0.391,1.023,0,1.414l-12,12c-0.391,0.391-1.023,0.391-1.414,0s-0.391-1.023,0-1.414L11.586,13L0.293,1.707c-0.391-0.391-0.391-1.023,0-1.414C0.488,0.098,0.744,0,1,0z"/> </svg>
                  <span class="alt sr-only"></span>
                </span>
              </div>
            </div>
          </div> 
        </section>
      </main>
    
</body>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/TweenMax.min.js'></script>
<script  src="./js/juegos/script.js"></script>

</html>