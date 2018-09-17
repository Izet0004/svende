function toast(text) {
    let toaster = document.getElementById("toaster");
    toaster.innerHTML = "<p>" + text + "</p>";
    toaster.style.display = "flex";
    setTimeout(function () {
        toaster.style.display = "none";
    }, 2000);

}

function newsletterSignup(elm) {
    let email = document.getElementById("emailInput").value;
    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "/handlers/newsletterHandle.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            toast(xhttp.responseText);
        } else {
            toast("Noget gik galt, prøv igen.");
        }
    };
    xhttp.send("newsletterEmail=" + email);
}