<div class="card">
  <div class="card-header">
    <button type="button" data-obj="user" data-query="create" class="btn btn-outline-success loadmodal" style="float: right;">Создать пользователя</button>
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
        { title: "Имя пользователя", data: "name", className: "name"},
        { title: "Фамилия пользователя", data: "surname", className: "surname" },
        { title: "Отчество пользователя", data: "middlename", className: "middlename" },
        { title: "Логин", data: "login", className: "login"},
        { title: "Пароль", data: "password", className: "password" },
        { title: "Статус пользователя", data: "user_status", className: "user_status"},
        { title: "delmark", data: "delmark", className: "delmark" }
        ];

        signature = 'user';


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

