<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- fontaswesome -->
    <link
      rel="stylesheet"
      href="src/fontawesome-free-6.6.0-web/css/all.min.css"
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
  <body dir="rtl">
    <div class="login-container">
      <div class="login-box">
        <div class="header">
          <h3>تسجيل دخول</h3>
        </div>
        <div class="content">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="input-box" style="margin-bottom: 10px;">
                    <input type="text" name="email" placeholder=" " required />
                    <span class="">رقم المستخدم - الايميل</span>
                    <span></span>
                </div>
                <div class="input-box" style="margin-bottom: 10px;margin-top: 10px;">
                    <input type="password" name="password" placeholder=" " required />
                    <span>كلمة المرور</span>
                    <span></span>
                </div>
                <div class="input-box">
                    <button type="submit">تسجيل دخول</button>
                    <div>
                        <a href="{{ route('password.request') }}">نسيت كلمة المرور؟</a>
                    </div>
                </div>
            </form>
            
      </div>
      <div class="login-box register-box">
        <span class="close">+</span>
        <div class="header">
          <h3>انشاء حساب</h3>
        </div>
        <div class="content">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div style="display: flex; gap: 20px; margin-bottom: 20px;">
                    <div class="input-box" style="flex: 1;">
                        <input type="text" name="name" id="name" placeholder="" required />
                        <span>اسم المستخدم</span>
                        <span></span>
                    </div>
                    <div class="input-box" style="flex: 1;">
                        <input type="email" name="email" id="email" placeholder="" required />
                        <span>البريد الإلكتروني</span>
                        <span></span>
                    </div>
                </div>
                <div style="display: flex; gap: 20px; margin-bottom: 20px;">
                    <div class="input-box" style="flex: 1;">
                        <input type="text" name="phone_number" id="phoneNumber" placeholder="" required />
                        <span>رقم الهاتف</span>
                        <span></span>
                    </div>
                    <div class="input-box" style="flex: 1;">
                        <input type="text" name="address" id="address" placeholder="" required />
                        <span>العنوان</span>
                        <span></span>
                    </div>
                </div>
                <div class="input-box" style="margin-bottom: 10px; margin-top: 10px;">
                    <select class="select" name="role_id" id="type" required>
                        <option selected disabled hidden>نوع الحساب</option>
                        <option value="2">مقدم خدمة</option>
                        <option value="3">حساب عميل</option>
                    </select>
                    <span></span>
                </div>
                <div class="input-box" style="margin-bottom: 10px; margin-top: 10px;">
                    <input type="password" name="password" id="password" placeholder="" required />
                    <span>كلمة السر</span>
                    <span></span>
                </div>
                <div class="input-box" style="margin-bottom: 10px; margin-top: 10px;">
                    <input type="password" name="password_confirmation" id="confPassword" placeholder="" required />
                    <span>إعادة كلمة السر</span>
                    <span></span>
                </div>
                <div class="input-box" style="margin-bottom: 10px; margin-top: 10px;">
                    <button type="submit">إنشاء حساب جديد</button>
                </div>
            </form>
            
        </div>
        
      </div>
    </div>
  </body>
  <script src="src/js/register.js"></script>
</html>
