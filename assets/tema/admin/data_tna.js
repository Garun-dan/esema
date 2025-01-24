dataJenjang.addEventListener("change", function () {
	var idValue = this.value;

	if (idValue === "all") {
		viewdataAllJenjang.classList.remove("d-none");
		var jabfungId = document.getElementById("jabfung").value;
		var xhr = new XMLHttpRequest();
		xhr.open("GET", urlGetJenjang + jabfungId, true);
		xhr.onload = function () {
			if (xhr.status === 200) {
				var options = JSON.parse(xhr.responseText);

				var allJenjang = document.getElementById("allJenjang");
				allJenjang.innerHTML = "";

				for (var i = 0; i < options.length; i++) {
					var divFormGroup = document.createElement("div");
					divFormGroup.className = "form-group mb-3";

					var div = document.createElement("div");
					div.className = "d-flex align-items-center justify-content-between";

					var inputAllElement = document.createElement("input");
					inputAllElement.type = "text";
					inputAllElement.id = "all_jenjang_" + i;
					inputAllElement.name = "all_jenjang[]";
					inputAllElement.className = "form-control mr-2";
					inputAllElement.value = options[i].nama_jenjang;
					inputAllElement.readOnly = true;
					div.appendChild(inputAllElement);

					if (dataRumah && dataRumah.length > 0) {
						var button = document.createElement("button");
						button.type = "button";
						button.className = "tbl-primer align-self-center";
						button.textContent = "Data";
						button.setAttribute("data-target", options[i].id_jenjang);
						div.appendChild(button);
					}

					divFormGroup.appendChild(div);
					allJenjang.appendChild(divFormGroup);
				}

				var buttons = document.querySelectorAll(".tbl-primer");
				buttons.forEach(function (button) {
					button.addEventListener("click", function () {
						var jenjangId = this.getAttribute("data-target");
						showDataRumah(jenjangId);
					});
				});
			} else {
				console.error("Permintaan gagal. Status: " + xhr.status);
			}
		};
		xhr.send();
	} else {
		viewdataAllJenjang.classList.remove("d-none");

		var oneJenjang = cekJenjang.find((item) => item.id_jenjang === idValue);

		var allJenjang = document.getElementById("allJenjang");
		allJenjang.innerHTML = "";
		var divFormGroup = document.createElement("div");
		divFormGroup.className = "form-group mb-3";

		var div = document.createElement("div");
		div.className = "d-flex align-items-center justify-content-between";

		var inputOneElement = document.createElement("input");
		inputOneElement.type = "text";
		inputOneElement.id = "all_jenjang";
		inputOneElement.name = "all_jenjang";
		inputOneElement.className = "form-control mr-2";
		inputOneElement.value = oneJenjang ? oneJenjang.nama_jenjang : "";
		inputOneElement.readOnly = true;
		div.appendChild(inputOneElement);

		if (dataRumah && dataRumah.length > 0) {
			var button = document.createElement("button");
			button.type = "button";
			button.className = "tbl-primer align-self-center";
			button.textContent = "Data";
			button.setAttribute("data-target", idValue);
			div.appendChild(button);
		}

		divFormGroup.appendChild(div);
		allJenjang.appendChild(divFormGroup);

		var buttons = document.querySelectorAll(".tbl-primer");
		buttons.forEach(function (button) {
			button.addEventListener("click", function () {
				var jenjangId = this.getAttribute("data-target");
				showDataRumah(jenjangId);
			});
		});
	}
});

function showDataRumah(jenjangId) {
	var allSetdata = document.getElementById("allSetdata");
	allSetdata.innerHTML = "";
	if (dataRumah && dataRumah.length > 0) {
		for (var i = 0; i < dataRumah.length; i++) {
			var checkItem = document.createElement("div");
			checkItem.className = "form-check";

			var inputCheck = document.createElement("input");
			inputCheck.className = "form-check-input";
			inputCheck.type = "checkbox";
			inputCheck.value = dataRumah[i].id_rumah;
			inputCheck.id = "id_rumah_" + i;
			inputCheck.name = "id_rumah[]";
			checkItem.appendChild(inputCheck);

			var labelInput = document.createElement("label");
			labelInput.className = "form-check-label";
			labelInput.setAttribute("for", "id_rumah_" + i);
			labelInput.textContent = dataRumah[i].nama_rumah;
			checkItem.appendChild(labelInput);

			var button = document.createElement("button");
			button.type = "button";
			button.className = "btn btn-primary btn-sm ml-2";
			button.textContent = "Pilih";
			button.style.display = "none";
			button.setAttribute("data-bs-toggle", "collapse");
			button.setAttribute(
				"data-bs-target",
				"#rumahView_" + jenjangId + "_" + dataRumah[i].id_rumah
			);
			checkItem.appendChild(button);

			inputCheck.addEventListener("change", function () {
				var button = this.parentNode.querySelector("button");
				if (this.checked) {
					button.style.display = "inline-block";
				} else {
					button.style.display = "none";
				}
			});

			allSetdata.appendChild(checkItem);
		}
	} else {
		allSetdata.textContent = "Tidak ada data rumah untuk ditampilkan";
	}
}
