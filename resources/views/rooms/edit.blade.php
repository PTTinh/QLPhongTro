<x-layouts title="Cập Nhật Phòng">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $title }} </h1>
        <div class="btn-toolbar mb-2">
            <a href="{{ route('rooms.index') }}" class="btn btn-secondary">
                <i class='bx bx-arrow-back me-2'></i>
                Quay Lại
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4>Cập Nhật Phòng</h4>
                </div>
                <div class="card-body">
                    @include('include._error')
                    <form action="{{ route('rooms.update', $room->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <x-app-input id="name" name="name" label="Tên Phòng" placeholder="Nhập tên phòng" value="{{ $room->name }}" required />
                        <x-app-input id="area" name="area" type="number" label="Diện Tích" placeholder="Nhập diện tích" value="{{ $room->area }}" required />
                        <x-app-input id="usable_area" name="usable_area" type="number" label="Diện Tích Sử Dụng" placeholder="Nhập diện tích sử dụng" value="{{ $room->usable_area }}" required />
                        <x-app-input id="price" type="number" name="price" label="Giá Phòng" placeholder="Nhập giá phòng" value="{{ $room->price }}" required />
                        <x-app-input id="capacity" type="number" name="capacity" label="Số Người Ở" placeholder="Nhập số người ở" value="{{ $room->capacity }}" required />
                        <div class="mb-3">
                            <label for="description" class="form-label">Mô tả</label>
                            <textarea name="description" id="description" class="form-control" rows="5">{{ $room->description }}</textarea>
                        </div>
                        {{-- <div class="form-group mb-3">
                            <label for="status">Trạng Thái</label>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="status" name="status" {{ $room->status ? 'checked' : '' }}>
                                <label class="form-check-label" for="status">Còn trống</label>
                            </div>
                        </div> --}}
                        <button type="submit" class="btn btn-primary w-100">Cập Nhật Phòng</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts>