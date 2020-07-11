<?php
//fetch.php
$connect = pg_connect("host=192.168.1.55 dbname=testing user=postgres password=123")
                                         or die('Не удалось соединиться: ' . pg_last_error());
$columns = array('order_id', 'order_customer_name', 'order_item', 'order_value', 'order_date');

$query = "SELECT * FROM tbl_order WHERE ";

if($_POST["is_date_search"] == "yes")
{
 $query .= 'order_date BETWEEN "'.$_POST["start_date"].'" AND "'.$_POST["end_date"].'" AND ';
}


 $query .= '
  (order_id::text LIKE "%'.$_POST["search"]["value"].'%"
  OR order_customer_name LIKE "%'.$_POST["search"]["value"].'%"
  OR order_item LIKE "%'.$_POST["search"]["value"].'%"
  OR order_value::text LIKE "%'.$_POST["search"]["value"].'%")
 ';

$query = str_replace('"',"'",$query);
if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].'
 ';
}
else
{
 $query .= 'ORDER BY order_id DESC ';
}

$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['length'];
}



$result = pg_query($connect, $query . $query1);
$number_filter_row = pg_num_rows($result);
$data = array();

while($row = pg_fetch_assoc($result))
{
 $sub_array = array();
 $sub_array[] = $row["order_id"];
 $sub_array[] = $row["order_customer_name"];
 $sub_array[] = $row["order_item"];
 $sub_array[] = $row["order_value"];
 $sub_array[] = $row["order_date"];
 $data[] = $sub_array;
}

function get_all_data($connect)
{
 $query = "SELECT * FROM tbl_order";
 $result = pg_query($connect, $query);
 return $number_filter_row;
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($connect),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);
echo json_encode($output);

?>