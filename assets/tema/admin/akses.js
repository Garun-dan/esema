// $(document).ready(function () {
// 	$(".give-access").on("click", function (event) {
// 		event.preventDefault();
// 		var $button = $(this);
// 		var role = $button.data("role");
// 		var menu = $button.data("menu");
// 		var submenu = $button.data("submenu");
// 		var url =
// 			"<?= base_url('admin/hak-akses/beri-akses/'); ?>" +
// 			role +
// 			"/" +
// 			menu +
// 			"/" +
// 			submenu;
// 		$button.toggleClass("tbl-danger tbl-primer");
// 		$button.children("span.bi").toggleClass("bi-lock-fill bi-unlock-fill");
// 		console.log(url);

// 		$.post(url, function (response) {});
// 	});

// 	$(".tbl-info").on("click", function (event) {
// 		event.preventDefault();
// 		var targetCollapseId = $(this).data("target");
// 		$(".collapse.show").removeClass("show");
// 		$(targetCollapseId).addClass("show");
// 	});
// });

function giveAccess(role, menu, submenu) {
	$.ajax({
		url: "<?php echo base_url('admin/settings/hak-akses/beri-akses'); ?>",
		type: "POST",
		data: {
			id_role: role,
			id_menu: menu,
			id_submenu: submenu,
		},
		success: function (response) {},
		error: function (xhr, status, error) {
			console.error("Terjadi kesalahan saat menyimpan data:", error);
		},
	});
}
