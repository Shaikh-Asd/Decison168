$(document).ready(function() {
    $('#datatable').DataTable();
    $('#datatable2').DataTable();
    $('#datatable3').DataTable();
    $('#datatable4').DataTable();
    $('#datatable5').DataTable({"ordering": true,
        "order": [[ 0, "desc" ]]});
    $('#datatable6').DataTable({"lengthMenu": [[5, 10, 50, -1], [5, 10, 50, "All"]],"pageLength": 5,"ordering": true,"order": [[ 6, "desc" ]]});
    $('#datatable7').DataTable({"ordering": true,
        "order": [[ 4, "desc" ]],initComplete: function () {
                    configFilter(this, [ 0, 1, 2, 3, 4]);
                }});
    $('#datatable8').DataTable({"ordering": true,
        "order": [[ 2, "desc" ]],initComplete: function () {
                    configFilter(this, [ 0, 1, 2]);
                }});
    $('#datatable9').DataTable({"ordering": true,
        "order": [[ 2, "desc" ]],initComplete: function () {
                    configFilter(this, [ 0, 1, 2]);
                }});
    $('#datatable10').DataTable({"ordering": true,
        "order": [[ 6, "desc" ]],initComplete: function () {
                    configFilter(this, [ 0, 1, 2, 3, 4, 5, 6]);
                }});
    $('#datatable11').DataTable({"ordering": true,
        "order": [[ 4, "desc" ]],initComplete: function () {
                    configFilter(this, [ 0, 1, 2, 3, 4]);
                }});
    $('#datatable12').DataTable({"ordering": true,
        "order": [[ 4, "desc" ]],initComplete: function () {
                    configFilter(this, [ 0, 1, 2, 4]);
                }});
    $('#datatable13').DataTable({"ordering": true,
        "order": [[ 2, "desc" ]],initComplete: function () {
                    configFilter(this, [ 0, 1, 2]);
                }});
    $('#datatable14').DataTable({"ordering": true,
        "order": [[ 2, "desc" ]],initComplete: function () {
                    configFilter(this, [ 0, 1, 2]);
                }});
    $('#arc_datatable').DataTable({"ordering": true,
        "order": [[ 4, "desc" ]],initComplete: function () {
                    configFilter(this, [ 0, 1, 2, 3, 4]);
                }});
    $('#arc_datatable2').DataTable({"ordering": true,
        "order": [[ 2, "desc" ]],initComplete: function () {
                    configFilter(this, [ 0, 1, 2]);
                }});
    $('#arc_datatable3').DataTable({"ordering": true,
        "order": [[ 2, "desc" ]],initComplete: function () {
                    configFilter(this, [ 0, 1, 2]);
                }});
    $('#arc_datatable4').DataTable({"ordering": true,
        "order": [[ 6, "desc" ]],initComplete: function () {
                    configFilter(this, [ 0, 1, 2, 3, 4, 5, 6]);
                }});
    $('#arc_datatable5').DataTable({"ordering": true,
        "order": [[ 4, "desc" ]],initComplete: function () {
                    configFilter(this, [ 0, 1, 2, 4]);
                }});
    $('#arc_datatable6').DataTable({"ordering": true,
        "order": [[ 2, "desc" ]],initComplete: function () {
                    configFilter(this, [ 0, 1, 2]);
                }});
    $('#arc_datatable7').DataTable({"ordering": true,
        "order": [[ 2, "desc" ]],initComplete: function () {
                    configFilter(this, [ 0, 1, 2]);
                }});
    $('#port_datatable').DataTable({"ordering": true,
        "order": [[ 0, "asc" ]],initComplete: function () {
                    configFilter(this, [ 0, 1]);
                }});
    $('#alert_datatable').DataTable({"ordering": true,
        "order": [[ 0, "desc" ]],initComplete: function () {
                    configFilter(this, [ 2]);
                }});
    $('#sa_quote_datatable').DataTable({"ordering": true,
        "order": [[ 0, "desc" ]],initComplete: function () {
                    configFilter(this, [ 2, 3, 4]);
                }});
    $('#new_tasks_list').DataTable({"ordering": true,
        "order": [[ 7, "desc" ]],initComplete: function () {
                    configFilter(this, [ 1, 2, 3]);
                }});
    $('#sa_pricing_datatable').DataTable({"ordering": true,
        "order": [[ 0, "asc" ]],initComplete: function () {
                    configFilter(this, [ 2]);
                }});
    $('#sa_logo_datatable').DataTable({"ordering": true,
        "order": [[ 0, "desc" ]],initComplete: function () {
                    configFilter(this, [ 2, 3]);
                }});
    $('#sa_cpdatatable').DataTable({"ordering": true,
        "order": [[ 0, "asc" ]]});
    $('#sa_ndatatable').DataTable({"ordering": true,
        "order": [[ 0, "desc" ]]});
    //Buttons examples
    var table = $('#datatable-buttons').DataTable({
        lengthChange: true,
        buttons: ['excel', 'pdf'],
        "ordering": true,
        "order": [[ 0, "desc" ]],
    });

    table.buttons().container()
        .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');

    $(".dataTables_length select").addClass('form-select form-select-sm');

    ////////////////-------------------------------////////////////////

    var table1 = $('#datatable-buttons1').DataTable({
        lengthChange: true,
        buttons: ['excel', 'pdf'],
        "ordering": true,
        "order": [],
        "columnDefs": [
          {
                "type": "date",
                "render": function (data, type, row, meta) {
                  var DateCreated = moment(data, 'YYYY-MM-DD hh:mm:ss').format('YYYY-MM-DD hh:mm:ss');
                  if (data == null){
                   return '';
                   }else{
                       return data;
                   }
                },
                "targets": [3,4]
              },
          ]
    });

    table1.buttons().container()
        .appendTo('#datatable-buttons1_wrapper .col-md-6:eq(0)');

    ////////////////-------------------------------//////////////////// 
    var table2 = $('#datatable-buttons2').DataTable({   
        lengthChange: true, 
        buttons: ['excel', 'pdf'],  
    }); 
    table2.buttons().container()    
        .appendTo('#datatable-buttons2_wrapper .col-md-6:eq(0)');
        
});