const practiceRecord = document.getElementById('practice-record');
const practiceReset = document.getElementById('practice-reset');
const stopwatchHours = document.getElementById('stopwatch-hour');
const stopwatchMin = document.getElementById('stopwatch-min');
const stopwatchSec = document.getElementById('stopwatch-sec');
const pWeek = document.getElementsByClassName('p-week');
const popup = document.getElementById('practice-popup');
let interval = null;
let currentIncrement = 0;
let recording = false;
let init = false;
let startTime = null;
let stopTime = null;
let idTokenArray = null;

/**
 * CLICK CONTROLLS
 * 
 * practiceRecord => start recording button
 * 
 * practiceReset => reset button
 * 
 * addClickToReps => adds click to list of Repertoires
 */
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
      ajaxStoreTime(idTokenArray[0], formatDate(startTime), formatDate(stopTime), idTokenArray[1]);
      ajaxStoreRunningTime(idTokenArray[0], currentIncrement, idTokenArray[1]);
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

const addClickToReps = async () => {
  const repArray = await document.getElementsByClassName('practice-entry');
  for (let i = 0; i < repArray.length; i++) {
    repArray[i].addEventListener('click', async () => {
      if (!recording) {
        let repId = repArray[i].id;
        idTokenArray = repId.split('-');

        removeCoverClass();
        startStyle();
        ajaxGetRunningTime(idTokenArray[0], idTokenArray[1]);
      }
    });
  }
}
//Needs to run to assign clickers
addClickToReps();

/**
 * CSS HELPERS
 * 
 * removeCoverClass => removes the class on timer
 * 
 * recordStyle => changes display on start button
 * 
 * completeStyle => changes display on start button
 */

const removeCoverClass = () => {
  pWeek[0].classList.remove('non-use');
}

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

const startStyle = () => {
  practiceRecord.style.opacity = 1;
  practiceRecord.style.color = 'white';
  practiceRecord.textContent = 'start';
}

/**
 * TIMER HELPERS
 * 
 * initializeTimer => sets the timer up note that setInterval is a
 * built in JS function. setInterval(func, time) where func is the action
 * performed and time is the amount of time to wait to perform func in 
 * milliseconds
 * 
 * updateStopwatch => helps set up UI display
 * 
 * reset => restarts the state of the timer and updates UI to 0's
 */

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
  stopwatchHours.textContent = hours < 10 ? ('0' + hours.toString()) : hours.toString()
  stopwatchMin.textContent = minutes < 10 ? ('0' + minutes.toString()) : minutes.toString()
  stopwatchSec.textContent = seconds < 10 ? ('0' + seconds.toString()) : seconds.toString()
}

const reset = () => {
  currentIncrement = 0;
  timesCollected = false;
  init = false;
  clearInterval(interval);
  stopwatchHours.textContent = '00';
  stopwatchMin.textContent = '00';
  stopwatchSec.textContent = '00';
  practiceRecord.textContent = 'start';
  practiceRecord.style.opacity = 1;
  practiceRecord.style.color = 'white';
  ajaxStoreRunningTime(idTokenArray[0], currentIncrement, idTokenArray[1]);
}

/**
 * DB/AJAX/STORAGE HELPERS
 * 
 * formatDate => converts JS date to SQL datetime format
 * 
 * ajaxStoreTime => calls the route from Laravel which stores time
 * in order to use ajax in Laravel you need a token to authenticate
 * DB use (THIS IS AWESOME) it was a pain to figure out but it ensures
 * that data can only be accessed through the interface and not through
 * bots or web scrapers. Success happens after the data is stored and 
 * a callback function is run (we may put the pop up here of data saved).
 * The same is true if the data is not saved. 
 * 
 */

const formatDate = (date) => {
  return new Date(date).toISOString().slice(0, 19).replace('T', ' ');
}

const ajaxStoreTime = (id, start, stop, token) => {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': token
    }
  });

  $.ajax({
    url: `/practice/add/${id}/${start}/${stop}`,
    method: 'post',
    data: {
      _token: token
    },
    success: function (result) {
      showPopUp('Added practice time for this Repertoire');
    },
    error: function (jqXHR, textStatus, errorThrown) {
      alert('problem with storing time for practice');
      console.log(errorThrown);
      console.log(jqXHR);
      console.log(textStatus);
    }
  });
}

const ajaxStoreRunningTime = (id, val, token) => {
  const type = 'practice_time'
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': token
    }
  });

  $.ajax({
    url: `/repertoire/update/${id}/${type}/${val}`,
    method: 'post',
    data: {
      _token: token
    },
    success: function (result) {
    },
    error: function (jqXHR, textStatus, errorThrown) {
      alert('problem with storing time to repertoire');
      console.log(errorThrown);
      console.log(jqXHR);
      console.log(textStatus);
    }
  });

}

const ajaxGetRunningTime = (id, token) => {
  const type = 'practice_time'
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': token
    }
  });

  $.ajax({
    url: `/repertoire/read/${id}/${type}`,
    method: 'get',
    data: {
      _token: token
    },
    success: function (result) {
      currentIncrement = Number.parseInt(result);
      updateStopwatch(currentIncrement);
    },
    error: function (jqXHR, textStatus, errorThrown) {
      alert('problem with getting time for repertoire');
      console.log(errorThrown);
      console.log(jqXHR);
      console.log(textStatus);
    }
  });
}

function showPopUp(content) {
  popup.className = 'show';
  popup.innerHTML = content;
  setTimeout(function(){ popup.className = popup.className.replace('show', ''); }, 3000);
}