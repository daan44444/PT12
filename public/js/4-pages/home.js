function calculateBmi() {
    var weight = document.bmiForm.weight.value;
    var height = document.bmiForm.height.value;

    var tmpWeight = weight.toLowerCase();
    var tmpHeight = height.toLowerCase();

    if(tmpWeight == "easter" && tmpHeight == "egg"){
        document.bmiForm.meaning.value = "Not a Easter Egg!"
    }else{
        if(weight > 0 && height > 0){
            var finalBmi = weight/(height/100*height/100);
            document.bmiForm.bmi.value = finalBmi;
            if(finalBmi < 18.5){
                document.bmiForm.meaning.value = "That you are too thin."
            }
            if(finalBmi > 18.5 && finalBmi < 25){
                document.bmiForm.meaning.value = "That you are healthy."
            }
            if(finalBmi > 25){
                document.bmiForm.meaning.value = "That you have overweight. (Fat ASF)"
            }
        }
        else{
            alert("Please Fill in everything correctly")
        }
    }
}

$(document).ready(function(){
    // Add smooth scrolling on all links inside the navbar
    $("#myArrow a").on('click', function(event) {
        // Make sure this.hash has a value before overriding default behavior
        if (this.hash !== "") {
            // Prevent default anchor click behavior
            event.preventDefault();

            // Store hash
            var hash = this.hash;

            // Using jQuery's animate() method to add smooth page scroll
            // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
            $('html, body').animate({
                scrollTop: $(hash).offset().top
            }, 800, function(){

                // Add hash (#) to URL when done scrolling (default click behavior)
                window.location.hash = hash;
            });
        }  // End if
    });
});