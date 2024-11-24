<x-layouts title="Quản lý Hợp Đồng">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $title }}</h1>
        <div class="btn-toolbar mb-2">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addContractModal">
                <i class='bx bx-plus me-2'></i>
                Thêm Hợp Đồng
            </button>
        </div>
    </div>
    <div class="table small">
        <table class="table table-striped table-sm border-2">
            <thead class="table-dark">
                <tr class="text-center">
                    <th scope="col">TT</th>
                    <th scope="col" class="text-truncate" style="max-width: 100px;">Tên người Tạo</th>
                    <th scope="col" class="text-truncate" style="max-width: 100px;">Ngày tạo</th>
                    <th scope="col" class="text-truncate" style="max-width: 100px;">Ngày bắt đầu</th>
                    <th scope="col" class="text-truncate" style="max-width: 100px;">Ngày kết thúc</th>
                    <th scope="col" class="text-truncate" style="max-width: 100px;">Thao tác</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($contracts as $contract)
                    <tr class="text-center">
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $contract->user->name }}</td>
                        <td>{{ $contract->created_at }}</td>
                        <td>{{ $contract->start_date }}</td>
                        <td>{{ $contract->end_date }}</td>
                        <td>
                            <div class="d-none d-lg-block border-4 border-start">
                                <form action="{{ route('contracts.destroy', $contract->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a class="btn btn-success" href="{{ route('contracts.show', $contract->id) }}" title="Xem">
                                        <i class='bx bx-show'></i>
                                    </a>
                                    <a class="btn btn-warning" href="{{ route('contracts.edit', $contract->id) }}" title="Sửa">
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
                                        <a class="btn btn-success" href="{{ route('contract-details.index', $contract->id) }}" title="Xem">
                                            <i class='bx bx-show'></i>
                                        </a>
                                        <a class="btn btn-warning ms-1" href="{{ route('contracts.edit', $contract->id) }}" title="Sửa">
                                            <i class='bx bx-edit'></i>
                                        </a>
                                        <form action="{{ route('contracts.destroy', $contract->id) }}" method="POST">
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
        <div class="modal fade" id="addContractModal" tabindex="-1" aria-labelledby="addContractModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addContractModalLabel">Thêm Hợp Đồng</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('contracts.store') }}" method="POST">
                            @include('include._error')
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <x-app-input id="start_date" name="start_date" type="date" label="Ngày Bắt Đầu" placeholder="Nhập ngày bắt đầu" required />
                                    <x-app-input id="end_date" name="end_date" type="date" label="Ngày Kết Thúc" placeholder="Nhập ngày kết thúc" required />
                                    <x-app-input id="month" name="month" type="number" label="Số Tháng" placeholder="Nhập số tháng" required />
                                </div>
                                <div class="col-lg-6">
                                    <x-app-input id="price_eletric" name="price_eletric" type="number" label="Giá Điện" placeholder="Nhập giá điện" required />
                                    <x-app-input id="price_water" name="price_water" type="number" label="Giá Nước" placeholder="Nhập giá nước" required />
                                    <x-app-input id="other_fees" name="other_fees" type="number" label="Phí Khác" placeholder="Nhập phí khác" required />
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3 col-4 offset-4">
                                <i class='bx bx-save me-2'></i>
                                Lưu
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts>