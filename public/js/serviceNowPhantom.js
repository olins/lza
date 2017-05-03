window.onload = serviceNow;
function serviceNow() {
  var page = require('webpage').create();
  page.open('https://tiger.service-now.com/sys_report_display.do?sysparm_report_id=51af0bc6db6b9a0095bffddabf961943', function (status) {
    window.setTimeout(function () {
        var target = document.getElementsByClassName("serviceNow");
        target.innerHTML = target_value;
        phantom.exit();
    }, 6000);
  });
}
