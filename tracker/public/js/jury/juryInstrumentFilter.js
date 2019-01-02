const showAll = document.getElementById('jury-landing-all');
const studentHTML = Array.from(document.getElementsByClassName('student-holder'));
const juryInstrumentHolder = Array.from(document.getElementsByClassName('jury-landing-row'));
console.log(juryInstrumentHolder);

showAll.addEventListener('click', () => {
    studentHTML.forEach(studentElement => {
        studentElement.hidden = false
    });
});

const hideStudents = () => {
    studentHTML.forEach(studentElement => {
        studentElement.hidden = true;
    });
}

juryInstrumentHolder.forEach((courseHTML) => {
    courseHTML.addEventListener('click', (course) => {
        if (course.target.innerHTML) {
            hideStudents();
            filterStudentByInstrument(course.target.innerHTML);
        }
    })
});

const filterStudentByInstrument = (instrument) => {
    studentHTML.forEach(studentElement => {
        let studentInstrument = studentElement.children[2].children[3].innerHTML;
        if (studentInstrument === instrument) {
            studentElement.hidden = false;
        }
    });
}