const tipe_data = document.getElementById("tipe_data");
const view_tipe = document.getElementById("view-tipe");

tipe_data.addEventListener("change", function () {
	var valueTipe = tipe_data.value;

	view_tipe.innerHTML = "";

	view_tipe.classList.remove("d-none");

	if (valueTipe === "api") {
		const inputElement = document.createElement("input");
		inputElement.type = "text";
		inputElement.name = "data_api";
		inputElement.id = "data_api";
		inputElement.className = "form-control mb-3";
		inputElement.required = true;
		view_tipe.appendChild(inputElement);

		var labelApi = document.createElement("label");
		labelApi.setAttribute("for", "data_api");
		labelApi.innerText = "URL API";
		view_tipe.insertBefore(labelApi, inputElement);

		const simpanButton = document.getElementById("simpanButton");
		simpanButton.addEventListener("click", function (event) {
			if (inputElement.value.trim() === "") {
				event.preventDefault();
				alert("URL API harus diisi");
			}
		});
	} else {
		hot = new Handsontable(view_tipe, {
			data: [
				["", "", ""],
				["", "", ""],
				["", "", ""],
				["", "", ""],
				["", "", ""],
				["", "", ""],
				["", "", ""],
				["", "", ""],
				["", "", ""],
				["", "", ""],
			],
			rowHeaders: true,
			colHeaders: ["Nama", "NIK", "No WhatsApp"],
			width: "100%",
			height: "auto",
			autoWrapRow: true,
			autoWrapCol: true,
			licenseKey: "non-commercial-and-evaluation",
		});

		const simpanButton = document.getElementById("simpanButton");
		simpanButton.addEventListener("click", function (event) {
			submitInstrumen(event);
		});

		function submitInstrumen(event) {
			event.preventDefault();
			const hotData = hot.getData();
			const postData = [];

			hotData.forEach((row) => {
				const nama = row[0];
				const nik = row[1];
				const whatsapp = row[2];
				const role = row[3];

				postData.push({
					nama,
					nik,
					whatsapp,
				});
			});

			if (postData.length > 0) {
				const hiddenInput = document.createElement("input");
				hiddenInput.type = "hidden";
				hiddenInput.name = "data_manual";
				hiddenInput.value = JSON.stringify(postData);
				const form = document.getElementById("formUser");
				form.appendChild(hiddenInput);

				form.submit();
			} else {
				alert("Tidak ada data yang valid untuk disimpan.");
			}
		}
	}
});
