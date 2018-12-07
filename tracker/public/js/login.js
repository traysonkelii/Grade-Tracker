
const netId = $('#netid');
const password = $('#password');
const type = $('#type');
const login = $('#login');

login.click(() => {
    if (type.val() === 'student') {
        let student = ajaxCheckLogin('students');
        if (student) {

        }
    }
    else {
        let teacher = ajaxCheckLogin('teachers')
        if (teacher) {
            //
        }
    }
})

const ajaxCheckLogin = (type, netid, password, token) => {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': token
        }
    });

    $.ajax({
        url: `/login/${type}/${id}/${password}`,
        method: 'post',
        data: {
            _token: token
        },
        success: function (result) {
            
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log('problem with deleting entry');
            console.log(errorThrown);
            console.log(jqXHR);
            console.log(textStatus);
        }
    });
}
