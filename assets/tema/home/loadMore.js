$(document).ready(function () {
	function calculateMaxCharsToShow() {
		var bodyHeight = $("body").height();
		var lineHeight = parseInt($("#pText").css("line-height"));
		var maxLines = Math.floor(bodyHeight / lineHeight);
		var maxCharsPerLine = Math.floor($("#pText").width() / 8);
		return maxLines * maxCharsPerLine;
	}

	var pText = $("#pText").text();
	var maxCharsToShow = calculateMaxCharsToShow();

	if (pText.length > maxCharsToShow) {
		$("#pText").text(pText.substring(0, maxCharsToShow) + "...");
		$("#loadMoreBtn").show();
	}

	$("#loadMoreBtn").click(function () {
		$("#pText").text(pText);
		$("#loadMoreBtn").hide();
	});
});
