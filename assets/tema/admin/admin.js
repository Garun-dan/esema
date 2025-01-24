const viewSubmenus = document.getElementsByClassName("view-submenu");

for (let i = 0; i < viewSubmenus.length; i++) {
	viewSubmenus[i].addEventListener("click", function () {
		const clickedSubmenu = this.nextElementSibling;

		const allSubmenus = document.getElementsByClassName("submenu");
		for (let j = 0; j < allSubmenus.length; j++) {
			if (allSubmenus[j] !== clickedSubmenu) {
				allSubmenus[j].style.display = "none";
				allSubmenus[j].style.background = "#ffffff";
			}
		}

		if (clickedSubmenu.style.display === "block") {
			clickedSubmenu.style.display = "none";
			clickedSubmenu.style.background = "#ffffff";
		} else {
			clickedSubmenu.style.display = "block";
			clickedSubmenu.style.background = "#ffffff";
		}
	});
}
