<x-layouts title="Chi Tiết Hợp Đồng">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $title }}</h1>
        <div class="btn-toolbar mb-2">
            <a class="btn btn-primary" href="{{ route('contracts.index') }}">
                <i class='bx bx-arrow-back me-2'></i>
                Quay Lại
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#lessee" onclick="document.getElementById('addLesseeButton').style.display = 'block';">Người Tham Gia</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#contract" onclick="document.getElementById('addLesseeButton').style.display = 'none';">Hợp Đồng</a>
                </li>
                <li class="nav-item ms-auto">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addLesseeModal" id="addLesseeButton" style="display: block;">
                        <i class='bx bx-user-plus me-2'></i> Thêm Người
                    </button>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-12 mt-2 tab-content">
        {{-- Thông tin người thuê --}}
        <div class="tab-pane fade show active" id="lessee">
            <div class="mt-3 table small">
                <table class="table table-striped table-sm border-2">
                    <thead class="table-dark">
                        <tr class="text-center">
                            <th scope="col" class="text-truncate" style="max-width: 100px;">TT</th>
                            <th scope="col" class="text-truncate" style="max-width: 100px;">Tên người thuê</th>
                            <th scope="col" class="text-truncate" style="max-width: 100px;">Số điện thoại</th>
                            <th scope="col" class="text-truncate" style="max-width: 100px;">Email</th>
                            <th scope="col" class="text-truncate" style="max-width: 100px;">Trạng thái</th>
                            <th scope="col" class="text-truncate" style="max-width: 100px;">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($contractDetails as $contractDetail)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $contractDetail->lessee->name }}</td>
                                <td>{{ $contractDetail->lessee->phone }}</td>
                                <td>{{ $contractDetail->lessee->email }}</td>
                                <td>{{ $contractDetail->is_signed ? 'Đã ký' : 'Chưa ký' }}</td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <form action="{{ route('contract-details.destroy', $contractDetail->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit" title="Xóa"
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">
                                                <i class='bx bx-trash'></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{-- Thông tin hợp đồng --}}
        <div class="tab-pane fade m-2 p-1" id="contract">
            {{-- <form action="{{ route('contracts.update', $contract->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="room_id" class="form-label">Phòng:</label>
                            <select class="form-select" name="room_id" id="room_id">
                                @foreach ($rooms as $room)
                                    <option value="{{ $room->id }}"
                                        @if ($room->id == $contract->room_id) selected @endif>
                                        {{ $room->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <x-app-input name="start_date" label="Ngày Bắt Đầu:" type="date" :value="$contract->start_date" />
                        <x-app-input name="end_date" label="Ngày Kết Thúc:" type="date" :value="$contract->end_date" />
                        <x-app-input name="month" label="Số Tháng:" type="number" :value="$contract->month" />
                    </div>
                    <div class="col-lg-6">
                        <x-app-input name="price_room" label="Giá Phòng:" type="number" :value="$contract->room->price" />
                        <x-app-input name="price_eletric" label="Giá Điện:" type="number" :value="$contract->price_eletric" />
                        <x-app-input name="price_water" label="Giá Nước:" type="number" :value="$contract->price_water" />
                        <x-app-input name="other_fees" label="Phí Khác:" type="number" :value="$contract->other_fees" />
                    </div>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </form> --}}
            <div class="row">
                <div class="col-lg-6">
                    <table class="table">
                        <tr>
                            <th>Thuê Phòng:</th>
                            <td class="text-end">{{ $contract->room->name }}</td>
                        </tr>
                        <tr>
                            <th>Ngày Bắt Đầu:</th>
                            <td class="text-end">{{ $contract->start_date }}</td>
                        </tr>
                        <tr>
                            <th>Ngày Kết Thúc:</th>
                            <td class="text-end">{{ $contract->end_date }}</td>
                        </tr>
                        <tr>
                            <th>Số Tháng:</th>
                            <td class="text-end">{{ $contract->month }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-6">
                    <table class="table">
                        <tr>
                            <th>Giá Phòng:</th>
                            <td class="text-end">{{ number_format($contract->room->price) }} VNĐ</td>
                        </tr>
                        <tr>
                            <th>Giá Điện:</th>
                            <td class="text-end">{{ number_format($contract->price_eletric) }} VNĐ/số</td>
                        </tr>
                        <tr>
                            <th>Giá Nước:</th>
                            <td class="text-end">{{ number_format($contract->price_water) }} VNĐ/số</td>
                        </tr>
                        <tr>
                            <th>Phí Khác:</th>
                            <td class="text-end">{{ number_format($contract->other_fees) }} VNĐ</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- Thêm người thuê --}}
    <div class="modal fade" id="addLesseeModal" tabindex="-1" aria-labelledby="addLesseeModalLabel">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addLesseeModalLabel">Thêm Người</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('contract-details.update', $contract->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @include('include._error')
                        <div class="row">
                            <div class="mb-3">
                                <label for="id_lessee" class="form-label">Tên người thuê</label>
                                <select class="form-select" name="id_lessee" id="id_lessee">
                                    @if (count($lessees) == 0)
                                        <option value="">-- Trống --</option>
                                    @endif
                                    @foreach ($lessees as $lessee)
                                        <option value="{{ $lessee->id }}">{{ $lessee->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Thêm Người Thuê</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts>
