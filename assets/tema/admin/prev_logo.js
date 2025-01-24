const logo_input = document.getElementById("logo");
const favicon = document.getElementById("favication");
const p_logo = document.getElementById("p_logo");
const p_fav = document.getElementById("p_fav");

logo_input.addEventListener("change", () => {
	const file = logo_input.files[0];
	if (file) {
		const reader = new FileReader();

		reader.onload = (e) => {
			p_logo.src = e.target.result;
		};

		reader.readAsDataURL(file);
	} else {
		p_logo.src = "";
	}
});

favicon.addEventListener("change", () => {
	const file = favicon.files[0];
	if (file) {
		const reader = new FileReader();

		reader.onload = (e) => {
			p_fav.src = e.target.result;
		};

		reader.readAsDataURL(file);
	} else {
		p_fav.src = "";
	}
});
