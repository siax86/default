<div class="card">
  <div class="card-header">
    <h1>Группы пользователей</h1>
    <button type="button" data-obj="group" data-query="create" class="btn btn-outline-success loadmodal" style="float: right;">Создать группу</button>
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
        { title: "Наименование", data: "name", className: "name" },
        { title: "delmark", data: "delmark", className: "delmark" }
        ];

        signature = 'group';


    var dt = $('#datatable').DataTable( {
       "processing": true,
        "serverSide": true,
        columns: Columns,
        "ajax": "/api/datatable.php?signature=" + signature,
        "createdRow": function( row, data, dataIndex ) {
          $(row).addClass('loadmodal');
          $(row).attr('data-query', 'update');
          $(row).attr('data-obj', signature);
          $(row).attr('data-data', JSON.stringify(data));

        }
      
    });

</script>