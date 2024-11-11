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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('success'))
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
            background-color: #0e95d5; /* لون الخلفية */
            color: #fff; /* لون النص */
        }
    </style>
    @endif
    

<!-- باقي الكود الخاص بالنموذج والتعديل -->

    <header class="header container">
      <div class="header--links">
        <div class="links-shower"><i class="fa-solid fa-bars"></i></div>
        <div class="links-holder">
          <span><i class="fa-solid fa-xmark"></i></span>
          <a href="{{ route('order') }}" class="link">الطلبات</a>
          <a href="{{ route('services') }}" class="link active">الخدمات</a>
        </div>
      </div>
      @auth
      <div class="header--content">
        <a href="{{ route('profile') }}" class="user"
          ><img src={{ asset('src/assets/images/user.jpg') }} class="logo"
        /></a>
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
        <span class="text">زود اعمالك</span>
      </article>
      <article class="filter-section">
        <div class="article-title">
          <h1 class="title">اعمالك</h1>
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
      <div class="title links container">
        <a href="{{ route('order') }}" class="link">الطلبات</a>
        <a href="{{ route('services') }}" class="link active">الخدمات</a>
        <button class="link pointer create-service-btn">إضافة خدمة</button>
      </div>
      <div class="services-section cards-holder container">
        @foreach ($services as $service)
        <div class="card">
          <div class="card-header">
            <div class="customer-info">
              <img
                src="../src/assets/images/user.jpg"
                alt=""
                class="customer-photo"
              />
              <h4 class="customer-name">{{$service->user->name}}</h4>
            </div>
         
          </div>
          <div class="task-desc">
            <h3 class="title"> {{$service->name}} </h3>
            <span class="desc">
              {{$service->description}}
            </span>
          </div>
          <div class="task-info">
            <div class="location">
             
          </div>
          <div class="card-buttons">
            <i class="fa-solid fa-pen-to-square edit-card-btn pointer me-2" 
            data-id="{{ $service->id }}" 
            data-name="{{ $service->name }}" 
            data-description="{{ $service->description }}" 
            ></i>
         <i class="fa-solid fa-trash pointer delete-btn" data-id="{{ $service->id }}"></i>
        </div>
            </div>
                      </div>
        @endforeach  
        </div>
        </div>
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
    <div class="create-service">
      <h2 class="title">إضافة خدمة جديد</h2>
      <form action="{{ route('services.store') }}" method="POST" class="add-service">
          @csrf
          <input type="text" id="name" name="name" class="form-control feild" placeholder="اسم الخدمة"
              required>

          <textarea id="description" name="description" class="form-control feild" placeholder="الوصف" required></textarea>

          <button type="submit" class="btn add">إضافة</button>
          <button class="btn cancel-servic red">إلغاء</button>
      </form>
  </div>
  <div class="edit-card">
      <h2 class="title">تعديل الخدمة</h2>
      <form id="edit-service-form" action="" method="POST" class="add-service">
          @csrf
          @method('POST')
          <input type="text" id="edit-name" name="name" class="form-control feild" placeholder="اسم الخدمة"
              required>
          <textarea id="edit-description" name="description" class="form-control feild" placeholder="الوصف" required></textarea>

          <button type="submit" class="btn add">تعديل</button>
          <button type="button" class="btn cancel-edit-card red" id="cancelEdit">إلغاء</button>
      </form>
  </div>

  <script>
      document.querySelectorAll('.edit-card-btn').forEach(button => {
          button.addEventListener('click', function() {
              const serviceId = this.getAttribute('data-id');
              const serviceName = this.getAttribute('data-name');
              const serviceDescription = this.getAttribute('data-description');

              document.getElementById('edit-name').value = serviceName;
              document.getElementById('edit-description').value = serviceDescription;

              document.getElementById('edit-service-form').action = `/services/update/${serviceId}`;
          });
      });
  </script>

  <div class="delete-card">
      <h2 class="title">هل أنت متأكد من عملية المسح؟</h2>
    <div class="w-full d-flex justify-content-center gap-2">
      <form class="" id="delete-form" action="" method="POST">
        @csrf
        @method('DELETE')
        <button type="btn add submit" class="btn btn-primary">نعم</button>
    </form>
    <button class="btn cancel-delete-card red">إلغاء</button>
    </div>
  </div>

<script>
document.querySelectorAll('.delete-btn').forEach(button => {
button.addEventListener('click', function() {
    const serviceId = this.getAttribute('data-id');
    
    const deleteForm = document.getElementById('delete-form');
    deleteForm.action = `/services/destroy/${serviceId}`;

    document.querySelector('.delete-card').style.display = 'block';
});
});

document.querySelector('.cancel-delete-card').addEventListener('click', function() {
document.querySelector('.delete-card').style.display = 'none';
});
</script>

    <span class="layout"></span>
  </body>
  <script src="../src/js/main.js"></script>
  <!-- bootstrap -->
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"
  ></script>
</html>
