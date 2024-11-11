<!DOCTYPE html>
<html lang="ar">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- fontaswesome -->
    <link
      rel="stylesheet"
      href="../src/fontawesome-free-6.6.0-web/css/all.min.css"
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
    <link rel="stylesheet" href="../src/style/main.min.css" />
    <title>gate</title>
  </head>
  <body dir="rtl" class="main">
    <header class="header container">
      <div class="header--links">
        <div class="links-shower"><i class="fa-solid fa-bars"></i></div>
        <div class="links-holder">
          <span><i class="fa-solid fa-xmark"></i></span>
          <a href="{{ route('users') }}" class="link">المستخدمين</a>
          <a href="{{ route('freelancers') }}" class="link">المستقلين</a>
          <a href="{{ route('admin.home') }}" class="link">مسؤولين النظام</a> 
          <a href="{{ route('contact.index') }}" class="link active"> الاراء</a>
          <a href="{{ route('orderDetails') }}" class="link">ادارة الخدمات</a>

        </div>
      </div>
      @auth
      <div class="header--content">
        <button type="button" class="sign-out" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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
    <main>
      <article class="backview">
        <img src="../src/assets/images/backview.jpg" alt="" class="image" />
        <span class="text">  اراء الزوار و الزبائن</span>
      </article>
    
      <article class="projects-section container">
        <h1 class="title">آراء الزوار و الزبائن</h1>
        <div class="projects-holder">
            <table class="rwd-table">
                <thead>
                    <tr>
                        <th>الاسم</th>
                        <th>البريد الإلكتروني</th>
                        <th>الرسالة</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $review)
                    <tr>
                        <td data-th="اسم الزبون">{{ $review->name }}</td>
                        <td data-th="البريد الإلكتروني">{{ $review->email }}</td>
                        <td data-th="الرسالة">{{ $review->message }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </article>
    
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
  <script src="../src/js/freelancer.js"></script>
  <!-- bootstrap -->
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"
  ></script>
</html>
