
<style>
    /* Google Font CDN Link */

*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  text-decoration: none;
  scroll-behavior: smooth;
}
:root{
    --primary-color:#ff8882;
    --black-color:#0E2431;
    --white-color:#fff;

}
body{
        font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
    }
/* Custom Scroll Bar CSS */
::-webkit-scrollbar {
    width: 10px;
}
::-webkit-scrollbar-track {
    background: #f1f1f1;
}
::-webkit-scrollbar-thumb {
    background: var(--primary-color);
    border-radius: 12px;
    transition: all 0.3s ease;
}
::-webkit-scrollbar-thumb:hover {
    background: var(--primary-color);
}
.btn-submit{
        background-color: black;
        color: white;
        padding: 7px 25px 7px 25px;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
        transition: 0.4s;
        width: 10%;
        border: 1px solid black;
    }
    .btn-submit:hover{
        background-color: white;
        color: black;
    }
/* navbar styling */
nav{
  position:fixed;
  width:100%;
  padding:20px 0;
  z-index: 999;
  transition: all 0.3s ease;
}
nav.sticky{
  background:var(--primary-color);
  padding:13px 0;
}
nav .navbar{
  width:90%;
  display:flex;
  justify-content: space-between;
  align-items: center;
  margin:auto;
}
nav .navbar .logo a{
  font-weight: 500;
  font-size: 35px;
  color:var(--black-color);
}

nav.sticky .navbar .logo a{
  color:var(--white-color);
}

nav .navbar .menu{
  display:flex;
  position:relative;
}
nav .navbar .menu li{
  list-style: none;
  margin:0 8px;
}
nav .navbar .menu a{
  font-size: 18px;
  font-weight: 500;
  color:var(--black-color);
  padding:6px 0;
  transition: all 0.4s ease;
}
.navbar .menu a:hover{
  color:var(--primary-color);
}
nav.sticky .menu a{
  color:var(--white-color);
}
nav.sticky .menu a:hover{
  color:var(--black-color);
}
.navbar .media-icons a{
  color:var(--black-color);
  font-size: 18px;
  margin:0 6px;
}
nav.sticky .media-icons a{
  color:var(--white-color);
}

/* side navigation Menu Button CSS */
nav .menu-btn,
.navbar .menu .cancel-btn{
  position:absolute;
  color:var(--white-color);
  right:30px;
  top:20px;
  font-size: 20px;
  cursor: pointer;
  transition: all 0.3s ease;
  display: none;
}
nav .menu-btn{
  color:var(--primary-color);
}
nav.sticky .menu-btn{
  color:var(--white-color);
}
.navbar .menu .menu-btn{
  color:var(--white-color);
}

/* home section styling */
.home{
  background-size: cover;
  background-position: center center;
  background-attachment: fixed;

}
.home .home-content{
  height:100%;
  margin:auto;
  display:flex;
  flex-direction: column;
  justify-content: center;
  margin-left: 30px;
}
.home .text-two{
  color:var(--black-color);
  font-size: 50px;
  font-weight: 600;
  margin-top: 110px;

}
.home .text-three{
  font-size: 40px;
  margin:5px 0;
  color:var(--black-color);
}
.home .text-four{
  font-size: 23px;
  margin:5px 0;
  color:var(--black-color);
}

        
      
</style>
<!DOCTYPE html> 
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title> Page d'accueil </title>
    <link rel="stylesheet" href="style.css">
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>

  
  <!-- navigation menu -->
  <nav>
    <div class="navbar">
      <div class="logo"><a href="#">Marque-Influenceur</a></div>
      <div class="media-icons">
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
      </div>
    </div>

  </nav>

  <!-- Home Section Start -->
  <section class="home" id="home">
    <div class="home-content">
      <div class="text" style="display:flex;">
        <div>
            <div class="text-two">Votre platforme pour <br> marque-influenceur</div>
            <div class="text-three">Expérience unique</div>
            <div class="text-four">Gagner la bonne réputation</div>
      </div>
      <div>
          <img src="images/gens.webp" width=800px>
      </div>

    </div>
      
        <a href="connexion.php" class="btn-submit">Connexion</a>
      

    </div>
  </section>

</body>
</html>


