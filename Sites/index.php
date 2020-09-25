<!doctype html>
<html lang="en">
<head>
  <title>Grupo 69 - Home</title>
  <?php include("modules/material.html") ?>
</head>
<body>
<script>0</script>
  <?php include("modules/top_bar.html") ?>
  <?php include("modules/side_bar.html") ?>
  <div class="mdc-drawer-app-content">
    <main class="main-content" id="main-content">
      <div class="mdc-top-app-bar--fixed-adjust"></div>
      <div class="mdc-layout-grid mdc-layout-grid--align-right">
        <div class="mdc-layout-grid__inner">

          <div class="mdc-card card-content mdc-layout-grid__cell mdc-layout-grid__cell--span-6" id="card-query-1">
            <h1 class="mdc-typography--headline3">Consulta 1</h1>
            <p class="mdc-typography--body1">Mostrar todos los <b>puertos</b> junto con la <b>ciudad</b> a la que son asignados</p>
            <div>
              <button class="mdc-button mdc-button--outlined query-button" id="button-query-1">
              <div class="mdc-button__ripple"></div>
              <span class="mdc-button__label">Consultar</span>
              </button>
            </div>
          </div>

          <div class="mdc-card card-content mdc-layout-grid__cell mdc-layout-grid__cell--span-6" id="card-query-2">
            <h1 class="mdc-typography--headline3">Consulta 2</h1>
            <p class="mdc-typography--body1">Mostrar todos los <b>jefes</b> de las <b>instalaciones</b> del <b>puerto</b> con nombre <i id="text-query-2">Mejillones</i></p>
            <label class="mdc-text-field mdc-text-field--outlined" id="input-query-2">
              <input type="text" class="mdc-text-field__input" aria-labelledby="input-query-2" onkeyup="textInputReceived(this)" autocomplete="off">
              <span class="mdc-notched-outline">
                <span class="mdc-notched-outline__leading"></span>
                <span class="mdc-notched-outline__notch">
                  <span class="mdc-floating-label" id="label-input-query-2">Nombre del puerto</span>
                </span>
                <span class="mdc-notched-outline__trailing"></span>
              </span>
            </label>
            <div>
              <button class="mdc-button mdc-button--outlined query-button" id="button-query-2">
              <div class="mdc-button__ripple"></div>
              <span class="mdc-button__label">Consultar</span>
              </button>
            </div>
          </div>

          <div class="mdc-card card-content mdc-layout-grid__cell mdc-layout-grid__cell--span-6" id="card-query-3">
            <h1 class="mdc-typography--headline3">Consulta 3</h1>
            <p class="mdc-typography--body1">Mostrar todos los <b>puertos</b> que tienen al menos un <b>astillero</b></p>
            <div>
              <button class="mdc-button mdc-button--outlined query-button" id="button-query-3">
              <div class="mdc-button__ripple"></div>
              <span class="mdc-button__label">Consultar</span>
              </button>
            </div>
          </div>

          <div class="mdc-card card-content mdc-layout-grid__cell mdc-layout-grid__cell--span-6" id="card-query-4">
            <h1 class="mdc-typography--headline3">Consulta 4</h1>
            <p class="mdc-typography--body1">Mostrar todas las veces que el <b>barco</b> <i id="text-query-4">Calypso</i> ha <b>atracado</b> en <i id="text-query-4b">Arica</i></p>
            <label class="mdc-text-field mdc-text-field--outlined" id="input-query-4">
              <input type="text" class="mdc-text-field__input" aria-labelledby="input-query-4" onkeyup="textInputReceived(this)" autocomplete="off">
              <span class="mdc-notched-outline">
                <span class="mdc-notched-outline__leading"></span>
                <span class="mdc-notched-outline__notch">
                  <span class="mdc-floating-label" id="label-input-query-4">Nombre del barco</span>
                </span>
                <span class="mdc-notched-outline__trailing"></span>
              </span>
            </label>
            <label class="mdc-text-field mdc-text-field--outlined" id="input-query-4b">
              <input type="text" class="mdc-text-field__input" aria-labelledby="input-query-4b" onkeyup="textInputReceived(this)" autocomplete="off">
              <span class="mdc-notched-outline">
                <span class="mdc-notched-outline__leading"></span>
                <span class="mdc-notched-outline__notch">
                  <span class="mdc-floating-label" id="label-input-query-4b">Nombre de la ciudad</span>
                </span>
                <span class="mdc-notched-outline__trailing"></span>
              </span>
            </label>
            <div>
              <button class="mdc-button mdc-button--outlined query-button" id="button-query-4">
              <div class="mdc-button__ripple"></div>
              <span class="mdc-button__label">Consultar</span>
              </button>
            </div>
          </div>

          <div class="mdc-card card-content mdc-layout-grid__cell mdc-layout-grid__cell--span-6" id="card-query-5">
            <h1 class="mdc-typography--headline3">Consulta 5</h1>
            <p class="mdc-typography--body1">Mostrar la edad promedio de los <b>trabajadores</b> de cada <b>puerto</b></p>
            <div>
              <button class="mdc-button mdc-button--outlined query-button" id="button-query-5">
              <div class="mdc-button__ripple"></div>
              <span class="mdc-button__label">Consultar</span>
              </button>
            </div>
          </div>

          <div class="mdc-card card-content mdc-layout-grid__cell mdc-layout-grid__cell--span-6" id="card-query-6">
            <h1 class="mdc-typography--headline3">Consulta 6</h1>
            <p class="mdc-typography--body1">Mostrar el <b>puerto</b> que ha recibido más <b>barcos</b> en <i>Agosto del 2020</i></p>
            <div>
              <button class="mdc-button mdc-button--outlined query-button" id="button-query-6">
              <div class="mdc-button__ripple"></div>
              <span class="mdc-button__label">Consultar</span>
              </button>
            </div>
          </div>

          <div class="mdc-card card-content mdc-layout-grid__cell mdc-layout-grid__cell--span-12" id="card-output">
            <h1 class="mdc-typography--headline3">Resultados</h1>
            <div id="result-placeholder" style="margin: auto">
              <p class="mdc-typography--overline" style="text-align: center">El resultado se mostrará aquí</p>
            </div>
          </div>
        </div>
      </div>

      <footer>
        <p>THIS IS THE FOOTER</p>
      </footer>
    </main>
  </div>

  <script src="js/script.js" async></script>
</body>
</html>
