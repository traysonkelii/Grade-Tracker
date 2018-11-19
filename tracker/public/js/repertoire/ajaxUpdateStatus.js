
const elements = document.getElementsByClassName('icon-holder');
let DOMarray = Array.from(elements);

DOMarray.map((element) => {
    element.addEventListener('click', function (e) {
        const dataArray = getQueryData(e.target.id);
        const id = dataArray[0];
        const type = dataArray[1];
        const token = dataArray[2];
        if (e.target && e.target.matches('img.accept')) {
            updateStatus(id, type, 2, token);
        }

        if (e.target && e.target.matches('img.reject')) {
            updateStatus(id, type, 4, token);
        }
    })
})

const getQueryData = (data) => {
    return data.split('-');
}

const updateStatus = (id, type, val, token) => {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': token
        }
    });

    $.ajax({
        url: `/repertoire/update/${id}/${type}/${val}`,
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
