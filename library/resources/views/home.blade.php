@extends('layouts.admin')
@section('header', 'Dashboard')

@section('content')
    <div class="row">
  <div class="col-lg-3 col-6">
    <div class="small-box bg-info">
      <div class="inner">
        <h3>{{ $total_books }}</h3>
        <p>Books</p>
      </div>
      <div class="icon">
        <i class="fas fa-book"></i>
      </div>
      <a href="{{ url('books') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-lg-3 col-6">
    <div class="small-box bg-success">
      <div class="inner">
        <h3>{{ $total_members }}</h3>
        <p>Members</p>
      </div>
      <div class="icon">
        <i class="fas fa-book"></i>
      </div>
      <a href="{{ url('members') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-lg-3 col-6">
    <div class="small-box bg-warning">
      <div class="inner">
        <h3>{{ $total_publishers }}</h3>
        <p>Publishers</p>
      </div>
      <div class="icon">
        <i class="fas fa-book"></i>
      </div>
      <a href="{{ url('publishers') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-lg-3 col-6">
    <div class="small-box bg-danger">
      <div class="inner">
        <h3>{{ $total_transactions }}</h3>
        <p>Transactions</p>
      </div>
      <div class="icon">
        <i class="fas fa-book"></i>
      </div>
      <a href="{{ url('transactions') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>

  <div class="col-lg-6">
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Grafik Catalog</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
        </div>
    </div>
  </div>

  <div class="col-lg-6">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Grafik Peminjaman</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>

        <div class="card-body">
            <div class="chart">
                <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
        </div>
    </div>
  </div>

  <div class="col-md-6">
    <!-- AREA CHART -->
    <div class="card card-success">
      <div class="card-header">
        <h3 class="card-title">Area Chart</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
        <div class="chart">
          <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
  </div>
</div>
@endsection

@section('js')
<!-- ChartJS -->
<script src="{{ asset('assets../../plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/plugins/chart.js/Chart.min.js') }}"></script>
<script type="text/javascript">
    var label_donut = '{!! json_encode($label_donut) !!}';
    var data_donut = '{!! json_encode($data_donut) !!}';
    var data_bar = '{!! json_encode($data_bar) !!}';
    var data_chart = '{!! json_encode($data_chart) !!}';

    $(function() {
        var donutChartCanvas = $('#donutChart').get(0).getContext('2d');
        var donutChartData = {
            labels : JSON.parse(label_donut),
            datasets : [{
                data : JSON.parse(data_donut),
                backgroundColor : ['#0033cc', '#00ff00', '#ffff00', '#cc9900', '#ff0000', '#ff33cc', '#9966ff', '#66ffff', '#009933']
            }]
        }
        var donutOptions = {
            maintainAspectRatio : false,
            responsive : true
        }
        new Chart(donutChartCanvas, {
            type : 'doughnut',
            data : donutChartData,
            options : donutOptions
        })
    })
    // Area Bar Chart
    var areaChartCanvas = {
        labels : ['Januari', 'February', 'March', 'April', 'Mei', 'Juny', 'July', 'Agustus', 'September', 'Oktober', 'November', 'December'],
        datasets : JSON.parse(data_bar)
    }

    var barChartCanvas = $('#barChart').get(0).getContext('2d');
    var barChartData = $.extend(true , {} , areaChartCanvas);

    var barChartOptions = {
        maintainAspectRatio : false,
        responsive : true,
        datasetFill :false
    }
    new Chart(barChartCanvas, {
        type : 'bar',
        data : barChartData,
        options : barChartOptions
    });

    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    var ChartCanvas = $('#areaChart').get(0).getContext('2d')

    var areaChartData = {
      labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July','Agustus', 'September', 'Oktober', 'November', 'Desember'],
      datasets: JSON.parse(data_chart)
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }

    // This will get the first returned node in the jQuery collection.
    new Chart(ChartCanvas, {
      type: 'line',
      data: areaChartData,
      options: areaChartOptions
    })
</script>
@endsection

