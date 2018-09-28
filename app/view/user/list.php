<div class="card">
  <div class="card-header">
    <h1 style="display: inline;">Пользователи</h1>
    <button type="button" data-obj="user" data-query="create" class="btn btn-outline-success loadmodal" style="float: right;">Создать пользователя</button>
  </div>
  <div style="margin-left: 100px;margin-right: 100px;" class="сard-body">   
    <div class="mt-4 table-responsive justify-content-md-center">
      <table id="datatable" class="table table-bordered table-secondary table-striped mt-4"></table>
    </div>
  </div>
</div>
<script type="text/javascript">

  /*создаем массив колонок в таблице #datatable*/
  Columns = 
  [
  { title: "id", data: "DT_RowId", className: "id"},
  { title: "Имя пользователя", data: "name", className: "name"},
  { title: "Фамилия пользователя", data: "surname", className: "surname" },
  { title: "Отчество пользователя", data: "middlename", className: "middlename" },
  { title: "Логин", data: "login", className: "login"},
  { title: "Пароль", data: "password", className: "password" },
  { title: "Статус пользователя", data: "user_status", className: "user_status"},
  { title: "Статус пользователя", data: "user_status_name", className: "user_status_name"},
  //{ title: "Статус пользователя", data: "user_status_color", className: "user_status_color"},
  { title: "role", data: "role", className: "role"},
  { title: "Роль", data: "role_name", className: "role_name"},
  { title: "config", data: "config", className: "config"},
  { title: "Конфигурация", data: "config_name", className: "config_name" },
  { title: "delmark", data: "delmark", className: "delmark" }
  ];

  signature = 'list_user';

  /*формирование таблицы с помощью плагина Datatable*/
  var dt = $('#datatable').DataTable( {
    "processing": true,
    "serverSide": true,
    columns: Columns,
    "ajax": "/api/datatable.php?signature=" + signature,
    "createdRow": function( row, data, dataIndex ) {
      $(row).addClass('loadmodal');
      $(row).attr('data-query', 'update');
      $(row).attr('data-obj', 'user');
      $(row).attr('data-data', JSON.stringify(data));
      //console.log(JSON.stringify(data));
    },

    "columnDefs" : [
    {
      "render": function(data,type,row)
      {
        return '<span style="color:' + row['user_status_color'] + '">' + row['user_status_name'] + '</span>';
      },
      "targets": getColumnIndexesWithClass(Columns,"user_status_name")
    },
    {
      "visible":false,
      "targets": getColumnIndexesWithClass(Columns,"user_status")
    },
    {
      "visible":false,
      "targets": getColumnIndexesWithClass(Columns,"user_status_color")
    },
        {
      "visible":false,
      "targets": getColumnIndexesWithClass(Columns,"role")
    },
    {
      "visible":false,
      "targets": getColumnIndexesWithClass(Columns,"config")
    }

    ]

  });

