const menuIcon = document.querySelector('#menu-icon');

const menuLines = menuIcon.querySelectorAll('.line');

const navigation = document.querySelector('#navigation');

function activateMenu() {
	navigation.classList.toggle('active');

	menuLines.forEach((menuLines) => {
		menuLines.classList.toggle('active');
	});
}

menuIcon.addEventListener('click', activateMenu);
