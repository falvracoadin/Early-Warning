<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('js/chart/old/chart.min.js') }}"></script>
<script src="{{ asset('js/chart/old/datalabels.js') }}"></script>

<canvas id="pie-chart"></canvas>

<script>
     var data = [{
            data: [3,2,],
            labels: ["India", "China",],
            backgroundColor: [
                "#4b77a9",
                "#5f255f",
                "#d21243",
                "#B27200"
            ],
            borderColor: "#fff"
        }];

           var options = {
           tooltips: {
         enabled: false
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
                color: '#fff',
                     }
        }
    };


        var ctx = document.getElementById("pie-chart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            datasets: data
        },
              options: options
    });


</script>
