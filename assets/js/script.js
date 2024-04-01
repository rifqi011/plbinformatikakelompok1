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
                    case "bx bxs-search-alt-2":
                        icon.classList.remove("bxs-search-alt-2");
                        icon.classList.add("bx-search-alt-2");
                        break;
                    case "bx bxs-cart":
                        icon.classList.remove("bxs-cart");
                        icon.classList.add("bx-cart");
                        break;
                    case "bx bxs-notepad":
                        icon.classList.remove("bxs-notepad");
                        icon.classList.add("bx-notepad");
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
                    case "bx bx-search-alt-2":
                        icon.classList.remove("bx-search-alt-2");
                        icon.classList.add("bxs-search-alt-2");
                        break;
                    case "bx bx-cart":
                        icon.classList.remove("bx-cart");
                        icon.classList.add("bxs-cart");
                        break;
                    case "bx bx-notepad":
                        icon.classList.remove("bx-notepad");
                        icon.classList.add("bxs-notepad");
                        break;
                }
            }
        }
    });
});
// ---------- Nav Link end ---------- //

// ---------- Navbar Scroll ---------- //
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
// ---------- Navbar Scroll end ---------- //

// ---------- Swiper ---------- //
let Slider = new Swiper(".homeSwiper", {
    grabCursor: true,
    loop: true,
    slidesPerView: 1,
    autoplay: {
        delay: 3000,
        disableOnInteraction: false,
    },
    spaceBetween: 10,
});

let Slide = new Swiper(".cardSwiper", {
    grabCursor: true,
    loop: false,
    slidesPerView: "auto",
    spaceBetween: 10,
    slideShadows: false,
});
// ---------- Swiper end ---------- //

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

//-------------------Mobile Only---------------------//
/* document.addEventListener("DOMContentLoaded", function() {
    const isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent)

    if (!isMobile) {
    // Tampilkan modal jika bukan perangkat seluler
        const modal = document.getElementById("modal-confirm")
        modal.style.display = "block"

        // Event listener untuk tombol "Lanjut"
        document.getElementById("continueBtn").addEventListener("click", function() {
            modal.style.display = "none"
            document.getElementById("desktop").style.display = "none"
            document.getElementById("mobile").style.display = "block"
        })

        // Event listener untuk tombol "Keluar"
        document.getElementById("exitBtn").addEventListener("click", function() {
            modal.style.display = "none"
            document.getElementById("desktop").style.display = "block"
            document.getElementById("mobile").style.display = "none"
        })
    } else {
        document.getElementById("desktop").style.display = "none"
        document.getElementById("mobile").style.display = "block" // Tampilkan konten mobile jika pengguna adalah perangkat mobile
    }
}) */

// ---------- Modal ---------- //
// Fungsi untuk menampilkan modal ketika tombol "Add to Cart" diklik
const addButtonList = document.querySelectorAll(".btn__add");
addButtonList.forEach((button) => {
    button.addEventListener("click", function () {
        const targetModalId = this.getAttribute("data-target");
        const modal = document.getElementById(targetModalId);
        modal.classList.add("modal-show");
    });
});

// Fungsi untuk menyembunyikan modal ketika tombol "Close" di dalam modal diklik
const closeButtonList = document.querySelectorAll(".modal-close");
closeButtonList.forEach((button) => {
    button.addEventListener("click", function () {
        const targetModalId = this.getAttribute("data-target");
        const modal = document.getElementById(targetModalId);
        modal.classList.remove("modal-show");
    });
});
// ---------- Nav Link ---------- //

function tambahBarang(idbarang) {
    const kuantitasInput = document.getElementById(`kuantitas-${idbarang}`);
    const currentKuantitas = parseInt(kuantitasInput.value);
    const stok = parseInt(
        document.getElementById(`stok-${idbarang}`).getAttribute("data-stok")
    );

    if (currentKuantitas < stok) {
        kuantitasInput.value = currentKuantitas + 1;
    }
}

function kurangBarang(idbarang) {
    const kuantitasInput = document.getElementById(`kuantitas-${idbarang}`);
    const currentKuantitas = parseInt(kuantitasInput.value);
    if (currentKuantitas > 1) {
        kuantitasInput.value = currentKuantitas - 1;
    }
}

function cartTambahBarang(idbarang) {
    const kuantitasInput = document.getElementById(
        `cart-kuantitas-${idbarang}`
    );
    const currentKuantitas = parseInt(kuantitasInput.value);
    const stok = parseInt(
        document.getElementById(`stok-${idbarang}`).getAttribute("data-stok")
    );

    if (currentKuantitas < stok) {
        kuantitasInput.value = currentKuantitas + 1;
    }
    updateTotal();
}

function cartKurangBarang(idbarang) {
    const kuantitasInput = document.getElementById(
        `cart-kuantitas-${idbarang}`
    );
    const currentKuantitas = parseInt(kuantitasInput.value);
    if (currentKuantitas > 1) {
        kuantitasInput.value = currentKuantitas - 1;
        updateTotal();
    }
}

function updateTotal() {
    // Mengambil semua elemen input kuantitas
    const kuantitasInputs = document.querySelectorAll(".kuantitas__keranjang");

    // Variabel untuk menyimpan total harga dan total barang
    let totalHarga = 0;
    let totalBarang = 0;

    // Melakukan iterasi untuk setiap input kuantitas
    kuantitasInputs.forEach((input) => {
        const hargaPerBarang = parseFloat(input.getAttribute("data-harga"));
        const kuantitas = parseInt(input.value);

        // Menambahkan harga per barang ke total harga
        totalHarga += hargaPerBarang * kuantitas;

        // Menambahkan kuantitas barang ke total barang
        totalBarang += kuantitas;
    });

    // Menampilkan total harga dan total barang di elemen HTML yang sesuai
    const hargaCheckout = document.getElementById("harga-checkout");
    const totalBarangElem = document.getElementById("total-barang");

    hargaCheckout.textContent = "Rp." + totalHarga.toLocaleString();
    totalBarangElem.textContent = "Total Barang: " + totalBarang;
}
updateTotal();

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

    xhr.open("GET", "assets/ajax/data.php?keyword=" + keyword.value, true);
    xhr.send();
});

// Pop out
// Ambil semua elemen transaction card
function popUp(id) {
    const popup = document.getElementById(`popup-${id}`)
    const closePopup = document.getElementById(`popup-close-${id}`)

    popup.classList.add("show-popup")

    closePopup.addEventListener("click", () => {
        popup.classList.remove("show-popup")
    })
}