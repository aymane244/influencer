<script>
    function influenceur(){
        document.getElementById("influenceur").style.display="block";
        document.getElementById("marque").style.display="none";
    }
    function marque(){
        document.getElementById("marque").style.display="block";
        document.getElementById("influenceur").style.display="none";
    }
    function afficher() {
        document.getElementById("modal").style.display = "block";
    }
    function fermer() {
        document.getElementById("modal").style.display = "none";
    }
    window.onclick = function(event) {
        if (event.target == document.getElementById("modal")) {
            document.getElementById("modal").style.display = "none";
        }
    }
</script>