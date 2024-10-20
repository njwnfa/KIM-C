<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>KIM-C</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Google fonts-->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,wght@0,600;1,600&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,300;0,500;0,600;0,700;1,300;1,500;1,600;1,700&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,400;1,400&amp;display=swap" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <style>
      .team-member {
        text-align: center;
        margin-bottom: 30px;
      }
      .team-member img {
        border-radius: 50%;
        width: 200px;
        height: 200px;
        object-fit: cover;
        object-position: center;
        transition: transform 0.3s ease-in-out;
      }
      .team-member img:hover {
        transform: scale(1.1);
      }
      .team-member .social-icons a {
        margin: 0 5px;
        color: #333;
      }
      .team-member .social-icons a:hover {
        color: #007bff;
      }
      .about-text {
        font-size: 1.1rem;
        line-height: 1.8;
      }
      .about-section {
        background: linear-gradient(to right, #ece9e6, #ffffff);
        border-radius: 10px;
        padding: 20px;
      }
    </style>
  </head>
  <body id="page-top">
    <!-- Navigation-->
    <?php
    session_start();
    ?>

<nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm" id="mainNav" style="background-color: #ffc670;">
    <div class="container px-5">
        <img src="assets/img/737.jpg" alt="" style="width: 35px; margin-right: 10px" />
        <a class="navbar-brand fw-bold" href="#page-top">KIM-C</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <i class="bi-list"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto me-4 my-3 my-lg-0">
                <li class="nav-item"><a class="nav-link me-lg" href="#home">Home</a></li>
                <li class="nav-item"><a class="nav-link me-lg" href="#features">Features</a></li>
                <li class="nav-item"><a class="nav-link me-lg" href="#about_us">About Us</a></li>
                
                <!-- Tambahkan Menu Cek Karbohidrat jika user login -->
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item"><a class="nav-link me-lg" href="cek-karbo/index.php">Cek Karbohidrat</a></li>
                <?php endif; ?>
            </ul>

            <!-- Ganti button login menjadi profile jika user login -->
            <?php if (isset($_SESSION['user_id'])): ?>
            <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="assets/img/profile.png" alt="Profile" style="width: 35px; height: 35px; border-radius: 50%;" />
                </button>
                <ul class="dropdown-menu" aria-labelledby="profileDropdown">
                    <li><a class="dropdown-item" href="#">Hello, <?php echo $_SESSION['user_name']; ?></a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="logout/logout.php">Logout</a></li> 
                </ul>
            </div>
            <?php else: ?>
            <button class="btn btn-primary rounded-pill px-3 mb-2 mb-lg-0" data-bs-toggle="modal" data-bs-target="#loginModal">
                <span class="d-flex align-items-center">
                    <i class="bi-chat-text-fill me-2"></i>
                    <span class="small">Login</span>
                </span>
            </button>
            <?php endif; ?>
        </div>
    </div>
</nav>


    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="loginModalLabel">Login</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="login/login.php" method="post">
              <div class="mb-3">
                <label for="loginEmail" class="form-label">Email address</label>
                <input type="text" class="form-control" id="loginEmail" name="email" required />
              </div>
              <div class="mb-3">
                <label for="loginPassword" class="form-label">Password</label>
                <input type="password" class="form-control" id="loginPassword" name="password" required />
              </div>
              <button type="submit" class="btn btn-primary">Login</button>
            </form>
          </div>
          <div class="modal-footer">
            <p>Don't have an account? <a href="#" data-bs-toggle="modal" data-bs-target="#signupModal" data-bs-dismiss="modal">Sign up</a></p>
          </div>
        </div>
      </div>
    </div>

    <!-- Signup Modal -->
    <div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="signupModalLabel">Sign Up</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="register/signup.php" method="post">
              <div class="mb-3">
                <label for="signupEmail" class="form-label">Email address</label>
                <input type="email" class="form-control" id="signupEmail" name="email" required />
              </div>
              <div class="mb-3">
                <label for="signupName" class="form-label">Name</label>
                <input type="text" class="form-control" id="signupName" name="name" required />
              </div>
              <div class="mb-3">
                <label for="signupPassword" class="form-label">Password</label>
                <input type="password" class="form-control" id="signupPassword" name="password" required />
              </div>
              <button type="submit" class="btn btn-primary">Sign Up</button>
            </form>
          </div>
          <div class="modal-footer">
            <p>Already have an account? <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal" data-bs-dismiss="modal">Login</a></p>
          </div>
        </div>
      </div>
    </div>

    <!-- Mashead header-->
    <header class="masthead" id="home">
      <div class="container px-5">
        <div class="row gx-5 align-items-center">
          <div class="col-lg-6">
            <!-- Mashead text and app badges-->
            <div class="mb-5 mb-lg-0 text-center text-lg-start">
              <h1 class="display-1 lh-1 mb-3">KIM-C</h1>
              <p class="lead fw-normal text-muted mb-5">Cek Karbohidrat Ibu Hamil  dan Menyusui</p>
              <p class="lead fw-normal text-black mb-5 mb-lg-0">
                Selamat datang di KIM-C, aplikasi pintar yang dirancang untuk mendukung kesehatan ibu hamil dan ibu menyusui melalui pemantauan asupan karbohidrat dalam makanan kemasan. Dengan menjaga asupan karbohidrat tetap terkendali, KIM-C membantu mencegah risiko diabetes melitus.
              </p>
              <div class="d-flex flex-column flex-lg-row align-items-center">
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <!-- Masthead device mockup feature-->
            <div class="masthead-device-mockup">
              <svg class="circle" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                <img src="assets/img/carbo.jpg" alt="..." class="rounded-circle">
                <defs>
                  <linearGradient id="circleGradient" gradientTransform="rotate(45)">
                    <stop class="gradient-start-color" offset="0%"></stop>
                    <stop class="gradient-end-color" offset="100%"></stop>
                  </linearGradient>
                </defs>
                <circle cx="50" cy="50" r="50"></circle></svg>
                <rect x="-32.54" y="78.39" width="305.92" height="84.05" rx="42.03" transform="translate(120.42 -49.88) rotate(45)"></rect>
                <rect x="-32.54" y="78.39" width="305.92" height="84.05" rx="42.03" transform="translate(-49.88 120.42) rotate(-45)"></rect></svg>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>
    <!-- Detail Karbohidrat-->
    <header class="masthead" id="features">
      <aside style="background-color: #ffc670;">
      <div class="container px-5">
        <div class="row gx-5 justify-content-center">
          <div class="col-xl-10">
            <h2 class="text-white display-1 lh-1 mb-4">
              Apa itu karbohidrat?
            </h2>
            <p class="lead fw-normal text-white mb-5 mb-lg-0">
              Karbohidrat adalah suatu zat gizi yang sangat dibutuhkan oleh manusia yang berfungsi untuk menghasilkan energi bagi tubuh manusia. Karbohidrat sederhana tersusun dari ikatan gula sederhana yang sangat cepat dicerna oleh tubuh sehingga memberikan pengaruh peningkatan glukosa pada tubuh. Peningkatan kadar glukosa dalam tubuh dapat menimbulkan resiko penyakit Diabetes Mellitus. Faktor yang mengakibatkan ibu hamil dan menyusui mengalami dibetes melitus salah satunya yaitu karena tingginya konsumsi kadar karbohidrat. 
            </p>
          </div>
        </div>
      </div>
    </aside>
    <!-- Karbohidrat terhadap DM-->
      <aside style="background-color: #f8f9fa;">
      <div class="cta-content">
        <div class="container px-5">
         <div class="row gx-5 justify-content-center">
          <div class="col-xl-10">
          <h6 class="text-black display-6 lh-1 mb-4">
            Mengapa tingginya konsumsi kadar karbohidrat dapat mempengaruhi resiko terkena diabetes?
          </h6>
          <p class="lead fw-normal text-black mb-5 mb-lg-0">
            Tingginya asupan karbohidrat, terutama dari gula sederhana dan karbohidrat olahan, dapat menyebabkan lonjakan gula darah. Lonjakan yang terus-menerus ini meningkatkan risiko resistensi insulin, di mana tubuh menjadi kurang responsif terhadap insulin. Resistensi insulin dapat berkembang menjadi diabetes tipe 2. Oleh karena itu, konsumsi karbohidrat berlebih merupakan faktor utama yang berkontribusi terhadap risiko diabetes, sehingga penting untuk mengelola asupannya guna menjaga kadar gula darah tetap stabil.
          </p>
         </div>
        </div>
        </div>
      </div>
      </aside>
      <!-- Dampak-->
      <aside style="background-color: #ffc670;">
        <div class="container px-5">
          <div class="row gx-5 justify-content-center">
            <div class="col-xl-10">
              <h2 class="text-white display-5 lh-1 mb-4">
                Berikut dampak yang dapat  dirasakan ketika  ibu hamil dan menyusui terkena diabetes mellitus!!
              </h2>
              <p class="lead fw-normal text-white mb-5 mb-lg-0">
                Diabetes mellitus, khususnya Gestational Diabetes Mellitus (GDM) pada ibu hamil,dapat menimbulkan risiko serius bagi ibu dan bayi. Ibu hamil dengan diabetes berisiko lebih tinggi mengalami pre-eklampsia, operasi caesar, serta komplikasi seperti persalinan prematur, cairan ketuban berlebih, dan bayi besar. Bayi berisiko mengalami sindrom gangguan pernapasan, hipoglikemia, hyperbilirubinemia, perawatan intensif, bahkan kematian saat lahir. Selain itu, ibu dengan GDM memiliki risiko lebih tinggi terkena diabetes tipe 2 di kemudian hari. Pada ibu menyusui, diabetes dapat memengaruhi produksi ASI, meningkatkan risiko infeksi, serta memperlambat pemulihan pasca-persalinan. Oleh karena itu, mengelola diabetes selama kehamilan dan menyusui sangat penting untuk mengurangi dampak buruk bagi ibu dan bayi.
              </p>
            </div>
          </div>
        </div>
      </aside>
      </header>
    <!-- Basic features section-->
    <header class="masthead" id="login">
    <section class="bg-light">
      <div class="container px-5">
        <div class="row gx-5 align-items-center justify-content-center justify-content-lg-center">
          <div class="text-center">
            <h2 class="display-4 lh-1 mb-4">Silahkan Login</h2>
            <button class="btn btn-primary rounded-pill px-5 mb-2 mb-lg-0" data-bs-toggle="modal" data-bs-target="#loginModal">
              <span class="d-flex align-items-center">
                <i class="bi-chat-text-fill me-2"></i>
                <span class="large">Login</span>
              </span>
            </button>
          </div>
        </div>
      </div>
    </section>
    </header>
    <!--nama group-->
    <header class="masthead" id="about_us">
    <section style="background-color: #f4c278;">
      <div class="row">
        <div class="col-md-3 team-member" data-aos="fade-up">
          <img src="https://64.media.tumblr.com/9a13ecc88b5104893246f683c60a812e/b8f018caf5076b2e-46/s1280x1920/33d8d72a5e04d6f94c10ab6a30c11105c26181e3.jpg" alt="Jenny Wilson">
          <h4 style="padding-top: 15px;">Aisiyah Haura R</h4>
          <p>Mahasiswa RMIK</p>
          <div class="social-icons">
            <a href="#"><i class="fa-brands fa-instagram"></i></a>
            <a href="#"><i class="fa-brands fa-facebook"></i></a>
            <a href="#"><i class="fa-brands fa-linkedin"></i></a>
          </div>
        </div>
        <div class="col-md-3 team-member" data-aos="fade-up">
          <img src="https://64.media.tumblr.com/9a13ecc88b5104893246f683c60a812e/b8f018caf5076b2e-46/s1280x1920/33d8d72a5e04d6f94c10ab6a30c11105c26181e3.jpg" alt="Theresa Bell">
          <h4 style="padding-top: 15px;">Atikah Shobrina</h4>
          <p>Mahasiswa RMIK</p>
          <div class="social-icons">
            <a href="#"><i class="fa-brands fa-instagram"></i></a>
            <a href="#"><i class="fa-brands fa-facebook"></i></a>
            <a href="#"><i class="fa-brands fa-linkedin"></i></a>
          </div>
        </div>
        <div class="col-md-3 team-member" data-aos="fade-up">
          <img src="https://64.media.tumblr.com/9a13ecc88b5104893246f683c60a812e/b8f018caf5076b2e-46/s1280x1920/33d8d72a5e04d6f94c10ab6a30c11105c26181e3.jpg" alt="Darrell Steward">
          <h4 style="padding-top: 15px;">Hari Iskandar</h4>
          <p>Mahasiswa RMIK</p>
          <div class="social-icons">
            <a href="#"><i class="fa-brands fa-instagram"></i></a>
            <a href="#"><i class="fa-brands fa-facebook"></i></a>
            <a href="#"><i class="fa-brands fa-linkedin"></i></a>
          </div>
        </div>
        <div class="col-md-3 team-member" data-aos="fade-up">
          <img src="https://64.media.tumblr.com/9a13ecc88b5104893246f683c60a812e/b8f018caf5076b2e-46/s1280x1920/33d8d72a5e04d6f94c10ab6a30c11105c26181e3.jpg" alt="Fiony Alveria">
          <h4 style="padding-top: 15px;">Najwa Medina Z.A.F</h4>
          <p>Mahasiswa RMIK</p>
          <div class="social-icons">
            <a href="#"><i class="fa-brands fa-instagram"></i></a>
            <a href="#"><i class="fa-brands fa-facebook"></i></a>
            <a href="#"><i class="fa-brands fa-linkedin"></i></a>
          </div>
        </div>
      </div>
      <section style="background-color: #f4c278;">
        <div class="row">
          <div class="col-md-3 team-member" data-aos="fade-up">
            <img src="https://64.media.tumblr.com/9a13ecc88b5104893246f683c60a812e/b8f018caf5076b2e-46/s1280x1920/33d8d72a5e04d6f94c10ab6a30c11105c26181e3.jpg" alt="Jenny Wilson">
            <h4 style="padding-top: 15px;">Nazwa Adzraa Labiqa</h4>
            <p>Mahasiswa RMIK</p>
            <div class="social-icons">
              <a href="#"><i class="fa-brands fa-instagram"></i></a>
              <a href="#"><i class="fa-brands fa-facebook"></i></a>
              <a href="#"><i class="fa-brands fa-linkedin"></i></a>
            </div>
          </div>
          <div class="col-md-3 team-member" data-aos="fade-up">
            <img src="https://64.media.tumblr.com/9a13ecc88b5104893246f683c60a812e/b8f018caf5076b2e-46/s1280x1920/33d8d72a5e04d6f94c10ab6a30c11105c26181e3.jpg" alt="Theresa Bell">
            <h4 style="padding-top: 15px;">Nur Farida Laila</h4>
            <p>Mahasiswa RMIK</p>
            <div class="social-icons">
              <a href="#"><i class="fa-brands fa-instagram"></i></a>
              <a href="#"><i class="fa-brands fa-facebook"></i></a>
              <a href="#"><i class="fa-brands fa-linkedin"></i></a>
            </div>
          </div>
          <div class="col-md-3 team-member" data-aos="fade-up">
            <img src="https://64.media.tumblr.com/9a13ecc88b5104893246f683c60a812e/b8f018caf5076b2e-46/s1280x1920/33d8d72a5e04d6f94c10ab6a30c11105c26181e3.jpg" alt="Darrell Steward">
            <h4 style="padding-top: 15px;">Revita Wulandari</h4>
            <p>Mahasiswa RMIK</p>
            <div class="social-icons">
              <a href="#"><i class="fa-brands fa-instagram"></i></a>
              <a href="#"><i class="fa-brands fa-facebook"></i></a>
              <a href="#"><i class="fa-brands fa-linkedin"></i></a>
            </div>
          </div>
          <div class="col-md-3 team-member" data-aos="fade-up">
            <img src="https://64.media.tumblr.com/9a13ecc88b5104893246f683c60a812e/b8f018caf5076b2e-46/s1280x1920/33d8d72a5e04d6f94c10ab6a30c11105c26181e3.jpg" alt="Fiony Alveria">
            <h4 style="padding-top: 15px;">Santi Prihantini</h4>
            <p>Mahasiswa RMIK</p>
            <div class="social-icons">
              <a href="#"><i class="fa-brands fa-instagram"></i></a>
              <a href="#"><i class="fa-brands fa-facebook"></i></a>
              <a href="#"><i class="fa-brands fa-linkedin"></i></a>
            </div>
          </div>
        </div>
      </div>
    </section>
    </header>
    <!-- Footer-->
    <aside style="background-color: #f8f9fa;">
    <footer class="text-center py-5">
      <div class="container px-5">
        <div class="text-black-100 small">
          <div class="mb-2">&copy; Your Website 2024. All Rights Reserved.</div>
          <a class="text-black" href="#!">Privacy</a>
          <span class="mx-1">&middot;</span>
          <a class="text-black" href="#!">Terms</a>
          <span class="mx-1">&middot;</span>
          <a class="text-black" href="#!">FAQ</a>
        </div>
      </div>
    </footer>
    </aside>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <!-- * *                               SB Forms JS                               * *-->
    <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
    <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
  </body>
</html>
