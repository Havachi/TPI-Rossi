<div class="register">
  <div class="register-container">
    <form class="register-form" action="index.php?action=register" method="post">
      <div class="register-form-tab">
        <div class="tab-label">
          <h2>Créer un compte</h2>
        </div>
        <div class="register-form-tab-inputGroup">
          <label for="emailAddress">Adresse E-mail</label>
          <input class="register-form-inputGroup-item" type="text" name="userEmailAddress">
        </div>
        <div class="register-form-tab-inputGroup">
          <label for="password">Mot de passe</label>
          <input class="register-form-inputGroup-item" type="password" name="userPassword">
        </div>
      </div>
      <div class="register-form-tab">
        <div class="tab-label">
          <h2>Information personnelles</h2>
        </div>
        <div class="register-form-tab-inputGroup">
          <label for="lastName">Nom de famille</label>
          <input class="register-form-inputGroup-item" type="text" name="userLastName">
        </div>
        <div class="register-form-tab-inputGroup">
          <label for="firstName">Prénom</label>
          <input class="register-form-inputGroup-item" type="text" name="userFirstName">
        </div>
        <div class="register-form-tab-inputGroup">
          <label for="phoneNumber">N° de téléphone</label>
          <input class="register-form-inputGroup-item" type="tel" name="userPhoneNumber">
        </div>
      </div>
      <div class="register-form-tab">
        <div class="tab-label">
          <h2>Adresse postale</h2>
        </div>
        <div class="register-form-tab-inputGroup">
          <label for="addressRoad">Rue</label>
          <input class="register-form-inputGroup-item" type="text" name="userAddressRoad">
        </div>
        <div class="register-form-tab-inputGroup">
          <label for="addressRoadNumber">N°</label>
          <input class="register-form-inputGroup-item" type="number" name="userAddressRoadNumber">
        </div>
        <div class="register-form-tab-inputGroup">
          <label for="addressPostalCode">Code Postal</label>
          <input class="register-form-inputGroup-item" type="text" name="userAddressPostalCode">
        </div>
      </div>

      <div class="register-form-btns">
        <button class="btn btn-back" id="prevBtn" type="button" onclick="nextPrev(-1)">Retour</button>
        <button class="btn btn-next" id="nextBtn" type="button" onclick="nextPrev(1)">Suivant</button>
        <button class="btn btn-primary" id="submitBtn" name="action" value="register" type="submit" href="index.php?action=Register">Créer un compte</button>
      </div>

      <div class="register-form-progress">
        <span class="step"></span>
        <span class="step"></span>
        <span class="step"></span>
      </div>

      <div class="register-form-links" id="regLink">
        <div class="linkToLogin"><u>Déjà inscrit ?<wbr></u> <a href="index.php?action=login">Se connecter</a></div>
      </div>
    </form>
  </div>
</div>
