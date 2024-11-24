<x-layouts title="Chi Tiết Hợp Đồng">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $title }}</h1>
        <div class="btn-toolbar mb-2">
            <a class="btn btn-primary" href="{{ route('contract-details.create') }}">
                <i class='bx bx-plus me-2'></i>
                Thêm Chi Tiết Hợp Đồng
            </a>
        </div>
    </div>
    <div class="table small">
        <table class="table table-striped table-sm border-2">
            <thead class="table-dark">
                <tr class="text-center">
                    <th scope="col" class="text-truncate" style="max-width: 100px;">TT</th>
                    <th scope="col" class="text-truncate" style="max-width: 100px;">Tên người thuê</th>
                    <th scope="col" class="text-truncate" style="max-width: 100px;">Phòng</th>
                    <th scope="col" class="text-truncate" style="max-width: 100px;">Ngày bắt đầu</th>
                    <th scope="col" class="text-truncate" style="max-width: 100px;">Ngày kết thúc</th>
                    <th scope="col" class="text-truncate" style="max-width: 100px;">Tình trạng</th>
                    <th scope="col" class="text-truncate" style="max-width: 100px;">Thao tác</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($contractDetails as $contractDetail)
                    <tr class="text-center">
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $contractDetail->lessee->name }}</td>
                        <td>{{ $contractDetail->room->name }}</td>
                        <td>{{ $contractDetail->contract->start_date }}</td>
                        <td>{{ $contractDetail->contract->end_date }}</td>
                        <td>{{ $contractDetail->is_signed ? 'Đã ký' : 'Chưa ký' }}</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="{{ route('contract-details.edit', $contractDetail->id) }}">
                                <i class='bx bx-edit'></i>
                            </a>
                            <form action="{{ route('contract-details.destroy', $contractDetail->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">
                                    <i class='bx bx-trash'></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layouts>
