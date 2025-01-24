function getJenjang() {
	var jabfungId = document.getElementById("jabfung").value;
	var xhr = new XMLHttpRequest();
	xhr.open("GET", urlGetJenjang + jabfungId, true);
	xhr.onload = function () {
		if (xhr.status === 200) {
			var options = JSON.parse(xhr.responseText);
			var jenjangSelect = document.getElementById("jenjang");
			jenjangSelect.innerHTML = "";
			var defaultOption = document.createElement("option");
			defaultOption.textContent = "Pilih Jenjang Jabatan";
			jenjangSelect.appendChild(defaultOption);

			var allOption = document.createElement("option");
			allOption.value = "all";
			allOption.textContent = "All";
			jenjangSelect.appendChild(allOption);
			options.forEach(function (option) {
				var optionElement = document.createElement("option");
				optionElement.value = option.id_jenjang;
				optionElement.textContent = option.nama_jenjang;
				jenjangSelect.appendChild(optionElement);
			});
		} else {
			console.error("Permintaan Gagal Diproses");
		}
	};
	xhr.send();
}

const dataJenjang = document.getElementById("jenjang");
const viewdataAllJenjang = document.getElementById("viewdataAllJenjang");
dataJenjang.addEventListener("change", function () {
	const jenjangValue = dataJenjang.value;
	if (jenjangValue === "all") {
		viewdataAllJenjang.classList.remove("d-none");
		const jabfungId = document.getElementById("jabfung").value;
		const xhr = new XMLHttpRequest();
		xhr.open("GET", urlGetJenjang + jabfungId, true);
		xhr.onload = function () {
			if (xhr.status === 200) {
				const itemData = JSON.parse(xhr.responseText);
				const allJenjang = document.getElementById("allJenjang");
				allJenjang.innerHTML = "";
				for (let i = 0; i < itemData.length; i++) {
					const divAllgroup = document.createElement("div");
					divAllgroup.className = "form-group mb-3";

					const divFlex = document.createElement("div");
					divFlex.className =
						"d-flex align-items-center justify-content-between";

					const inputAllJenjang = document.createElement("input");
					inputAllJenjang.type = "text";
					inputAllJenjang.id = "all_jenjang_" + i;
					inputAllJenjang.name = "all_jenjang[]";
					inputAllJenjang.className = "form-control";
					inputAllJenjang.value = itemData[i].nama_jenjang;
					inputAllJenjang.readOnly = true;
					divFlex.appendChild(inputAllJenjang);

					if (dataRumah && dataRumah.length > 0) {
						const button = document.createElement("button");
						button.type = "button";
						button.className = "tbl-primer align-self-center";
						button.textContent = "Data";
						button.setAttribute("data-bs-toggle", "collapse");
						button.setAttribute("data-bs-target", "#" + itemData[i].id_jenjang);
						divFlex.appendChild(button);
					}

					divAllgroup.appendChild(divFlex);
					allJenjang.appendChild(divAllgroup);
				}

				const tblPrimerButtons = document.querySelectorAll(".tbl-primer");
				tblPrimerButtons.forEach(function (button) {
					button.addEventListener("click", function () {
						const jenjangId = this.getAttribute("data-bs-target");
						showDataRumah(jenjangId);
					});
				});
			} else {
				console.error("Permintaan Gagal Dipenuhi");
			}
		};
		xhr.onerror = function () {
			console.error("Kesalahan Jaringan");
		};
		xhr.send();
	} else {
		viewdataAllJenjang.classList.remove("d-none");
		const oneJenjang = cekJenjang.find(
			(item) => item.id_jenjang === jenjangValue
		);
		const allJenjang = document.getElementById("allJenjang");
		allJenjang.innerHTML = "";
		const divFormGroup = document.createElement("div");
		divFormGroup.className = "form-group mb-3";

		const div = document.createElement("div");
		div.className = "d-flex align-items-center justify-content-between";

		const inputOneElement = document.createElement("input");
		inputOneElement.type = "text";
		inputOneElement.id = "all_jenjang";
		inputOneElement.name = "all_jenjang";
		inputOneElement.className = "form-control mr-2";
		inputOneElement.value = oneJenjang ? oneJenjang.nama_jenjang : "";
		inputOneElement.readOnly = true;
		div.appendChild(inputOneElement);

		if (dataRumah && dataRumah.length > 0) {
			const button = document.createElement("button");
			button.type = "button";
			button.className = "tbl-primer align-self-center";
			button.textContent = "Data";
			button.setAttribute("data-bs-toggle", "collapse");
			button.setAttribute("data-bs-target", "#" + jenjangValue);
			div.appendChild(button);
		}

		divFormGroup.appendChild(div);
		allJenjang.appendChild(divFormGroup);

		const tblPrimerButtons = document.querySelectorAll(".tbl-primer");
		tblPrimerButtons.forEach(function (button) {
			button.addEventListener("click", function () {
				const jenjangId = this.getAttribute("data-bs-target");
				showDataRumah(jenjangId);
			});
		});
	}
});

function showDataRumah(jenjangId) {
	const allCollapses = document.querySelectorAll(".collapse.show");
	allCollapses.forEach(function (collapse) {
		collapse.classList.remove("show");
	});
	const selectedCollapse = document.querySelector(jenjangId);
	if (selectedCollapse) {
		const activeCollapse = document.querySelector(".collapse.show");
		if (activeCollapse && activeCollapse !== selectedCollapse) {
			$(activeCollapse).collapse("hide");
		}
		selectedCollapse.classList.add("show");
	}
}

const checkAllCheckbox = document.getElementById("checkAll");
const checkboxes = document.querySelectorAll(".checkbox-item");
checkAllCheckbox.addEventListener("change", function () {
	checkboxes.forEach(function (checkbox) {
		checkbox.checked = checkAllCheckbox.checked;
	});
});

checkboxes.forEach(function (checkbox) {
	checkbox.addEventListener("change", function () {
		const allChecked = [...checkboxes].every((checkbox) => checkbox.checked);
		checkAllCheckbox.checked = allChecked;
	});
});

tinymce.init({
	selector: "textarea",
	plugins:
		"anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount",
	toolbar:
		"undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat",
});

$(document).ready(function () {
	function toggleTableHeader(show) {
		if (show) {
			$(".display thead").show();
		} else {
			$(".display thead").hide();
		}
	}

	toggleTableHeader(false);

	$(".tambahdataTNA").submit(function (event) {
		event.preventDefault();
		var formData = new FormData(this);

		$.ajax({
			url: $(this).attr("action"),
			type: $(this).attr("method"),
			data: formData,
			contentType: false,
			processData: false,
			success: function (response) {
				$("#itemData").addClass("d-none");
				$("#itemKet").removeClass("d-none");
				toggleTableHeader(false);
			},
			error: function (xhr, status, error) {
				console.error("Terjadi kesalahan saat menyimpan data:", error);
			},
		});
	});

	var tableInstance;

	$("#rumahJabatan").on("shown.bs.collapse", function () {
		toggleTableHeader(true);
		var activeTable = $(this).find(
			'.accordion-body table[id^="tabelInstrumen"]'
		);

		if (activeTable.length && activeTable.find("tbody tr").length) {
			var theadColumns = activeTable.find("thead th");
			var tbodyColumns = activeTable.find("tbody tr:first td");

			theadColumns.each(function (index) {
				$(this).css("width", $(tbodyColumns[index]).width() + "px");
			});

			if (tableInstance) {
				tableInstance.columns.adjust().draw();
			} else {
				tableInstance = activeTable.DataTable({
					fixedHeader: true,
					paging: false,
					scrollY: 300,
				});
			}
		}
	});
});
