<x-layouts title="Quản lý Phòng Trọ">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $title }}</h1>
        <div class="btn-toolbar mb-2">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRoomModal">
                <i class='bx bx-plus me-2'></i>
                Thêm Phòng
            </button>
        </div>
    </div>
    <div class="table small">
        <table class="table table-striped table-sm border-2">
            <thead class="table-dark">
                <tr class="text-center">
                    <th scope="col" class="text-truncate" style="max-width: 100px;">TT</th>
                    <th scope="col" class="text-truncate" style="max-width: 100px;">Tên phòng</th>
                    <th scope="col" class="text-truncate" style="max-width: 100px;">Diện tích</th>
                    <th scope="col" class="text-truncate" style="max-width: 100px;">Diện tích dùng</th>
                    <th scope="col" class="text-truncate" style="max-width: 100px;">Số người ở</th>
                    <th scope="col" class="text-truncate" style="max-width: 100px;">Giá</th>
                    <th scope="col" class="text-truncate" style="max-width: 100px;">Trạng thái</th>
                    <th scope="col" class="text-truncate" style="max-width: 100px;">Thao tác</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($rooms as $room)
                    <tr class="text-center">
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $room->name }}</td>
                        <td>{{ $room->area }}m<sup>2</sup></td>
                        <td>{{ $room->usable_area }}m<sup>2</sup></td>
                        <td>{{ $room->capacity }}</td>
                        <td>{{ number_format($room->price) }} VNĐ</td>
                        <td>{{ isset($room->status) ? 'Còn trống' : 'Đã thuê' }}</td>
                        <td>
                            <div class="d-none d-lg-flex border-4 border-start justify-content-center gap-2">
                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addLesseeModal">
                                    <i class='bx bx-user-plus'></i> 
                                </button>
                                <a class="btn btn-warning" href="{{ route('rooms.edit', $room->id) }}"
                                    title="Sửa">
                                    <i class='bx bx-edit'></i>
                                </a>
                                <form action="{{ route('rooms.destroy', $room->id) }}" method="POST">
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
                                    <li class="d-flex align-items-center">
                                        <a class="btn btn-success ms-2" href="#" title="Thêm Người Thuê">
                                            <i class='bx bx-user-plus'></i>
                                        </a>
                                        <a class="btn btn-warning ms-1" href="{{ route('rooms.edit', $room->id) }}"
                                            title="Sửa">
                                            <i class='bx bx-edit'></i>
                                        </a>
                                        <form action="{{ route('rooms.destroy', $room->id) }}" method="POST">
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
        <!-- Modal -->
        <div class="modal fade" id="addRoomModal" tabindex="-1" aria-labelledby="addRoomModalLabel">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addRoomModalLabel">Thêm Phòng</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('rooms.store') }}" method="POST">
                            @csrf
                            <x-app-input id="name" name="name" label="Tên Phòng" placeholder="Nhập tên phòng"
                                required />
                            <x-app-input id="area" name="area" type="number" label="Diện Tích"
                                placeholder="Nhập diện tích" required />
                            <x-app-input id="usable_area" name="usable_area" type="number"
                                label="Diện Tích Sử Dụng" placeholder="Nhập diện tích sử dụng" required />
                            <x-app-input id="price" type="number" name="price" label="Giá Phòng"
                                placeholder="Nhập giá phòng" required />
                            <x-app-input id="capacity" type="number" name="capacity" label="Số Người Ở"
                                placeholder="Nhập số người ở" required />
                            <div class="mb-3">
                                <label for="description" class="form-label">Mô tả</label>
                                <textarea name="description" id="description" class="form-control" rows="5"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Thêm Phòng</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="addLesseeModal" tabindex="-1" aria-labelledby="addLesseeModalLabel">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addLesseeModalLabel">Thêm Người Thuê</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="#" method="POST">
                            @csrf
                            <x-app-input id="name" name="name" label="Tên Người Thuê"
                                placeholder="Nhập tên người thuê" required />
                            <x-app-input id="phone" name="phone" type="number" label="Số Điện Thoại"
                                placeholder="Nhập số điện thoại" required />
                            <x-app-input id="email" name="email" type="email" label="Email"
                                placeholder="Nhập email" />
                            <x-app-input id="address" name="address" label="Địa Chỉ" placeholder="Nhập địa chỉ"
                                required />
                            <x-app-input id="room_id" name="room_id" type="number" label="Phòng"
                                placeholder="Nhập phòng" required />
                            <button type="submit" class="btn btn-primary w-100">Thêm Người Thuê</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts>
