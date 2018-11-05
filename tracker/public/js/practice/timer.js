const practiceRecord = document.getElementById('practice-record');
const practiceReset = document.getElementById('practice-reset');
const stopwatchHours = document.getElementById('stopwatch-hour');
const stopwatchMin = document.getElementById('stopwatch-min');
const stopwatchSec = document.getElementById('stopwatch-sec');
let interval = null;
let currentIncrement = 0;
let recording = false;
let init = false;
let startTime = null;
let stopTime = null;

practiceRecord.addEventListener('click', function () {
  if (!init) {
    startTime = new Date(Date.now());
    recording = true;
    init = true;
    
    recordStyle();
    initializeTimer();
  }

  else {
    if (recording) {
      stopTime = new Date(Date.now());

      completeStyle();
      alert(`Send to DB: ${startTime.getHours()}:${startTime.getMinutes()}:${startTime.getSeconds()} and ${stopTime.getHours()}:${stopTime.getMinutes()}:${stopTime.getSeconds()}`);
      recording = false;
    }
    else {
      startTime = new Date(Date.now());
      recording = true;
      recordStyle();
    }
  }
});

practiceReset.addEventListener('click', () => {
  if (!recording) {
    reset();
  }
});

const recordStyle = () => {
  practiceRecord.style.opacity = .8;
  practiceRecord.style.color = 'red';
  practiceRecord.textContent = 'recording';
}

const completeStyle = () => {
  practiceRecord.style.opacity = 1;
  practiceRecord.style.color = 'green';
  practiceRecord.textContent = 'complete';
}

const initializeTimer = () => {
  interval = setInterval(() => {
    if (!recording) return;
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
