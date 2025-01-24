const avatar = document.getElementById("avatar");
const p_provile = document.getElementById("p_provile");

avatar.addEventListener("change", () => {
	const file = avatar.files[0];
	if (file) {
		const reader = new FileReader();

		reader.onload = (e) => {
			p_provile.src = e.target.result;
		};

		reader.readAsDataURL(file);
	} else {
		p_provile.src = "";
	}
});
