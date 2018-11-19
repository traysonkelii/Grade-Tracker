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
    let repertoireJsonId = await ajaxGetId('repertoires', 'id', 'name', repInput.val());
    let check;
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
    if (!repertoireJsonId.id) {
        repertoireJsonId.id = await ajaxAddRepertoire(repInput.val(), composerJsonId.id,
        instrumentJsonId.id, genreJsonId.id, token);
    }
    
    check = await ajaxCheckRepertoire(repertoireJsonId.id, composerJsonId.id, 
        instrumentJsonId.id, genreJsonId.id, token);
    if (check.id) {
        addedRepPivotId = await ajaxAddRepertoirePivot(myStuId, check.id, token);
    }
    else {
        let newRepertoire = await ajaxAddRepertoire(repInput.val(), composerJsonId.id, 
            instrumentJsonId.id, genreJsonId.id, token);
        addedRepPivotId = await ajaxAddRepertoirePivot(myStuId, newRepertoire, token);
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
            return;
        },
        error: function (jqXHR, textStatus, errorThrown) {
            showPopUp('problem with adding rep to practice');
            console.log(errorThrown);
            console.log(jqXHR);
            console.log(textStatus);
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
            showPopUp('problem adding repertoire');
            console.log(errorThrown);
            console.log(jqXHR);
            console.log(textStatus);
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
            showPopUp('problem with checking the repertoire');
            console.log(errorThrown);
            console.log(jqXHR);
            console.log(textStatus);
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
            showPopUp('You already have this repertoire on your list.');
            console.log(errorThrown);
            console.log(jqXHR);
            console.log(textStatus);
        }
    });
}
