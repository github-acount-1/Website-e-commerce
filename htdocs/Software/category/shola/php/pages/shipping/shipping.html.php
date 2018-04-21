<!DOCTYPE html>
<?php
include("header.html");
?>
<html>
<body>
<div class="container bg-white no-margin-bottom">

    <img class="no-margin-top no-margin-bottom"src="img/image alt.jpg" >

      <h2 class="padding20">Shipping Info</h2>

            <hr class="thin margin20 no-margin-top"/>

              <div class="grid padding20">

                  <div class="row">
                    <span>Address</span>

                    <form action="" method="post">
                      <div class="input-control select full-size">
                      <select name="cities" id="cities">
                          <optgroup label="Cities" >
                            <option value="Shiromeda" selected="">Please select a city</option>
                            <option value="Adisugebeya">Adisugebeya</option><option value="Aratkilo">Aratkilo</option><option value="Akaki">Akaki</option>
                            <option value="Asco">Asco</option><option value="Atobistera">Atobistera</option><option value="Ayat">Ayat</option>  <option value="Ayertena">Ayertena</option>
                            <option value="Bethel">Bethel</option><option  value="Bole">Bole</option><option value="Gerji">Gerji</option><option value="Gotera">Gotera</option>
                            <option value="Emperial" >Emperial</option><option value="Kaliti">Kaliti</option><option value="Kazanchis">Kazanchis</option>
                            <option value="Kera">Kera</option><option value="Laphto">Laphto</option>  <option value="Lebu">Lebu</option>
                            <option value="Lideta">Lideta</option><option value="Megenagna">Megenagna</option><option value="Mekanisa">Mekanisa</option>
                            <option value="Merkato">Merkato</option><option value="Mexico">Mexico</option><option value="Piassa">Piassa</option>
                            <option value="Sarbet">Sarbet</option><option value="Saris">Saris</option><option value="Semit">Semit</option>
                            <option value="Shiromeda">Shiromeda</option>
                          </optgroup>
                      </select>
                    </div>
                  </div>

                  <div class="row cells2">
                        <div class="cell">

                                <div class="input-control modern text full-size" data-role="input">

                                      <span class="label">Street Address</span>
                                      <input type="text" name="street-number" required="" id="street-number">
                                      <span class="label">Street Number</span>

                                      <span class="placeholder">Enter Street Number</span>
                                </div>

                              </div>

                            <div class="cell">

                                <div class="input-control modern text full-size" data-role="input">

                                    <span class="label" >House number</span>
                                    <input type="text" name="house-number" required="" id="house-number">
                                    <span class="label" >House number</span>

                                    <span class="placeholder">Enter House Number</span>
                                </div>
                            </div>
                          </div>




                        <div class="row cells2">
                            <div class="cell">
                                <button onclick="calculate()" class="button primary rounded no-border">Calculate</button>


                            </div>

                            <div class="cell input-control modern text">
                                <span class="label">Shipping Cost</span>
                                <input type="text" name="house-number" required="" id="costLabel">


                            </div>

                          </div>



                  <div class="row">



                      <button class="button rounded place-right primary"  id="p">Next </button>
                      <button class="button rounded bg-grayLighter">Go back</button>

                  </div>

  </div>



    </div>



</body>

</html>
<?php

include("footer.html")

 ?>
