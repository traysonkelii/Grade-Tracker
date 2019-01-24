const token = document.getElementById('token').innerHTML;
const practiceContainer = Array.from(document.getElementsByClassName('student-teacherView-prow'));
const summaryContainer = document.getElementsByClassName('student-teacherView-sbody')[0];
const summaryTitle = document.getElementsByClassName('student-teacherView-stitle')[0];
const addPracticeContainer = Array.from(document.getElementsByClassName('student-teacherView-addToPractice'));
const removePracticeContainer = Array.from(document.getElementsByClassName('student-teacherView-removeFromPractice'));

practiceContainer.forEach(container => {
    container.addEventListener('click', function(){
        let hidden = this.children[1];
        hideAll();
        show(hidden);
    })
})

addPracticeContainer.forEach(container => {
    container.addEventListener('click', function(){
        const infoArray = this.id.split('-');
        const studentId = infoArray[0];
        const repId = infoArray[1];
        const type = 'practice';
        const value = 1 //set flag in DB
        ajaxUpdateStatus(studentId,repId,type,value,token)
    })
})

removePracticeContainer.forEach(container => {
    container.addEventListener('click', function(){
        const infoArray = this.id.split('-');
        const studentId = infoArray[0];
        const repId = infoArray[1];
        const type = 'practice';
        const value = 0 //set flag in DB
        ajaxUpdateStatus(studentId,repId,type,value,token)
    })
})

summaryTitle.addEventListener('click', function(){
    hideAll();
    show(summaryContainer);
})

const hideAll = () => {
    hide(summaryContainer);
    practiceContainer.forEach(container => {
        hide(container.children[1]);
    })
}

const hide = (element) => {
    element.style.display = 'none';
}

const show = (element) => {
    element.style.display = 'block';
    element.style.height = '250px';
    element.style.opacity = 1;
}

const ajaxUpdateStatus = (studentId, repertoireId, type, val, token) => {
    console.log(studentId, repertoireId, type, val, token)
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': token
      }
    });
  
    $.ajax({
      url: `/repertoire/updateStatus/${studentId}/${repertoireId}/${type}/${val}`,
      method: 'post',
      data: {
        _token: token
      },
      success: function (result) {
        console.log(result)
        location.reload()
      },
      error: function (jqXHR, textStatus, errorThrown) {
        alert('problem with adding to practice');
        console.log(errorThrown);
        console.log(jqXHR);
        console.log(textStatus);
      }
    });
  }
