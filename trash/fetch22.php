<?php

$connect = pg_connect("host=192.168.1.55 dbname=test user=postgres password=123")
                              or die('Не удалось соединиться: ' . pg_last_error());
$columns = array('id', 'First', 'Second', 'Third', 'Fourth');

$query = "SELECT * FROM useri ";

if($_POST["is_date_search"] == "yes")
{
 $query .= 'id BETWEEN "'.$_POST["start_date"].'" AND "'.$_POST["end_date"].'" AND ';
}

if(isset($_POST["search"]["value"]))
{

}


if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].'
 ';
}
else
{
 $query .= 'ORDER BY id DESC ';
}

$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT 1';
}


$result = pg_query($connect, $query . $query1);
$number_filter_row = pg_num_rows($result);
$data = array();

while($row = pg_fetch_assoc($result))
{
 $sub_array = array();
 $sub_array[] = $row["id"];
 $sub_array[] = $row["First"];
 $sub_array[] = $row["Second"];
 $sub_array[] = $row["Third"];
 $sub_array[] = $row["Fourth"];
 $data[] = $sub_array;
}

function get_all_data($connect)
{
 $query = "SELECT * FROM useri";
 $result = pg_query($connect, $query);
 return $number_filter_row;
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($connect),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);
//echo $query . $query1;
echo json_encode($output);

?>