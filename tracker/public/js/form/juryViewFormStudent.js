let infoArray = $('#formView-info').html().split('-');
const formAttributes = JSON.parse(infoArray[0]);
const studentResponse = infoArray[1];
const token = infoArray[2];
const questions = document.getElementById('formView-holder');
const answers = document.getElementById('formView-answers');

const buildView = async (attributes) => {
    attributes.forEach(async (a) => {
        await ajaxGetAttribute(a, token);
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
    //checks attribute is meant for student or jury
    //0 student 1 jury
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
}

const doDropDown = (att) => {
    let myHTML = `<div id=${att.id}>`;
    myHTML += `<span>${att.name}</span><br>`;
    myHTML = addDescription(att.description, myHTML);
    myHTML += `<select>`;
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
    myHTML += `<textarea rows="5" cols="100"></textarea><br>`;
    return myHTML;
}

const doCheckBox = (att) => {
    let myHTML = `<div id=${att.id}>`;
    myHTML += `<span>${att.name}</span><br>`;
    myHTML = addDescription(att.description, myHTML);
    myHTML += `<input type="checkbox"><br>`;
    return myHTML;
}

const doShortAnswer = (att) => {
    let myHTML = `<div id=${att.id}>`;
    myHTML += `<span>${att.name}</span><br>`;
    myHTML += `<input>`
    myHTML += `</div>
    <span id=${att.id}-value></span>
    </div><br>`;

    return myHTML;
}

const doAppend = (html, container) => {
    container.insertAdjacentHTML('afterend', html);
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
        for(id in resp){
            if(Number.parseInt(id) === attribute.id){
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
let meeeee = document.getElementsByClassName('meeeester');
console.log(meeeee)
buildView(formAttributes);