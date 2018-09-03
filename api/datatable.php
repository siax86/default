<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/system/declaration.php';
@session_start();

$columns = array();

foreach ($_REQUEST['columns'] as $column) 
{
    if($column['data'] == 'DT_RowId')
    {
        $columns[] = array(
            'db' => 'id',
            'dt' => 'DT_RowId',
            'formatter' => function( $d, $row ) {
                return $d;
            }
        );
    }
    else
    {
        $columns[] = array( 
            'db' => $column['data'],
            'dt' => $column['data']
        );
    };
};

$table = $_REQUEST['signature'];
 
$primaryKey = 'id';
 
$sql_details = array(
    'user' => $GLOBALS['config']['db_user_name'],
    'pass' => $GLOBALS['config']['db_user_password'],
    'db'   => $GLOBALS['config']['db_name'],
    'host' => 'localhost'
);
 
require( 'ssp.class.php' );


$result = SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns);

echo json_encode(
    $result, JSON_UNESCAPED_UNICODE
);

/*{
    "draw":1,
    "recordsTotal":2,
    "recordsFiltered":2,
    "data":[
        {
            "DT_RowId":"1",
            "name":"Статус 1"
        },
        {
            "DT_RowId":"2",
            "name":"Статус 2"
        }
    ]
}*/