class Zipper {
    constructor(zipInput, cityOutput) {
        this.zipInput = zipInput;
        this.cityOutput = cityOutput;
        this.getZip(this.zipInput, this.cityOutput);
    }

    getZip(zipInput, cityOutput) {
        let zipInputElm = document.getElementById(zipInput);
        let cityOutputElm = document.getElementById(cityOutput);
        zipInputElm.addEventListener("keyup", () => {
            if (zipInputElm.value.length >= 3) {
                let xhttp = new XMLHttpRequest();
                xhttp.open("POST", "handlers/zipHandle.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        cityOutputElm.value = xhttp.response;
                    }
                };
                xhttp.send("zip=" + zipInputElm.value);
            }
        });
    }
}