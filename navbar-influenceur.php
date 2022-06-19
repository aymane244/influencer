<div class="navbar">
    <div>
        <h1><?php echo $_SESSION['firstname'] ?> <?php echo $_SESSION['name'] ?></h1>
    </div>
    <nav class="div-grid" id="div_active">
        <a href="espace-influenceur.php" class="items">Mon espace</a>
        <a href="profile-influenceur.php" class="items">Mon profile</a>
        <a href="messanger-influenceur.php" class="items">Messanger</a>
        <a href="contrat-influenceur.php" class="items">Mes contrats</a>
        <a href="deconnexion.php" class="items">Déconnexion</a>
    </nav>
</div>
<script>
    const activePage = window.location.pathname;
    const navLinks = document.querySelectorAll('nav a').forEach(link => {
        if(link.href.includes(`${activePage}`)){
            link.classList.add('active');
        }
    })
</script>