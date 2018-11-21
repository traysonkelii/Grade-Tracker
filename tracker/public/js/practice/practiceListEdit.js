// update dom
const pList = document.getElementById('practice-list');
const safeRemoveModal = document.getElementById('practice-removeModal');
const confirmYes = document.getElementById('practice-confirmYes');
const confirmNo = document.getElementById('practice-confirmNo');

const ajaxEditPracticeList = (id, token, val) => {
    const type = 'practice'
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

const ajaxDeletePivotEntry = (id, token) => {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': token
        }
    });

    $.ajax({
        url: `/repertoire/deletePivotEntry/${id}`,
        method: 'post',
        data: {
            _token: token
        },
        success: function (result) {
            loader.show()
            location.reload();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log('problem with deleting entry');
            console.log(errorThrown);
            console.log(jqXHR);
            console.log(textStatus);
        }
    });
}

const safeRemovePopUp = (id, token) => {
    safeRemoveModal.style.display = 'block';
    confirmYes.addEventListener('click', async () => {
        safeRemoveModal.style.display = 'none';
        ajaxDeletePivotEntry(id, token);
    })
    confirmNo.addEventListener('click', () => {
        safeRemoveModal.style.display = 'none';
    })
}

const addToPracticeList = async () => {
    const repArray = document.getElementsByClassName('practice-addToList');
    for (let i = 0; i < repArray.length; i++) {
        repArray[i].addEventListener('click', async () => {
            let repId = repArray[i].id;
            idTokenArray = repId.split('-');
            ajaxEditPracticeList(idTokenArray[1], idTokenArray[2], 1);
        });
    }
}

const removeFromPracticeList = async () => {
    const repArray = document.getElementsByClassName('practice-removeFromList');
    for (let i = 0; i < repArray.length; i++) {
        repArray[i].addEventListener('click', async () => {
            let repId = repArray[i].id;
            idTokenArray = repId.split('-');
            ajaxEditPracticeList(idTokenArray[1], idTokenArray[2], 0);
        });
    }
}

const deleteFromRepertoireList = async () => {
    const repArray = document.getElementsByClassName('practice-safeRemove');
    for (let i = 0; i < repArray.length; i++) {
        repArray[i].addEventListener('click', async () => {
            let repId = repArray[i].id;
            idTokenArray = repId.split('-');
            console.log(idTokenArray);
            safeRemovePopUp(idTokenArray[1], idTokenArray[2]);
        });
    }
}

addToPracticeList();
removeFromPracticeList();
deleteFromRepertoireList();