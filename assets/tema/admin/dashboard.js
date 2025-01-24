// Chart Doughnut
document.addEventListener("DOMContentLoaded", function () {
	var nakesCanvas = document.getElementById("totalNakes").getContext("2d");
	var respondenCanvas = document
		.getElementById("totalResponden")
		.getContext("2d");
	var pelatihanCanvas = document
		.getElementById("totalPelatihan")
		.getContext("2d");
	var seminarCanvas = document.getElementById("totalSeminar").getContext("2d");
	// var workshopCanvas = document
	// 	.getElementById("totalWorkshop")
	// 	.getContext("2d");

	var nakesChart, respondenChart, pelatihanChart, seminarChart;

	function setCanvasSize() {
		var screenSize = window.innerWidth;
		var canvases = [
			nakesCanvas,
			respondenCanvas,
			pelatihanCanvas,
			seminarCanvas,
			// workshopCanvas,
		];

		if (screenSize <= 540) {
			canvases.forEach(function (canvas) {
				canvas.canvas.width = 50;
				canvas.canvas.height = 50;
			});
		} else {
			canvases.forEach(function (canvas) {
				canvas.canvas.width = 100;
				canvas.canvas.height = 100;
			});
		}

		var cutoutValue = screenSize <= 540 ? 10 : 30;
		var doughnutOptions = {
			cutout: cutoutValue,
			responsive: false,
		};

		if (nakesChart) nakesChart.destroy();
		if (respondenChart) respondenChart.destroy();
		if (pelatihanChart) pelatihanChart.destroy();
		if (seminarChart) seminarChart.destroy();
		// if (workshopChart) workshopChart.destroy();

		nakesChart = new Chart(nakesCanvas, {
			type: "doughnut",
			data: {
				datasets: [
					{
						data: [pria, wanita],
						backgroundColor: ["#b330c0", "#3e4c7a"],
					},
				],
			},
			options: doughnutOptions,
		});

		respondenChart = new Chart(respondenCanvas, {
			type: "doughnut",
			data: {
				datasets: [
					{
						data: [priaRekom, wanitaRekom],
						backgroundColor: ["#b330c0", "#3e4c7a"],
					},
				],
			},
			options: doughnutOptions,
		});

		pelatihanChart = new Chart(pelatihanCanvas, {
			type: "doughnut",
			data: {
				datasets: [
					{
						data: [priaRekomPelatihan, wanitaRekomPelatihan],
						backgroundColor: ["#b330c0", "#3e4c7a"],
					},
				],
			},
			options: doughnutOptions,
		});

		seminarChart = new Chart(seminarCanvas, {
			type: "doughnut",
			data: {
				datasets: [
					{
						data: [priaRekomSeminar, wanitaRekomSeminar],
						backgroundColor: ["#b330c0", "#3e4c7a"],
					},
				],
			},
			options: doughnutOptions,
		});

		// workshopChart = new Chart(workshopCanvas, {
		// 	type: "doughnut",
		// 	data: {
		// 		datasets: [
		// 			{
		// 				data: [priaRekomWorkshop, wanitaRekomWorkshop],
		// 				backgroundColor: ["#b330c0", "#3e4c7a"],
		// 			},
		// 		],
		// 	},
		// 	options: doughnutOptions,
		// });
	}

	setCanvasSize();

	window.addEventListener("resize", setCanvasSize);
});

// Jabatan Fungsional
document.addEventListener("DOMContentLoaded", function () {
	const tahun = document.getElementById("tahun");
	const currentYear = new Date().getFullYear();
	for (let year = currentYear; year >= currentYear - 100; year--) {
		tahun.innerHTML += `<option value="${year}">${year}</option>`;
	}

	checkSelectedYear();

	function checkSelectedYear() {
		let selectedYear;
		if (!tahun.value) {
			selectedYear = new Date().getFullYear();
		} else {
			selectedYear = parseInt(tahun.value);
		}
		updateChart(selectedYear);
	}

	function getDataByYear(year, idJabfung = null) {
		return getRekom.filter(function (rekomendasi) {
			if (idJabfung !== null) {
				return (
					rekomendasi.id_jabfung == idJabfung &&
					new Date(rekomendasi.tgl_validasi).getFullYear() === year
				);
			} else {
				return new Date(rekomendasi.tgl_validasi).getFullYear() === year;
			}
		});
	}

	function updateChart(selectedYear) {
		const statistikCanvas = document
			.getElementById("barJabfung")
			.getContext("2d");
		let statistikJabfung = Chart.getChart(statistikCanvas);

		function setCanvasSize() {
			const screensize = window.innerWidth;
			if (screensize <= 540) {
				statistikCanvas.canvas.width = screensize;
				statistikCanvas.canvas.height = 300 * (screensize / 540);
			} else {
				statistikCanvas.canvas.width = 100;
				statistikCanvas.canvas.height = 100;
			}
		}
		setCanvasSize();

		if (statistikJabfung) {
			statistikJabfung.destroy();
		}

		const dataByYear = getDataByYear(
			selectedYear,
			getJabfung.map((item) => item.id_jabfung)
		);
		const jumlahPelatihan = dataByYear.filter(
			(rekomendasi) => rekomendasi.rekom === "Peningkatan Kompetensi"
		).length;
		const jumlahSeminar = dataByYear.filter(
			(rekomendasi) => rekomendasi.rekom === "Kompeten"
		).length;
		// const jumlahWorkshop = dataByYear.filter(
		// 	(rekomendasi) => rekomendasi.rekom === "Workshop"
		// ).length;

		statistikJabfung = new Chart(statistikCanvas, {
			type: "bar",
			data: {
				labels: getJabfung.map((item) => item.nama_jabfung),
				datasets: [
					{
						label: "Peningkatan Kompetensi",
						data: Array(getJabfung.length).fill(jumlahPelatihan),
						borderWidth: 1,
						backgroundColor: "#b330c0",
					},
					{
						label: "Kompeten",
						data: Array(getJabfung.length).fill(jumlahSeminar),
						borderWidth: 1,
						backgroundColor: "#3e4c7a",
					},
					// {
					// 	label: "Workshop",
					// 	data: Array(getJabfung.length).fill(jumlahWorkshop),
					// 	borderWidth: 1,
					// 	backgroundColor: "#566d24",
					// },
				],
			},
			options: {
				scales: {
					x: {
						align: "center",
					},
					y: {
						beginAtZero: true,
					},
				},
			},
		});

		window.addEventListener("resize", setCanvasSize);
	}

	tahun.addEventListener("change", function () {
		checkSelectedYear();
	});

	updateChart(currentYear);
});

// Jenjang Jabatan
document.addEventListener("DOMContentLoaded", function () {
	const tahunJenjang = document.getElementById("tahunJenjang");
	const listJabfung = document.getElementById("listJabfung");
	const currentYear = new Date().getFullYear();

	let currentJabfung = listJabfung.value;

	for (let year = currentYear; year >= currentYear - 100; year--) {
		tahunJenjang.innerHTML += `<option value="${year}">${year}</option>`;
	}

	tahunJenjang.addEventListener("change", cekTahunJenjang);
	listJabfung.addEventListener("change", cekTahunJenjang);

	function cekTahunJenjang() {
		let selectedYear = tahunJenjang.value;
		let selectedJabfung = listJabfung.value;

		diagramJenjang(selectedYear, selectedJabfung);
	}

	function getRekomendasiByYear(year, idJabfung, idJenjang) {
		return getRekom.filter(function (rekomendasi) {
			return (
				rekomendasi.id_jabfung == idJabfung &&
				rekomendasi.id_jenjang == idJenjang &&
				new Date(rekomendasi.tgl_validasi).getFullYear() === parseInt(year)
			);
		});
	}

	function diagramJenjang(selectedYear, selectedJabfung) {
		var dataJenjang = getJenjang.filter(function (jenjang) {
			return jenjang.id_jabfung === selectedJabfung;
		});

		var namaJenjang = [];
		var idJenjang = [];
		dataJenjang.forEach(function (jj) {
			idJenjang.push(jj.id_jenjang);
			namaJenjang.push(jj.nama_jenjang);
		});

		const jenjangCanvas = document
			.getElementById("barJenjang")
			.getContext("2d");
		let statistikJenjang = Chart.getChart(jenjangCanvas);

		function setCanvasSize() {
			const screensize = window.innerWidth;
			if (screensize <= 540) {
				jenjangCanvas.canvas.width = screensize;
				jenjangCanvas.canvas.height = 300 * (screensize / 540);
			} else {
				jenjangCanvas.canvas.width = 100;
				jenjangCanvas.canvas.height = 100;
			}
		}
		setCanvasSize();

		if (statistikJenjang) {
			statistikJenjang.destroy();
		}

		var jumlahPelatihan = [];
		var jumlahSeminar = [];
		var jumlahWorkshop = [];

		idJenjang.forEach(function (id) {
			var rekomendasiPelatihan = getRekomendasiByYear(
				selectedYear,
				selectedJabfung,
				id
			).filter(function (rekomendasi) {
				return rekomendasi.rekom === "Peningkatan Kompetensi";
			});
			jumlahPelatihan.push(rekomendasiPelatihan.length);

			var rekomendasiSeminar = getRekomendasiByYear(
				selectedYear,
				selectedJabfung,
				id
			).filter(function (rekomendasi) {
				return rekomendasi.rekom === "Kompeten";
			});
			jumlahSeminar.push(rekomendasiSeminar.length);

			// var rekomendasiWorkshop = getRekomendasiByYear(
			// 	selectedYear,
			// 	selectedJabfung,
			// 	id
			// ).filter(function (rekomendasi) {
			// 	return rekomendasi.rekom === "Workshop";
			// });
			// jumlahWorkshop.push(rekomendasiWorkshop.length);
		});

		statistikJenjang = new Chart(jenjangCanvas, {
			type: "bar",
			data: {
				labels: namaJenjang,
				datasets: [
					{
						label: "Peningkatan Kompetensi",
						data: jumlahPelatihan,
						borderWidth: 1,
						backgroundColor: "#b330c0",
					},
					{
						label: "Kompeten",
						data: jumlahSeminar,
						borderWidth: 1,
						backgroundColor: "#3e4c7a",
					},
					// {
					// 	label: "Workshop",
					// 	data: jumlahWorkshop,
					// 	borderWidth: 1,
					// 	backgroundColor: "#566d24",
					// },
				],
			},
			options: {
				scales: {
					x: {
						align: "center",
					},
					y: {
						beginAtZero: true,
					},
				},
			},
		});

		window.addEventListener("resize", setCanvasSize);
	}

	diagramJenjang(currentYear, currentJabfung);
});

// Rumah Jabatan
document.addEventListener("DOMContentLoaded", function () {
	const tahunRumah = document.getElementById("tahunRumah");
	const listDataJabfung = document.getElementById("listDataJabfung");
	const currentYear = new Date().getFullYear();
	let statistikRumah = null;

	for (let year = currentYear; year >= currentYear - 100; year--) {
		tahunRumah.innerHTML += `<option value="${year}">${year}</option>`;
	}

	tahunRumah.addEventListener("change", cektahunRumah);
	listDataJabfung.addEventListener("change", cektahunRumah);

	function cektahunRumah() {
		let selectedYear = tahunRumah.value;
		let selectedJabfung = listDataJabfung.value;

		var xhr = new XMLHttpRequest();
		xhr.open("GET", url + selectedJabfung, true);
		xhr.onload = function () {
			if (xhr.status === 200) {
				var options = JSON.parse(xhr.responseText);

				var jenjangSelect = document.getElementById("listJenjang");
				jenjangSelect.innerHTML = "";

				options.forEach(function (option) {
					var optionElement = document.createElement("option");
					optionElement.value = option.id_jenjang;
					optionElement.textContent = option.nama_jenjang;
					jenjangSelect.appendChild(optionElement);
				});

				jenjangSelect.value = options[0].id_jenjang;

				let selectedJenjang = jenjangSelect.value;

				if (statistikRumah) {
					statistikRumah.destroy();
				}

				jenjangSelect.addEventListener("change", function () {
					selectedJenjang = jenjangSelect.value;
					diagramRumah(selectedYear, selectedJabfung, selectedJenjang);
				});

				diagramRumah(selectedYear, selectedJabfung, selectedJenjang);
			} else {
				console.error("Permintaan gagal. Status: " + xhr.status);
			}
		};
		xhr.send();
	}

	function getRumahByYear(year, idJabfung, idJenjang, idRumah) {
		return getRekom.filter(function (rekomendasi) {
			return (
				rekomendasi.id_jabfung == idJabfung &&
				rekomendasi.id_jenjang == idJenjang &&
				rekomendasi.id_rumah == idRumah &&
				new Date(rekomendasi.tgl_validasi).getFullYear() === parseInt(year)
			);
		});
	}

	function diagramRumah(selectedYear, selectedJabfung, selectJenjang) {
		var namaRumah = [];
		var idRumah = [];
		getRumah.forEach(function (rj) {
			idRumah.push(rj.id_rumah);
			namaRumah.push(rj.nama_rumah);
		});

		const rumahCanvas = document.getElementById("barRumah").getContext("2d");
		if (statistikRumah) {
			statistikRumah.destroy();
		}
		statistikRumah = new Chart(rumahCanvas, {
			type: "bar",
			data: {
				labels: namaRumah,
				datasets: [
					{
						label: "Peningkatan Kompetensi",
						data: [],
						borderWidth: 1,
						backgroundColor: "#b330c0",
					},
					{
						label: "Kompeten",
						data: [],
						borderWidth: 1,
						backgroundColor: "#3e4c7a",
					},
					// {
					// 	label: "Workshop",
					// 	data: [],
					// 	borderWidth: 1,
					// 	backgroundColor: "#566d24",
					// },
				],
			},
			options: {
				scales: {
					x: {
						align: "center",
					},
					y: {
						beginAtZero: true,
					},
				},
			},
		});

		idRumah.forEach(function (id) {
			var rekomendasiPelatihan = getRumahByYear(
				selectedYear,
				selectedJabfung,
				selectJenjang,
				id
			).filter(function (rekomendasi) {
				return rekomendasi.rekom === "Peningkatan Kompetensi";
			});
			statistikRumah.data.datasets[0].data.push(rekomendasiPelatihan.length);

			var rekomendasiSeminar = getRumahByYear(
				selectedYear,
				selectedJabfung,
				selectJenjang,
				id
			).filter(function (rekomendasi) {
				return rekomendasi.rekom === "Kompeten";
			});
			statistikRumah.data.datasets[1].data.push(rekomendasiSeminar.length);

			// var rekomendasiWorkshop = getRumahByYear(
			// 	selectedYear,
			// 	selectedJabfung,
			// 	selectJenjang,
			// 	id
			// ).filter(function (rekomendasi) {
			// 	return rekomendasi.rekom === "Workshop";
			// });
			// statistikRumah.data.datasets[2].data.push(rekomendasiWorkshop.length);
		});

		statistikRumah.update();
	}

	cektahunRumah();
});

// Instrumen
// document.addEventListener("DOMContentLoaded", function () {
// 	const tahunInstrumen = document.getElementById("tahunInstrumen");
// 	const listItemsJabfung = document.getElementById("listItemsJabfung");
// 	const listItemsJenjang = document.getElementById("listItemsJenjang");
// 	const listItemsInstrumen = document.getElementById("listItemsInstrumen");
// 	const tahunNow = new Date().getFullYear();

// 	for (let tahun = tahunNow; tahun >= tahunNow - 100; tahun--) {
// 		tahunInstrumen.innerHTML += `<option value="${tahun}">${tahun}</option>`;
// 	}

// 	tahunInstrumen.addEventListener("change", function () {
// 		cektahunInstrumen();
// 	});
// 	listItemsJabfung.addEventListener("change", function () {
// 		cektahunInstrumen();
// 	});
// 	listItemsJenjang.addEventListener("change", function () {
// 		getListInstrumen();
// 	});
// 	listItemsInstrumen.addEventListener("change", function () {
// 		getStatistik();
// 	});

// 	function cektahunInstrumen() {
// 		let pilihJabfung = listItemsJabfung.value;
// 		var xhr = new XMLHttpRequest();
// 		xhr.open("GET", url + pilihJabfung, true);
// 		xhr.onload = function () {
// 			if (xhr.status === 200) {
// 				var options = JSON.parse(xhr.responseText);
// 				listItemsJenjang.innerHTML = "";

// 				options.forEach(function (option) {
// 					var elemetOption = document.createElement("option");
// 					elemetOption.value = option.id_jenjang;
// 					elemetOption.textContent = option.nama_jenjang;
// 					listItemsJenjang.appendChild(elemetOption);
// 				});

// 				if (options.length > 0) {
// 					listItemsJenjang.value = options[0].id_jenjang;
// 					getListInstrumen();
// 					getStatistik();
// 				}
// 			} else {
// 				console.error("Permintaan gagal. Status: " + xhr.status);
// 			}
// 		};
// 		xhr.send();
// 	}

// 	function getListInstrumen() {
// 		var pilihJenjang = listItemsJenjang.value;
// 		var listInstrumen = getInstrumen.filter(function (butir) {
// 			return butir.id_jenjang == pilihJenjang;
// 		});

// 		listItemsInstrumen.innerHTML = "";

// 		listInstrumen.forEach(function (items) {
// 			var butirElemen = document.createElement("option");
// 			butirElemen.value = items.id_instrumen;
// 			butirElemen.textContent = items.instrumen;
// 			listItemsInstrumen.appendChild(butirElemen);
// 		});

// 		if (listInstrumen.length > 0) {
// 			listItemsInstrumen.value = listInstrumen[0].id_instrumen;
// 		}
// 	}

// 	function getStatistik() {
// 		const pilihTahun = tahunInstrumen.value;
// 		const pilihJabfung = listItemsJabfung.value;
// 		const pilihJenjang = listItemsJenjang.value;
// 		const pilihInstrumen = listItemsInstrumen.value;

// 		getRumah.forEach(function (rumah) {
// 			var xhr = new XMLHttpRequest();
// 			xhr.open(
// 				"GET",
// 				urlInstrumen +
// 					pilihTahun +
// 					"/" +
// 					pilihJabfung +
// 					"/" +
// 					pilihJenjang +
// 					"/" +
// 					pilihInstrumen +
// 					"/" +
// 					rumah.id_rumah,
// 				true
// 			);
// 			xhr.onload = function () {
// 				if (xhr.status === 200) {
// 					const statistikData = JSON.parse(xhr.responseText);
// 					drawBarChart(rumah.id_rumah, statistikData);
// 				} else {
// 					console.error("Permintaan gagal. Status: " + xhr.status);
// 				}
// 			};
// 			xhr.send();
// 		});
// 	}

// 	function drawBarChart(rumahId, statistikData) {
// 		const canvasId = "barDIF" + rumahId;
// 		const canvas = document.getElementById(canvasId);
// 		const ctx = canvas.getContext("2d");

// 		const labels = ["Skor 1", "Skor 2", "Skor 3", "Skor 4", "Skor 5"];
// 		const data_d = statistikData.skor_d;
// 		const data_i = statistikData.skor_i;
// 		const data_f = statistikData.skor_f;

// 		new Chart(ctx, {
// 			type: "bar",
// 			data: {
// 				labels: labels,
// 				datasets: [
// 					{
// 						label: "Tingkat Kesulitan",
// 						data: data_d,
// 						backgroundColor: "rgba(255, 99, 132, 0.2)",
// 						borderColor: "rgba(255, 99, 132, 1)",
// 						borderWidth: 1,
// 					},
// 					{
// 						label: "Tingkat Kepentingan",
// 						data: data_i,
// 						backgroundColor: "rgba(54, 162, 235, 0.2)",
// 						borderColor: "rgba(54, 162, 235, 1)",
// 						borderWidth: 1,
// 					},
// 					{
// 						label: "Tingkat Keseringan",
// 						data: data_f,
// 						backgroundColor: "rgba(75, 192, 192, 0.2)",
// 						borderColor: "rgba(75, 192, 192, 1)",
// 						borderWidth: 1,
// 					},
// 				],
// 			},
// 			options: {
// 				scales: {
// 					y: {
// 						beginAtZero: true,
// 					},
// 				},
// 			},
// 		});
// 	}

// 	cektahunInstrumen();
// });

document.addEventListener("DOMContentLoaded", function () {
	const tahunInstrumen = document.getElementById("tahunInstrumen");
	const listItemsJabfung = document.getElementById("listItemsJabfung");
	const listItemsJenjang = document.getElementById("listItemsJenjang");
	const listItemsInstrumen = document.getElementById("listItemsInstrumen");
	const tahunNow = new Date().getFullYear();
	let chartInstances = {}; // Memantau instance chart

	for (let tahun = tahunNow; tahun >= tahunNow - 100; tahun--) {
		tahunInstrumen.innerHTML += `<option value="${tahun}">${tahun}</option>`;
	}

	tahunInstrumen.addEventListener("change", function () {
		cektahunInstrumen();
	});
	listItemsJabfung.addEventListener("change", function () {
		cektahunInstrumen();
	});
	listItemsJenjang.addEventListener("change", function () {
		getListInstrumen();
	});
	listItemsInstrumen.addEventListener("change", function () {
		getStatistik();
	});

	function cektahunInstrumen() {
		let pilihJabfung = listItemsJabfung.value;
		var xhr = new XMLHttpRequest();
		xhr.open("GET", url + pilihJabfung, true);
		xhr.onload = function () {
			if (xhr.status === 200) {
				var options = JSON.parse(xhr.responseText);
				listItemsJenjang.innerHTML = "";

				options.forEach(function (option) {
					var elemetOption = document.createElement("option");
					elemetOption.value = option.id_jenjang;
					elemetOption.textContent = option.nama_jenjang;
					listItemsJenjang.appendChild(elemetOption);
				});

				if (options.length > 0) {
					listItemsJenjang.value = options[0].id_jenjang;
					getListInstrumen();
					getStatistik();
				}
			} else {
				console.error("Permintaan gagal. Status: " + xhr.status);
			}
		};
		xhr.send();
	}

	function getListInstrumen() {
		var pilihJenjang = listItemsJenjang.value;
		var listInstrumen = getInstrumen.filter(function (butir) {
			return butir.id_jenjang == pilihJenjang;
		});

		listItemsInstrumen.innerHTML = "";

		listInstrumen.forEach(function (items) {
			var butirElemen = document.createElement("option");
			butirElemen.value = items.id_instrumen;
			butirElemen.textContent = items.instrumen;
			listItemsInstrumen.appendChild(butirElemen);
		});

		if (listInstrumen.length > 0) {
			listItemsInstrumen.value = listInstrumen[0].id_instrumen;
		}
	}

	function getStatistik() {
		const pilihTahun = tahunInstrumen.value;
		const pilihJabfung = listItemsJabfung.value;
		const pilihJenjang = listItemsJenjang.value;
		const pilihInstrumen = listItemsInstrumen.value;

		Object.keys(chartInstances).forEach(function (rumahId) {
			if (chartInstances[rumahId]) {
				chartInstances[rumahId].destroy();
				delete chartInstances[rumahId];
			}
		});

		getRumah.forEach(function (rumah) {
			var xhr = new XMLHttpRequest();
			xhr.open(
				"GET",
				urlInstrumen +
					pilihTahun +
					"/" +
					pilihJabfung +
					"/" +
					pilihJenjang +
					"/" +
					pilihInstrumen +
					"/" +
					rumah.id_rumah,
				true
			);
			xhr.onload = function () {
				if (xhr.status === 200) {
					const statistikData = JSON.parse(xhr.responseText);
					drawBarChart(rumah.id_rumah, statistikData);
				} else {
					console.error("Permintaan gagal. Status: " + xhr.status);
				}
			};
			xhr.send();
		});
	}

	function drawBarChart(rumahId, statistikData) {
		const canvasId = "barDIF" + rumahId;
		const canvas = document.getElementById(canvasId);
		const ctx = canvas.getContext("2d");

		const rangeSkala = Object.keys(statistikData.skor_d).map(Number);
		const labels = rangeSkala.map((skala) => "Skor " + (skala + 1));

		const data_d = statistikData.skor_d || Array(rangeSkala.length).fill(0);
		const data_i = statistikData.skor_i || Array(rangeSkala.length).fill(0);
		const data_f = statistikData.skor_f || Array(rangeSkala.length).fill(0);

		chartInstances[rumahId] = new Chart(ctx, {
			type: "bar",
			data: {
				labels: labels,
				datasets: [
					{
						label: "Tingkat Kesulitan",
						data: data_d,
						backgroundColor: "rgba(255, 99, 132, 0.2)",
						borderColor: "rgba(255, 99, 132, 1)",
						borderWidth: 1,
					},
					{
						label: "Tingkat Kepentingan",
						data: data_i,
						backgroundColor: "rgba(54, 162, 235, 0.2)",
						borderColor: "rgba(54, 162, 235, 1)",
						borderWidth: 1,
					},
					{
						label: "Tingkat Keseringan",
						data: data_f,
						backgroundColor: "rgba(75, 192, 192, 0.2)",
						borderColor: "rgba(75, 192, 192, 1)",
						borderWidth: 1,
					},
				],
			},
			options: {
				scales: {
					y: {
						beginAtZero: true,
					},
				},
			},
		});
	}

	cektahunInstrumen();
});
