<x-layouts title="Quản lý Người Thuê">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $title }}</h1>
        <div class="btn-toolbar mb-2">
            <a href="{{ route('lessees.create') }}" class="btn btn-primary">
                <i class='bx bx-plus me-2'></i>
                Thêm Người Thuê
            </a>
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
                    <th scope="col" class="text-truncate" style="max-width: 100px;">Nghề nghiệp</th>
                    <th scope="col" class="text-truncate" style="max-width: 100px;">Năm sinh</th>
                    <th scope="col" class="text-truncate" style="max-width: 100px;">Số CCCD</th>
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
                        <td>{{ $lessee->occupation }}</td>
                        <td>{{ $lessee->birth_year }}</td>
                        <td>{{ $lessee->cccd_number }}</td>
                        <td>
                            <div class="d-none d-lg-block border-4 border-start">
                                <form action="{{ route('lessees.destroy', $lessee->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a class="btn btn-warning" href="{{ route('lessees.edit', $lessee->id) }}"
                                        title="Sửa">
                                        <i class='bx bx-edit'></i>
                                    </a>
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
                                        <a class="btn btn-warning ms-1" href="{{ route('lessees.edit', $lessee->id) }}"
                                            title="Sửa">
                                            <i class='bx bx-edit'></i>
                                        </a>
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
</x-layouts>
