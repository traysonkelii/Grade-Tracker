
let count = 0;
const adder = $('#form-adder');
const submitter = $('#form-submit');
const formHolder = $('.jury-build-holder');
const token = $('#form-token');
const formName = $('#form-name');
const formArray = [];

adder.click(() => {
    const newHTML = getHTMLString();
    formHolder.append(newHTML);
    const selectionAdder = $(`#form-selection-adder-${count - 1}`);
    selectionAdder.click(function () {
        $(this).parent().append('<input>');
    })
})

submitter.click(async () => {
    if (!formName[0].value || formName[0].value.length < 0) {
        alert("add proper name");
        return;
    }
    let fieldsHTML = document.getElementsByClassName('jury-build-attribute');
    let fieldsArray = Array.from(fieldsHTML);
    let dept = document.getElementById('jury-form-department').value;
    let formIds = await getIds(fieldsArray);

    ajaxCreateForm(formName[0].value, formIds, dept, token.html());
});


const getIds = async (IdArray) => {
    const promises = await IdArray.map(async (a) => {
        let htmlArray = Array.from(a.children);

        let name = htmlArray[0].children[1].value;

        let desc = htmlArray[1].children[1].value;

        let typeHTML = htmlArray[2].children[1].value;
        let typeArray = typeHTML.split(' ');
        let type = typeArray[0];

        let scopeHTML = htmlArray[3].children[1].value;
        let scopeArray = scopeHTML.split(' ');
        let scope = scopeArray[0];

        let selectHTML = htmlArray[4].children;
        let tempSelect = Array.from(selectHTML[1].children);
        let selectArray = tempSelect.slice(1);
        let selectJSON = selectArray.map(s => s.value);
        let select = JSON.stringify(selectJSON);

        let max = htmlArray[5].children[1].value;

        let min = htmlArray[6].children[1].value;

        let personHTML = htmlArray[7].children[1].value;
        let personArray = personHTML.split(' ');
        person = personArray[0];

        let id = await ajaxCreateFormAttribute(name, desc, type, scope, max, min, select, person, token.html());
        return id;
    });
    return Promise.all(promises);
}

const getHTMLString = () => {
    let attributeHTMLString =
        `
        <div class="jury-build-attribute">
                    <div>
                        <p>Attribute Name</p>
                        <input type="text">
                    </div>
                    <div>
                        <p>Description</p>
                        <input type="text">
                    </div>
                    <div>
                        <p>Type</p>
                        <select>
                            <option value="0">Drop Down</option>
                            <option value="1">Long Answer</option>
                            <option value="2">Check Box</option>
                            <option value="3">Rate</option>
                        </select>
                    </div>
                    <div>
                        <p>Scope</p>
                        <select>
                            <option value="0">Individual Piece</option>
                            <option value="1">Whole Performance</option>
                        </select>
                    </div>
                    <div>
                        <p>Select (for Drop)</p>
                        <div>
                            <div id="form-selection-adder-${count}">+</div>
                        </div>
                    </div>
                    <div>
                        <p>Max (for Rate)</p>
                        <input type="number">
                    </div>
                    <div>
                        <p>Min (for Rate)</p>
                        <input type="number">
                    </div>
                    <div>
                        <p>Person</p>
                        <select>
                            <option value="0">Student</option>
                            <option value="1">Jury</option>
                        </select>
                    </div>
                </div>
        `;
    count += 1;
    return attributeHTMLString
}

const ajaxCreateForm = async (name, attributes, dept, token) => {
    let att = JSON.stringify(attributes);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': token
        }
    });

    return $.ajax({
        url: `/form/createForm`,
        method: 'post',
        data: {
            _token: token,
            name,
            att,
            dept,
        },
        success: (results) => {
            window.location.reload();
        },
        error: (jqXHR, textStatus, error) => {
            console.log(error);
            console.log(jqXHR);
            console.log(textStatus);
            return;
        }
    })
}

const ajaxCreateFormAttribute = async (name, desc, type, scope, max, min, selections, person, token) => {

    if (!desc)
        desc = "none";
    if (selections.length < 1)
        selections = "none";
    if (!max)
        max = 0;
    if (!min)
        min = 0;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': token
        }
    });

    return $.ajax({
        url: `/form/createFormAttribute`,
        method: 'post',
        data: {
            _token: token,
            name,
            desc,
            type,
            scope,
            max,
            min,
            selections,
            person,
        },
        success: (result) => {
            return result;
        },
        error: (jqXHR, textStatus, errorThrown) => {
            console.log(errorThrown);
            console.log(jqXHR);
            console.log(textStatus);
            return;
        }
    });
}
