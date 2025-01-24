function generateDescriptions(maxRange) {
	const descriptions = [
		["Sangat Mudah", "Mudah", "Sedang", "Sulit", "Sangat Sulit"],
		[
			"Sangat Tidak Penting",
			"Tidak Penting",
			"Cukup Penting",
			"Penting",
			"Sangat Penting",
		],
		["Sangat Jarang", "Jarang", "Cukup Sering", "Sering", "Sangat Sering"],
	];

	const scaledDescriptions = [];

	for (let i = 0; i < descriptions.length; i++) {
		const scaled = [];
		for (let j = 0; j < maxRange; j++) {
			const index = Math.floor((j / maxRange) * 5);
			scaled.push(descriptions[i][index]);
		}
		scaledDescriptions.push(scaled);
	}

	return scaledDescriptions;
}

function showRangeForms() {
	const range = document.getElementById("range_skala");
	const item_range = document.getElementById("item-range");
	var skalaD = document.getElementById("skala_d");
	var skalaI = document.getElementById("skala_i");
	var skalaF = document.getElementById("skala_f");

	skalaD.innerHTML = "";
	skalaI.innerHTML = "";
	skalaF.innerHTML = "";

	const rangeValue = parseInt(range.value);
	const descriptions = generateDescriptions(rangeValue);

	if (rangeValue === 5) {
		alert("Nilai range sama dengan nilai default!");
	} else if (rangeValue > 0 && rangeValue !== 5) {
		item_range.classList.remove("d-none");
	} else {
		item_range.classList.add("d-none");
	}

	for (let i = 1; i <= rangeValue; i++) {
		const kesulitanDescription = descriptions[0][i - 1];
		const kepentinganDescription = descriptions[1][i - 1];
		const keseringanDescription = descriptions[2][i - 1];

		var inputD = document.createElement("input");
		inputD.type = "text";
		inputD.name = "skala_d[]";
		inputD.id = "skala_d_" + i;
		inputD.className = "form-control mb-3";
		inputD.value = kesulitanDescription;
		inputD.required = true;
		skalaD.appendChild(inputD);

		var labelD = document.createElement("label");
		labelD.setAttribute("for", "skala_d[]");
		labelD.innerText = "Tingkat Kesulitan " + i;
		labelD.style.fontSize = "12px";
		skalaD.insertBefore(labelD, inputD);

		var inputI = document.createElement("input");
		inputI.type = "text";
		inputI.name = "skala_i[]";
		inputI.id = "skala_i_" + i;
		inputI.className = "form-control mb-3";
		inputI.value = kepentinganDescription;
		inputI.required = true;
		skalaI.appendChild(inputI);

		var labelI = document.createElement("label");
		labelI.setAttribute("for", "skala_i[]");
		labelI.innerText = "Tingkat Kepentingan " + i;
		labelI.style.fontSize = "12px";
		skalaI.insertBefore(labelI, inputI);

		var inputF = document.createElement("input");
		inputF.type = "text";
		inputF.name = "skala_f[]";
		inputF.id = "skala_f_" + i;
		inputF.className = "form-control mb-3";
		inputF.value = keseringanDescription;
		inputF.required = true;
		skalaF.appendChild(inputF);

		var labelF = document.createElement("label");
		labelF.setAttribute("for", "skala_f[]");
		labelF.innerText = "Tingkat Keseringan " + i;
		labelF.style.fontSize = "12px";
		skalaF.insertBefore(labelF, inputF);
	}
}

document
	.getElementById("range_skala")
	.addEventListener("input", showRangeForms);

showRangeForms();
