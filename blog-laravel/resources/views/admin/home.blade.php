@extends("admin.layouts.app")



@section("content")
    <div class="border-bottom">
        <h3 class="h3">首页</h3>
    </div>
    <div class="web-data mt-3 pr-3">
        <div class="row">
            <div class="col-2 block text-center pr-3 mr-5">
                <h5 class="h5">用户人数</h5>
                <span class="">{{$userCount}}</span>
            </div>
            <div class="col-2 block text-center pr-3 mr-5">
                <h5 class="h5">栏目数量</h5>
                <span class="">{{$sectionCount}}</span>
            </div>
            <div class="col-2 block text-center pr-3 mr-5">
                <h5 class="h5">文章数量</h5>
                <span class="">{{$articleCount}}</span>
            </div>
            <div class="col-2 block text-center pr-3 mr-5">
                <h5 class="h5">图片数量</h5>
                <span class="">{{$photoCount}}</span>
            </div>
        </div>
    </div>
    <div class="chat mt-5 pr-5">
        <div class="border-bottom">
            <h6 class="h6">七天人数</h6>
        </div>
        <canvas id="myChart" width="100%" height="50" class="mt-3"></canvas>
    </div>

@stop


@section("script")
    <script src="https://cdn.bootcss.com/Chart.js/2.8.0-rc.1/Chart.js"></script>
    <script>

        let labels = [];
        let data = [];

        @foreach($access_data as $item)
            labels.push("{{$item["created_at"][0]}}-{{$item["created_at"][1]}}{{-$item["created_at"][2]}}");
            data.push({{$item['access']}});
        @endforeach

        console.log(labels);

        chartCreate(labels, data);

        /* chart.js */
        function chartCreate(labels, data) {
            let ctx = $("#myChart");
            let myChart = new Chart(ctx, {
                    type: "line",
                    data: {
                        labels: labels,
                        datasets: [{
                            label: "# of access data",
                            data: data,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticksL: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                },
            )
        }
    </script>
@stop

