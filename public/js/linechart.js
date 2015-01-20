window.addEventListener('load', function() {

    var ctx = document.getElementById("myChart").getContext("2d");

    var data = {
        //labels: ["January", "February", "March", "April", "May", "June", "July"],
        datasets: [
            {
                label: "My First dataset",
                fillColor: "rgba(0,187,205,0.2)",
                strokeColor: "rgba(151,187,205,1)",
                pointColor: "rgba(151,187,205,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(151,187,205,1)"
            }
        ]
    };

    scores = [], labels = [];

    $.post('evolution/getData', function(d) {

        json = JSON.parse(d);

        if (json.length === 1) {
            scores.push(parseInt(json[0].score));
            labels.push("");
        }

        for (i = 0; i < json.length; i++) {

            scores.push(parseInt(json[i].score));
            labels.push(json[i].date);
        }

        data.datasets[0].data = scores;
        data.labels = labels;

        new Chart(ctx).Line(data);
    });

});
