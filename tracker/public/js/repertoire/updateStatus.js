"use strict";

const elements = document.getElementsByClassName('icon-holder');
let DOMarray = Array.from(elements);

DOMarray.map((element) => {
    element.addEventListener('click', function (e) {
        const studentId = e.target.name;
        const repertoireId = e.target.rep;
        const type = e.target.type;
        if (e.target && e.target.matches('img.accept')) {
            updateStatus(studentId, repertoireId, type, '2');
        }

        if (e.targe && e.target.matches('img.reject')) {
            updateStatus(studentId, repertoireId, type, '4');
        }
    })
})


console.log(studentId, repId, type, val);
    $(document).ready(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        
        $.ajax({
            url: "{{ url('/update/{student_id}/{repertoire_id}/{type}/{val}') }}",
            method: 'post',
            data: {
                student_id: studentId,
                repertoire_id: repId,
                type: type,
                val: val,
            },
            success: function (result) {
                console.log(result);
            }
        });
    
    });