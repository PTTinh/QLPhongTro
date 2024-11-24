<x-layouts title="Chi Tiết Hợp Đồng">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $title }}</h1>
        <div class="btn-toolbar mb-2">
            <a class="btn btn-primary" href="{{ route('contracts.index') }}">
                <i class='bx bx-arrow-back me-2'></i>
                Quay Lại
            </a>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                data-bs-target="#showContractDetailModal">
                <i class='bx bx-plus me-2'></i>
                Thêm Chi Tiết Hợp Đồng
            </button>
        </div>
    </div>
    {{-- Modal --}}
    <div class="modal fade" id="showContractDetailModal" tabindex="-1" aria-labelledby="showContractDetailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showContractDetailModalLabel">Xem Chi Tiết Hợp Đồng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <span class="fw-bold">Thuê Phòng: </span> {{ $contractDetail->room->name }}<br>
                            <span class="fw-bold">Tên Người Thuê: </span>{{ $contractDetail->lessee->name }}<br>
                            <span class="fw-bold">Số Điện Thoại: </span>{{ $contractDetail->lessee->phone }}<br>
                            <span class="fw-bold">Email: </span>{{ $contractDetail->lessee->email }}<br>
                            <span class="fw-bold">Địa Chỉ: </span>{{ $contractDetail->lessee->address }}<br>
                            <span class="fw-bold">Nghề Nghiệp: </span>{{ $contractDetail->lessee->job }}<br>
                            <span class="fw-bold">Năm Sinh: </span>{{ $contractDetail->lessee->dob }}<br>
                            <span class="fw-bold">Số CCCD: </span>{{ $contractDetail->lessee->cccd }}<br>
                        </div>
                        <div class="col-lg-6">
                            <span class="fw-bold">Ảnh CCCD</span><br>
                            <img src="{{ asset('inages/' . $contractDetail->lessee->cccd_front_image) }}" alt="cccd_front_image"
                                class="img-fluid"><br>
                            <span class="fw-bold">Ngày Bắt Đầu: </span>{{ $contractDetail->contract->start_date }}<br>
                            <span class="fw-bold">Ngày Kết Thúc: </span>{{ $contractDetail->contract->end_date }}<br>
                            <span class="fw-bold">Số Tháng: </span>{{ $contractDetail->contract->month }}<br>
                            <span class="fw-bold">Giá Điện: </span>{{ $contractDetail->contract->price_eletric }}<br>
                            <span class="fw-bold">Giá Nước: </span>{{ $contractDetail->contract->price_water }}<br>
                            <span class="fw-bold">Phí Khác: </span>{{ $contractDetail->contract->other_fees }}<br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-layouts>
