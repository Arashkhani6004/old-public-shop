var timeLimitInMinutes = 2;
var timeLimitInSeconds = timeLimitInMinutes * 60;
var timerElement = document.getElementById("timer");
var btnAgain = document.getElementById("againCode");
var el = document.getElementById("el");

function startTimer() {
    timeLimitInSeconds--;
    var minutes = Math.floor(timeLimitInSeconds / 60);
    var seconds = timeLimitInSeconds % 60;

    if (timeLimitInSeconds < 0) {
        timerElement.textContent = "00:00";
        clearInterval(timerInterval);
        return;
    }

    if (minutes < 10) {
        minutes = "0" + minutes;
    }
    if (seconds < 10) {
        seconds = "0" + seconds;
    }
    timerElement.textContent = minutes + ":" + seconds;
    if (minutes == 0 && seconds == 0) {
        btnAgain.classList.add("show");
        el.remove();
    }
}
var timerInterval = setInterval(startTimer, 1000);
