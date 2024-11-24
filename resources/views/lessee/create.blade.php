<x-layouts>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Thêm Người Thuê</h1>
        <div class="btn-toolbar mb-2">
            <a href="{{ route('lessees.index') }}" class="btn btn-primary">
                <i class='bx bx-arrow-back me-2'></i>
                Quay lại
            </a>
        </div>
    </div>
    <form action="{{ route('lessees.store') }}" class="row" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            @include('include._error')
            <div class="col-lg-6">
                <x-app-input id="name" name="name" label="Tên Người Thuê" placeholder="Nhập tên người thuê"
                    required />
                <x-app-input id="phone" name="phone" type="text" label="Số Điện Thoại"
                    placeholder="Nhập số điện thoại" required />
                <x-app-input id="email" name="email" type="email" label="Email" placeholder="Nhập email"
                    required />
                <x-app-input id="address" name="address" label="Địa Chỉ" placeholder="Nhập địa chỉ" required />
            </div>
            <div class="col-lg-6">
                <x-app-input id="occupation" name="occupation" label="Nghề Nghiệp" placeholder="Nhập nghề nghiệp"
                    required />
                <x-app-input id="birth_year" name="birth_year" type="number" label="Năm Sinh"
                    placeholder="Nhập năm sinh" required />
                <x-app-input id="cccd_number" name="cccd_number" type="text" label="Số CCCD"
                    placeholder="Nhập số CCCD" required />
                <input type="file" name="cccd_front_image" id="cccd_front_image" class="form-control mb-3">
                <input type="file" name="cccd_back_image" id="cccd_back_image" class="form-control mb-3">
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3 col-4 offset-4">
            <i class='bx bx-save me-2'></i>
            Lưu
        </button>
    </form>
</x-layouts>
