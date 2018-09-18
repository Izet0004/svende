// USERS AJAX
function showUserDetails(id) {
    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "handlers/usersHandle.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            modalData("User Details", xhttp.response);
        }
    };
    xhttp.send("userId=" + id + "&details");
}

function editUser(id) {
    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "handlers/usersHandle.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            modalData("Edit User", xhttp.response, '<div><button type="button" name="" id="" onclick="saveUser()" class="btn btn-primary btn-green" btn-lg btn-block>Gem</button></div>');
        }
    };
    xhttp.send("userId=" + id + "&edit");
}
function createUser(){
    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "handlers/usersHandle.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            modalData("Create User", xhttp.response, '<div><button type="button" name="" id="" onclick="saveUser()" class="btn btn-primary btn-green" btn-lg btn-block>Gem</button></div>');
        }
    };
    xhttp.send("userId=0" + "&edit");
}
function saveUser(){
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
    xhttp.open("POST", "handlers/usersHandle.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(xhttp.response);
            toggleModal();
            listUsers();
        }
    };
    xhttp.send("data=" + finalData + "&save");
}

function listUsers() {
    let content = document.getElementById("listContent");
    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "handlers/usersHandle.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            content.innerHTML = xhttp.response;
        }
    };
    xhttp.send("listUsers");
}

function deleteUser(id){
    if(confirm("Er du sikker på du vil slette?")){
        let xhttp = new XMLHttpRequest();
        xhttp.open("POST", "handlers/usersHandle.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                listUsers();
            }
        };
        xhttp.send("userId=" + id + "&delete");
    }
}
// USERS AJAX END

// MODAL

// VALIDATE FORM IN MODAL
function modalData(heading = "Modal", data, saveButton = "") {
    if(saveButton.length > 0){
        Modal(heading, data, saveButton);
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
function Modal(heading = "Modal", body = "Body", saveButton = "", script=""){
    let bodyElm = document.getElementById("body");
    let modalHtml = "";
    modalHtml += '<div class="modalContainer" id="modalContainer">';
    modalHtml += '<div class="customModal" id="modalCustom">';
    modalHtml += '<div id="modalHeading">'
    modalHtml += '<div><h3>' + heading + '</h3></div></div>';
    modalHtml += '<div id="modalBody">' + body + '</div>';
    modalHtml += '<div id="modalFooter">';
    modalHtml += '<div><button type="button" onclick="toggleModal()" name="" id="" class="btn btn-primary btn-dark" btn-lg btn-block>Annuller</button></div>';
    modalHtml += saveButton;
    modalHtml += script;
    modalHtml += '</div></div></div>';
    bodyElm.innerHTML += modalHtml;
    toggleModal();
}
