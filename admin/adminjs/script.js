// ---------- Nav Link ---------- //
const navLinks = document.querySelectorAll(".nav__link");

navLinks.forEach((link) => {
    link.addEventListener("click", () => {
        // Hapus kelas active-link dari semua tautan
        navLinks.forEach((navLink) => {
            navLink.classList.remove("active-link");
            // Cari ikon dalam tautan dan reset kelasnya menjadi yang semula
            const icon = navLink.querySelector("i");
            if (icon) {
                switch (icon.classList.value) {
                    case "bx bxs-home-alt-2":
                        icon.classList.remove("bxs-home-alt-2");
                        icon.classList.add("bx-home-alt-2");
                        break;
                    case "bx bxs-category":
                        icon.classList.remove("bxs-category");
                        icon.classList.add("bx-category");
                        break;
                    case "bx bxs-pie-chart-alt-2":
                        icon.classList.remove("bxs-pie-chart-alt-2");
                        icon.classList.add("bx-pie-chart-alt-2");
                        break;
                    case "bx bxs-group":
                        icon.classList.remove("bxs-group");
                        icon.classList.add("bx-group");
                        break;
                }
            }
        });

        // Tambahkan kelas active-link ke tautan yang diklik
        link.classList.add("active-link");

        // Periksa apakah tautan yang diklik memiliki kelas active-link
        if (link.classList.contains("active-link")) {
            // Cari ikon dalam tautan dan ubah kelasnya sesuai dengan tautan yang diklik
            const icon = link.querySelector("i");
            if (icon) {
                switch (icon.classList.value) {
                    case "bx bx-home-alt-2":
                        icon.classList.remove("bx-home-alt-2");
                        icon.classList.add("bxs-home-alt-2");
                        break;
                    case "bx bx-category":
                        icon.classList.remove("bx-category");
                        icon.classList.add("bxs-category");
                        break;
                    case "bx bx-pie-chart-alt-2":
                        icon.classList.remove("bx-pie-chart-alt-2");
                        icon.classList.add("bxs-pie-chart-alt-2");
                        break;
                    case "bx bx-group":
                        icon.classList.remove("bx-group");
                        icon.classList.add("bxs-group");
                        break;
                }
            }
        }
    });
});
// ---------- Nav Link end ---------- //

// ---------- Navbar Scroll ---------- //
// Periksa lebar layar perangkat
if (window.matchMedia("(min-width: 968px)").matches) {
    // Jika lebar layar lebih dari 968px, gunakan "header" sebagai elemen navbar
    const header = document.getElementById("header");

    window.addEventListener("scroll", () => {
        let sticky = navbar.offsetTop;

        if (window.pageYOffset > sticky) {
            header.classList.add("scroll__header");
            header.classList.add("shadow");
        } else {
            header.classList.remove("scroll__header");
            header.classList.remove("shadow");
        }
    });
} else {
    // Jika lebar layar kurang dari atau sama dengan 968px, gunakan "navbar" sebagai elemen navbar
    const navbar = document.getElementById("navbar");

    window.addEventListener("scroll", () => {
        let sticky = header.offsetTop;

        if (window.pageYOffset > sticky) {
            navbar.classList.add("scroll__navbar");
            navbar.classList.add("shadow");
        } else {
            navbar.classList.remove("scroll__navbar");
            navbar.classList.remove("shadow");
        }
    });
}
// ---------- Navbar Scroll end ---------- //

// ---------- Change Section ---------- //
document.addEventListener("DOMContentLoaded", function () {
    const navLinks = document.querySelectorAll(".nav__link");
    const sections = document.querySelectorAll("section");

    // Cek jika terdapat hash di URL (misal: #cart)
    const hash = window.location.hash;
    if (hash) {
        // Ambil id section dari hash URL
        const sectionId = hash.substring(1);
        // Aktifkan section sesuai dengan id
        activateSection(sectionId);
    }

    // Event listener untuk setiap menu navigasi
    navLinks.forEach((link) => {
        link.addEventListener("click", function (event) {
            event.preventDefault(); // Menghentikan default behavior dari anchor tag

            const sectionId = this.getAttribute("data-section");
            activateSection(sectionId);
            activateNavLink(link);
        });
    });

    // Fungsi untuk mengaktifkan section tertentu dan menonaktifkan section lainnya
    function activateSection(sectionId) {
        sections.forEach((section) => {
            if (section.id === sectionId) {
                section.classList.add("active-section");
                section.classList.remove("hidden");
            } else {
                section.classList.remove("active-section");
                section.classList.add("hidden");
            }
        });
    }

    // Fungsi untuk mengaktifkan link navigasi tertentu dan menonaktifkan link navigasi lainnya
    function activateNavLink(activeLink) {
        navLinks.forEach((link) => {
            if (link === activeLink) {
                link.classList.add("active");
            } else {
                link.classList.remove("active");
            }
        });
    }
});
// ---------- Change Section end ---------- //

// ---------- Pop up Barang ---------- //
function productPopUp(id) {
    const card = document.getElementById(`product-popup-${id}`);
    const closeBtn = document.getElementById(`popup-close-${id}`);

    card.classList.add("show-popup");

    closeBtn.addEventListener("click", () => {
        card.classList.remove("show-popup");
    });
}
// ---------- Pop up Barang end ---------- //

// ---------- Live Searching ---------- //
const keyword = document.getElementById("search-input");
const product = document.getElementById("product-search");

// tambah event ketika keyword ditulis
keyword.addEventListener("keyup", () => {
    let xhr = new XMLHttpRequest();

    xhr.onreadystatechange = () => {
        if (xhr.readyState == 4 && xhr.status == 200) {
            product.innerHTML = xhr.responseText;
        }
    };

    xhr.open("GET", "ajax/ajaxadmin.php?keyword=" + keyword.value, true);
    xhr.send();
});
// ---------- Live Searching end ---------- //

// ---------- Pop up Tambah Barang ---------- //
function barangAdd(id) {
    const card = document.getElementById(`add-popup-${id}`);
    const closeBtn = document.getElementById(`add-close-${id}`);

    card.classList.add("show-popup");

    closeBtn.addEventListener("click", () => {
        card.classList.remove("show-popup");
    });
}
// ---------- Pop up Tambah Barang end ---------- //
