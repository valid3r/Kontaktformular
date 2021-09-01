


<!DOCTYPE html>
<html lang="en">
<?php require 'templates/head.phtml'; ?>
  <body>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->




<div class="container">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark" style="min-width: 235px;">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <span class="fs-5 d-none d-sm-inline">tecnoConcept</span>
                </a>


                 <?php
                 $path = 'emails';
                 require 'templates/navigation.phtml';
                 ?> 
            <hr>
      
            </div>
        </div>



        <div class="col py-3 content px-4" style="overflow: auto;">
            

        <?php require 'templates/emails.phtml'; ?>

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




