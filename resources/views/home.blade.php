


<x-layouts title="Home">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $title }}</h1>
        <div class="btn-toolbar mb-2">
           
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 mt-2">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title">Số lượng phòng</h5>
                    <p class="card-text">{{ $roomCount }}</p>
                </div>
            </div>
            <canvas id="rooms"></canvas>
        </div>
        <div class="col-lg-4 mt-2">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Số lượng người thuê</h5>
                    <p class="card-text">{{ $LesseeCount }}</p>
                </div>
            </div>
            <canvas id="lessee"></canvas>
        </div>
        <div class="col-lg-4 mt-2">
            <div class="card text-white bg-danger mb-3">
                <div class="card-body">
                    <h5 class="card-title">Hợp đồng sắp hết hạn</h5>
                    <p class="card-text">{{ $expiringContractsCount }}</p>
                </div>
            </div>
            <canvas id="expiringContracts"></canvas>
        </div>
    </div>
    <x-slot:script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            var ctx1 = document.getElementById('rooms').getContext('2d');
            var myPieChart1 = new Chart(ctx1, {
                type: 'pie',
                data: {
                    labels: ['Phòng trống', 'Phòng đã thuê'],
                    datasets: [{
                        label: 'Số lượng phòng',
                        data: [{{ $emptyRoomCount }}, {{ $occupiedRoomCount }}],
                        backgroundColor: [
                            'rgb(75, 192, 192)',
                            'rgb(153, 102, 255)',      
                        ],
                        hoverOffset: 4
                    }]
                }
            });
            var ctx2 = document.getElementById('lessee').getContext('2d');
            var myPieChart2 = new Chart(ctx2, {
                type: 'pie',
                data: {
                    labels: ['Người đã thuê', 'Người chưa thuê'],
                    datasets: [{
                        label: 'Số lượng người thuê',
                        data: [{{ $occupiedLesseeCount }}, {{ $emptyLesseeCount }}],
                        backgroundColor: [
                            'rgb(255, 206, 86)',
                            'rgb(75, 192, 192)',      
                        ],
                        hoverOffset: 4
                    }]
                }
            });
            var ctx3 = document.getElementById('expiringContracts').getContext('2d');
            var myPieChart3 = new Chart(ctx3, {
                type: 'pie',
                data: {
                    labels: ['Hợp đồng sắp hết hạn', 'Hợp đồng còn hạn'],
                    datasets: [{
                        label: 'Hợp đồng sắp hết hạn',
                        data: [{{ $expiringContractsCount }}, {{ $validContractsCount }}],
                        backgroundColor: [
                            'rgb(255, 99, 132)',
                            'rgb(54, 162, 235)',
                        ],
                        hoverOffset: 4
                    }]
                }
            });
        </script>
    </x-slot:script>
</x-layouts>
