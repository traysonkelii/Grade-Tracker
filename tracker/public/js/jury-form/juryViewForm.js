let infoArray = $('#formView-info').html().split('-');
const formAttributes = JSON.parse(infoArray[0]);
const token = infoArray[1];

let pieceArray = Array.from(Array.from(document.getElementsByClassName('form-piece-holder'))[0].children);
let whole = document.getElementsByClassName('form-whole')[0];

const buildView = async (attributes) => {
    attributes.forEach(a => {
        ajaxGetAttribute(a, token);
    });
};

const ajaxGetAttribute = async (id, token) => {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': token
        }
    });

    return $.ajax({
        url: `/form/getAttribute/${id}`,
        method: 'get',
        data: {
            _token: token
        },
        success: (result) => {
            addToDom(result);
        },
        error: (jqXHR, textStatus, error) => {
            console.log(error);
            console.log(jqXHR);
            console.log(textStatus);
            return;
        }
    })
}

const addToDom = (attribute) => {
    let html;
    switch (attribute.type) {
        case 0:
            html = doDropDown(attribute);
            findAppend(attribute, html);
            break;
        case 1:
            html = doLongResponse(attribute);
            findAppend(attribute, html);
            break;
        case 2:
            html = doCheckBox(attribute);
            findAppend(attribute, html);
            break;
        case 3:
            html = doRating(attribute);
            findAppend(attribute, html);
            break;
        default:
            break;
    }
    console.log(attribute);
    return;
}

const doDropDown = (att) => {
    let myHTML = '';
    myHTML += `<span>${att.name}</span> `;
    myHTML += `<select>`;
    let options = JSON.parse(att.selections);
    console.log(options);
    options.forEach(option => {
        myHTML += `<option>${option}</option>`
    });
    myHTML += `</select><br>`;
    return myHTML;
}

const doLongResponse = (att) => {
    let myHTML = '';
    myHTML += `<span>${att.name}</span><br>`;
    myHTML += `<textarea rows="5" cols="100"></textarea><br>`;
    return myHTML;
}

const doCheckBox = (att) => {
    let myHTML = '';
    myHTML += `<span>${att.name}</span>`;
    myHTML += `<input type="checkbox"><br>`;
    return myHTML;
}

const doRating = (att) => {
    let myHTML = '';
    myHTML += `<span>${att.name}</span><br>`;
    myHTML += `<div class="form-rating-holder">`;
    for (let i = att.min; i <= att.max; i++)
    {
        myHTML += `<span>${i}</span>`
    }
    myHTML += `</div><br>`;
    return myHTML;
}

const findAppend = (att, html) => {
    if (att.scope) {
        whole.insertAdjacentHTML('beforebegin',html)
    }
    else {
        pieceArray.forEach(element => {
            element.insertAdjacentHTML('afterend', html)
        });
    }
}


buildView(formAttributes);