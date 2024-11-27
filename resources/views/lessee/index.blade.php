<x-layouts title="Quản lý Người Thuê">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $title }}</h1>
        <div class="btn-toolbar mb-2">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addLesseeModal">
                <i class='bx bx-plus me-2'></i>
                Thêm Người Thuê
            </button>
        </div>
    </div>
    <div class="table small">
        <table class="table table-striped table-sm border-2">
            <thead class="table-dark">
                <tr class="text-center">
                    <th scope="col" class="text-truncate" style="max-width: 100px;">TT</th>
                    <th scope="col" class="text-truncate" style="max-width: 100px;">Tên người thuê</th>
                    <th scope="col" class="text-truncate" style="max-width: 100px;">Số điện thoại</th>
                    <th scope="col" class="text-truncate" style="max-width: 100px;">Email</th>
                    <th scope="col" class="text-truncate" style="max-width: 100px;">Địa chỉ</th>
                    <th scope="col" class="text-truncate" style="max-width: 100px;">Thao tác</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($lessees as $lessee)
                    <tr class="text-center">
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td title="{{ $lessee->name }}" class="text-truncate" style="max-width: 100px;">{{ $lessee->name }}</td>
                        <td>{{ $lessee->phone }}</td>
                        <td>{{ $lessee->email }}</td>
                        <td title="{{ $lessee->address }}" class="text-truncate" style="max-width: 100px;">{{ $lessee->address }}</td>
                        <td>
                            <div class="d-none d-lg-flex justify-content-center gap-2">
                                <button class="btn btn-success js-show-edit-lessee" title="Sửa"
                                    data-id="{{ $lessee->id }}"
                                    data-urlGet="{{ route('lessees.edit', $lessee->id) }}"
                                    data-urlPut="{{ route('lessees.update', $lessee->id) }}">
                                    <i class='bx bx-show'></i>
                                </button>
                                <form action="{{ route('lessees.destroy', $lessee->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit" title="Xóa"
                                        onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">
                                        <i class='bx bx-trash'></i>
                                    </button>
                                </form>
                            </div>
                            <div class="d-block d-lg-none">
                                <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class='bx bx-dots-horizontal-rounded'></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li class="d-flex align-items-center justify-content-center gap-1 ms-1 me-1">
                                        <button class="btn btn-success js-show-eidt-lessee" title="xem"
                                            data-id="{{ $lessee->id }}"
                                            data-urlGet="{{ route('lessees.edit', $lessee->id) }}"
                                            data-urlPut="{{ route('lessees.update', $lessee->id) }}">
                                            <i class='bx bx-show'></i>
                                        </button>
                                        <form action="{{ route('lessees.destroy', $lessee->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger ms-1" type="submit" title="Xóa"
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">
                                                <i class='bx bx-trash'></i>
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Modal Thêm Người Thuê -->
    <x-app-modal id="addLesseeModal" title="Thêm Người Thuê">
        <form action="{{ route('lessees.store') }}" method="POST">
            @csrf
            <div class="modal-body row">
                <div class="col-lg-6">
                    <x-app-input id="name" name="name" label="Tên Người Thuê" placeholder="Nhập tên người thuê" required />
                    <x-app-input id="phone" name="phone" type="text" label="Số Điện Thoại" placeholder="Nhập số điện thoại" required />
                    <x-app-input id="email" name="email" type="email" label="Email" placeholder="Nhập email" required />
                    <div class="mb-3">
                        <label for="address" class="form-label">Địa Chỉ</label>
                        <textarea class="form-control" id="address" name="address" rows="4" placeholder="Nhập địa chỉ"></textarea>
                    </div>
                </div>
                <div class="col-lg-6">
                    <x-app-input id="job" name="job" label="Nghề Nghiệp" placeholder="Nhập nghề nghiệp" required />
                    <x-app-input id="dob" name="dob" type="date" label="Ngày Sinh" placeholder="Nhập ngày sinh" required />
                    <x-app-input id="cccd_number" name="cccd_number" type="text" label="Số CCCD" placeholder="Nhập số CCCD" required />
                    <div class="mb-3">
                        <label for="cccd_front_image" class="form-label">Ảnh mặt trước CCCD</label>
                        <input type="file" class="form-control" id="cccd_front_image" name="cccd_front_image" >
                    </div>
                    <div class="mb-3">
                        <label for="cccd_back_image" class="form-label">Ảnh mặt sau CCCD</label>
                        <input type="file" class="form-control" id="cccd_back_image" name="cccd_back_image" >
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
        </form>
    </x-app-modal>
    
    <!-- Modal Sửa TT Người Thuê -->
    <x-app-modal id="showLesseeModal" title="Thông Tin Người Thuê">
        <form id="f-update-lessee" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-body row">
                <div class="col-lg-6">
                    <x-app-input id="name-update" name="name" label="Tên Người Thuê" placeholder="Nhập tên người thuê" required />
                    <x-app-input id="phone-update" name="phone" type="text" label="Số Điện Thoại" placeholder="Nhập số điện thoại" required />
                    <x-app-input id="email-update" name="email" type="email" label="Email" placeholder="Nhập email" required />
                    <div class="mb-3">
                        <label for="address-update" class="form-label">Địa Chỉ</label>
                        <textarea class="form-control" id="address-update" name="address" rows="4" placeholder="Nhập địa chỉ"></textarea>
                    </div>
                </div>
                <div class="col-lg-6">
                    <x-app-input id="job-update" name="job" label="Nghề Nghiệp" placeholder="Nhập nghề nghiệp" required />
                    <x-app-input id="dob-update" name="dob" type="date" label="Ngày Sinh" placeholder="Nhập ngày sinh" required />
                    <x-app-input id="cccd_number-update" name="cccd_number" type="text" label="Số CCCD" placeholder="Nhập số CCCD" required />
                    <div class="mb-3">
                        <label for="cccd_front_image-update" class="form-label">Ảnh mặt trước CCCD</label>
                        <img src="#" alt="cccd_front_image" class="img-fluid" id="cccd_front_image-update">
                        <input type="file" class="form-control" id="cccd_front_image-update" name="cccd_front_image" >
                    </div>
                    <div class="mb-3">
                        <label for="cccd_back_image-update" class="form-label">Ảnh mặt sau CCCD</label>
                        <img src="#" alt="cccd_back_image" class="img-fluid" id="cccd_back_image-update">
                        <input type="file" class="form-control" id="cccd_back_image-update" name="cccd_back_image" >
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
        </form>
    </x-app-modal>
    <x-slot:script>
        <script src="{{ asset('js/lessee.js') }}"></script>
    </x-slot:script>
</x-layouts>
