
const practiceContainer = Array.from(document.getElementsByClassName('student-teacherView-prow'));
const summaryContainer = document.getElementsByClassName('student-teacherView-sbody')[0];
const summaryTitle = document.getElementsByClassName('student-teacherView-stitle')[0];

practiceContainer.forEach(container => {
    container.addEventListener('click', function(){
        let hidden = this.children[1];
        hideAll();
        show(hidden);
    })
})

summaryTitle.addEventListener('click', function(){
    hideAll();
    show(summaryContainer);
})

const hideAll = () => {
    hide(summaryContainer);
    practiceContainer.forEach(container => {
        hide(container.children[1]);
    })
}

const hide = (element) => {
    element.style.display = 'none';
}

const show = (element) => {
    element.style.display = 'block';
    element.style.height = '250px';
    element.style.opacity = 1;
}

