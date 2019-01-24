const messageContainer = Array.from(document.getElementsByClassName('student-teacherView-message'));
const buttonContainer = Array.from(document.getElementsByClassName('student-teacherView-sendMessage'));

const submit = () => {
    alert('sending student the message')
}

messageContainer.forEach(containter => {
    containter.addEventListener('keyup', function (event) {
        event.preventDefault();
        if (event.keyCode === 13) {
            submit();
        }
    })
})

buttonContainer.forEach(containter => {
    containter.addEventListener('click', submit);
})
