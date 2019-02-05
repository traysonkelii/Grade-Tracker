const messageContainer = Array.from(document.getElementsByClassName('student-teacherView-message'));
const buttonContainer = Array.from(document.getElementsByClassName('student-teacherView-sendMessage'));
const commentHolder = Array.from(document.getElementsByClassName('student-teacherView-comment-holder'));
const messageToken = document.getElementById('token').innerHTML;

commentHolder.forEach(container => {
    let data =  container.children[0].innerHTML.split('[')[1]
    let cleansedCommentArray = JSON.parse(`[${data}`);
    console.log(cleansedCommentArray)
    // let id = container.children[0].id
    cleansedCommentArray.forEach(comment => {
        let person =  comment.person ? 'student-teacherView-tcomment' : 'student-teacherView-scomment';
        container.insertAdjacentHTML('beforeend',
        `
        <div class=${person}>${comment.value}</div>
        `
        )
    })
})

messageContainer.forEach(container => {
    container.addEventListener('keyup', (event) => {
        event.preventDefault();
        if (event.keyCode === 13) {
            let message = container.value;
            let repStuId = container.parentNode.children[2].innerHTML;
            let display = container.parentNode.parentNode.children[1]
            container.value = ''
            ajaxSendMessage(message, repStuId, messageToken, display)
        }
    })
})

buttonContainer.forEach(container => {
    container.addEventListener('click', () => {
        let message = container.parentNode.children[0].value;
        let repStuId = container.parentNode.children[2].innerHTML;
        let display = container.parentNode.parentNode.children[1]
        container.parentNode.children[0].value = '';
        ajaxSendMessage(message, repStuId, messageToken, display)
    });
})


const ajaxSendMessage = (message, repStuId, token, container) => {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': token
        }
    });

    $.ajax({
        url: `/comments/add`,
        method: 'post',
        data: {
            _token: token,
            message,
            repStuId,
            person: 1
        },
        success: function (result) {
            addToDom(container, message)
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('problem with adding to practice');
            console.log(errorThrown);
            console.log(jqXHR);
            console.log(textStatus);
        }
    });
}

const addToDom = (container, message) => {
    container.insertAdjacentHTML('beforeend',`
        <div class="student-teacherView-tcomment">${message}</div>
        `);
}

