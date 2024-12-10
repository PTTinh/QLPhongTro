<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('lib/bootstrap-5.3.3-dist/css/bootstrap.min.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <title>{{ $attributes['title'] }}</title>
</head>

<body>
    <header class="navbar sticky-top bg-primary flex-md-nowrap p-0 shadow" data-bs-theme="dark">
        <a class="navbar-brand col-lg-2 me-0 px-3 fs-6 text-white d-flex" href="#">
            <img src="https://anhcuoiviet.vn/wp-content/uploads/2022/11/avatar-dep-dang-yeu-nu-5.jpg" alt="User Avatar"
                class="rounded-circle border border-primary ms-2 me-2" width="30" height="30">
            <span>Admin</span>
        </a>
        <ul class="navbar-nav flex-row d-lg-none">
            <li class="nav-item text-nowrap">
                <button class="nav-link px-3 text-white" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class='bx bx-menu bx-flip-horizontal '></i>
                </button>
            </li>
        </ul>
    </header>
    <div class="container-fluid">
        <div class="row">
            @include('include._alert')
            <div class="sidebar border border-right d-md-none d-lg-block col-lg-2 p-0 bg-body-tertiary">
                <div class="offcanvas-lg offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu"
                    aria-labelledby="sidebarMenuLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="sidebarMenuLabel">
                            Quản lý Phòng Trọ
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                            data-bs-target="#sidebarMenu" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body d-flex flex-column p-0 pt-lg-3 overflow-y-auto">
                        <ul class="nav flex-column list-group">
                            <li class="nav-item">

                                <a class="list-group-item nav-link d-flex align-items-center gap-2 {{ request()->is('/') ? 'myactive' : '' }}"
                                    href="/">
                                    <i class='bx bx-pie-chart-alt-2'></i>
                                    Thông kê
                                </a>
                                <a class="list-group-item nav-link d-flex align-items-center gap-2 {{ request()->is('rooms') ? 'myactive' : '' }}"
                                    href="/rooms">
                                    <i class='bx bx-home'></i>
                                    Phòng
                                </a>
                                <a class="list-group-item nav-link d-flex align-items-center gap-2 {{ request()->is('lessees') ? 'myactive' : '' }}"
                                    href="/lessees">
                                    <i class='bx bx-user nav-icon'></i>
                                    Người Thuê
                                </a>
                                <a class="list-group-item nav-link d-flex align-items-center gap-2 {{ request()->is('contracts') ? 'myactive' : '' }}"
                                    href="/contracts">
                                    <i class='bx bx-file nav-icon'></i> 
                                    Hợp Đồng
                                </a>
                            </li>
                        </ul>

                        <hr class="my-3">

                        <ul class="list-group-item nav flex-column mb-auto list-group">
                            <li class="nav-item">
                                <form action="{{ route('logout') }}" method="GET">
                                    @csrf
                                    <button class="nav-link d-flex align-items-center gap-2" type="submit"
                                        onclick="return confirm('Bạn có chắc chắn muốn đăng xuất không?')">
                                        <i class='bx bx-door-open'></i>
                                        Đăng xuất
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <main class="ms-sm-auto col-lg-10">
                {{ $slot }}
            </main>
        </div>
    </div>
    <div class="container-fluid bg-light">
        <footer class="py-3 my-4 ">
            <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Home</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Features</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">Pricing</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">FAQs</a></li>
                <li class="nav-item"><a href="#" class="nav-link px-2 text-body-secondary">About</a></li>
            </ul>
            <p class="text-center text-body-secondary">&copy; 2024 Company, Inc</p>
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('lib/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js') }}"></script>
    {{ $script ?? '' }}
</body>

</html>
