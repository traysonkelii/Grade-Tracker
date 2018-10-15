const all = document.getElementById('all');
const juried = document.getElementById('juried');
const recital = document.getElementById('recital');
const unsubmitted = document.getElementById('unsubmitted');
const allRep = document.getElementById('all-rep');
const juriedRep = document.getElementById('juried-rep');
const recitalRep = document.getElementById('recital-rep');
const unsubmittedRep = document.getElementById('unsubmitted-rep')


const setClick = (element, list) => {
    element.addEventListener('click', function(){
        reset();
        this.style.opacity = 1;
        list.style.display = 'block';
    });
}

const reset = () => {
    all.style.opacity = .5;
    juried.style.opacity = .5;
    recital.style.opacity = .5;
    unsubmitted.style.opacity = .5;
    allRep.style.display = 'none';
    juriedRep.style.display = 'none';
    recitalRep.style.display = 'none';
    unsubmittedRep.style.display = 'none';
}

setClick(all, allRep);
setClick(juried, juriedRep);
setClick(recital, recitalRep);
setClick(unsubmitted, unsubmittedRep);

