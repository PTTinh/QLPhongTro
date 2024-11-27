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
                    <th scope="col" class="text-truncate" style="max-width: 100px;">Phòng</th>
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
                        <td>{{ $contract->room->name }}</td>
                        <td>{{ $contract->created_at }}</td>
                        <td>{{ $contract->start_date }}</td>
                        <td>{{ $contract->end_date }}</td>
                        <td>
                            <div class="d-none d-lg-flex justify-content-center gap-2">
                                <a class="btn btn-success" href="{{ route('contracts.show', $contract->id) }}" title="Xem">
                                    <i class='bx bx-show'></i>
                                </a>
                                <button class="btn btn-warning js-edit-contract" type="button" 
                                        data-id="{{ $contract->id }}"
                                        data-urlGet="{{ route('contracts.edit', $contract->id) }}"
                                        data-urlPut="{{ route('contracts.update', $contract->id) }}"
                                        data-urlGetRoom="{{ route('rooms.create') }}"
                                        title="Sửa">
                                            <i class='bx bx-edit'></i>
                                        </button>
                                <form action="{{ route('contracts.destroy', $contract->id) }}" method="POST">
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
                                    <li class="d-flex align-items-center justify-content-center gap-2">
                                        <a class="btn btn-success" href="{{ route('contract-details.index', $contract->id) }}" title="Xem">
                                            <i class='bx bx-show'></i>
                                        </a>
                                        <button class="btn btn-warning js-edit-contract" type="button" 
                                        data-id="{{ $contract->id }}"
                                        data-urlGet="{{ route('contracts.edit', $contract->id) }}"
                                        data-urlPut="{{ route('contracts.update', $contract->id) }}"
                                        data-urlGetRoom="{{ route('rooms.create') }}"
                                        title="Sửa">
                                            <i class='bx bx-edit'></i>
                                        </button>
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
        <!-- Modal Thêm Hợp Đồng -->
        <x-app-modal id="addContractModal" title="Thêm Hợp Đồng">
            <form action="{{ route('contracts.store') }}" method="POST">
                @include('include._error')
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="room_id" class="form-label">Phòng</label>
                            <select class="form-select" name="room_id" id="room_id">
                                @if (count($rooms) == 0)
                                    <option value="">Không có phòng nào</option>
                                @endif
                                @foreach ($rooms as $room)
                                    <option value="{{ $room->id }}">{{ $room->name }}</option>
                                @endforeach
                            </select>
                        </div>
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
        </x-app-modal>
        {{-- Modal Sửa Hợp Đồng --}}
        <x-app-modal id="editContractModal" title="Sửa Hợp Đồng">
            <form id="f-edit-contract" action="#" method="POST">
                @include('include._error')
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label for="room_id-update" class="form-label">Phòng</label>
                            <select class="form-select" name="room_id" id="room_id-update">
                                {{-- thêm tù js --}}
                            </select>
                        </div>
                        <x-app-input id="start_date-update" name="start_date" type="date" label="Ngày Bắt Đầu" placeholder="Nhập ngày bắt đầu" required />
                        <x-app-input id="end_date-update" name="end_date" type="date" label="Ngày Kết Thúc" placeholder="Nhập ngày kết thúc" required />
                        <x-app-input id="month-update" name="month" type="number" label="Số Tháng" placeholder="Nhập số tháng" required />
                    </div>
                    <div class="col-lg-6">
                        <x-app-input id="price_eletric-update" name="price_eletric" type="number" label="Giá Điện" placeholder="Nhập giá điện" required />
                        <x-app-input id="price_water-update" name="price_water" type="number" label="Giá Nước" placeholder="Nhập giá nước" required />
                        <x-app-input id="other_fees-update" name="other_fees" type="number" label="Phí Khác" placeholder="Nhập phí khác" required />
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3 col-4 offset-4">
                    <i class='bx bx-save me-2'></i>
                    Lưu
                </button>
            </form>
        </x-app-modal>

    </div>
    <x-slot:script>
        <script src="{{ asset('js/contract.js') }}"></script>
    </x-slot:script>
</x-layouts>