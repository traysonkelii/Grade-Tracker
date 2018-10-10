const all = document.getElementById('all');
const juried = document.getElementById('juried');
const recital = document.getElementById('recital');
const practiced = document.getElementById('practiced');

const setClick = (element) => {
    element.addEventListener('click', function(){
        reset();
        this.style.opacity = 1;
    });
}

const reset = () => {
    all.style.opacity = .5;
    juried.style.opacity = .5;
    recital.style.opacity = .5;
    practiced.style.opacity = .5;
}

setClick(all);
setClick(juried);
setClick(recital);
setClick(practiced);

