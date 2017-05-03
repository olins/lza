window.onload = load_charts;
function load_charts() {
    var interval = document.getElementById("interval_list");
    $.ajax({
      method: "POST",
      url: "/get_faq_data",
      data: { interval: interval.value},
        success:function(data) {
          data = JSON.parse(data);
          lineDataPoints = [];
          linePerfectPoints = [];
          userDataPoints = [];
          userTargetPoints = [];
          previous = 0;

          data.target = parseInt(data.target);

          for (i = 0; i < data.total.length; i++) {
            data.total[i].sumatory = parseInt(data.total[i].sumatory) + previous;
            previous = data.total[i].sumatory;
            lineDataPoints.push({ 'x': new Date(data.total[i].date), 'y': parseInt(data.total[i].sumatory) });
          }

          for (key in data.users) {
            if(data.users[key].faqs_total == null) {
              data.users[key].faqs_total = 0;
            }
            userDataPoints.push({ 'label': data.users[key].user, 'y': parseInt(data.users[key].faqs_total) });
            userTargetPoints.push({ 'label': data.users[key].user, 'y':  data.target });
          }

          for (key in data.perfect) {
            linePerfectPoints.push({ 'x': new Date(data.perfect[key].date), 'y': parseInt(data.perfect[key].faq) });
          }

          var chartTotal = new CanvasJS.Chart("chartContainerTotal",
          {

            title:{
              text: "Site Traffic",
              fontSize: 30
            },

            animationEnabled: true,

            axisX:{

              gridColor: "Silver",
              tickColor: "silver",
              valueFormatString: "DDDD"

            },

            toolTip:{
              shared:true
            },

            theme: "theme2",
            axisY: {
              gridColor: "Silver",
              tickColor: "silver"
            },
            legend:{
              verticalAlign: "center",
              horizontalAlign: "right"
            },
            data: [
            {
              type: "line",
              showInLegend: true,
              lineThickness: 2,
              name: "Target",
              markerType: "square",
              color: "#7d8084",
              dataPoints: linePerfectPoints
            },
            {
              type: "line",
              showInLegend: true,
              name: "Fact",
              color: "#8fba44",
              lineThickness: 2,

              dataPoints: lineDataPoints
            }


            ],
                legend:{
                  cursor:"pointer",
                  itemclick:function(e){
                    if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                      e.dataSeries.visible = false;
                    }
                    else{
                      e.dataSeries.visible = true;
                    }
                    chart.render();
                  }
                }
          });


          var chartUsers = new CanvasJS.Chart("chartContainerUsers",
          {
            title:{
              text: "FAQ's created",
              fontSize: 30
            },
            theme: "theme2",
            animationEnabled: true,
            axisY: {
              stripLines:[
                {
                 value: data.target,
                 thickness: 4,
                 legendMarkerColor: "#005bae",
                 legendText: "Target",
                 color:"#005bae",
                 showOnTop: true,
               }
             ]
            },
            legend: {
              verticalAlign: "bottom",
              horizontalAlign: "center"
            },
            data: [

            {
              color: "#8fba44",
              type: "column",
              showInLegend: true,
              legendMarkerColor: "#8fba44",
              legendText: "Total",
              dataPoints: userDataPoints
            },
            {
              type: "line",
              showInLegend: true,
              markerType: "none",
              name: "Target",
              color: "#005bae",
              lineThickness: 4,

              dataPoints: userTargetPoints
            }
            ]
          });

          chartUsers.render();
          chartTotal.render();
        }
    });
}

function showFaq(date, user_id) {
    var userFaq = document.getElementById("faq-value-"+date+'-'+user_id);
    var staticFaq = document.getElementById("user-"+date+'-'+user_id);
    staticFaq.style.display = 'none';
    userFaq.removeAttribute("class");
    userFaq.style.display = 'inline-block';

}

function changeFaq(date, user_id) {
   if(event.keyCode == 13) {
     var userFaq = document.getElementById("faq-value-"+date+'-'+user_id);
     var staticFaq = document.getElementById("user-"+date+'-'+user_id);
     var userTotal = document.getElementById("total-user-"+user_id);
     if(!userFaq.value) {
       userFaq.value = 0;
     } else if(userFaq.value < 0) {
       userFaq.value = 0;
     }
     else if(userFaq.value > 20) {
       userFaq.value = 20;
     }
      $.ajax({
        method: "POST",
        url: "/changeFaq",
        data: { user: user_id, date: date, faq_count: userFaq.value}
      })
        .done(function( msg ) {
          userTotal.innerHTML = userTotal.innerHTML - ( - userFaq.value );
          staticFaq.innerHTML = userFaq.value;
          staticFaq.style.display = 'table';
          userFaq.style.display = 'none';
          load_charts();
        });
    }

}

function changeTarget(target) {
    $.ajax({
      method: "POST",
      url: "/changeTarget",
      data: { target: target}
    })
      .done(function( target_value ) {
        target_value = JSON.parse(target_value);
        var targets = document.getElementsByClassName("target");
        for (key in targets) {
          targets[key].innerHTML = target_value;
        }
        load_charts();
      });

}
