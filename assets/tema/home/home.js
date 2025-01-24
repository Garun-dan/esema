document.addEventListener("DOMContentLoaded", function () {
	const itemMenuBtn = document.getElementById("item-menu");
	const topbar = document.getElementById("topbar");
	const menuTophome = document.getElementById("menu-tophome");
	const offcanvasMenu = document.createElement("div");

	offcanvasMenu.id = "offcanvas-menu";
	offcanvasMenu.style.display = "none";
	offcanvasMenu.style.position = "fixed";
	offcanvasMenu.style.padding = "20px";
	offcanvasMenu.style.top = "0";
	offcanvasMenu.style.right = "0";
	offcanvasMenu.style.width = "80%";
	offcanvasMenu.style.height = "100%";
	offcanvasMenu.style.background = "#fff";
	offcanvasMenu.style.color = "#000";
	offcanvasMenu.style.zIndex = "1000";
	offcanvasMenu.style.overflowX = "hidden";
	offcanvasMenu.style.overflowY = "auto";
	document.body.appendChild(offcanvasMenu);

	const menuTophomeList = menuTophome.cloneNode(true);
	menuTophomeList.style.display = "flex";
	menuTophomeList.style.flexDirection = "column";
	menuTophomeList.style.width = "100%";
	menuTophomeList.style.flexWrap = "nowrap";
	menuTophomeList.style.justifyContent = "flex-start";
	menuTophomeList.style.alignItems = "flex-start";
	menuTophomeList.style.marginTop = "20px";
	menuTophomeList.querySelectorAll("a").forEach((a) => {
		a.style.marginBottom = "20px";
		a.style.color = "#000";
	});
	offcanvasMenu.appendChild(menuTophomeList);

	function toggleOffcanvasMenu() {
		if (offcanvasMenu.style.display === "block") {
			offcanvasMenu.style.display = "none";
			topbar.appendChild(menuTophome);
		} else {
			offcanvasMenu.style.display = "block";
		}
	}

	itemMenuBtn.addEventListener("click", function () {
		toggleOffcanvasMenu();
	});

	const closeButton = document.createElement("button");
	closeButton.textContent = "X";
	closeButton.style.position = "absolute";
	closeButton.style.top = "10px";
	closeButton.style.right = "10px";
	closeButton.style.background = "none";
	closeButton.style.border = "none";
	closeButton.style.color = "#000";
	closeButton.style.fontSize = "20px";
	closeButton.style.cursor = "pointer";
	closeButton.addEventListener("click", function () {
		offcanvasMenu.style.display = "none";
		topbar.appendChild(menuTophome);
	});
	offcanvasMenu.appendChild(closeButton);

	document.addEventListener("click", function (event) {
		if (
			!offcanvasMenu.contains(event.target) &&
			!itemMenuBtn.contains(event.target)
		) {
			offcanvasMenu.style.display = "none";
			topbar.appendChild(menuTophome);
		}
	});

	window.addEventListener("resize", function () {
		if (window.innerWidth > 540 && offcanvasMenu.style.display === "block") {
			toggleOffcanvasMenu();
		}
	});
});
