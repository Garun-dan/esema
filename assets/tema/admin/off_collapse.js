document.addEventListener("DOMContentLoaded", function () {
	var collapseButtons = document.querySelectorAll(
		'[data-bs-toggle="collapse"]'
	);

	collapseButtons.forEach(function (button) {
		button.addEventListener("click", function () {
			var target = button.getAttribute("data-bs-target");
			var collapseElements = document.querySelectorAll(".collapse.show");

			collapseElements.forEach(function (collapse) {
				if (collapse.getAttribute("id") !== target.slice(1)) {
					var bsCollapse = new bootstrap.Collapse(collapse, {
						toggle: false,
					});
					bsCollapse.hide();
				}
			});
		});
	});
});
