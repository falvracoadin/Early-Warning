<div>
    <div class="card" id="klasifikasi-nasabah">
        <div class="card-header">
            <div class="ch-group">
                <label class="label_filter" for="filter">Filter By : </label>
                <select id="filter" name="filter" class="filter" onchange="resetCanvas()">
                    <option value="pekerjaan">Pekerjaan</option>
                    <option value="usia">Usia</option>
                    <option value="besar_pinjaman">Besar Pinjaman</option>
                    <option value="lama_tenor">Lama Tenor</option>
                    </select>
            </div>

            <div class="ch-groupt">
                <label class="label_type" for="type">Chart : </label>
                <select id="type" name="type" class="type" onchange="changeChart()"  value="bar">
                    <option value="bar">Bar</option>
                    <option value="pie">Pie</option>
                    <option value="doughnut">Doughnut</option>
                    <option value="polarArea">Polar Area</option>
                </select>
            </div>

        </div>
        <!-- /.card-header -->
        <div class="card-body p-0" id="klasifikasi-content">
            <div class="chart-content" id="chart-content">
                <canvas id="chart">
                </canvas>
            </div>
            <div class="chart-info" id="chart-info">
                <ul id="info">
                    <div id="info-content">

                    </div>
                </ul>
            </div>
        </div>
    </div>


    <script src="{{ asset('js/chart/old/chart.min.js') }}"></script>
    <script src="{{ asset('js/chart/old/datalabels.js') }}"></script>
    <script>
        let canvas,ctx;
        let myChart;
        let filter = document.querySelector('#filter');
        let type = document.querySelector('#type');
        let info = $('#info');
        let _labels = [
                        @foreach ($data as $label)
                        '{{ $label["label"] }}',
                        @endforeach
                    ];
        let _data = [
            @foreach ($data as $dt)
                {{ $dt['num'] }},
            @endforeach
        ];
        function information(){
            $('#info-content').remove();
            let prt = "<div id='info-content'>";
            for(let i =0; i< _labels.length;i++){
                prt += `<li>${_labels[i]} : <span class="ic">${_data[i]}</span></li>`
            }
            prt+= '</div>'
            info.append(prt);
        }
        function resetCanvas(){
            $('#chart').remove();
            $('#chart-content').append('<canvas id="chart"></canvas>');
            canvas = document.querySelector('#chart');
            if(ctx){
                ctx.clearRect(0, 0, canvas.width, canvas.height);
            }
            ctx = canvas.getContext('2d');
        }

        function changeChart(){
            resetCanvas();
            if(myChart){
                myChart.clear();
                myChart.destroy();
            }
            myChart = new Chart(ctx, {
                type: type.value,
                data: {
                    labels: _labels,
                    datasets: [{
                        label: 'Jumlah Nasabah',
                        data: _data,
                        backgroundColor: [
                            @for ($i=0;$i<sizeof(config('app.background'));$i++)
                                '{{ config('app.background')[$i] }}',
                            @endfor
                        ],
                        borderColor: [
                            @for ($i=0;$i<sizeof(config('app.border'));$i++)
                                '{{ config('app.border')[$i] }}',
                            @endfor
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive:true,
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    },
                    animateScale:true,
                    segmentShowStroke : false,
                    animations: {
                        tension: {
                            duration: 1000,
                            easing: 'easeOutBounce',
                            from: 1,
                            to: 0,
                            loop: true
                        }
                    },
                    tooltips: {
                        enabled: true
                    },
                    plugins: {
                        datalabels: {
                            formatter: (value, ctx) => {
                                let sum = 0;
                                let dataArr = ctx.chart.data.datasets[0].data;
                                dataArr.map(data => {
                                    sum += data;
                                });
                                let percentage = (value*100 / sum).toFixed(2)+"%";
                                return percentage;
                            },
                            color: '#000',
                        }
                    }
                }
            });
            information();
            myChart.canvas.parentNode.style.height = '600px';
            myChart.canvas.parentNode.style.width = '600px';
        }



        function getData(){
            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                method:"POST",
                success:function (data, status){
                    data = JSON.parse(data).data;
                    _labels=[];
                    _data=[];
                    for(let i=0;i<data.length;i++){
                        _labels.push(data[i].label);
                        _data.push(data[i].num);
                    }
                    changeChart();
                },
                url:'/klasifikasi-nasabah',
                data:{
                    'filter':filter.value
                },
            });
        }
        $('#klasifikasi-nasabah').on('change',getData);
        changeChart();
    </script>
</div>
