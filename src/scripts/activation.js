// Functions

function activatePasswordChange() {
	passDiv.innerHTML = passwordForm;
}

function activateLoginChange() {
	loginDiv.innerHTML = loginForm;
}

function activateEmailChange() {
	emailDiv.innerHTML = emailForm;
}

// Variables
const loginActivation = document.querySelector('#activate-login');
const passwordActivation = document.querySelector('#activate-password');
const emailActivation = document.querySelector('#activate-email');
const loginDiv = document.querySelector('#nick-holder');
const passDiv = document.querySelector('#pass-holder');
const emailDiv = document.querySelector('#email-holder');

const loginForm = `<form id="login-change" method = "post" action="changeLogin.php">
<div class="place-holder">
  <label for="nick" class="labels">Nick: </label>
  <input required type="text" class="inputs" name="nick">
</div>
<div class="place-holder">
<button type="submit" name="submit" class="buttons" >Zmień login</button>
</div>
</form>`;

const passwordForm = `<form id="password-change" method = "post" action="changePassword.php">
<div class="place-holder">
  <label for="password" class="labels">Hasło: </label>
  <input required type="password" class="inputs" name="password">
</div>
<div class="place-holder">
<button type="submit" name="submit" class="buttons" >Zmień hasło</button>
</div>
</form>`;

const emailForm = `<form id="email-change" method = "post" action="changeEmail.php">
<div class="place-holder">
  <label for="email" class="labels">Email: </label>
  <input required type="email" class="inputs" name="email">
</div>
<div class="place-holder">
<button type="submit" name="submit" class="buttons" >Zmień email</button>
</div>
</form>`;

loginActivation.addEventListener('click', activateLoginChange);

passwordActivation.addEventListener('click', activatePasswordChange);

emailActivation.addEventListener('click', activateEmailChange);
