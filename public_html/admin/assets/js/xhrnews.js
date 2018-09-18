// USERS AJAX
function showNewsDetails(id) {
    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "handlers/newsHandle.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            modalData("News Details", xhttp.response);
        }
    };
    xhttp.send("newsId=" + id + "&details");
}

function editNews(id) {
    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "handlers/newsHandle.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            modalData("Edit News", xhttp.response, '<div><button type="submit" name="" id=""  class="btn btn-primary btn-green" btn-lg btn-block>Gem</button></div>', "saveNews()");
        }
    };
    xhttp.send("newsId=" + id + "&edit");
}

function createNews() {
    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "handlers/newsHandle.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            modalData("Create News", xhttp.response, '<div><button type="submit" name="" id="" onclick="saveNews()" class="btn btn-primary btn-green" btn-lg btn-block>Gem</button></div>');
        }
    };
    xhttp.send("newsId=0" + "&edit");
}

function saveNews() {
    let xhttp = new XMLHttpRequest();
    let modalBody = document.getElementById("modalBody");
    let inputs = modalBody.querySelectorAll("input, select");
    let data = [];
    inputs.forEach(input => {
        data.push({
            name: input.name,
            value: input.value
        });
    });
    let finalData = JSON.stringify(data);
    xhttp.open("POST", "handlers/newsHandle.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(xhttp.response);
            toggleModal();
            listNews();
        }
    };
    xhttp.send("data=" + finalData + "&save");
}
function uploadImage(image){
    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "handlers/newsHandle.php", true);
    xhttp.setRequestHeader("Content-type", "multipart/form-data");
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            content.innerHTML = xhttp.response;
        }
    };
    xhttp.send("file=" + file);
}
function listNews() {
    let content = document.getElementById("listContent");
    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "handlers/newsHandle.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            content.innerHTML = xhttp.response;
        }
    };
    xhttp.send("listNews");
}

function deleteNews(id) {
    if (confirm("Er du sikker på du vil slette?")) {
        let xhttp = new XMLHttpRequest();
        xhttp.open("POST", "handlers/newsHandle.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                listNews();
            }
        };
        xhttp.send("newsId=" + id + "&delete");
    }
}
// USERS AJAX END

// MODAL

// VALIDATE FORM IN MODAL
function modalData(heading = "Modal", data, saveButton = "", script="") {
    if (saveButton.length > 0) {
        Modal(heading, data, saveButton, script);
    } else {
        Modal(heading, data);
    }
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
    modalHtml += '<div id="modalHeading">'
    modalHtml += '<div><h3>' + heading + '</h3></div></div>';
    modalHtml += '<div id="modalBody">' + body + '</div>';
    modalHtml += '<div id="modalFooter">';
    modalHtml += '<div><button type="button" onclick="toggleModal()" name="" id="" class="btn btn-primary btn-dark" btn-lg btn-block>Annuller</button></div>';
    modalHtml += saveButton;
    modalHtml += '</div></form></div>';
    bodyElm.innerHTML += modalHtml;
    toggleModal();
}