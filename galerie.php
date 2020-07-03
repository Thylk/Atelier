<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="fr">
	
<?php include 'head.php';?>

<body>

<?php include 'header.php';?>

<main>

    <h1>Galerie</h1>
    <div id="toto6">

        <div id="galerie">

            <!-- Full-width images with number text -->
            <div class="mySlides">
                <img src="assets/img/mannequin.jpg" style="width:100%">
            </div>

            <div class="mySlides">
                <img src="assets/img/shopping.jpg" style="width:100%">
            </div>

            <div class="mySlides">
                <img src="assets/img/fox.jpg" style="width:100%">
            </div>

            <div class="mySlides">
                <img src="assets/img/mannequin.jpg" style="width:100%">
            </div>

            <div class="mySlides">
                <img src="assets/img/shopping.jpg" style="width:100%">
            </div>

            <div class="mySlides">
                <img src="assets/img/fox.jpg" style="width:100%">
            </div>

            <!-- Next and previous buttons -->
            
            

        </div>

        <!-- Image text -->
        <div class="caption-container">
            <div id="topy">
                <a class="prevti" onclick="plusSlides(-1)">&#10094;</a>
                <p id="caption"></p>
                <a class="nextti" onclick="plusSlides(1)">&#10095;</a>
            </div>
        </div>

        <!-- Thumbnail images -->
        <div id="miniatures" class="row">
            <div class="column">
                <img class="demo cursor" src="assets/img/mannequin.jpg" style="width:100%" onclick="currentSlide(1)" alt="The Woods">
            </div>
            <div class="column">
                <img class="demo cursor" src="assets/img/shopping.jpg" style="width:100%" onclick="currentSlide(2)" alt="Cinque Terre">
            </div>
            <div class="column">
                <img class="demo cursor" src="assets/img/fox.jpg" style="width:100%" onclick="currentSlide(3)" alt="Mountains and fjords">
            </div>
            <div class="column">
                <img class="demo cursor" src="assets/img/mannequin.jpg" style="width:100%" onclick="currentSlide(4)" alt="Northern Lights">
            </div>
            <div class="column">
                <img class="demo cursor" src="assets/img/shopping.jpg" style="width:100%" onclick="currentSlide(5)" alt="Nature and sunrise">
            </div>
            <div class="column">
                <img class="demo cursor" src="assets/img/fox.jpg" style="width:100%" onclick="currentSlide(6)" alt="Snowy Mountains">
            </div>
        </div>
        

    </div>

</main>

<script>
        var slideIndex = 1;
    showSlides(slideIndex);

    // Next/previous controls
    function plusSlides(n) {
    showSlides(slideIndex += n);
    }

    // Thumbnail image controls
    function currentSlide(n) {
    showSlides(slideIndex = n);
    }

    function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("demo");
    var captionText = document.getElementById("caption");
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";
    dots[slideIndex-1].className += " active";
    captionText.innerHTML = dots[slideIndex-1].alt;
    } 
</script>

</body>
</html>