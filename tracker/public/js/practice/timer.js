const practiceRecord = document.getElementById('practice-record');
const practiceReset = document.getElementById('practice-reset');
const stopwatchHours = document.getElementById('stopwatch-hour');
const stopwatchMin = document.getElementById('stopwatch-min');
const stopwatchSec = document.getElementById('stopwatch-sec')
let interval = null;
let currentIncrement = 0;
let init = false;
let timesCollected = false;
let startTime = null;
let stopTime = null;

practiceRecord.addEventListener('click', function () {
  if (timesCollected) {
    return false;
  }

  if (!init) {
    startTime = Date.now();
    init = true;
    practiceRecord.style.opacity = .8;
    practiceRecord.style.color = 'red';
    practiceRecord.textContent = 'recording';
    initialiseTimer();
  }

  else {
    stopTime = Date.now();
    practiceRecord.style.opacity = 1;
    practiceRecord.style.color = 'green';
    practiceRecord.textContent = 'complete';
    timesCollected = true;
  }
});

practiceReset.addEventListener('click', () => {
  if (timesCollected)
  {
    reset();
  }
});

const initialiseTimer = () => {
  interval = setInterval(() => {
    if (timesCollected) return;
    currentIncrement += 1;
    updateStopwatch(currentIncrement);
  }, 1000)
}

const updateStopwatch = (increment) => {
  let hours = Math.floor(increment / 3600);
  let minutes = Math.floor((increment - (hours * 3600)) / 60);
  let seconds = increment - (hours * 3600) - (minutes * 60);

  if (hours > 99)
    reset();

  stopwatchHours.textContent = hours < 10 ? ("0" + hours.toString()) : hours.toString()
  stopwatchMin.textContent = minutes < 10 ? ("0" + minutes.toString()) : minutes.toString()
  stopwatchSec.textContent = seconds < 10 ? ("0" + seconds.toString()) : seconds.toString()
}

const reset = () => {
  currentIncrement = 0;
  timesCollected = false;
  init = false;
  clearInterval(interval);
  stopwatchHours.textContent = "00";
  stopwatchMin.textContent = "00";
  stopwatchSec.textContent = "00";
  practiceRecord.textContent = "start";
  practiceRecord.style.opacity = 1;
  practiceRecord.style.color = "white";
}