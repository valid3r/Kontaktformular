


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link
      href="/css/styles.css"
      rel="stylesheet"
 
    />

    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We"
      crossorigin="anonymous"
    />

  
    <script
      src="/js/main.js"
    ></script>

    <script
    type="text/javascript"
    src="https://code.jquery.com/jquery-1.11.3.min.js"
  ></script>

    <title>PHP Kontakt Formular</title>
  </head>
  <body>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->


      <div class="container">
        <div class="row">


        <?php
        $path = 'index';
        require 'templates/navigation.phtml';
        ?>
  

          <div class="col content px-4">
     

          <!-- Kontaktformular-->

            <?php require 'templates/kontaktformular.phtml'; ?>
  
         
          </div>
        </div>
      </div>










    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
