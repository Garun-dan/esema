document.getElementById("tot_jenjang").addEventListener("input", function () {
	const item_jenjang = document.getElementById("item-jenjang");
	var totJenjang = parseInt(this.value);
	item_jenjang.innerHTML = "";

	if (totJenjang > 0) {
		item_jenjang.classList.remove("d-none");
	} else {
		item_jenjang.classList.add("d-none");
	}

	var nilaiJenjang = [
		"Terampil",
		"Mahir",
		"Penyelia",
		"Ahli Pertama",
		"Ahli Muda",
		"Ahli Madya",
		"Ahli Utama",
	];

	for (var i = 1; i <= totJenjang; i++) {
		var selectJenjang = document.createElement("select");
		selectJenjang.name = "nama_jenjang[]";
		selectJenjang.id = "nama_jenjang_" + i;
		selectJenjang.className = "form-control mb-3";
		selectJenjang.required = true;

		for (var j = 0; j < nilaiJenjang.length; j++) {
			var option = document.createElement("option");
			option.value = nilaiJenjang[j];
			option.text = nilaiJenjang[j];
			selectJenjang.appendChild(option);
		}

		var optionLainnya = document.createElement("option");
		optionLainnya.value = "Tambah Lainnya";
		optionLainnya.text = "Tambah Lainnya";
		selectJenjang.appendChild(optionLainnya);

		selectJenjang.selectedIndex = i - 1;

		item_jenjang.appendChild(selectJenjang);

		selectJenjang.addEventListener("change", function () {
			if (this.value === "Tambah Lainnya") {
				var inputBaru = document.createElement("input");
				inputBaru.type = "text";
				inputBaru.name = "nama_jenjang_new[]";
				inputBaru.className = "form-control mb-3";
				inputBaru.placeholder = "Masukkan jenjang baru";
				inputBaru.required = true;
				this.parentNode.appendChild(inputBaru);
			}
		});

		var labelJenjang = document.createElement("label");
		labelJenjang.setAttribute("for", "nama_jenjang_" + i);
		labelJenjang.innerText = "Pilih Jenjang " + i;
		item_jenjang.insertBefore(labelJenjang, selectJenjang);
	}
});
