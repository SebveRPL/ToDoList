//Variables
const deleteButton = document.querySelector('#delete-account');
const cancelButton = document.querySelector('#cancel-button');
const deleteDiv = document.querySelector('#delete-section');

//Functions
function showDeletePanel() {
	deleteDiv.classList.add('active');
}

function hideDeletePanel() {
	deleteDiv.classList.remove('active');
}

//Functions Activation

deleteButton.addEventListener('click', showDeletePanel);

cancelButton.addEventListener('click', hideDeletePanel);
