<script>
// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("myPieChartPengeluaran");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    labels: [
      <?php
        foreach ($kategori as $k) {
          echo "'".$k['nama']."',";
        }
      ?>
    ],
    datasets: [{
      data: [30, 20, 100, 20, 5, 80, 64,36],
      // backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
      backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#0779e4', '#12AF92', '#4cbbb9', '#ffd31d', '#00909e'],
      // backgroundColor: ['#0779e4', '#12AF92', '#d63447', '#00909e', '#4cbbb9', '#f57b51', '#ffd31d', '#00909e'],
      // hoverBackgroundColor: ['#4cbbb9', '#17a673', '#2c9faf'],
      // hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
      // hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});
</script>