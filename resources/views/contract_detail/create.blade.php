<x-layouts title="Thêm Chi Tiết Hợp Đồng">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $title }}</h1>
        <div class="btn-toolbar mb-2">
        </div>
    </div>
    <form action="{{ route('contract-details.store') }}" method="POST">
        @include('include._error')
        @csrf
        <div class="mb-3">
            <label for="id_lessee" class="form-label">Tên người thuê</label>
            <select class="form-select" name="id_lessee" id="id_lessee">
                @foreach ($lessees as $lessee)
                    <option value="{{ $lessee->id }}">{{ $lessee->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="contract_id" class="form-label">Hợp đồng</label>
            <select class="form-select" name="contract_id" id="contract_id">
                @foreach ($contracts as $contract)
                    <option value="{{ $contract->id }}">{{ $contract->id }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="room_id" class="form-label">Phòng</label>
            <select class="form-select" name="room_id" id="room_id">
                @foreach ($rooms as $room)
                    <option value="{{ $room->id }}">{{ $room->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Thêm</button>
    </form>
</x-layouts>