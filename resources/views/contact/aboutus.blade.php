<!DOCTYPE html>
<html lang="ar">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- fontaswesome -->
    <link
      rel="stylesheet"
      href="src/fontawesome-free-6.6.0-web/css/all.min.css"
    />
    <!-- bootstrap -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&family=Cairo:wght@200..1000&display=swap"
      rel="stylesheet"
    />
    <!-- main css file -->
    <link rel="stylesheet" href="src/style/main.min.css" />
    <title>gate</title>
  </head>
  <body dir="rtl" class="main">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'نجاح',
                text: '{{ session('success') }}', // عرض الرسالة من الجلسة
                confirmButtonText: 'حسنًا',
                customClass: {
                    confirmButton: 'confirm-button-custom'
                }
            });
        </script>

        <style>
            .confirm-button-custom {
                background-color: #0e95d5;
                /* لون الخلفية */
                color: #fff;
                /* لون النص */
            }
        </style>
    @endif
    <header class="header container">
        <div class="header--links">
            <div class="links-shower"><i class="fa-solid fa-bars"></i></div>
            <div class="links-holder">
                <span><i class="fa-solid fa-xmark"></i></span>
                <a href="{{ route('home') }}" class="link">الصفحة الرئيسية</a>
                <a href="{{ route('about') }}" class="link active">من نحن</a>
                <a href="{{ route('contact') }}" class="link">تواصل معنا</a>
                <a href="{{ route('allServices') }}" class="link">الخدمات</a>
            </div>
        </div>
        @auth
            <div class="header--content">
                <a href="{{ route('profile') }}" class="user"><img src={{ asset('src/assets/images/user.jpg') }}
                        class="logo" /></a>
                <button type="button" class="sign-out"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    تسجيل الخروج
                </button>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

            </div>
        @else
            <div class="header--content">
                <a href="{{ route('login') }}" class="sign-out">تسجيل الدخول</a>
            </div>
        @endauth
    </header>
    <main class="text-center">
        <article class="backview">
          <img src="src/assets/images/backview.jpg" alt="" class="image" />
          <span class="text">من نحن</span>
        </article>
        <section class="about-us mt-5 text-center">
          <p class="section-text ">
            نحن شركة رائدة في تقديم الخدمات الرقمية والحلول التكنولوجية، نعمل على
            توفير حلول مبتكرة ومتكاملة تلبي احتياجات السوق المتغيرة.
          </p>
        </section>
        <section class="mission mt-5 d-flex align-items-center flex-column">
          <h2 class="section-title mb-5 primery-bg p-2 rounded-3">مهمتنا</h2>
          <p class="section-text">
            مهمتنا هي تمكين الشركات والأفراد من تحقيق النجاح الرقمي من خلال تقديم
            خدمات تقنية مبتكرة وفعالة تساعدهم في التفوق في أعمالهم.
          </p>
        </section>
        <section class="vision mt-5 d-flex align-items-center flex-column">
          <h2 class="section-title mb-5 primery-bg p-2 rounded-3">رؤيتنا</h2>
          <p class="section-text">
            رؤيتنا هي أن نكون الرواد في تقديم حلول تقنية مبتكرة، تدعم تطور السوق
            الرقمي وتساهم في خلق قيمة طويلة الأجل لعملائنا وشركائنا.
          </p>
        </section>
      </main>
    <footer class="footer container">
      <div class="copy-rights">
        <i class="fa-regular fa-copyright"></i> كل الحقوق محفوظة
        <span class="year"></span>
      </div>
      <div class="social-meida">
        <a href=""><i class="fa-brands fa-facebook"></i></a>
        <a href=""><i class="fa-solid fa-at"></i></a>
        <a href=""><i class="fa-brands fa-whatsapp"></i></a>
      </div>
    </footer>
  </body>
  <script src="src/js/main.js"></script>
  <!-- bootstrap -->
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"
  ></script>
</html>
