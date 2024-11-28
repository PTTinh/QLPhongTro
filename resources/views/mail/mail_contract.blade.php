<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('lib/bootstrap-5.3.3-dist/css/bootstrap.min.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/layout.css') }}">
    <title>Hợp Đồng Thuê Phòng</title>
</head>

<body>
    @include('include._alert')
    @if ($contractDetail->is_signed == 0)
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="text-center">Hợp Đồng Thuê Phòng</h1>
                    <div class="row mt-2">
                        <div class="col-lg-6">
                            <table class="table">
                                <tr>
                                    <th>Thuê Phòng:</th>
                                    <td class="text-end">{{ $contractDetail->contract->room->name }}</td>
                                </tr>
                                <tr>
                                    <th>Ngày Bắt Đầu:</th>
                                    <td class="text-end">{{ $contractDetail->contract->start_date }}</td>
                                </tr>
                                <tr>
                                    <th>Ngày Kết Thúc:</th>
                                    <td class="text-end">{{ $contractDetail->contract->end_date }}</td>
                                </tr>
                                <tr>
                                    <th>Số Tháng:</th>
                                    <td class="text-end">{{ $contractDetail->contract->month }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-6">
                            <table class="table">
                                <tr>
                                    <th>Giá Phòng:</th>
                                    <td class="text-end">{{ number_format($contractDetail->contract->room->price) }} VNĐ
                                    </td>
                                </tr>
                                <tr>
                                    <th>Giá Điện:</th>
                                    <td class="text-end">{{ number_format($contractDetail->contract->price_eletric) }}
                                        VNĐ/số</td>
                                </tr>
                                <tr>
                                    <th>Giá Nước:</th>
                                    <td class="text-end"> {{ number_format($contractDetail->contract->price_water) }}
                                        VNĐ/m<sup>3</sup></td>
                                </tr>
                                <tr>
                                    <th>Phí Khác:</th>
                                    <td class="text-end"> {{ number_format($contractDetail->contract->other_fees) }} VNĐ
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-12">
                            <form action="{{ route('mail-contract.post') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <table class="table">
                                    <tr>
                                        <th>Người Thuê:</th>
                                        <td class="text-start">
                                            {{ $contractDetail->lessee->name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Số CCCD:</th>
                                        <td colspan="1" class="text-start">
                                            {{ substr($contractDetail->lessee->cccd_number, 0, 3) . '****' . substr($contractDetail->lessee->cccd_number, -3) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Xác Nhận CCCD:</th>
                                        <td colspan="1" class="text-end">
                                            <input type="number" name="cccd_number" class="form-control"
                                                value="{{ old('cccd_number') }}" placeholder="Nhập số CCCD">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Hính mặt trước CCCD:</th>
                                        <td class="text-end d-flex">
                                            <input type="file" name="cccd_front_image"
                                                style="width: 200px; height: 30px" class="form-control"
                                                placeholder="Chọn hình mặt trước CCCD" id="img_front">
                                            <div class="img_front d-flex justify-content-center">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Hính mặt sau CCCD:</th>
                                        <td class="text-end d-flex">
                                            <input type="file" name="cccd_back_image" value=""
                                                style="width: 200px; height: 30px" class="form-control"
                                                placeholder="Chọn hình mặt sau CCCD" id="img_back">
                                            <div class="img_back d-flex justify-content-center">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <td class="text-end">
                                            <button type="submit" class="btn btn-primary">Xác Nhận</button>
                                        </td>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="text-center">Hợp Đồng Thuê Phòng</h1>
                    <div class="row mt-2">
                        <div class="col-lg-6">
                            <table class="table">
                                <tr>
                                    <th>Thuê Phòng:</th>
                                    <td class="text-end">{{ $contractDetail->contract->room->name }}</td>
                                </tr>
                                <tr>
                                    <th>Ngày Bắt Đầu:</th>
                                    <td class="text-end">{{ $contractDetail->contract->start_date }}</td>
                                </tr>
                                <tr>
                                    <th>Ngày Kết Thúc:</th>
                                    <td class="text-end">{{ $contractDetail->contract->end_date }}</td>
                                </tr>
                                <tr>
                                    <th>Số Tháng:</th>
                                    <td class="text-end">{{ $contractDetail->contract->month }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-6">
                            <table class="table">
                                <tr>
                                    <th>Giá Phòng:</th>
                                    <td class="text-end">{{ number_format($contractDetail->contract->room->price) }}
                                        VNĐ</td>
                                </tr>
                                <tr>
                                    <th>Giá Điện:</th>
                                    <td class="text-end">{{ number_format($contractDetail->contract->price_eletric) }}
                                        VNĐ/số</td>
                                </tr>
                                <tr>
                                    <th>Giá Nước:</th>
                                    <td class="text-end"> {{ number_format($contractDetail->contract->price_water) }}
                                        VNĐ/m<sup>3</sup></td>
                                </tr>
                                <tr>
                                    <th>Phí Khác:</th>
                                    <td class="text-end"> {{ number_format($contractDetail->contract->other_fees) }}
                                        VNĐ</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-12">
                            <table class="table">
                                <tr>
                                    <th>Người Thuê:</th>
                                    <td class="text-end">
                                        {{ $contractDetail->lessee->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Số CCCD:</th>
                                    <td colspan="1" class="text-end">
                                        {{ substr($contractDetail->lessee->cccd_number, 0, 3) . '****' . substr($contractDetail->lessee->cccd_number, -3) }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Thời Gian Ký:</th>
                                    <td class="text-end">
                                        {{ $contractDetail->contract->created_at }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Trạng Thái:</th>    
                                    <td class="text-end">
                                        đã ký
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <script src="{{ asset('lib/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        document.getElementById('img_front').addEventListener('change', function(e) {
            var file = e.target.files[0];
            var reader = new FileReader();
            reader.onload = function(e) {
                var img = document.createElement("img");
                img.src = e.target.result;
                img.width = 100;
                img.height = 100;
                document.querySelector('.img_front').innerHTML = '';
                document.querySelector('.img_front').appendChild(img);
            }
            reader.readAsDataURL(file);
        });

        document.getElementById('img_back').addEventListener('change', function(e) {
            var file = e.target.files[0];
            var reader = new FileReader();
            reader.onload = function(e) {
                var img = document.createElement("img");
                img.src = e.target.result;
                img.width = 100;
                img.height = 100;
                document.querySelector('.img_back').innerHTML = '';
                document.querySelector('.img_back').appendChild(img);
            }
            reader.readAsDataURL(file);
        });
    </script>
</body>

</html>
