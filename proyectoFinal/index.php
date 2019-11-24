<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Project</title>
  <meta name="keywords" content="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.">
  <meta name="description" content="Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.">
  <link rel="stylesheet" href="include/assets/fonts/flat-icon/flaticon.css">
  <link rel="stylesheet" href="include/assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="include/css/styles.css">
</head>
<body>
<div id="content-wrapper">
  <header class="header header--bg">
    <div class="container">
      <nav class="navbar">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span> 
          </button>
          <a class="navbar-brand" href="#">Rotten Cucumber</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
            <li><a href="#">HOME</a></li>
            <li><a href="#">ABOUT</a></li>
            <li><a href="#">SKILL</a></li> 
            <li><a href="#">PORTFOLIO</a></li> 
            <li><a href="#">TEAM</a></li> 
            <li><a href="#">BLOG</a></li> 
            <li><a href="#">CONTACT</a></li> 
          </ul>
        </div>
      </nav>
      <div class="header__content text-center">
        <span class="header__content__block">HELLO WELCOME</span>
        <h1 class="header__content__title">ROTTEN COCUMBER</h1>
      
       <a class="header__button"  href="login.php">Login</a>
        <a class="header__button" href="userAdd.php">Create Account</a>
      </div>
      <div class="social-icon pull-right">
        <ul>
          <li><a href="#"><i class="flaticon-facebook-letter-logo"></i></a></li>
          <li><a href="#"><i class="flaticon-twitter-logo"></i></a></li>
          <li><a href="#"><i class="flaticon-behance-logo"></i></a></li>
          <li><a href="#"><i class="flaticon-dribbble-logo"></i></a></li>
        </ul>
      </div>
    </div>
  </header>

  <section class="about">
    <div class="container about__container--narrow">
      <div class="page-section">
        <h2 class="page-section__title">ABOUT THIS PAGE</h2>
          <img class="page-section__title-style" src="include/assets/images/title-style.png" alt="">
          <p class="page-section__paragraph">INGRESE LA DESCRIPCION DE LA PAGINA </p>
          <div class="row gutters-80">
            <div class="col-md-4">
              <div class="about__image">
                <img src="" alt="">
              </div>
            
          </div>
      </div>
    </div>
  </section>

  <?php
  include 'include/footer.php';
  ?>
</div>
  

 
</body>
</html>  