<div class="card">
  <div class="card-header">
    <button type="button" data-obj="user_status" data-query="create" class="btn btn-outline-success loadmodal" style="float: right;">Создать статус</button>
  </div>
  <div class="сard-body">   
    <div class="mt-4 table-responsive justify-content-md-center">
      <table id="datatable" class="table table-bordered table-secondary table-striped mt-4"></table>
    </div>
  </div>
</div>
<script type="text/javascript">

        Columns = 
        [
        { title: "id", data: "DT_RowId", className: "id"},
        { title: "Наименование", data: "name", className: "name" }
        ];

        signature = 'user';


    var dt = $('#datatable').DataTable( {
        "processing": true,
        "serverSide": true,
        columns: Columns,
        "columnDefs": [
          {
            "render": function ( data, type, row ) {
              return '<b style="color:' + row["color"] + ';">' + row["name"] + '</b>';
            },
            "targets": getColumnIndexesWithClass( Columns, "name" )
          },
          { 
            "visible": false,  "targets": getColumnIndexesWithClass( Columns, "color" ) 
          }
        ],
        "ajax": "/api/datatable.php?signature=" + signature
    } );


</script>