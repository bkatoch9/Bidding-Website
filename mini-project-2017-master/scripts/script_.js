function setTimer(element_id,date){

var countDownDate = new Date(date).getTime();
var countDownElement = document.getElementById(element_id);

var x = setInterval(function() {

  var now = new Date().getTime();
  var distance = countDownDate - now;

  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)) + (days * 24);
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  
  countDownElement.innerHTML = hours + "h " + minutes + "m " + seconds + "s ";
 if (distance < 0) {
    clearInterval(x);
    countDownElement.innerHTML = "EXPIRED";
  }
}, 1000);
}
/*setTimer("demo-1","Nov 2, 2017 00:25:34");
setTimer("demo-2","Oct 31, 2017 23:59:25");
setTimer("demo-3","Oct 29, 2017 23:57:32");
setTimer("demo-4","Oct 29, 2017 23:57:32");
setTimer("demo-5","Oct 29, 2017 23:57:32");
setTimer("demo-6","Oct 29, 2017 23:57:32");
setTimer("demo-7","Oct 29, 2017 23:57:32");
setTimer("demo-8","Oct 29, 2017 23:57:32");
setTimer("demo-9","Oct 29, 2017 23:57:32");

*/