
const studentHolder = Array.from(document.getElementsByClassName('assign-student-holder')[0].children);
studentHolder.splice(0, 2);

const juryHolder = Array.from(document.getElementsByClassName('assign-jury-holder')[0].children);
juryHolder.splice(0, 2);

const getGroupId = (groupHolder) => {
    let myGroupIds = groupHolder.reduce((results, holder) => {
        //childeren drill down to the input element
        if (holder.children[0].children[0].checked) {
            results.push(holder.children[0].children[0].value);
        }
        return results
    }, []);
    return myGroupIds;
}



$('#performanceSubmit').click(() => {
    let studentId = Array.from(getGroupId(studentHolder));
    let juryIdArray = Array.from(getGroupId(juryHolder));
    const formId = Array.from(document.getElementsByClassName('assign-forms-holder')[0].children)[1].value;

    studentId.forEach(id => {
        console.log(id);
        ajaxAddPerformance(id, juryId, formId);
    })

})

const ajaxAddPerformance = (studentId, juryIdArray, formId, token) => {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': token
        },
        body: {
            'student_id': studentId,
            'jury': juryIdArray,
            formId: formId,
        }
    });

    return $.ajax({
        url: `/performance/addPerformance`,
        method: 'post',
        data: {
            _token: token
        },
        success: function (result) {
            return result;
        },
        error: function (jqXHR, textStatus, errorThrown) {
            showPopUp('Problem getting DB attribute');
            console.log(errorThrown);
            console.log(jqXHR);
            console.log(textStatus);
            return;
        }
    });
}


