<!DOCTYPE html>
<html lang="ar">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- fontawesome -->
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
    <title>تواصل معنا</title>
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
                color: #fff;
            }
        </style>
    @endif
    <header class="header container">
        <div class="header--links">
            <div class="links-shower"><i class="fa-solid fa-bars"></i></div>
            <div class="links-holder">
                <span><i class="fa-solid fa-xmark"></i></span>
                <a href="{{ route('home') }}" class="link">الصفحة الرئيسية</a>
                <a href="{{ route('about') }}" class="link">من نحن</a>
                <a href="{{ route('contact') }}" class="link active">تواصل معنا</a>
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
        <span class="text">تواصل معنا</span>
      </article>

      <section class="contact-form mt-5 text-center">
        <h2 class="section-title mb-5 primery-bg p-2 rounded-3">اتصل بنا</h2>
        <p class="section-text">
          نسعد بتواصلكم معنا للإجابة عن استفساراتكم أو لتقديم الدعم. يمكنكم التواصل
          معنا عبر النموذج أدناه أو الاتصال بنا مباشرة.
        </p>
        <form class="d-flex flex-column align-items-center" method="POST" action="{{ route('contact.store') }}">
          @csrf
      
          <div class="mb-3 w-50">
              <label for="name" class="form-label">الاسم الكامل</label>
              <input
                  type="text"
                  class="form-control"
                  id="name"
                  name="name"
                  value="{{ auth()->check() ? auth()->user()->name : old('name') }}"
                  placeholder="أدخل اسمك الكامل"
                  {{ auth()->check() ? 'readonly' : '' }}
                  required
              />
          </div>
      
          <!-- حقل البريد الإلكتروني -->
          <div class="mb-3 w-50">
              <label for="email" class="form-label">البريد الإلكتروني</label>
              <input
                  type="email"
                  class="form-control"
                  id="email"
                  name="email"
                  value="{{ auth()->check() ? auth()->user()->email : old('email') }}"
                  placeholder="أدخل بريدك الإلكتروني"
                  {{ auth()->check() ? 'readonly' : '' }}
                  required
              />
          </div>
      
          <div class="mb-3 w-50">
              <label for="message" class="form-label">رسالتك</label>
              <textarea
                  class="form-control"
                  id="message"
                  name="message"
                  rows="4"
                  placeholder="أدخل رسالتك هنا"
                  required>{{ old('message') }}</textarea>
          </div>
      
          <button type="submit" class="btn btn-primary">إرسال</button>
      </form>
      
      </section>

      <section class="contact-info mt-5 d-flex align-items-center flex-column">
        <h2 class="section-title mb-5 primery-bg p-2 rounded-3">معلومات التواصل</h2>
        <p class="section-text">
          <strong>العنوان:</strong> ليبيا
        </p>
        <p class="section-text">
          <strong>الهاتف:</strong> 091 234 56 78 
        </p>
        <p class="section-text">
          <strong>البريد الإلكتروني:</strong> info@company.com
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

    <script src="src/js/main.js"></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
