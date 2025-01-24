$(document).ready(function () {
	$(".tambahdataTNA").submit(function (event) {
		event.preventDefault();
		var formData = $(this).serialize();
		var modalId = $(this).closest(".modal").attr("id");
		$.post($(this).attr("action"), formData, function (response) {
			$("#" + modalId).modal("hide");
		});
	});
});
