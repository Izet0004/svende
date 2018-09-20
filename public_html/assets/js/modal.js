function modalData(heading = "Modal", data) {
    Modal(heading, data);
}
function showArtist(id) {
    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "handlers/artistHandle.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            modalData("User Details", xhttp.response);
            console.log(xhttp.response);
        }
    };
    xhttp.send("id=" + id);
}
function toggleModal() {
    let modalContainer = document.getElementById("modalContainer");
    let modal = document.getElementById("modalCustom");
    if (modal.style.display != "flex") {
        modal.style.display = "flex";
        modalContainer.style.display = "flex";
    } else {
        modal.style.display = "none";
        modalContainer.style.display = "none";
        modalContainer.remove();
    }
}

function Modal(heading = "Modal", body = "Body", saveButton = "", script = "") {
    let bodyElm = document.getElementById("body");
    let modalHtml = "";
    modalHtml += '<div class="modalContainer" id="modalContainer">';
    modalHtml += '<form onsubmit="' + script + '; return false;" action="" method="POST" class="customModal" id="modalCustom">';
    // modalHtml += '<div id="modalHeading">'
    // modalHtml += '<div><h3>' + heading + '</h3></div></div>';
    modalHtml += '<div id="modalBody">' + body + '</div>';
    modalHtml += '<div id="modalFooter">';
    modalHtml += '<div><button type="button" onclick="toggleModal()" name="" id="" class="btn btn-primary btn-dark" btn-lg btn-block>Annuller</button></div>';
    modalHtml += saveButton;
    modalHtml += '</div></form></div>';
    bodyElm.innerHTML += modalHtml;
    toggleModal();
}