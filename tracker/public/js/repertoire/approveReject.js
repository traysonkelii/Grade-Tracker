const approved = document.getElementsByClassName('accept');
const unapproved = document.getElementsByClassName('reject');

const approveClick = (elements, check) => {
    // conversion to ES6 array to allow map function
    let DOMarray = Array.from(elements);

    // loops through each item and adds a click listener
    DOMarray.map((elem) => {
        elem.addEventListener('click', function () {
            let myHTML;
            if (check)
            {
                myHTML = '<p style="color: green" class="center-submission">Approved</p>';
            }
            else
            {
                myHTML =  '<p style="color: red" class="center-submission">Rejected</p>';
            }

            let parent = this.parentNode;
            let grandParent = parent.parentNode;

            while (grandParent.firstChild) 
            {
                grandParent.removeChild(grandParent.firstChild);
            }

            grandParent.innerHTML = myHTML;
        })
    })
}

// sets the listeners
approveClick(approved, 1);
approveClick(unapproved, 0);