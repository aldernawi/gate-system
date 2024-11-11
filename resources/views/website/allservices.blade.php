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
    <link rel="stylesheet" href={{ asset('src/style/main.min.css') }} />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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
                <a href="{{ route('about') }}" class="link">من نحن</a>
                <a href="{{ route('contact') }}" class="link">تواصل معنا</a>
                <a href="{{ route('allServices') }}" class="link active">الخدمات</a>
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
    <main>
      <article class="backview">
        <img src="src/assets/images/backview.jpg" alt="" class="image" />
        <span class="text">كل الخدمات في مكان واحد</span>
      </article>
      <article class="filter-section">
        <div class="article-title">
          <h1 class="title">الخدمات</h1>
        </div>
        <div class="filters-holder container">
          <div class="search-container">
            <form class="">
              <input id="search-box" type="text" class="search-box" name="q" />
              <label for="search-box">
                <i class="fa-solid fa-magnifying-glass search-icon"></i>
              </label>
            </form>
          </div>
        </div>
      </article>
      <article class="works-section container">
        <div class="cards-holder">
            @foreach ($services as $service)
                <div class="card">
                    <div class="card-header">
                        <div class="customer-info">
                            <img src="{{ asset('src/assets/images/user.jpg') }}" alt=""
                                class="customer-photo" />
                            <h4 class="customer-name">{{ $service->user->name }}</h4>
                        </div>
                    </div>
                    <div class="deadline"></div>
                    <div class="task-desc">
                        <h3 class="title"> {{ $service->name }} </h3>
                        <span class="desc">
                            {{ $service->description }}
                        </span>
                    </div>
                    <div class="task-info">
                        <div class="location">
                        </div>
                        <button class="submit " data-service-id="{{ $service->id }}"
                          data-user-id="{{ $service->user_id }}">احجز الآن</button>

                    </div>
                    
                </div>
            @endforeach
        </div>
    </article>
    <script>
      $(document).ready(function() {
          $('.submit').on('click', function() {
              var serviceId = $(this).data('service-id');
              var companyId = $(this).data('user-id');
              showBookingForm(serviceId, companyId);
          });
  
          function showBookingForm(serviceId, companyId) {
              @if (auth()->check())
                  Swal.fire({
                      title: 'طلب الخدمة',
                      html: `
                      <div class="bg-white p-8 rounded-md w-96">
                          <form id="bookingForm">
                              <input type="hidden" id="service_id" value="${serviceId}">
                              <input type="hidden" id="owner_id" value="${companyId}">
                              <div>
                                  <label for="title">عنوان الطلب:</label>
                                  <input type="text" id="title" class="form-control w-full" name="title">
                              </div>
                              <div>
                                  <label for="des">وصف الطلب:</label>
                                  <input type="text" id="des" class="form-control w-full" name="des">
                              </div>
                              <div>
                                  <label for="delivery_date">تاريخ التسليم المطلوب:</label>
                                  <input type="date" id="delivery_date" class="form-control w-full" name="delivery_date">
                              </div>
                              <button type="submit" class="btn btn-primary w-full mt-3">إرسال الطلب</button>
                              <button type="button" class="btn btn-outline-primary w-full mt-3" onclick="Swal.close()">إغلاق</button>
                          </form>
                      </div>
                      `,
                      showConfirmButton: false,
                      didOpen: function() {
                          $('#bookingForm').on('submit', function(event) {
                              event.preventDefault();
  
                              var serviceId = $('#service_id').val();
                              var ownerId = $('#owner_id').val();
                              var title = $('#title').val();
                              var des = $('#des').val();
                              var deliveryDate = $('#delivery_date').val();
  
                              // التحقق من القيم
                              console.log("Title: " + title);
                              console.log("Description (des): " + des);
                              console.log("Delivery Date: " + deliveryDate);
  
                              // التحقق من الحقول المدخلة
                              if (!title.trim() || !des.trim() || !deliveryDate) {
                                  Swal.fire({
                                      icon: 'warning',
                                      title: 'يرجى تعبئة جميع الحقول قبل الإرسال.',
                                  });
                                  return;
                              }
  
                              fetch('{{ route('booking.store') }}', {
                                  method: 'POST',
                                  headers: {
                                      'Content-Type': 'application/json',
                                      'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                  },
                                  body: JSON.stringify({
                                      service_id: serviceId,
                                      owner_id: ownerId,
                                      title: title,
                                      des: des,  // إرسال الحقل الجديد
                                      delivery_date: deliveryDate
                                  })
                              })
                              .then(response => response.json())
                              .then(data => {
                                  if (data.success) {
                                      Swal.fire({
                                          icon: 'success',
                                          title: 'تم إرسال الطلب بنجاح',
                                          text: data.message,
                                          showConfirmButton: false,
                                          timer: 2000,
                                      });
                                  } else {
                                      Swal.fire({
                                          icon: 'error',
                                          title: 'حدث خطأ',
                                          text: data.error || 'يرجى المحاولة لاحقاً.',
                                      });
                                  }
                              })
                              .catch(error => {
                                  Swal.fire({
                                      icon: 'error',
                                      title: 'حدث خطأ',
                                      text: error.message,
                                  });
                              });
                          });
                      }
                  });
              @endif
          }
      });
  </script>
  
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
