let infoArray = $('#formView-info').html().split('-');
const formAttributes = JSON.parse(infoArray[0]);
const studentResponse = infoArray[1];
const token = infoArray[2];
const questions = document.getElementById('formView-holder');
const answers = document.getElementById('formView-answers');

const buildView = (attributes) => {
    ajaxGetAttributes(attributes);
};

const ajaxGetAttributes = async (ids, token) => {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': token
        }
    });

    return $.ajax({
        url: `/form/getAttributes`,
        method: 'post',
        data: {
            _token: token,
            ids
        },
        success: (result) => {
            addToDom(result)
        },
        error: (jqXHR, textStatus, error) => {
            console.log(error);
            console.log(jqXHR);
            console.log(textStatus);
            return;
        }
    })
}

const addToDom = (attributes) => {

    attributes.forEach(attribute => {
        if (attribute.person) {
            return;
        }
        let html;
    
        switch (attribute.type) {
            case 0:
                html = doDropDown(attribute);
                doAppend(html, questions);
                getAnswers(attribute);
                break;
            case 1:
                html = doLongResponse(attribute);
                doAppend(html, questions);
                getAnswers(attribute);
                break;
            case 2:
                html = doCheckBox(attribute);
                doAppend(html, questions);
                getAnswers(attribute);
                break;
            case 3:
                html = doShortAnswer(attribute);
                doAppend(html, questions);
                getAnswers(attribute);
                break;
            default:
                break;
        }
        return;
    })
    //checks attribute is meant for student or jury
    //0 student 1 jury
}

const doDropDown = (att) => {
    let myHTML = `<div id=${att.id}>`;
    myHTML += `<span>${att.name}</span><br>`;
    myHTML = addDescription(att.description, myHTML);
    myHTML += `<select id='val-${att.id}'>`;
    let options = JSON.parse(att.selections);
    options.forEach(option => {
        myHTML += `<option>${option}</option>`
    });
    myHTML += `</select><br></div>`;
    return myHTML;
}

const doLongResponse = (att) => {
    let myHTML = `<div id=${att.id}>`;
    myHTML += `<span>${att.name}</span><br>`;
    myHTML = addDescription(att.description, myHTML);
    myHTML += `<textarea rows="5" cols="100" id='val-${att.id}'></textarea>`;
    return myHTML;
}

const doCheckBox = (att) => {
    let myHTML = `<div id=${att.id}>`;
    myHTML += `<span>${att.name}</span><br>`;
    myHTML = addDescription(att.description, myHTML);
    myHTML += `<div id=val-${att.id} name="checkbox">`
    let options = JSON.parse(att.selections);
    options.forEach(option => {
        myHTML += `<input name="check-${att.id}" type="checkbox" id="${option}">
                    <label for="${option}">${option}</label>
                `
    })
    myHTML += `</div></div>`;
    return myHTML;
}

const doShortAnswer = (att) => {
    let myHTML = `<div id=${att.id}>`;
    myHTML += `<span>${att.name}</span>`;
    myHTML += `<input id='val-${att.id}'>`
    myHTML += `</div>`;
    return myHTML;
}

const doAppend = (html, container) => {
    container.innerHTML += html;
}

const addDescription = (desc, myHTML) => {
    if (desc === 'none') {
        return myHTML;
    }
    else {
        return myHTML += `<span>${desc}</span><br>`;
    }
}

const getAnswers = (attribute) => {
    if (studentResponse !== 'none') {
        let value = 'none';
        let resp = JSON.parse(studentResponse);
        for (id in resp) {
            if (Number.parseInt(id) === attribute.id) {
                value = resp[id];
            }
        }
        let html = `<div><span>${attribute.name}: ${value}</span></div>`;
        doAppend(html, answers);
        attribute.name

    }
    else {
        let html = `<div><span>${attribute.name}: Not submitted</span></div>`;
        doAppend(html, answers);
    }
}

buildView(formAttributes);