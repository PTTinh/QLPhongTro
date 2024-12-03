<x-layouts title="Quản lý Phòng Trọ">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $title }}</h1>
        <div class="btn-toolbar mb-2">

            <form action="{{ route('rooms.search') }}" method="post" class="d-flex">
                @csrf
                <div class="input-group me-2">
                    <span class="input-group-text" id="button-search">
                        <i class='bx bx-search'></i>
                    </span>
                    <input type="text" class="form-control" name="search" placeholder="Tìm kiếm phòng"
                        aria-label="Tìm kiếm phòng" aria-describedby="button-search">
                    <button class="btn btn-outline-secondary" type="submit">Tìm kiếm</button>
                </div>
            </form>
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
                        <td>{{ $room->capacity }} người</td>
                        <td>{{ number_format($room->price) }} VNĐ</td>
                        <td>{{ $room->status == 0 ? 'Còn trống' : 'Đã có hợp đồng' }}</td>
                        <td>
                            <div class="d-none d-lg-flex justify-content-center gap-2">
                                <button class="btn btn-primary js-edit-room" title="Sửa"
                                    data-id="{{ $room->id }}" data-urlGet="{{ route('rooms.edit', $room->id) }}"
                                    data-urlPut="{{ route('rooms.update', $room->id) }}">
                                    <i class='bx bx-edit'></i>
                                </button>
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
                                    <li class="d-flex align-items-center justify-content-center gap-1 ms-1 me-1">
                                        <button class="btn btn-primary js-edit-room" title="Sửa"
                                            data-id="{{ $room->id }}"
                                            data-urlGet="{{ route('rooms.edit', $room->id) }}"
                                            data-urlPut="{{ route('rooms.update', $room->id) }}">
                                            <i class='bx bx-edit'></i>
                                        </button>
                                        <form action="{{ route('rooms.destroy', $room->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit" title="Xóa"
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
    <!-- Modal Thêm Phòng -->
    <x-app-modal id="addRoomModal" title="Thêm Phòng">
        <form action="{{ route('rooms.store') }}" method="POST">
            @csrf
            <div class="modal-body row">
                <div class="col-lg-6">
                    <x-app-input id="name" type="text" name="name" label="Tên Phòng:"
                        placeholder="Nhập tên phòng" required />
                    <div class="mb-3">
                        <label for="area" class="form-label">Diện Tích</label>
                        <div class="input-group">
                            <input type="number" name="area" id="area" class="form-control"
                                placeholder="Nhập diện tích" required>
                            <span class="input-group-text">m<sup>2</sup></span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="usable_area" class="form-label">Diện Tích Sử Dụng</label>
                        <div class="input-group">
                            <input type="number" name="usable_area" id="usable_area" class="form-control"
                                placeholder="Nhập diện tích sử dụng" required>
                            <span class="input-group-text">m<sup>2</sup></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="price" class="form-label">Giá Phòng</label>
                        <div class="input-group">
                            <input type="number" name="price" id="price" class="form-control"
                                placeholder="Nhập giá phòng" required>
                            <span class="input-group-text">VNĐ</span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="capacity" class="form-label">Số Người Ở</label>
                        <div class="input-group">
                            <input type="number" name="capacity" id="capacity" class="form-control"
                                placeholder="Nhập số người ở" required>
                            <span class="input-group-text">Người</span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Mô tả</label>
                        <textarea name="description" id="description" class="form-control" rows="5"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </div>
        </form>
    </x-app-modal>
    {{-- Modal Sửa Phòng --}}
    <x-app-modal id="editRoomModal" title="Sửa Phòng">
        <form id="f-update-room" action="#" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-body row">
                <div class="col-lg-6">
                    <x-app-input id="name-update" type="text" name="name" label="Tên Phòng:"
                        placeholder="Nhập tên phòng" required />
                    <div class="mb-3">
                        <label for="area-update" class="form-label">Diện Tích</label>
                        <div class="input-group">
                            <input type="number" name="area" id="area-update" class="form-control"
                                placeholder="Nhập diện tích" required>
                            <span class="input-group-text">m<sup>2</sup></span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="usable_area-update" class="form-label">Diện Tích Sử Dụng</label>
                        <div class="input-group">
                            <input type="number" name="usable_area" id="usable_area-update" class="form-control"
                                placeholder="Nhập diện tích sử dụng" required>
                            <span class="input-group-text">m<sup>2</sup></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="price-update" class="form-label">Giá Phòng</label>
                        <div class="input-group">
                            <input type="number" name="price" id="price-update" class="form-control"
                                placeholder="Nhập giá phòng" required>
                            <span class="input-group-text">VNĐ</span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="capacity-update" class="form-label">Số Người Ở</label>
                        <div class="input-group">
                            <input type="number" name="capacity" id="capacity-update" class="form-control"
                                placeholder="Nhập số người ở" required>
                            <span class="input-group-text">Người</span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="description-update" class="form-label">Mô tả</label>
                        <textarea name="description" id="description-update" class="form-control" rows="5"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
            </div>
        </form>
    </x-app-modal>
    <x-slot:script>
        <script src="{{ asset('js/room.js') }}"></script>
    </x-slot>
</x-layouts>
