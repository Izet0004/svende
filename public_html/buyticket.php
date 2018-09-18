<?php
require("assets/incl/header.php");
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 p-0">
            <img src="assets/images/hands.jpg" alt="hero" class="full-img">
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-12 ticket-heading black text-center">
            <h2 class="p-2 marg-top-bottom-1">KØB BILLET</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="white bg-dark2 font-32">
                <p class="pad-sides-1">INFORMATION OM DEN VALGTE BILLET</p>
            </div>
            <div>
                <h4>Almindelig partout billet - 4 dage</h4>
                <p>Billetten giver adgang til Mediesusets festivalplads fra onsdag d. 4. Juli til lørdag d. 7. Juli.</p>
                <p>Billetten ombyttes til et 4-dages armbånd ved en af billetvognene ved ingangen til festivalpladsen</p>
                <p>Billetter giver fri adgang til festivalpladsen, alle festivalens scener, spisesteder og aktiviteter</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="white bg-dark2 font-32">
                <p class="pad-sides-1">BESTILLING</p>
            </div>
            <div class="buy-ticket-wrapper">
                <div class="buy-ticket-info">
                    <div>
                        <input type="number">
                        <span>Stk.</span>
                    </div>
                    <div>
                        <p>Almindelig partout billet - 4 dage</p>
                    </div>
                </div>
                <div class="buy-ticket-price">
                    <div>
                        <span>á</span>
                    </div>
                    <div>
                        <span>DKK 1495,00</span>
                    </div>
                    <div>
                        <span>DKK 0,00</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="buy-ticket-total">
            <div>
                <p>Pris i alt:</p>
            </div>
            <div>
                <p>DKK 0,00</p>
            </div>
        </div>
    </div>
    <form class="row">
        <div class="col-lg-6 ticket-form">
            <p class="font-32">Reserver Camp pladser</p>
            <div class="buy-ticket-up-flex">
                <div class="buy-ticket-up">
                    <span>Antal:</span>
                    <input type="number">
                </div>
                <div>
                    <span>Vælg camp:</span>
                    <select class="buy-ticket-up-height" name="camp" id="camp">
                        <option value="camp">Camp Colorit</option>
                        <option value="camp">Camp Kultunaut</option>
                    </select>
                </div>
            </div>
            <p class="font-32">Indtast oplysninger</p>
            <div class="form-group">
                <label for="email">Email/Brugernavn</label>
                <input type="text" class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="Indtast din email">
            </div>
            <div class="form-group">
                <label for="password">Adgangskode:</label>
                <input type="password" class="form-control" name="password" id="password" aria-describedby="helpId"
                    placeholder="Indtast din adgangskode">
            </div>
            <div class="form-group">
                <label for="password2">Gentag adgangskode:</label>
                <input type="password" class="form-control" name="password2" id="password2" aria-describedby="helpId"
                    placeholder="Gentag adgangskode">
            </div>
            <div class="form-group">
                <label for="name">Navn:</label>
                <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="Indtast dit navn">
            </div>
            <div class="form-group">
                <label for="address">Addresse:</label>
                <input type="text" class="form-control" name="address" id="address" aria-describedby="helpId"
                    placeholder="Indtast din addresse">
            </div>
            <div class="form-group">
                <label for="name">Navn:</label>
                <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="Indtast dit navn">
            </div>
            <div class="form-group input-split">
                <div>
                    <label for="zip">Post nr:</label>
                    <input type="number" class="form-control" name="zip" id="zip" aria-describedby="helpId" placeholder="Indtast dit Post nr">
                </div>
                <div>
                    <label for="city">By</label>
                    <input type="text" class="form-control" name="city" id="city" aria-describedby="helpId" disabled
                        placeholder="By:">
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <p class="font-32">Vælg forsendelsmetode</p>
            <div>
                <div class="ticket-form-delivery">
                    <div class="form-check">
                        <label class="form-check-label font-18">
                            <input type="radio" class="form-check-input" name="" id="" value="checkedValue">
                            <b>Jeg ønsker billeterne tilsendt<br></b>
                            <small>Vi sender billeterne til dig med posten</small>
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label font-18">
                            <input type="radio" class="form-check-input" name="" id="" value="checkedValue">
                            <b>Jeg udskriver billeterne selv<br></b>
                            <small>Du modtager billeterne på din email. Du kan så selv udskrive dem, og du sparer
                                således forsendelses-gebyret</small>
                        </label>
                    </div>
                </div>
            </div>
            <div class="ticket-form-submit">
                <a class="white bg-blue font-32" href="#">SEND</a>
            </div>
        </div>
    </form>
</div>
<?php require("assets/incl/footer.php")?>