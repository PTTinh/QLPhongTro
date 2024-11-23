<x-layouts title="Quản lý Phòng Trọ">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $title }}</h1>
        <div class="btn-toolbar mb-2">
            <a href="{{ route('rooms.create') }}" class="btn btn-primary">
                <i class='bx bx-plus me-2'></i>
                Thêm Phòng
            </a>
        </div>
    </div>
    <div class="table small">
        <table class="table table-striped table-sm">
            <thead>
                <tr class="text-center">
                    <th scope="col">TT</th>
                    <th scope="col">Tên Phòng</th>
                    <th scope="col">Diện Tích</th>
                    <th scope="col">Diện Tích Sử Dụng</th>
                    <th scope="col">Số Người Ở</th>
                    <th scope="col">Giá Phòng</th>
                    <th scope="col">Trạng Thái</th>
                    <th scope="col">Thao Tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rooms as $room)
                    <tr class="text-center">
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $room->name }}</td>
                        <td>{{ $room->area }}</td>
                        <td>{{ $room->usable_area }}</td>
                        <td>{{ $room->capacity }}</td>
                        <td>{{ $room->price }}</td>
                        <td>{{ isset($room->status) ? 'Còn trống' : 'Đã thuê' }}</td>
                        <td>
                            <div class="d-none d-lg-block">
                                <a class="btn btn-success" href="#" title="Thêm Người Thuê">
                                    <i class='bx bx-user-plus'></i>
                                </a>
                                <a class="btn btn-warning" href="#" title="Sửa">
                                    <i class='bx bx-edit'></i>
                                </a>
                                <a class="btn btn-danger" href="#" title="Xóa">
                                    <i class='bx bx-trash'></i>
                                </a>
                            </div>
                            <div class="d-block d-lg-none">
                                <button class="btn btn-secondary" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class='bx bx-dots-horizontal-rounded'></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li class="d-flex align-items-center">
                                        <a class="btn btn-success ms-2" href="#" title="Thêm Người Thuê">
                                            <i class='bx bx-user-plus'></i>
                                        </a>
                                        <a class="btn btn-warning ms-1" href="#" title="Sửa">
                                            <i class='bx bx-edit'></i>
                                        </a>
                                        <a class="btn btn-danger ms-1" href="#" title="Xóa">
                                            <i class='bx bx-trash'></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layouts>
