const submit = document.getElementById('formView-submit');
const saveInfoArray = $('#formView-info').html().split('-');
const saveToken = saveInfoArray[2];
const saveStudentId = saveInfoArray[3];
const saveFormId = saveInfoArray[4];
submit.addEventListener('click', () => {
    const studentAnswers = {};
    const updatedView = document.getElementById('formView-holder');
    const answersHolder = Array.from(updatedView.children);
    answersHolder.forEach((answer) => {
        let id = answer.id;
        let val = document.getElementById(`val-${answer.id}`).value;
        let valHolder = $(`#val-${answer.id}`);
        if (valHolder.attr('name') === 'checkbox')
        {
           let checkboxes = document.getElementById(`val-${answer.id}`);
           let jsCheckboxes = Array.from(checkboxes.children);
           let answers = [];
           jsCheckboxes.forEach(e => {
               if(e.checked){
                   answers.push(e.id)
               }
           })
           val = answers;
        }
        studentAnswers[id] = val; 
    })

    ajaxAddAnswer(studentAnswers, saveStudentId, saveFormId, saveToken);
});

const ajaxAddAnswer = async (answer, studentId, formId, token) => {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': token
        }
    });
    answer = JSON.stringify(answer);

    return $.ajax({
        url: `/form/student/answer`,
        method: 'post',
        data: {
            _token: token,
            answer,
            studentId,
            formId
        },
        success: (results) => {
            alert('responses saved')
        },
        error: (jqXHR, textStatus, error) => {
            console.log(error);
            console.log(jqXHR);
            console.log(textStatus);
            return;
        }
    })
};
