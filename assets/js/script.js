// ---------- Nav Link ---------- //
const navLinks = document.querySelectorAll('.nav__link')

navLinks.forEach(link => {
    link.addEventListener('click', () => {
        // Hapus kelas active-link dari semua tautan
        navLinks.forEach(navLink => {
            navLink.classList.remove('active-link')
            // Cari ikon dalam tautan dan reset kelasnya menjadi yang semula
            const icon = navLink.querySelector('i')
            if (icon) {
                switch (icon.classList.value) {
                    case 'bx bxs-home-alt-2':
                        icon.classList.remove('bxs-home-alt-2')
                        icon.classList.add('bx-home-alt-2')
                        break
                    case 'bx bxs-search-alt-2':
                        icon.classList.remove('bxs-search-alt-2')
                        icon.classList.add('bx-search-alt-2')
                        break
                    case 'bx bxs-cart':
                        icon.classList.remove('bxs-cart')
                        icon.classList.add('bx-cart')
                        break
                }
            }
        })

        // Tambahkan kelas active-link ke tautan yang diklik
        link.classList.add('active-link')

        // Periksa apakah tautan yang diklik memiliki kelas active-link
        if (link.classList.contains('active-link')) {
            // Cari ikon dalam tautan dan ubah kelasnya sesuai dengan tautan yang diklik
            const icon = link.querySelector('i')
            if (icon) {
                switch (icon.classList.value) {
                    case 'bx bx-home-alt-2':
                        icon.classList.remove('bx-home-alt-2')
                        icon.classList.add('bxs-home-alt-2')
                        break
                    case 'bx bx-search-alt-2':
                        icon.classList.remove('bx-search-alt-2')
                        icon.classList.add('bxs-search-alt-2')
                        break
                    case 'bx bx-cart':
                        icon.classList.remove('bx-cart')
                        icon.classList.add('bxs-cart')
                        break
                }
            }
        }
    })
})
// ---------- Nav Link end ---------- //

// ---------- Navbar Scroll ---------- //
const navbar = document.getElementById("navbar")

window.addEventListener("scroll", () => {
    let sticky = header.offsetTop

    if (window.pageYOffset > sticky) {
        navbar.classList.add('scroll__navbar')
        navbar.classList.add("shadow")
    } else {
        navbar.classList.remove('scroll__navbar')
        navbar.classList.remove("shadow")
    }
})
// ---------- Navbar Scroll end ---------- //

// ---------- Swiper ---------- //
let Slider = new Swiper('.homeSwiper', {
    grabCursor: true,
    loop: true,
    slidesPerView: 1,
    autoplay: {
        delay: 3000,
        disableOnInteraction: false,
    },
    spaceBetween: 10
})

let Slide = new Swiper('.cardSwiper', {
    grabCursor: true,
    loop: false,
    slidesPerView: 'auto',
    spaceBetween: 10,
    slideShadows: false
})
// ---------- Swiper end ---------- //

// ---------- Change Section ---------- //
document.addEventListener('DOMContentLoaded', function () {
    const navLinks = document.querySelectorAll('.nav__link')
    const sections = document.querySelectorAll('section')

    // Cek jika terdapat hash di URL (misal: #cart)
    const hash = window.location.hash;
    if (hash) {
        // Ambil id section dari hash URL
        const sectionId = hash.substring(1);
        // Aktifkan section sesuai dengan id
        activateSection(sectionId);
    }

    // Event listener untuk setiap menu navigasi
    navLinks.forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault() // Menghentikan default behavior dari anchor tag

            const sectionId = this.getAttribute('data-section')
            activateSection(sectionId)
            activateNavLink(link)
        })
    })

    // Fungsi untuk mengaktifkan section tertentu dan menonaktifkan section lainnya
    function activateSection(sectionId) {
        sections.forEach(section => {
            if (section.id === sectionId) {
                section.classList.add('active-section')
                section.classList.remove('hidden')
            } else {
                section.classList.remove('active-section')
                section.classList.add('hidden')
            }
        })
    }

    // Fungsi untuk mengaktifkan link navigasi tertentu dan menonaktifkan link navigasi lainnya
    function activateNavLink(activeLink) {
        navLinks.forEach(link => {
            if (link === activeLink) {
                link.classList.add('active')
            } else {
                link.classList.remove('active')
            }
        })
    }
})

// ---------- Change Section end ---------- //

//-------------------Mobile Only---------------------//
/* document.addEventListener("DOMContentLoaded", function() {
    const isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);

    if (!isMobile) {
    // Tampilkan modal jika bukan perangkat seluler
        const modal = document.getElementById("modal-confirm");
        modal.style.display = "block";

        // Event listener untuk tombol "Lanjut"
        document.getElementById("continueBtn").addEventListener("click", function() {
            modal.style.display = "none";
            document.getElementById("desktop").style.display = "none";
            document.getElementById("mobile").style.display = "block";
        });

        // Event listener untuk tombol "Keluar"
        document.getElementById("exitBtn").addEventListener("click", function() {
            modal.style.display = "none";
            document.getElementById("desktop").style.display = "block";
            document.getElementById("mobile").style.display = "none";
        });
    } else {
        document.getElementById("desktop").style.display = "none";
        document.getElementById("mobile").style.display = "block"; // Tampilkan konten mobile jika pengguna adalah perangkat mobile
    }
}); */

// ---------- Modal ---------- //
// Fungsi untuk menampilkan modal ketika tombol "Add to Cart" diklik
const addButtonList = document.querySelectorAll('.btn__add')
addButtonList.forEach(button => {
    button.addEventListener('click', function() {
        const targetModalId = this.getAttribute('data-target')
        const modal = document.getElementById(targetModalId)
        modal.classList.add("modal-show")
    })
})

// Fungsi untuk menyembunyikan modal ketika tombol "Close" di dalam modal diklik
const closeButtonList = document.querySelectorAll('.modal-close')
closeButtonList.forEach(button => {
    button.addEventListener('click', function() {
        const targetModalId = this.getAttribute('data-target')
        const modal = document.getElementById(targetModalId)
        modal.classList.remove("modal-show")
    })
})
// ---------- Nav Link ---------- //

function tambahBarang(id) {
    const kuantitasInput = document.getElementById(`kuantitas-${id}`)
    const currentKuantitas = parseInt(kuantitasInput.value)
    kuantitasInput.value = currentKuantitas + 1
    updateTotal() // Panggil fungsi updateTotal setelah menambah barang
}

function kurangBarang(id) {
    const kuantitasInput = document.getElementById(`kuantitas-${id}`)
    const currentKuantitas = parseInt(kuantitasInput.value)
    if (currentKuantitas > 1) {
        kuantitasInput.value = currentKuantitas - 1
        updateTotal() // Panggil fungsi updateTotal setelah mengurangi barang
    }
}
// Function untuk mengupdate total harga dan jumlah barang yang dipilih
function updateTotal() {
    let totalHarga = 0
    let jumlahBarang = 0

    // Loop melalui setiap checkbox
    let checkboxes = document.getElementsByClassName('checkbox__cart')
    for (let i = 0; i < checkboxes.length; i++) {
        let checkbox = checkboxes[i]
        let cartId = checkbox.name.replace('aktif-', '')

        // Cek apakah checkbox tercentang
        if (checkbox.checked) {
            let hargaProduk = parseFloat(document.getElementById('harga-' + cartId).innerText.replace('Rp.', '').replace(',', ''))
            let jumlahProduk = parseInt(document.getElementById('kuantitas-' + cartId).value)

            // Tambahkan harga produk ke total harga
            totalHarga += hargaProduk * jumlahProduk

            // Tambahkan jumlah produk ke jumlah barang
            jumlahBarang += jumlahProduk
            document.getElementById("cart-container-" + cartId).style.border = "2px solid red"
        } else {
            document.getElementById("cart-container-" + cartId).style.border = "2px solid transparent"
        }
    }

    // Update elemen HTML dengan total harga dan jumlah barang yang dipilih
    document.querySelector('.harga__checkout').innerText = 'Harga: Rp.' + totalHarga.toLocaleString()
    document.getElementById('total-barang').innerText = 'Item: ' + jumlahBarang + ''
}

// Event listener untuk setiap kali checkbox diubah
let checkboxes = document.getElementsByClassName('checkbox__cart')
for (let i = 0; i < checkboxes.length; i++) {
    checkboxes[i].addEventListener('change', function() {
        updateTotal() // Panggil fungsi updateTotal saat checkbox diubah
    })
}

// Panggil updateTotal untuk menginisialisasi total harga dan jumlah barang yang dipilih saat halaman dimuat
updateTotal()
