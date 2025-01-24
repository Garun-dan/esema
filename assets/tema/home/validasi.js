function simpanHP(nik) {
	const hp = $("#hp").val();

	console.log("NIK:", nik);
	console.log("HP:", hp);

	$.ajax({
		type: "POST",
		url: "<?= base_url('cek-login/simpan-hp'); ?>",
		data: {
			nik: nik,
			hp: hp,
		},
		success: function (response) {
			var dataOTP = $("#dataOTP");
			dataOTP.removeClass("d-none");
			var btnSimpanHP = $("#btnSimpanHP");
			btnSimpanHP.addClass("d-none");
			const formHP = $("#hp");
			formHP.prop("readonly", true);
			var btnValidOTP = $("#btnValidOTP");
			btnValidOTP.removeClass("d-none");
		},
		error: function (xhr, status, error) {
			console.error(xhr.responseText);
		},
	});
}
