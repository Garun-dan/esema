document.addEventListener("DOMContentLoaded", function () {
	var jabfungCanvas = document.getElementById("barJabfung").getContext("2d");
	var jabfungChart;

	function setCanvasSize() {
		var screenSize = window.innerWidth;

		if (screenSize <= 540) {
			jabfungCanvas.canvas.width = screenSize;
			jabfungCanvas.canvas.height = 400 * (screenSize / 540);
		} else {
			jabfungCanvas.canvas.width = 100;
			jabfungCanvas.canvas.height = 100;
		}

		if (jabfungChart) jabfungChart.destroy();

		var idRekom = [];
		getRekom.forEach(function (rekom) {
			var parts = rekom.id.split("-");
			idRekom.push(parts[0] + "-" + parts[1]);
		});

		var idJabfung = idRekom[0];

		var jabfungNames = getJabfung.map((item) => item.nama_jabfung);
		if (jabfungNames.includes(idJabfung)) {
			var selectedYear = parseInt(document.getElementById("tahun").value);
			var newData = getChartData(selectedYear, idJabfung);
			jabfungChart = new Chart(jabfungCanvas, {
				type: "bar",
				data: {
					labels: getJabfung.map((item) => item.nama_jabfung),
					datasets: [
						{
							label: "Pelatihan",
							data: newData.Pelatihan,
							borderWidth: 1,
							backgroundColor: "#b330c0",
						},
						{
							label: "Seminar",
							data: newData.Seminar,
							borderWidth: 1,
							backgroundColor: "#3e4c7a",
						},
						{
							label: "Workshop",
							data: newData.Workshop,
							borderWidth: 1,
							backgroundColor: "#566d24",
						},
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
		}
	}

	setCanvasSize();

	window.addEventListener("resize", setCanvasSize);

	document.getElementById("tahun").addEventListener("change", function () {
		var selectedYear = parseInt(this.value);

		var idRekom = [];
		getRekom.forEach(function (rekom) {
			var parts = rekom.id.split("-");
			idRekom.push(parts[0] + "-" + parts[1]);
		});

		var idJabfung = idRekom[0];

		var newData = getChartData(selectedYear, idJabfung);

		jabfungChart.data.datasets.forEach((dataset, index) => {
			dataset.data = newData[index];
		});

		jabfungChart.update();
	});

	function getChartData(year, idJabfung) {
		var totalPelatihan = 0;
		var totalSeminar = 0;
		var totalWorkshop = 0;

		getRekom.forEach(function (rekom) {
			var parts = rekom.id.split("-");
			var tgl_validasi = rekom.tgl_validasi.split("-");
			if (
				parts[0] + "-" + parts[1] === idJabfung &&
				parseInt(tgl_validasi[0]) === year
			) {
				if (rekom.rekom === "Pelatihan") {
					totalPelatihan++;
				} else if (rekom.rekom === "Seminar") {
					totalSeminar++;
				} else if (rekom.rekom === "Workshop") {
					totalWorkshop++;
				}
			}
		});

		return {
			Pelatihan: totalPelatihan,
			Seminar: totalSeminar,
			Workshop: totalWorkshop,
		};
	}
});
