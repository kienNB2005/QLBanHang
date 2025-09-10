

  <!-- Content -->
  <div class="content">

    <!-- Dashboard Stats -->
    <div class="row g-4 mb-4">
      <div class="col-md-4">
        <div class="card p-3 text-center">
          <h5><i class="fa fa-book text-primary"></i> Tổng số truyện</h5>
          <h3><?= $data ?></h3>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card p-3 text-center">
          <h5><i class="fa fa-users text-success"></i> Người dùng</h5>
          <h3><?= $dataUser ?></h3>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card p-3 text-center">
          <h5><i class="fa fa-shopping-cart text-danger"></i> Đơn hàng</h5>
          <h3><?= $dataOrder ?></h3>
        </div>
      </div>
    </div>

    <!-- Biểu đồ -->
    <div class="card p-3">
      <h5 class="mb-3">📊 Thống kê</h5>
      <canvas id="dashboardChart" style="width:100%; max-height:400px;"></canvas>
    </div>

  </div>

  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const ctx = document.getElementById('dashboardChart').getContext('2d');
    const dashboardChart = new Chart(ctx, {
      type: 'bar', // có thể đổi sang 'line', 'pie', ...
      data: {
        labels: ['Tổng số truyện', 'Người dùng', 'Đơn hàng'], // bạn sẽ lấy dữ liệu PHP
        datasets: [{
          label: 'Số lượng',
          data: [<?= $data ?>, <?= $dataUser ?> , <?= $dataOrder?>], // thay bằng PHP khi cần
          backgroundColor: [
            'rgba(52, 152, 219, 0.7)',
            'rgba(46, 204, 113, 0.7)',
            'rgba(231, 76, 60, 0.7)'
          ],
          borderColor: [
            'rgba(52, 152, 219, 1)',
            'rgba(46, 204, 113, 1)',
            'rgba(231, 76, 60, 1)'
          ],
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        plugins: { legend: { display: false } },
        scales: { y: { beginAtZero: true, ticks: { stepSize: 10 } } }
      }
    });
  </script>

