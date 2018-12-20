const showAll = document.getElementById('teacher-show-all');
const studentHTML = Array.from(document.getElementsByClassName('student-holder'));
const studentHolder = Array.from(document.getElementsByClassName('student-holder')).map(student => student.id);
const teacherCourseHolder = Array.from(document.getElementById('teacher-course-holder').children);
const token = document.getElementById('teacher-token').innerHTML;

showAll.addEventListener('click', ()=>{
    studentHTML.forEach( studentElement => {
        console.log(studentElement);
        studentElement.hidden = false});
});

const hideStudents = () => {
    studentHTML.forEach( studentElement => {
        studentElement.hidden = true});
}

teacherCourseHolder.forEach( (courseHTML) => {
    courseHTML.addEventListener('click', async (course) => {
        hideStudents();
        filterStudentByClass(course.target.id);
    })
});

const filterStudentByClass = async (courseId) => {
    studentHolder.forEach(async studentId => {
        checkStudentCourse(studentId, courseId, token);
    });
}

const checkStudentCourse = async (studentId, courseId, token) => {
    const URL = 'teacher/filterCourse';
    const body = {
        studentId,
        courseId,
    };

    fetch(URL, {
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json, text-plain, */*',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': token
        },
        method: 'post',
        credentials: 'same-origin',
        body: JSON.stringify(body),
    })
        .then(res => res.json())
        .then((response) => {
            console.log(response);
            if (response.student_id) {
                const tempStudent = document.getElementById(response.student_id);
                tempStudent.hidden = false;
            }
        })
        .catch((error) => {
            console.log(error);
        });
}