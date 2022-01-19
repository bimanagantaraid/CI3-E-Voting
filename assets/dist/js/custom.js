const navMenu = document.getElementById("nav__menu"),
	navToggle = document.getElementById("nav-toggle"),
	navClose = document.getElementById("nav-close");
if (navToggle) {
	navToggle.addEventListener("click", () => {
		navMenu.classList.add("show-menu");
	});
}

if (navClose) {
	navClose.addEventListener("click", () => {
		navMenu.classList.remove("show-menu");
	});
}

const navLink = document.querySelectorAll(".nav__link");

function linkAction() {
	const navMenu = document.getElementById("nav__menu");
	navMenu.classList.remove("show-menu");
}

navLink.forEach((n) => n.addEventListener("click", linkAction));

const visimisi = document.querySelectorAll(".btn-info");

visimisi.forEach((n) =>
	n.addEventListener("click", () => {
		const paslon_id = n.getAttribute("paslon_id");
		$.ajax({
			url: "vote/getPaslon",
			method: "GET",
			data: {
				paslon_id: paslon_id,
			},
			success: function (data) {
				const paslon = JSON.parse(data);
				document.getElementById("modal-title").innerHTML =
					"Visi dan Misi no urut " + paslon["data"].no_paslon;
				document.getElementById("modal-deskripsi").innerHTML =
					paslon["data"].deskripsi;
			},
		});
		$("#exampleModal").modal("show");
	})
);

const voteButton = document.querySelectorAll(".btn-vote");
voteButton.forEach((n) =>
	n.addEventListener("click", () => {
		const paslon_id = n.getAttribute("paslon_id");
		const pemilih_id = n.getAttribute("pemilih_id");
		$.ajax({
			url: "vote/insert",
			method: "POST",
			data: {
				paslon_id: paslon_id,
				pemilih_id: pemilih_id,
			},
			success: function (response) {
				const data = JSON.parse(response);
				if (data.status == "valid") {
					Swal.fire("Terimakasih", "Suara anda sudah kami terima!", "success");
					setTimeout(function () {
						location.reload(true);
					}, 1500);
				} else if (data.status == "notlogin"){
					Swal.fire("Maaf", "anda belum login, silahkan terlebih dahulu!", "warning");
					setTimeout(function () {
						location.reload(true);
					}, 1500);
				}
			},
		});
	})
);
