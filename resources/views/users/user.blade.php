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
    <header class="header container">
      <div class="header--links">
        <div class="links-shower"><i class="fa-solid fa-bars"></i></div>
        <div class="links-holder">
          <span><i class="fa-solid fa-xmark"></i></span>
          <a href="{{ route('users') }}" class="link active">المستخدمين</a>
          <a href="{{ route('freelancers') }}" class="link">المستقلين</a>
          <a href="{{ route('admin.home') }}" class="link">مسؤولين النظام</a> 
          <a href="{{ route('contact.index') }}" class="link"> الاراء</a>
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
    <main class="admin-pages">
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
      <article class="projects-section container">
        <div class="title links">
            <a href="{{ route('users') }}" class="link active">المستخدمين</a>
            <a href="{{ route('freelancers') }}" class="link">المستقلين</a>
            <a href="{{ route('admin.home') }}" class="link">مسؤولين النظام</a>

          <button class="btn create-new-user">انشاء مستخدم جديد</button>
        </div>
        <div class="projects-holder">
          <table class="rwd-table">
            <tr>
              <th>اسم المستخدم</th>
              <th>المدينة</th>
              <th>عدد الطلبات</th>
              <th>الاعدادات</th>
            </tr>
            @foreach ($users as $user)
            <tr>
              <td data-th="اسم الادمن">{{ $user->name }}</td>
              <td data-th="المدينة">{{ $user->address }}</td>
              <td data-th="عدد الطلبات">{{ $user->orders->count() }}</td>
              <td class="d-flex gap-2 justify-content-center dots">
                <i class="fa-solid fa-ellipsis-vertical dots-btn" 
                data-id="{{ $user->id }}" 
                data-name="{{ $user->name }}" 
                data-phone="{{ $user->phone_number }}" 
                data-email="{{ $user->email }}" 
                data-address="{{ $user->address }}" 
                data-role="{{ $user->role_id }}" 
                data-bs-toggle="modal" data-bs-target="#editUserModal"></i>
             
             <i class="fa-solid fa-trash delete-btn pointer" data-id="{{ $user->id }}"></i>
             
              </td>
            </tr>
          @endforeach
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
    <div class="delete-card">
      <h2 class="title">هل أنت متأكد من عملية المسح؟</h2>
     <div class="d-flex justify-content-center gap-4">
      <form id="delete-form" action="" method="POST" class="fit-content">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-primary">نعم</button>
    </form>
    <button class="btn cancel-delete-card red">إلغاء</button>
     </div>
  </div>
  
  <div class="edit-user">
    <form action="" method="POST" class="edit-user-form">
        @csrf
        @method('POST')
        <h2 class="title">تعديل بيانات المستخدم</h2>
      

            
            <div class="content add-service mb-4">
                <input type="text" name="name" placeholder="اسم المستخدم" id="name" class="field" value="{{ $user->name }}" required />
                
                <input type="text" name="phone_number" placeholder="رقم الهاتف" id="phoneNumber" class="field" value="{{ $user->phone_number }}" required />
                
                <input type="email" name="email" placeholder="البريد الإلكتروني" id="email" class="field" value="{{ $user->email }}" required />
                
                <!-- كلمة المرور ستبقى فارغة حتى يتم تحديثها من قبل المستخدم -->
                <input type="password" name="password" placeholder="كلمة المرور (اتركه فارغًا إذا لم ترغب في تغييره)" id="password" class="field" />                
                <input type="text" name="address" placeholder="العنوان" id="address" class="field" value="{{ $user->address }}" />
                
                <select name="role_id" id="type" class="field" required>
                    <option selected disabled hidden>نوع الحساب</option>
                    <option value="1" {{ $user->role_id == 1 ? 'selected' : '' }}> مدير النظام</option>
                    <option value="2" {{ $user->role_id == 2 ? 'selected' : '' }}> مقدم خدمة</option>
                    <option value="3" {{ $user->role_id == 3 ? 'selected' : '' }}> حساب عميل</option>
                </select>
            </div>
            
            <div class="add-service flex-row">
                <button type="submit" class="btn add">تحديث</button>
                <button type="button" class="btn cancel-dots-btn red" onclick="toggleEditUser()">إلغاء</button>
            </div>
        </form>
        
    </div>
    <!-- جافاسكريبت لإظهار وإخفاء النموذج -->
    <script>
       // كود التعديل
document.querySelectorAll('.dots-btn').forEach(button => {
    button.addEventListener('click', function() {
        const userId = this.getAttribute('data-id');
        const userName = this.getAttribute('data-name');
        const userPhone = this.getAttribute('data-phone');
        const userEmail = this.getAttribute('data-email');
        const userAddress = this.getAttribute('data-address');
        const userRole = this.getAttribute('data-role');
        
        // ملء الحقول في نموذج التعديل
        document.getElementById('name').value = userName;
        document.getElementById('phoneNumber').value = userPhone;
        document.getElementById('email').value = userEmail;
        document.getElementById('address').value = userAddress;
        document.getElementById('type').value = userRole;
        
        // تحديث مسار النموذج للتعديل
        document.querySelector('.edit-user-form').action = `/users/update/${userId}`;
    });
});


document.querySelectorAll('.delete-btn').forEach(button => {
    button.addEventListener('click', function() {
        const userId = this.getAttribute('data-id');
        
        const deleteForm = document.getElementById('delete-form');
        deleteForm.action = `/users/destroy/${userId}`;
        
        document.querySelector('.delete-card').style.display = 'block';
    });
});

document.querySelector('.cancel-delete-card').addEventListener('click', function() {
    document.querySelector('.delete-card').style.display = 'none';
});

    </script>
    
    <div class="create-user">
      <h2 class="title">انشاء مستخدم جديد</h2>
      <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="content add-service mb-4">
            <input type="text" name="name" placeholder="اسم المستخدم" id="name" class="field" required />
            
            <input type="text" name="phone_number" placeholder="رقم الهاتف" id="phoneNumber" class="field" required />
            
            <input type="email" name="email" placeholder="البريد الإلكتروني" id="email" class="field" required />
            
            <input type="password" name="password" placeholder="كلمة المرور" id="password" class="field" required />
            
            <input type="password" name="password_confirmation" placeholder="تأكيد كلمة المرور" id="password_confirmation" class="field" required />
            
            <input type="text" name="address" placeholder="العنوان" id="address" class="field" />
            
            <input type="hidden" name="role_id" value="3" />
                        
            <div class="add-service flex-row">
                <button type="submit" class="btn add">انشاء</button>
                <button class="btn cancel-create-user red">إلغاء</button>
              </div>
        </div>
    </form>
    
      
    </div>
    <span class="layout"></span>
  </body>
  <script src="../src/js/main.js"></script>
</html>
