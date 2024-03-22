<?php
include 'koneksi.php'
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anggota Kelompok 1</title>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Pixelify+Sans&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            scroll-behavior: smooth;
        }

        body {
            background-color: #070F2B;
            font-family: "Pixelify Sans", sans-serif;
            color: #f3f3f3;
        }

        #particles-js {
            width: 100%;
            height: 400vh;
            position: absolute;
            z-index: -1;
        }

        section {
            min-height: 100vh;
            text-align: center;
        }

        .title {
            font-size: 60px;
            text-shadow: 4px 4px 10px #FFB000;
            padding-block: 2rem;
        }

        .subtitle {
            font-size: 30px;
            text-shadow: 2px 2px 6px #FFB000;
        }

        .teks {
            width: 90%;
            margin-inline: auto;
            font-size: 1.1rem;
            font-family: 'Courier New', Courier, monospace;
            text-shadow: 0px 0px 7px #FFB000;
            padding-block: 2rem;
        }

        #down-arrow {
            color: #f3f3f3;
        }

        #anggota img {
            border-radius: 50%;
            object-fit: cover;
            width: 200px;
            height: 200px;
            margin-block: 1rem;
        }

        .data__anggota {
            margin-bottom: 5rem;
        }

        .homeback {
            text-align: center;
            text-decoration: none;
            color: #f3f3f3;
        }
    </style>
</head>

<body>
    <div id="particles-js"></div>
    <section id="home">
        <h1 data-aos="fade-down" data-aos-delay="0" class="title">Kelompok 1</h1>
        <h2 data-aos="fade-down" data-aos-delay="250" class="subtitle">Praktik Lintas Bidang</h2>
        <h2 data-aos="fade-down" data-aos-delay="500" class="subtitle">X PPLG 1</h2>
        <p data-aos="fade-down" data-aos-delay="1000" class="teks">Dalam tugas "Praktik Lintas Bidang" ini, kami dari jurusan PPLG berkolaborasi dengan Akl, PM, dan DKV untuk menciptakan prototipe web kantin dengan konsep food delivery ala Go-Food. Kami menggabungkan keahlian dan pengetahuan dari berbagai bidang untuk menghasilkan sebuah solusi yang inovatif dan fungsional. Dengan pendekatan lintas bidang, kami bertujuan untuk menghadirkan pengalaman pengguna yang lebih baik dan efisien dalam memesan makanan secara online.</p>
        <a href="#anggota"><svg data-aos="fade-down" data-aos-delay="1200" fill="#f3f3f3" width="120px" height="120px" viewBox="-2.2 -2.2 26.40 26.40" xmlns="http://www.w3.org/2000/svg" id="memory-arrow-down" stroke="#f3f3f3" transform="rotate(0)" stroke-width="0.00022"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.22000000000000003"></g><g id="SVGRepo_iconCarrier"><path d="M12 17H10V16H9V15H8V14H7V13H6V11H8V12H9V13H10V4H12V13H13V12H14V11H16V13H15V14H14V15H13V16H12"></path></g></svg></a>
    </section>

    <section id="anggota">
        <h1 data-aos="fade-down" data-aos-delay="0" class="title">Anggota Kelompok</h1>
        <?php
        $anggota = mysqli_query($connect, "SELECT * FROM kelompok");
        while ($data = mysqli_fetch_array($anggota)) {
        ?>
        <div class="data__anggota">
            <h2 data-aos="fade-down" data-aos-delay="250" class="subtitle"><?php echo $data['jabatan']; ?></h2>
            <img data-aos="fade-down" data-aos-delay="500" src="assets/img/anggotakelompok/<?php echo $data['foto']; ?>" alt="">
            <h2 data-aos="fade-down" data-aos-delay="750" class="subtitle"><?php echo $data['nama']; ?></h2>
            <h2 data-aos="fade-down" data-aos-delay="1000" class="subtitle">Absen: <?php echo $data['absen']; ?></h2>
        </div>
        <?php
        }
        ?>
    </section>
    <footer>
        <a class="homeback" href="/inforp5"><h1>Home</h1></a>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="assets/js/particles.js"></script>
    <script>
        AOS.init({
            duration: 1200,
            once: false,
        })


        particlesJS('particles-js',
            {
                "particles": {
                    "number": {
                        "value": 200,
                        "density": {
                            "enable": true,
                            "value_area": 800
                        }
                    },
                    "color": {
                        "value": "#ffffff"
                    },
                    "shape": {
                        "type": "circle",
                        "stroke": {
                            "width": 0,
                            "color": "#ffffff"
                        },
                    },
                    "opacity": {
                        "value": 1,
                        "random": true,
                        "anim": {
                            "enable": true,
                            "speed": 1,
                            "opacity_min": 0.3,
                            "sync": false
                        }
                    },
                    "size": {
                        "value": 5,
                        "random": true,
                        "anim": {
                            "enable": false,
                            "speed": 4,
                            "size_min": 0.3,
                            "sync": false
                        }
                    },
                    "line_linked": {
                        "enable": true,
                    },
                    "move": {
                        "enable": true,
                        "speed": 2,
                        "direction": "none",
                        "random": true,
                        "straight": false,
                        "out_mode": "out",
                        "bounce": false,
                        "attract": {
                            "enable": false,
                            "rotateX": 600,
                            "rotateY": 600
                        }
                    }
                },
                "interactivity": {
                    "detect_on": "canvas",
                    "events": {
                        "onhover": {
                            "enable": false,
                            "mode": "bubble"
                        },
                        "onclick": {
                            "enable": true,
                            "mode": "repulse"
                        },
                        "resize": true
                    },
                    "modes": {
                        "repulse": {
                            "distance": 100,
                            "duration": 0.4
                        },
                        "push": {
                            "particles_nb": 4
                        },
                        "remove": {
                            "particles_nb": 2
                        }
                    }
                },
                "retina_detect": true
            }
        )
    </script>
</body>

</html>