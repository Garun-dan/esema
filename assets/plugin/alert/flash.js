var success = $("#success").data("success");
if (success) {
	Swal.fire({
		icon: "success",
		title: success,
	});
}

var error = $("#error").data("error");
if (error) {
	Swal.fire({
		icon: "error",
		title: error,
	});
}

var warning = $("#warning").data("warning");
if (warning) {
	Swal.fire({
		icon: "warning",
		title: warning,
	});
}

$(".tbl-logout").on("click", function (e) {
	e.preventDefault();

	const href = $(this).attr("href");

	Swal.fire({
		title: "Konfirmasi Logout!",
		text: "Apakah Anda Yakin Ingin Keluar Dari Sesi Ini?",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Logout",
	}).then((result) => {
		if (result.value) {
			document.location.href = href;
		}
	});
});

$(".tbl-hapus").on("click", function (e) {
	e.preventDefault();

	const href = $(this).attr("href");

	Swal.fire({
		title: "Konfirmasi Hapus!",
		text: "Apakah Anda Yakin Ingin Menghapus Data Ini?",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Hapus",
	}).then((result) => {
		if (result.value) {
			document.location.href = href;
		}
	});
});

$(".tbl-reset").on("click", function (e) {
	e.preventDefault();

	const href = $(this).attr("href");

	Swal.fire({
		title: "Konfirmasi Reset!",
		text: "Apakah Anda Yakin Ingin Kembali Ke Data Pabrik?",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Reset",
	}).then((result) => {
		if (result.value) {
			document.location.href = href;
		}
	});
});

$(".tbl-tolak").on("click", function (e) {
	e.preventDefault();

	const href = $(this).attr("href");

	Swal.fire({
		title: "Konfirmasi Tolak!",
		text: "Apakah Anda Yakin Ingin Menolak Komentar Ini?",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Tolak",
	}).then((result) => {
		if (result.value) {
			document.location.href = href;
		}
	});
});
