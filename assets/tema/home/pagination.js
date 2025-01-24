$(document).ready(function () {
	var pageSize = 4;
	var mediaData = dataMedia;
	var currentPage = 1;

	function loadMedia(page) {
		currentPage = page;
		var start = (page - 1) * pageSize;
		var end = start + pageSize;

		$.ajax({
			type: "GET",
			url: urlLoadmedia,
			data: {
				start: start,
				end: end,
				media: JSON.stringify(mediaData),
			},
			success: function (response) {
				$("#mediaContainer").html(response);
			},
		});
	}

	function generatePagination(totalPages) {
		var pagination = $("#pagination");
		pagination.html("");

		if (currentPage > 1) {
			var liPrevious = $("<li>")
				.addClass("page-item")
				.append(
					$("<a>")
						.addClass("page-link")
						.attr("href", "#")
						.text("Previous")
						.click(function () {
							loadMedia(currentPage - 1);
						})
				);
			pagination.append(liPrevious);
		}

		for (
			var i = Math.max(1, currentPage - 2);
			i <= Math.min(totalPages, currentPage + 2);
			i++
		) {
			var li = $("<li>")
				.addClass("page-item")
				.append(
					$("<a>")
						.addClass("page-link")
						.attr("href", "#")
						.text(i)
						.click(function () {
							$(".page-item.active").removeClass("active");
							$(this).parent().addClass("active");
							loadMedia(parseInt($(this).text()));
						})
				);
			if (i === currentPage) {
				li.addClass("active");
			}
			pagination.append(li);
		}

		if (currentPage < totalPages) {
			var liNext = $("<li>")
				.addClass("page-item")
				.append(
					$("<a>")
						.addClass("page-link")
						.attr("href", "#")
						.text("Next")
						.click(function () {
							loadMedia(currentPage + 1);
						})
				);
			pagination.append(liNext);
		}
	}

	function openModal(media) {
		$("#pedoman-" + media + "-modal").modal("show");
	}

	var totalPages = Math.ceil(mediaData.length / pageSize);
	generatePagination(totalPages);
	loadMedia(currentPage);
});
