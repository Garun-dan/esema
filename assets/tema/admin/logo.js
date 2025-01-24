var logo = document.getElementById("topbar-logo");

var canvas = document.createElement("canvas");
var ctx = canvas.getContext("2d");

canvas.width = logo.width;
canvas.height = logo.height;

ctx.drawImage(logo, 0, 0, canvas.width, canvas.height);

var imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
var data = imageData.data;

for (var i = 0; i < data.length; i += 4) {
	if (data[i] === 0 && data[i + 1] === 0 && data[i + 2] === 0) {
		data[i] = 255;
		data[i + 1] = 255;
		data[i + 2] = 255;
	}
}

ctx.putImageData(imageData, 0, 0);

logo.src = canvas.toDataURL();
