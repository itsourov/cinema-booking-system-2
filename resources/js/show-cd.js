// Set the date we're counting down to

var _second = 1000;
var _minute = _second * 60;
var _hour = _minute * 60;
var _day = _hour * 24;

function countdownTimeStart(element) {

    var countDownDate = new Date(element.getAttribute('data-show_time')).getTime();
    // Get todays date and time
    var now = new Date(element.getAttribute('data-now')).getTime();

    // Find the distance between now an the count down date
    var distance = countDownDate - now;
    // Update the count down every 1 second
    var x = setInterval(function () {


        distance = distance - 1000


        // Time calculations for days, hours, minutes and seconds

        var days = Math.floor(distance / _day);
        var hours = Math.floor((distance % _day) / _hour);
        var minutes = Math.floor((distance % _hour) / _minute);
        var seconds = Math.floor((distance % _minute) / _second);

        // Output the result in an element with id="demo"
        element.innerHTML = days + "d " +
            hours + "h " +
            minutes + "m " + seconds + "s ";

        // If the count down is over, write some text 
        if (distance < 0) {
            clearInterval(x);
            element.innerHTML = "Done";
        }
    }, 1000);
}

var cds = document.getElementsByClassName('cd_show')
for (let index = 0; index < cds.length; index++) {
    var element = cds[index];
    countdownTimeStart(element)
}