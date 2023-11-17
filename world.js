document.addEventListener("DOMContentLoaded", function() {
    var lookupButton = document.getElementById("lookup");
    var lookupCities = document.getElementById("lookup_cities")
    var countryInput = document.getElementById("country");
    var resultDiv = document.getElementById("result");

    lookupButton.addEventListener("click", function() {
        var country = countryInput.value;
        var xhr = new XMLHttpRequest();

        xhr.open("GET", "world.php?country=" + encodeURIComponent(country), true);

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                resultDiv.innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    });

    lookupCities.addEventListener("click", function(){
        var country = countryInput.value;
        var xhr = new XMLHttpRequest();

        xhr.open("GET", "world.php?country=" + encodeURIComponent(country), true);

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                resultDiv.innerHTML = xhr.responseText;
            }
        };
        xhr.send();
    });
    
});
