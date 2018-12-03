
let count = 0;
const adder = $('#form-adder');
const submitter = $('#form-submit');
const formHolder = $('.jury-build-holder');
const token = $('#form-token');
const formName = $('#form-name');
const formArray = [];
//implement remove


adder.click(() => {
    const newHTML = getHTMLString();
    formHolder.append(newHTML);
    const selectionAdder = $(`#form-selection-adder-${count - 1}`);
    selectionAdder.click(function () {
        $(this).parent().append('<input>');
    })
})

submitter.click(async () => {
    if (!formName[0].value || formName[0].value.length < 0){
        alert("add proper name");
        return;
    }
    let fieldsHTML = document.getElementsByClassName('jury-build-attribute');
    let fieldsArray = Array.from(fieldsHTML);
    let formIds = await getIds(fieldsArray);

    ajaxCreateForm(formName[0].value, formIds, token.html());
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

        let id = await ajaxReadOrCreateFormAttribute(name, desc, type, scope, max, min, select, max, min, token.html());
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
                        <p>Select (for Drop Down)</p>
                        <div>
                            <div id="form-selection-adder-${count}">+</div>
                        </div>
                    </div>
                    <div>
                        <p>Max (for Check Box)</p>
                        <input type="number">
                    </div>
                    <div>
                        <p>Min (for Check Box)</p>
                        <input type="number">
                    </div>
                    <div>
                        <p>Remove</p>
                        X
                    </div>
                </div>
        `;
    count += 1;
    return attributeHTMLString
}

const ajaxCreateForm = async (name, attributes, token) => {
    let stringAtt = JSON.stringify(attributes);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN':token
        }
    });

    return $.ajax({
        url: `/form/createForm/${name}/${stringAtt}`,
        method: 'post',
        data: {
            _token: token
        },
        success: () => {
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

const ajaxReadOrCreateFormAttribute = async (name, desc, type, scope, max, min, selections, token) => {
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
        url: `/form/createFormAttribute/${name}/${desc}/${type}/${scope}/${max}/${min}/${selections}`,
        method: 'get',
        data: {
            _token: token
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
