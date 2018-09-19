<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/system/declaration.php';
if(isset($_SESSION['user']->id))
{
  ?>
  <!Doctype html>
  <html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard</title>
    <link rel="stylesheet" href="/lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="/lib/jquery/datatables.css"> 
    <!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css"> -->


  </head>

  <body>
    <div id="modalbox"></div>
    <nav style="background: #DCDCDC;border-bottom: 2px solid #C0C0C0" class="navbar navbar-expand-md navbar-light sticky-top">
      <a class="navbar-brand w-75" href="#">
        <img src="/img/1.png" width="18%" height="40" alt="">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse nav justify-content-end" id="navbarCollapse">
        <form class="form-inline">
          <input class="form-control m-2" type="text" placeholder="Поиск" aria-label="Search">
          <button class="btn btn-secondary m-2" type="submit">Найти</button>
        </form>
      </div>
    </nav>
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-2">
          <div id="second-navbar" style="width:15%; background: #fff;border-right: 2px solid #C0C0C0">
          </div>
        </div>
        <div class="col-md-10">
          <main id="content" role="main" style="padding-top:25px;">
          </main>
        </div>
      </div>
    </div>
    <script src="/lib/jquery/jquery.js"></script>
    <script src="/lib/jquery/datatables.js"></script>
    <script src="/lib/bootstrap/js/bootstrap.js"></script>

    <!--<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>-->

    <script type="text/javascript" charset="utf8" src="/js/script.js"></script>
    
  </body>
  </html>
  <?php
}
else
{
  header('Location:auth.php');
};
?>