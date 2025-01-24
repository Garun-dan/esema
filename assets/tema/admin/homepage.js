function viewOpen(event, idMenu) {
	var i, menuview, tabhomemenu;

	menuview = document.getElementsByClassName("menuview");

	for (i = 0; i < menuview.length; i++) {
		menuview[i].style.display = "none";
	}

	tabhomemenu = document.getElementsByClassName("tabhomemenu");
	for (i = 0; i < tabhomemenu.length; i++) {
		tabhomemenu[i].classList.remove("chart-aktif");
	}

	document.getElementById(idMenu).style.display = "block";
	event.currentTarget.classList.add("chart-aktif");
}

document.addEventListener("DOMContentLoaded", function () {
	var tabhomemenu = document.getElementsByClassName("tabhomemenu");
	var smallestId = tabhomemenu[0].dataset.idMenu;
	var firsttabhomemenu = tabhomemenu[0];
	for (var i = 1; i < tabhomemenu.length; i++) {
		var currentId = tabhomemenu[i].dataset.idMenu;
		if (currentId < smallestId) {
			smallestId = currentId;
			firsttabhomemenu = tabhomemenu[i];
		}
	}

	viewOpen(
		{
			currentTarget: firsttabhomemenu,
		},
		smallestId
	);
});

const judul_h1 = document.getElementById("judul_h1");
const v_h1 = document.getElementById("v_h1");
const judul_h3 = document.getElementById("judul_h3");
const v_h3 = document.getElementById("v_h3");
const ket = document.getElementById("ket");
const v_ket = document.getElementById("v_ket");
const bc = document.getElementById("background");
const v_bc = document.getElementById("v_bc");

judul_h1.addEventListener("input", function () {
	v_h1.classList.remove("d-none");
	v_h1.innerHTML = "";
	var viewH1 = document.createElement("h1");
	var inputH1 = judul_h1.value.trim();
	var wordsh1 = inputH1.split(" ");
	if (wordsh1.length > 2) {
		var firstLine = wordsh1.slice(0, 2).join(" ");
		var secondLine = wordsh1.slice(2).join(" ");
		viewH1.innerHTML = firstLine + "<br>" + secondLine;
	} else {
		viewH1.textContent = inputH1;
	}
	viewH1.style.fontSize = "32px";
	v_h1.appendChild(viewH1);
});

judul_h3.addEventListener("input", function () {
	v_h3.classList.remove("d-none");
	v_h3.innerHTML = "";
	var viewH3 = document.createElement("h3");
	var inputH3 = judul_h3.value.trim();
	var wordsh3 = inputH3.split(" ");
	if (wordsh3.length > 3) {
		var firstLine = wordsh3.slice(0, 2).join(" ");
		var secondLine = wordsh3.slice(2).join(" ");
		viewH3.innerHTML = firstLine + "<br>" + secondLine;
	} else {
		viewH3.textContent = inputH3;
	}

	viewH3.style.fontSize = "22px";
	v_h3.appendChild(viewH3);
});

ket.addEventListener("input", function () {
	v_ket.classList.remove("d-none");
	v_ket.innerHTML = "";
	var viewKet = document.createElement("p");
	viewKet.textContent = ket.value;
	viewKet.style.fontSize = "10px";
	v_ket.appendChild(viewKet);
});

bc.addEventListener("change", () => {
	const file = bc.files[0];
	if (file) {
		const reader = new FileReader();

		reader.onload = (e) => {
			v_bc.src = e.target.result;
		};

		reader.readAsDataURL(file);
	} else {
		v_bc.src = "";
	}
});
