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
        text: '{{ session('success') }}',
        confirmButtonText: 'حسنًا',
        customClass: {
            confirmButton: 'confirm-button-custom'
        }
    });
</script>

<style>
    .confirm-button-custom {
        background-color: #0e95d5; /* لون النص */
    }
</style>

@endif
    <header class="header container">
      <div class="header--links">
        <div class="links-shower"><i class="fa-solid fa-bars"></i></div>
        <div class="links-holder">
          <span><i class="fa-solid fa-xmark"></i></span>
          <a href="{{ route('home') }}" class="link active"> العودة</a>
        </div>
      </div>
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
    </header>
    <main>
      <article class="profile container">
        <div class="profile-header">
          <div class="profile-info justify-content-center">
            <h2 class="user-name"> {{ $user->name }}</h2>
             @if(auth()->user()->role_id == 2)
            <span class="projects">{{ $booking}} مشاريع منفدة</span>
          @endif
          </div>
          <img
            src="../src/assets/images/profile.jfif"
            alt=""
            class="profile-image"
          />
          <i class="fa-solid fa-pen-to-square edit-btn pointer"></i>
        </div>
        <h2 class="title">حجوزاتي</h2>
        @if(auth()->user()->role_id == 3)
        <div class="projects-section">
          <div class="projects-holder">
              <table class="rwd-table">
                  <tr>
                      <th>مقدم الخدمة</th>
                      <th>نوع الخدمة</th>
                      <th>حالة الخدمة</th>
                      <th>السعر</th> <!-- عمود السعر -->
                      <th>الإجراءات</th>
                  </tr>
                  @foreach ($bookings as $booking)
                  <tr>
                      <td>{{ $booking->owner->name }} </td>
                      <td>{{ $booking->service->name }} </td>
                      <td class="status">
                          @php
                              $statusLabel = '';
                              $statusClass = '';
                              switch ($booking->status) {
                                  case 'Accepted':
                                      $statusLabel = 'مقبول';
                                      $statusClass = 'bg-success';
                                      break;
                                  case 'Rejected':
                                      $statusLabel = 'مرفوض';
                                      $statusClass = 'bg-danger';
                                      break;
                                  case 'Canceled':
                                      $statusLabel = 'ملغي';
                                      $statusClass = 'bg-secondary';
                                      break;
                                  case 'Finished':
                                      $statusLabel = 'تم الإنجاز';
                                      $statusClass = 'bg-primary';
                                      break;
                                  case 'PriceSend':
                                      $statusLabel = 'تم إرسال السعر';
                                      $statusClass = 'bg-info';
                                      break;
                                  case 'Pending':
                                  default:
                                      $statusLabel = 'معلق';
                                      $statusClass = 'bg-warning';
                                      break;
                              }
                          @endphp
                          <span class="badge {{ $statusClass }}">
                              {{ $statusLabel }}
                          </span>
                      </td>
                      <td>
                          @if ($booking->status === 'PriceSend')
                          <strong>{{ $booking->price }} دينار</strong> <!-- عرض السعر -->
                          @else
                          <span>غير متوفر</span>
                          @endif
                      </td>
                      <td class="d-flex gap-2 justify-content-center">
                          @if ($booking->status === 'PriceSend')
                          <form action="{{ route('booking.accept', ['id' => $booking->id]) }}" method="POST" style="display:inline;">
                              @csrf
                              <button type="submit" class="btn btn-outline-success">قبول</button>
                          </form>
                          <form action="{{ route('booking.reject', ['id' => $booking->id]) }}" method="POST" style="display:inline;">
                              @csrf
                              <button type="submit" class="btn btn-outline-danger">رفض</button>
                          </form>
                          @elseif ($booking->status === 'Pending')
                          <form action="{{ route('booking.cancel', ['id' => $booking->id]) }}" method="POST" style="display:inline;">
                              @csrf
                              <button type="submit" class="btn btn-warning">إلغاء</button>
                          </form>
                          @endif
                      </td>
                  </tr>
                  @endforeach
              </table>
          </div>
      </div>
      @elseif(auth()->user()->role_id == 2)
      <div class="projects-section">
        <div class="projects-holder">
          <table class="rwd-table">
            <tr>
              <th>مقدم الخدمة</th>
              <th>طالب الخدمة</th>
              <th>نوع الخدمة</th>
              <th>حالةالخدمة</th>
              <th>الاجراءات</th>
            </tr>
            <tr>
              @foreach ($myorders as $order)
              <td>{{ $order->owner->name}} </td>
              <td>{{ $order->user->name}} </td>
              <td>{{ $order->service->name}} </td>
              <td class="status">
                @php
                    $statusLabel = '';
                    $statusClass = '';
                    switch ($order->status) {
                        case 'Accepted':
                            $statusLabel = 'مقبول';
                            $statusClass = 'bg-success';
                            break;
                        case 'Rejected':
                            $statusLabel = 'مرفوض';
                            $statusClass = 'bg-danger';
                            break;
                        case 'Canceled':
                            $statusLabel = 'ملغي';
                            $statusClass = 'bg-secondary';
                            break;
                        case 'Finished':
                            $statusLabel = 'منجز';
                            $statusClass = 'bg-primary';
                            break;
                        case 'Pending':
                        default:
                            $statusLabel = 'معلق';
                            $statusClass = 'bg-warning';
                            break;
                    }
                @endphp
                <span class="badge {{ $statusClass }}">
                    {{ $statusLabel }}
                </span>
            </td>
              <td class="d-flex gap-2 justify-content-center dots">
                @if ($order->status === 'Pending')
                <form action="{{ route('order.cancel', ['id' => $order->id]) }}" method="POST" style="display:inline;">
                  @csrf
                  <button type="submit" class="btn btn-warning">إلغاء</button>
              </form>
                @endif
              </td>
            </tr>
            @endforeach
          </table>
        </div>
      </div>
      @endif
      
        <h2 class="title">طلباتي</h2>
        @if(auth()->user()->role_id == 2)
        <div class="projects-section">
          <div class="projects-holder">
              <table class="rwd-table">
                  <tr>
                      <th>طالب الخدمة</th>
                      <th>عنوان الخدمة</th>
                      <th>نوع الخدمة</th>
                      <th>حالة الخدمة</th>
                      <th>الإجراءات</th>
                  </tr>
                  @foreach ($mybookings as $order)
                  <tr>
                    <td>{{ $order->user->name }} </td>
                    <td>{{ $order->title}} </td>
                      <td>{{ $order->service->name }} </td>
                      <td class="status">
                          @php
                              $statusLabel = '';
                              $statusClass = '';
                              switch ($order->status) {
                                  case 'Accepted':
                                      $statusLabel = 'مقبول';
                                      $statusClass = 'bg-success';
                                      break;
                                  case 'Rejected':
                                      $statusLabel = 'مرفوض';
                                      $statusClass = 'bg-danger';
                                      break;
                                  case 'Canceled':
                                      $statusLabel = 'ملغي';
                                      $statusClass = 'bg-secondary';
                                      break;
                                  case 'Finished':
                                      $statusLabel = 'منجز';
                                      $statusClass = 'bg-primary';
                                      break;
                                  case 'PriceSend':
                                      $statusLabel = 'تم إرسال السعر';
                                      $statusClass = 'bg-info';
                                      break;
                                  case 'Pending':
                                  default:
                                      $statusLabel = 'معلق';
                                      $statusClass = 'bg-warning';
                                      break;
                              }
                          @endphp
                          <span class="badge {{ $statusClass }}">
                              {{ $statusLabel }}
                          </span>
                      </td>
                      <td class="d-flex gap-2 justify-content-center">
                          @if ($order->status === 'Pending' && is_null($order->price))
                          <!-- نموذج لإدخال السعر -->
                          <form action="{{ route('booking.respond', ['bookingId' => $order->id]) }}" method="POST" class="form-inline" style="display: inline;">
                              @csrf
                              <div class="form-group">
                                  <input type="number" name="price" class="form-control" placeholder="أدخل السعر" required>
                              </div>
                              <button type="submit" class="btn btn-primary">إرسال السعر</button>
                          </form>
                          @elseif ($order->status === 'PriceSend')
                          <form action="{{ route('booking.cancel', ['id' => $order->id]) }}" method="POST" style="display:inline;">
                              @csrf
                              <button type="submit" class="btn btn-outline-white text-white" style="background-color: rgb(255, 0, 0); color: white; border-radius: 10px">الغاء</button>
                          </form>
                      
                          @elseif ($order->status === 'Accepted')
                          <form action="{{ route('booking.finish', ['id' => $order->id]) }}" method="POST" style="display:inline;">
                              @csrf
                              <button type="submit" class="btn btn-success" style="background-color: rgb(0, 110, 29); color: white; border-radius: 10px">منجز</button>
                          </form>
                          @endif
                      </td>
                  </tr>
                  @endforeach
              </table>
          </div>
      </div>
      @else
      <div class="projects-section">
        <div class="projects-holder">
          <table class="rwd-table">
            <tr>
              <th>مقدم الخدمة</th>
              <th>طالب الخدمة</th>
              <th>نوع الخدمة</th>
              <th>حالةالخدمة</th>
              <th>الاجراءات</th>
            </tr>
            <tr>
              @foreach ($orders as $order)
              <td>{{ $order->owner->name}} </td>
              <td>{{ $order->user->name}} </td>
              <td>{{ $order->service->name}} </td>
              <td class="status">
                @php
                    $statusLabel = '';
                    $statusClass = '';
                    switch ($order->status) {
                        case 'Accepted':
                            $statusLabel = 'مقبول';
                            $statusClass = 'bg-success';
                            break;
                        case 'Rejected':
                            $statusLabel = 'مرفوض';
                            $statusClass = 'bg-danger';
                            break;
                            case 'Canceled':
                            $statusLabel = 'ملغي';
                            $statusClass = 'bg-secondary';
                            break;
                            case 'Finished':
                            $statusLabel = 'منجز';
                            $statusClass = 'bg-primary';
                            break;
                        case 'Pending':
                        default:
                            $statusLabel = 'معلق';
                            $statusClass = 'bg-warning';
                            break;
                    }
                @endphp
                <span class="badge {{ $statusClass }}">
                    {{ $statusLabel }}
                </span>
            </td>
              <td class="d-flex gap-2 justify-content-center">
                @if ($order->status === 'Pending')
                <form action="{{ route('order.accept', ['id' => $order->id]) }}" method="POST" style="display:inline;">
                  @csrf
                  <button type="submit" class="btn btn-outline-white text-white" style="background-color: green">قبول</button>
              </form>
              
              <form action="{{ route('order.reject', ['id' => $order->id]) }}" method="POST" style="display:inline;">
                  @csrf
                  <button type="submit" class="btn btn-danger">رفض</button>
              </form>
           
              @endif
              </td>
            </tr>
            @endforeach
          </table>
        </div>
      </div>
      @endif


      
      </article>
    </main>
    <form class="edit-header" action="{{ route('profile.update', auth()->user()->id) }}" method="POST">
      @csrf
      <h2 class="title">تعديل المعلومات الشخصية</h2>
      <div class="add-service">
          <input type="text" id="name" name="name" placeholder="الإسم" class="field" value="{{ auth()->user()->name }}" />
          <input type="email" id="email" name="email" placeholder="الإيميل" class="field" value="{{ auth()->user()->email }}" />
          <input type="password" id="password" name="password" placeholder="كلمة المرور" class="field" />
          <input type="number" id="phone_number" name="phone_number" placeholder="رقم الهاتف" class="field" value="{{ auth()->user()->phone_number }}" />
          <input type="text" id="address" name="address" placeholder="العنوان" class="field" value="{{ auth()->user()->address }}" />
          <button type="submit" class="btn add">تعديل</button>
          <button type="button" class="btn cancel-edit red">إلغاء</button>
      </div>
  </form>
  
    <div class="edit-card">
      <h2 class="title">تعديل المعلومات البطاقة</h2>
      <div class="add-service">
        <select class="form-select field">
          <option value="" selected disabled hidden>نوع الخدمة</option>
          <option>1</option>
        </select>
        <textarea id="desc" placeholder="وصف الخدمة" class="field"></textarea>
        <select class="form-select field">
          <option value="" selected disabled hidden>مكان الخدمة</option>
          <option>1</option>
        </select>
        <button class="btn add">إضافة</button>
        <button class="btn cancel-edit-card red">إلغاء</button>
      </div>
    </div>
    <span class="layout"></span>
  </body>
  <script src="../src/js/main.js"></script>
</html>
