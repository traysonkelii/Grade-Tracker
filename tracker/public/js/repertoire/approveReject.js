const approved = document.getElementsByClassName('approved-click');
const unapproved = document.getElementsByClassName('unapproved-click');

const approveClick = (elements, check) => {
    // conversion to ES6 array to allow map function
    let DOMarray = Array.from(elements);

    // loops through each item and adds a click listener
    DOMarray.map((elem) => {
        elem.addEventListener('click', function () {

            let parent = this.parentNode;
            let grandParent = parent.parentNode;

            while (grandParent.firstChild) 
            {
                grandParent.removeChild(grandParent.firstChild);
            }
            
            if (check) 
            {
                grandParent.innerHTML = '<p style="color: green" class="center-submission">Approved</p>';
            }
            else 
            {
                grandParent.innerHTML = '<p style="color: red" class="center-submission">Rejected</p>';
            }
        })
    })
}

// sets the listeners
approveClick(approved, 1);
approveClick(unapproved, 0);