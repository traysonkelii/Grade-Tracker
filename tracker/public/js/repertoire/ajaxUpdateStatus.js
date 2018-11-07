
const elements = document.getElementsByClassName('icon-holder');
let DOMarray = Array.from(elements);

DOMarray.map((element) => {
    element.addEventListener('click', function (e) {
        const dataArray = getQueryData(e.target.id);
        const repertoireId = dataArray[2];
        const type = dataArray[1];
        const studentId = dataArray[0]
        const token = dataArray[3];
        if (e.target && e.target.matches('img.accept')) {
            updateStatus(studentId, repertoireId, type, token, '2');
        }

        if (e.target && e.target.matches('img.reject')) {
            updateStatus(studentId, repertoireId, type, token, '4');
        }
    })
})

const getQueryData = (data) => {
    return data.split('-');
}

const updateStatus = (studentId, repId, type, token, val) => {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': token
        }
    });

    $.ajax({
        url: `/repertoire/updateStatus/${studentId}/${repId}/${type}/${val}`,
        method: 'post',
        data: {
            _token : token
        },
        success: function (result) {
            console.log(result);
        },
        error : function(jqXHR, textStatus, errorThrown){
            console.log(errorThrown);
            console.log(jqXHR);
            console.log(textStatus);
        }
    });
}
