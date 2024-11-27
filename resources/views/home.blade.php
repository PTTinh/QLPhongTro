<x-layouts title="Home">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Thêm Người Thuê</h1>
        <div class="btn-toolbar mb-2">
            <a href="#" class="btn btn-primary">
                <i class='bx bx-arrow-back me-2'></i>
                Quay lại
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#lessee">Người Thuê</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#contract">Hợp Đồng</a>
                </li>
            </ul>
        </div>
        <div class="col-12 mt-2 tab-content">
            {{-- Thông tin người thuê --}}
            <div class="tab-pane fade show active" id="lessee">
                <form action="#" class="row" method="post">
                    <div class="col-lg-6">
                        <x-app-input id="name" name="name" label="Tên Người Thuê"
                            placeholder="Nhập tên người thuê" required />
                        <x-app-input id="phone" name="phone" type="text" label="Số Điện Thoại"
                            placeholder="Nhập số điện thoại" required />
                        <x-app-input id="email" name="email" type="email" label="Email"
                            placeholder="Nhập email" required />
                        <x-app-input id="address" name="address" label="Địa Chỉ" placeholder="Nhập địa chỉ"
                            required />
                    </div>
                    <div class="col-lg-6">
                        <x-app-input id="occupation" name="occupation" label="Nghề Nghiệp"
                            placeholder="Nhập nghề nghiệp" required />
                        <x-app-input id="birth_year" name="birth_year" type="number" label="Năm Sinh"
                            placeholder="Nhập năm sinh" required />
                        <x-app-input id="number_cccd" name="number_cccd" type="text" label="Số CCCD"
                            placeholder="Nhập số CCCD" required />
                        <input type="file" name="cccd_front_image" id="cccd_front_image" class="form-control mb-3"
                            required>
                        <input type="file" name="cccd_back_image" id="cccd_back_image" class="form-control mb-3"
                            required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3 col-4 offset-4">
                        <i class='bx bx-save me-2'></i>
                        Lưu
                    </button>
                </form>
            </div>
            {{-- Thông tin hợp đồng --}}
            <div class="tab-pane fade" id="contract">
                <form action="#" class="row" method="post">
                    <div class="col-lg-6">
                        <x-app-input id="start_date" name="start_date" type="date" label="Ngày Bắt Đầu"
                            placeholder="Nhập ngày bắt đầu" required />
                        <x-app-input id="end_date" name="end_date" type="date" label="Ngày Kết Thúc"
                            placeholder="Nhập ngày kết thúc" required />
                        <x-app-input id="month" name="month" type="number" label="Số Tháng"
                            placeholder="Nhập số tháng" required />
                    </div>
                    <div class="col-lg-6">
                        <x-app-input id="price_eletric" name="price_eletric" type="number" label="Giá Điện"
                            placeholder="Nhập giá điện" required />
                        <x-app-input id="price_water" name="price_water" type="number" label="Giá Nước"
                            placeholder="Nhập giá nước" required />
                        <x-app-input id="other_fee" name="other_fee" type="number" label="Phí Khác"
                            placeholder="Nhập phí khác" required />
                    </div>
                    <button type="submit" class="btn btn-primary mt-3 col-4 offset-4">
                        <i class='bx bx-save me-2'></i>
                        Lưu
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layouts>
