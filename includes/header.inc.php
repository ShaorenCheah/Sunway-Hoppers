<?php

include './includes/modals/loginModal.php';
include './includes/modals/registerModal.php';
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
<link rel="stylesheet" type="text/css" href="./styles/navbar.css">
<style>
  @import url('https://fonts.googleapis.com/css2?family=League+Spartan:wght@300;400;500;600;700&family=Open+Sans:wght@300;400;600&family=Spectral:wght@300&display=swap');
</style>

<nav class="navbar shadow container w-100 my-3 mb-lg-0 py-2 px-5 header">
  <div class="col d-flex justify-content-start">
    <a class="navbar-brand" href="#">
      <img src="images/logo/nav.png" width="100">
    </a>
  </div>
  <ul class="col navbar-nav w-100  d-flex flex-row justify-content-around">
    <li class="nav-item">
      <a class="nav-link" href="#">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#"><i class="bi bi-geo-alt-fill"></i> Find Carpool</a>
    </li>
    <li class="nav-item">
      <a class="nav-link">Rewards</a>
    </li>
    <?php
    if(session_status() === PHP_SESSION_ACTIVE){
    ?>
    <li class="nav-item">
      <a class="nav-link" href="./includes/logout.inc.php">Logout</a>
    </li>
    <?php }?>
  </ul>
  <div class="col d-flex justify-content-end">
    <?php
    if(session_status() === PHP_SESSION_ACTIVE){
    ?>
    <button type="button" class="btn btn-primary btn-circle shadow profile px-4"><i class="bi bi-person"></i></button>
    <?php
    }else{
    ?>
    <button type="button" class="btn btn-primary shadow login px-4" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
    <?php } ?>
  </div>
</nav>