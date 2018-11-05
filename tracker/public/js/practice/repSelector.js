const selected = document.getElementById('practice-selected');

const addFunction = async () => {
     const repArray = await document.getElementsByClassName('practice-entry');
     for (let i = 0; i < repArray.length; i++)
     {
         repArray[i].addEventListener('click', function(){
             let repId = repArray[i].id.substr(1);
             selected.append(`${repId} `);
         });
     }
}

addFunction();
const setPractice = () => {}
