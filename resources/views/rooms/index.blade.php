<x-layouts title="Quản lý Phòng Trọ">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Quản lý Phòng Trọ</h1>
        <div class="btn-toolbar mb-2">
            <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#AddRoomModal">
                Thêm Phòng
            </button>
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
                <tr class="text-center">
                    <th scope="row">1</th>
                    <td>Phòng 1</td>
                    <td>20m2</td>
                    <td>15m2</td>
                    <td>2</td>
                    <td>1.000.000</td>
                    <td>Đã Thuê</td>
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
            </tbody>
        </table>
    </div>
</x-layouts>
