// update dom
const pList = document.getElementById('p-list');

const ajaxAddToPractice = (id, token) => {
    const type = 'practice'
    const val = 1;
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
           location.reload();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('problem with storing time to repertoire');
            console.log(errorThrown);
            console.log(jqXHR);
            console.log(textStatus);
        }
    });
}

const addClickToPractice = async () => {
    const repArray = document.getElementsByClassName('add-practice');
    for (let i = 0; i < repArray.length; i++) {
        repArray[i].addEventListener('click', async () => {
            let repId = repArray[i].id;
            idTokenArray = repId.split('-');
            ajaxAddToPractice(idTokenArray[1], idTokenArray[2]);
        });
    }
}

addClickToPractice();