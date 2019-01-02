const showAll = document.getElementById('teacher-show-all');
const studentHTML = Array.from(document.getElementsByClassName('student-holder'));
const studentHolder = Array.from(document.getElementsByClassName('student-holder')).map(student => student.id);
const teacherCourseHolder = Array.from(document.getElementById('teacher-course-holder').children);

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

teacherCourseHolder.forEach((courseHTML) => {
    courseHTML.addEventListener('click', (course) => {
        if (course.target.id) {
            hideStudents();
            filterStudentByClass(course.target.id);
        }
    })
});

const filterStudentByClass = (courseId) => {
    studentHTML.forEach(async studentElement => {
        let studentCourses = studentElement.childNodes[7].childNodes;
        await studentCourses.forEach(course => {
            if (course.innerHTML === courseId) {
                studentElement.hidden = false;
            }
        })
    });
}