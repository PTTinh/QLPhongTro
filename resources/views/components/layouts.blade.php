<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('lib/bootstrap-5.3.3-dist/css/bootstrap.min.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>{{ $attributes['title'] }}</title>
</head>

<body>
    <header>
        <div class="container-xxl">
            <div class="row text-white" style="background-color: rgb(255, 119, 0); padding: 1rem;">
                <div class="col-1 d-flex d-lg-none align-items-center justify-content-center">
                    <button class="btn btn-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#Sidebar"
                        aria-controls="offcanvasWithBothOptions">
                        <i class='bx bx-menu'></i>
                    </button>
                </div>
                <div class="col-10 col-lg-9 d-flex align-items-center justify-content-center justify-content-lg-start">
                    <img src="https://anhcuoiviet.vn/wp-content/uploads/2022/11/avatar-dep-dang-yeu-nu-5.jpg"
                        alt="User Avatar" class="rounded-circle border border-primary ms-2 me-2" width="30" height="30">
                    <span class="d-none d-lg-flex">Admin</span>
                </div>
                <div class="col-lg-3 d-none d-lg-flex align-items-center justify-content-end">
                    <img src="https://anhcuoiviet.vn/wp-content/uploads/2022/11/avatar-dep-dang-yeu-nu-5.jpg"
                        alt="User Avatar" class="rounded-circle border border-primary ms-2 me-2" width="30" height="30">
                    <span>Admin</span>
                </div>
                <div class="col-1 d-flex d-lg-none align-items-center justify-content-center">
                    <span><i class='bx bx-cog'></i></span>
                </div>
            </div>
        </div>
    </header>
    <div class="container-xxl ">
        <div class="row">
            <aside class="col-lg-3">
                <div class="offcanvas-lg offcanvas-start" data-bs-scroll="true" tabindex="-1" id="Sidebar"
                    aria-labelledby="offcanvasWithBothOptionsLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="Sidebar">Quản lý Phòng Trọ</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"
                            data-bs-target="#Sidebar"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="nav flex-column bg-light p-2">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">
                                    Quản lý Phòng Trọ
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    Quản lý Khách Hàng
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    Quản lý Hợp Đồng
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </aside>
            <main class="col-lg-9">
                {{ $slot }}
            </main>
        </div>
    </div>
    <footer>

    </footer>
    <script src="{{ asset('lib/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js') }}"></script>
    {{ $script ?? '' }}
</body>

</html>
