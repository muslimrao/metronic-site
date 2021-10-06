$(document).ready(function(){


    for (var i =0;  i <  $(".datatable").length; i++ )
    {
        var table = $(".datatable")[i]; //document.getElementById('kt_table_users');


        const tableRows = table.querySelectorAll('tbody tr');
        /*
        tableRows.forEach(row => {
            const dateRow = row.querySelectorAll('td');
            const lastLogin = dateRow[3].innerText.toLowerCase(); // Get last login time
            let timeCount = 0;
            let timeFormat = 'minutes';

            // Determine date & time format -- add more formats when necessary
            if (lastLogin.includes('yesterday')) {
                timeCount = 1;
                timeFormat = 'days';
            } else if (lastLogin.includes('mins')) {
                timeCount = parseInt(lastLogin.replace(/\D/g, ''));
                timeFormat = 'minutes';
            } else if (lastLogin.includes('hours')) {
                timeCount = parseInt(lastLogin.replace(/\D/g, ''));
                timeFormat = 'hours';
            } else if (lastLogin.includes('days')) {
                timeCount = parseInt(lastLogin.replace(/\D/g, ''));
                timeFormat = 'days';
            } else if (lastLogin.includes('weeks')) {
                timeCount = parseInt(lastLogin.replace(/\D/g, ''));
                timeFormat = 'weeks';
            }

            // Subtract date/time from today -- more info on moment datetime subtraction: https://momentjs.com/docs/#/durations/subtract/
            const realDate = moment().subtract(timeCount, timeFormat).format();

            // Insert real date to last login attribute
            dateRow[3].setAttribute('data-order', realDate);

            // Set real date for joined column
            const joinedDate = moment(dateRow[5].innerHTML, "DD MMM YYYY, LT").format(); // select date from 5th column in table
            dateRow[5].setAttribute('data-order', joinedDate);
        });
        */
       
        // Init datatable --- more info on datatables: https://datatables.net/manual/


        var orderableColumns = [
            { orderable: false, targets: 0 }, // Disable ordering on column 0 (checkbox)
            // { orderable: false, targets: 0 }, // Disable ordering on column 6 (actions)                
        ];

        if ( DIRECTORY == 'sitecontrol/managepilots/' )
        {
            orderableColumns = [{}];
        }
        else {
            
        }


        datatable = $(table).DataTable({
            "info": false,
            'order': [],
            "pageLength": 10,
            "lengthChange": false,
            'columnDefs': orderableColumns
        });

        // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
        datatable.on('draw', function () {

            toggleCheckBoxes();
            // initToggleToolbar();
            // handleDeleteRows();
            // toggleToolbars();
        });




        const filterSearch = document.querySelector('[data-kt-user-table-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            datatable.search(e.target.value).draw();
        });

    }



});