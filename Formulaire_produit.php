<!DOCTYPE html>
<html lang="fr">

<?php include("Ext_head.php"); ?>
<title>Formulaire Produit</title>
</head>

<body>
    <div class="container">
        <form action="formProduit.php" onSubmit="return valider()" method="POST" name="formulaire">
            <fieldset>
                <legend class="legend">Formulaire Produit</legend>
                <p>*Champs obligatoires</p>

                <!-- Champs 1 La Marque -->
                <section class="input-group input-group-lg">
                    <section class="input-group-prepend">
                        <span class="input-group-text champs">Marque*</span>
                    </section>
                    <input type="text" class="form-control" id="marque" name="marque" required>
                </section>
                <br>

                <!-- Champs 2 Le Nom du Produit -->
                <section class="input-group input-group-lg">
                    <section class="input-group-prepend">
                        <span class="input-group-text champs">Nom du produit*</span>
                    </section>
                    <input type="text" class="form-control" id="nom_prod" name="nom_prod" required>
                </section>
                <br>

                <!-- Champs 3  Le Prix-->
                <section class="input-group input-group-lg">
                    <section class="input-group-prepend">
                        <span class="input-group-text champs">Prix*</span>
                    </section>
                    <input type="text" class="form-control" id="prix" name="prix" required>
                </section>
                <br>

                <!-- Champs 4 La Description-->
                <section>
                    <section class="form-group input-group">
                        <span class="input-group-text text champs">Description*</span>
                        <textarea class="form-control" id="desc" name="desc" rows="5" required></textarea>
                    </section>
                </section>
                <br>

                <!-- Champs 5 Les Caractéristiques-->
                <section>
                    <section class="form-group input-group">
                        <span class="input-group-text text champs">Caractéristiques <br> techniques*</span>
                        <textarea class="form-control" id="caract" name="caract" rows="5" required></textarea>
                    </section>
                </section>
                <br>

                <!-- Champs 6 La Sélection de la Catégorie -->
                <section class="input-group-lg input-group">
                    <section class="input-group-prepend">
                        <span class="input-group-text champs">Catégorie*</span>
                    </section>
                    <select class="custom-select form-control form-control-lg" name="categorie" id="sel1" size="1" onchange="giveSelection(this.value)">
                        <option value="0">Choisissez la catégorie</option>
                        <option value="1">Guitares/Basses</option>
                        <option value="2">Batteries</option>
                        <option value="3">Clavier</option>
                        <option value="4">Studio</option>
                        <OPTION value="5">Sonorisation</option>
                        <option value="6">Éclairage</option>
                        <option value="7">DJ</option>
                        <option value="8">Flight cases</option>
                        <option value="9">Accessoires</option>
                    </select>
                </section>
                <br>

                <!-- Champs 7 La Sélection de la Sous-Catégorie -->
                <section class="input-group-lg input-group">
                    <section class="input-group-prepend">
                        <span class="input-group-text champs">Sous-Catégorie*</span>
                    </section>
                    <select class="custom-select form-control form-control-lg" name="sous_categorie" id="sel2" size="1">
                        <option data-option="0" value="0">Choisissez la sous-catégorie</option>
                        <option data-option="1" value="1">Basses</option>
                        <option data-option="1" value="2">Guitares acoustiques</option>
                        <option data-option="1" value="3">Guitares classiques</option>
                        <option data-option="1" value="4">Guitare électriques</option>
                        <option data-option="1" value="5">Guitare électro acoustiques</option>
                        <option data-option="1" value="6">Guitare pour gauchers</option>
                        <option data-option="1" value="7">Instruments sectioners</option>
                        <option data-option="1" value="8">Ukulélés</option>
                        <option data-option="2" value="9">Batteries acoustiques</option>
                        <option data-option="2" value="10">Batteries électroniques</option>
                        <option data-option="2" value="11">Caisses claires</option>
                        <option data-option="2" value="12">Cymbales</option>
                        <option data-option="2" value="13">Marching & Fanfare</option>
                        <option data-option="2" value="14">Musicothérapie</option>
                        <option data-option="2" value="15">Percussions</option>
                        <option data-option="2" value="16">Xylophones & Carillons</option>
                        <option data-option="3" value="17">Accordéons</option>
                        <option data-option="3" value="18">Claviers arrangeurs</option>
                        <option data-option="3" value="19">Claviers maîtres</option>
                        <option data-option="3" value="20">Claviers orientaux</option>
                        <option data-option="3" value="21">Orgues & Clavecins</option>
                        <option data-option="3" value="22">Pianos numériques</option>
                        <option data-option="4" value="23">Casques & Gestions</option>
                        <option data-option="4" value="24">Enceintes de monitoring</option>
                        <option data-option="4" value="25">Enregistrement</option>
                        <option data-option="4" value="26">Format 500 & Modulaire</option>
                        <option data-option="4" value="27">Informatique</option>
                        <option data-option="4" value="28">Interfaces audio</option>
                        <option data-option="4" value="29">M.A.O</option>
                        <option data-option="4" value="30">Microphones</option>
                        <option data-option="4" value="31">Mixage & Production</option>
                        <option data-option="4" value="32">Périphériques numériques</option>
                        <option data-option="4" value="33">Périphériques analogiques</option>
                        <option data-option="5" value="34">Amplis de puissance</option>
                        <option data-option="5" value="35">Effets voix</option>
                        <option data-option="5" value="36">Enceintes actives</option>
                        <option data-option="5" value="37">Enceintes passives</option>
                        <option data-option="6" value="38">Décorations</option>
                        <option data-option="6" value="39">Lasers</option>
                        <option data-option="6" value="40">Projecteurs</option>
                        <option data-option="6" value="41">Stroboscopes</option>
                        <option data-option="6" value="42">Vidéo</option>
                        <option data-option="7" value="43">Casques</option>
                        <option data-option="7" value="44">Cellules & Diamants</option>
                        <option data-option="7" value="45">Effets DJ</option>
                        <option data-option="7" value="46">Groove stations & Samplers</option>
                        <option data-option="7" value="47">Karaoké</option>
                        <option data-option="7" value="48">Mixeurs numériques</option>
                        <option data-option="7" value="49">Platines CD</option>
                        <option data-option="7" value="50">Tables de mixage DJ</option>
                        <option data-option="7" value="51">Platines vinyles</option>
                        <option data-option="8" value="52">Batteries & Percussions</option>
                        <option data-option="8" value="53">DJ</option>
                        <option data-option="8" value="54">Éléments rackables</option>
                        <option data-option="8" value="55">Pièces détachées</option>
                        <option data-option="8" value="56">Lumières</option>
                        <option data-option="8" value="57">Sono</option>
                        <option data-option="9" value="58">Accessoires Guitares</option>
                        <option data-option="9" value="59">Accessoires Batteries</option>
                        <option data-option="9" value="60">Accessoires Claviers</option>
                        <option data-option="9" value="61">Accessoires Sonorisation</option>
                        <option data-option="9" value="62">Accessoires Éclairage</option>
                        <option data-option="9" value="63">Accessoires DJ</option>
                    </select>
                </section>
                <br>

                <!-- Champs 8 Le Stock Actuel -->
                <section class="input-group input-group-lg">
                    <section class="input-group-prepend">
                        <span class="input-group-text champs">Stock Quantité*</span>
                    </section>
                    <input type="text" class="form-control" id="stock_qt" name="stock_qt" value="100" required>
                </section>
                <br>

                <!-- Champs 9 Le Stock d'Alerte -->
                <section class="input-group input-group-lg">
                    <section class="input-group-prepend">
                        <span class="input-group-text champs">Stock Alerte*</span>
                    </section>
                    <input type="text" class="form-control" id="stock_al" name="stock_al" value="15" required>
                </section>
                <br>

                <!-- Champs 10 Les Boutons Envoyer/Annuler -->
                <input type="submit" class="btn-lg btn-success" id="envoie" NAME="Envoyer" VALUE=" Envoyer">
                <input type="reset" class="btn-lg btn-warning" NAME="Annuler" VALUE=" Annuler">
            </fieldset>
        </FORM>
    </div>
    <br>
    </section>
    <?php
    include("Ext_script.php");
    ?>
</body>

</html>