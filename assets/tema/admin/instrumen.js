document.addEventListener("DOMContentLoaded", function () {
	const butir_jenjang = document.querySelector("#butir-jenjang");

	hot = new Handsontable(butir_jenjang, {
		data: [[""], [""], [""], [""], [""], [""], [""], [""], [""], [""]],
		rowHeaders: true,
		colHeaders: ["Butir Kegiatan"],
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
			const instrumen = row[0];

			postData.push({
				instrumen,
			});
		});

		if (postData.length > 0) {
			const hiddenInput = document.createElement("input");
			hiddenInput.type = "hidden";
			hiddenInput.name = "instrumen";
			hiddenInput.value = JSON.stringify(postData);
			const form = document.getElementById("formInstrumen");
			form.appendChild(hiddenInput);

			form.submit();
		} else {
			alert("Tidak ada data yang valid untuk disimpan.");
		}
	}
});

// function openView(event, idJenjang) {
// 	var i, tabview, tabmenu;

// 	tabview = document.getElementsByClassName("tabview");

// 	for (i = 0; i < tabview.length; i++) {
// 		tabview[i].style.display = "none";
// 	}

// 	tabmenu = document.getElementsByClassName("tabmenu");
// 	for (i = 0; i < tabmenu.length; i++) {
// 		tabmenu[i].classList.remove("chart-aktif");
// 	}

// 	document.getElementById(idJenjang).style.display = "block";
// 	event.currentTarget.classList.add("chart-aktif");
// }

// document.addEventListener("DOMContentLoaded", function () {
// 	var tabmenu = document.getElementsByClassName("tabmenu");
// 	var smallestId = tabmenu[0].dataset.idJenjang;
// 	var firstTabmenu = tabmenu[0];
// 	for (var i = 1; i < tabmenu.length; i++) {
// 		var currentId = tabmenu[i].dataset.idJenjang;
// 		if (currentId < smallestId) {
// 			smallestId = currentId;
// 			firstTabmenu = tabmenu[i];
// 		}
// 	}

// 	openView(
// 		{
// 			currentTarget: firstTabmenu,
// 		},
// 		smallestId
// 	);
// });
