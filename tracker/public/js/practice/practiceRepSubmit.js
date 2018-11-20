let repInput = $('#practice-repertoireInput');
let comInput = $('#practice-composerInput');
let insInput = $('#practice-instrumentInput');
let genInput = $('#practice-genreInput');
const submitInput = $('#practice-submitRep');
const myStuId = $('#my-stu-id');
const loader = $('#practice-loading-popup');

submitInput.click(() => {
    let token = submitInput.attr('name');
    loader.show();
    validate(token, myStuId.html());
})


const validate = async (token, myStuId) => {
    const genreJsonId = await ajaxGetId('genres', 'id', 'name', genInput.val(), token);
    const instrumentJsonId = await ajaxGetId('instruments', 'id', 'name', insInput.val(), token);
    let composerJsonId = await ajaxGetId('composers', 'id', 'name', comInput.val());
    let repertoireJsonArray = await ajaxGetRepIds(repInput.val());
    let repertoireJsonId;
    let addedRepPivotId;
    if (!genreJsonId.id) {
        showPopUp("genre doesn't exist");
        return;
    }
    if (!instrumentJsonId.id) {
        showPopUp("instrument doesn't exist");
        return;
    }
    if (!composerJsonId.id) {
        composerJsonId.id = await ajaxAddComposer(comInput.val(), token);
    }
    if (!repertoireJsonArray || repertoireJsonArray.length < 1) {
        repertoireJsonId = await ajaxAddRepertoire(repInput.val(), composerJsonId.id, instrumentJsonId.id, genreJsonId.id, token);
        addedRepPivotId = await ajaxAddRepertoirePivot(myStuId, repertoireJsonId, token);
    }
    else {
        let none = true;
        for (let i = 0; i < repertoireJsonArray.length; i++) {
            check = await ajaxCheckRepertoire(repertoireJsonArray[i].id, composerJsonId.id, instrumentJsonId.id, genreJsonId.id, token);
            if (check.original.id) {
                addedRepPivotId = await ajaxAddRepertoirePivot(myStuId, check.original.id, token);
                none = false;
            }
        }
        if (none) {
            repertoireJsonId = await ajaxAddRepertoire(repInput.val(), composerJsonId.id, instrumentJsonId.id, genreJsonId.id, token);
            addedRepPivotId = await ajaxAddRepertoirePivot(myStuId, repertoireJsonId, token);
        }

    }
    ajaxAddToPractice(addedRepPivotId, token);
    return;
}


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
            window.location.reload();
            loader.hide();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            showPopUp('problem with adding rep to practice');
            console.log(errorThrown);
            console.log(jqXHR);
            console.log(textStatus);
            return;
        }
    });
}

const ajaxGetId = (table, wanted, col, val, token) => {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': token
        }
    });

    return $.ajax({
        url: `/search/getAttribute/${table}/${wanted}/${col}/${val}`,
        method: 'get',
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

const ajaxGetRepIds = (val, token) => {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': token
        }
    });

    return $.ajax({
        url: `/search/getRepId/${val}`,
        method: 'get',
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

const ajaxAddComposer = (name, token) => {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': token
        }
    });

    return $.ajax({
        url: `/composer/create/${name}`,
        method: 'post',
        data: {
            _token: token
        },
        success: function (result) {
            return result;
        },
        error: function (jqXHR, textStatus, errorThrown) {
            showPopUp('problem with creating composer');
            console.log(errorThrown);
            console.log(jqXHR);
            console.log(textStatus);
            return;
        }
    });
}


const ajaxAddRepertoire = (name, com_id, ins_id, gen_id, token) => {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': token
        }
    });

    return $.ajax({
        url: `/repertoire/createRep/${name}/${com_id}/${ins_id}/${gen_id}`,
        method: 'post',
        data: {
            _token: token
        },
        success: function (result) {
            return result;
        },
        error: function (jqXHR, textStatus, errorThrown) {
            showPopUp('problem with adding the repertoire');
            console.log(errorThrown);
            console.log(jqXHR);
            console.log(textStatus);
            return;
        }
    });
}


const ajaxCheckRepertoire = (id, comId, insId, genId, token) => {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': token
        }
    });

    return $.ajax({
        url: `/repertoire/readRepCheck/${id}/${comId}/${insId}/${genId}`,
        method: 'get',
        data: {
            _token: token
        },
        success: function (result) {
            return result;
        },
        error: function (jqXHR, textStatus, errorThrown) {
            showPopUp('problem with reading the repertoire');
            console.log(errorThrown);
            console.log(jqXHR);
            console.log(textStatus);
            return;
        }
    });
}

const ajaxAddRepertoirePivot = (stuId, repId, token) => {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': token
        }
    });

    return $.ajax({
        url: `/repertoire/createPivot/${stuId}/${repId}`,
        method: 'post',
        data: {
            _token: token
        },
        success: function (result) {
            return result;
        },
        error: function (jqXHR, textStatus, errorThrown) {
            showPopUp('Problem adding to Repertoire list');
            console.log(errorThrown);
            console.log(jqXHR);
            console.log(textStatus);
            return;
        }
    });
}
