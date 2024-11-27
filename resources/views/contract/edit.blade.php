<x-layouts title="Chỉnh Sửa Hợp Đồng">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $title }}</h1>
        <div class="btn-toolbar mb-2">
        </div>
    </div>
    <form action="{{ route('contracts.update', $contract->id) }}" method="POST">
        @include('include._error')
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-lg-6">
                <div class="mb-3">
                    <label for="room_id" class="form-label">Phòng</label>
                    <select class="form-select" name="room_id" id="room_id">
                        @foreach ($rooms as $room)
                            <option value="{{ $room->id }}">{{ $room->name }}</option>
                        @endforeach
                    </select>
                </div>
                <x-app-input id="start_date" name="start_date" type="date" label="Ngày Bắt Đầu" placeholder="Nhập ngày bắt đầu" required :value="$contract->start_date" />
                <x-app-input id="end_date" name="end_date" type="date" label="Ngày Kết Thúc" placeholder="Nhập ngày kết thúc" required :value="$contract->end_date" />
                <x-app-input id="month" name="month" type="number" label="Số Tháng" placeholder="Nhập số tháng" required :value="$contract->month" />
            </div>
            <div class="col-lg-6">
                <x-app-input id="price_eletric" name="price_eletric" type="number" label="Giá Điện" placeholder="Nhập giá điện" required :value="$contract->price_eletric" />
                <x-app-input id="price_water" name="price_water" type="number" label="Giá Nước" placeholder="Nhập giá nước" required :value="$contract->price_water" />
                <x-app-input id="other_fees" name="other_fees" type="number" label="Phí Khác" placeholder="Nhập phí khác" required :value="$contract->other_fees" />
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3 col-4 offset-4">
            <i class='bx bx-save me-2'></i>
            Lưu
        </button>
    </form>
</x-layouts>