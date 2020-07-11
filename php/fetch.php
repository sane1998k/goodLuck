<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "root", "avto");
$columns = array('id', 'CurrentDateTime', 'RecName', 'WeightPartTask', 'WeightPartFakt',
                 'OtvesTask', 'OtvesFakt', 'Component1Name', 'Сomponent1Task' ,'Сomponent1Fakt',
                 'Component2Name', 'Сomponent2Task', 'Сomponent2Fakt', 'Component3Name', 'Сomponent3Task',
                 'Сomponent3Fakt', 'Component4Name', 'Сomponent4Task', 'Сomponent4Fakt', 'Component5Name',
                 'Сomponent5Task', 'Сomponent5Fakt', 'Component6Name', 'Сomponent6Task', 'Сomponent6Fakt',
                 'Component7Name', 'Сomponent7Task', 'Сomponent7Fakt', 'Component8Name', 'Сomponent8Task',
                 'Сomponent8Fakt', 'Component9Name', 'Сomponent9Task', 'Сomponent9Fakt', 'Component10Name',
                 'Сomponent10Task', 'Сomponent10Fakt');

$query = "SELECT * FROM linea WHERE ";

if($_POST["is_date_search"] == "yes")
{
 $query .= 'CurrentDateTime BETWEEN "'.$_POST["start_date"].'" AND "'.$_POST["end_date"].'" AND ';
}

if(isset($_POST["search"]["value"]))
{
 $query .= '
  (id LIKE "%'.$_POST["search"]["value"].'%"
  OR RecName LIKE "%'.$_POST["search"]["value"].'%"
  OR WeightPartTask LIKE "%'.$_POST["search"]["value"].'%"
  OR WeightPartFakt LIKE "%'.$_POST["search"]["value"].'%")
 ';
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
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));

$result = mysqli_query($connect, $query . $query1);

$data = array();

while($row = mysqli_fetch_array($result))
{
 $sub_array = array();
 $sub_array[] = $row["id"];
 $sub_array[] = $row["CurrentDateTime"];
 $sub_array[] = $row["RecName"];
 $sub_array[] = $row["WeightPartTask"];
 $sub_array[] = $row["WeightPartFakt"];

  $sub_array[] = $row["OtvesTask"];
  $sub_array[] = $row["OtvesFakt"];
  $sub_array[] = $row["Component1Name"];
  $sub_array[] = $row["Сomponent1Task"];
  $sub_array[] = $row["Сomponent1Fakt"];

    $sub_array[] = $row["Component2Name"];
    $sub_array[] = $row["Сomponent2Task"];
    $sub_array[] = $row["Сomponent2Fakt"];
    $sub_array[] = $row["Component3Name"];
    $sub_array[] = $row["Сomponent3Task"];

        $sub_array[] = $row["Сomponent3Fakt"];
        $sub_array[] = $row["Component4Name"];
        $sub_array[] = $row["Сomponent4Task"];
        $sub_array[] = $row["Сomponent4Fakt"];
        $sub_array[] = $row["Component5Name"];

                $sub_array[] = $row["Сomponent5Task"];
                $sub_array[] = $row["Сomponent5Fakt"];
                $sub_array[] = $row["Component6Name"];
                $sub_array[] = $row["Сomponent6Task"];
                $sub_array[] = $row["Сomponent6Fakt"];

                $sub_array[] = $row["Component7Name"];
                                $sub_array[] = $row["Сomponent7Task"];
                                $sub_array[] = $row["Сomponent7Fakt"];
                                $sub_array[] = $row["Component8Name"];
                                $sub_array[] = $row["Сomponent8Task"];

                                                $sub_array[] = $row["Component7Name"];
                                                                $sub_array[] = $row["Сomponent8Fakt"];
                                                                $sub_array[] = $row["Component9Name"];
                                                                $sub_array[] = $row["Сomponent9Fakt"];
                                                                $sub_array[] = $row["Component10Name"];
       $sub_array[] = $row["Сomponent10Task"];
                                                                       $sub_array[] = $row["Сomponent10Fakt"];
 $data[] = $sub_array;
}

function get_all_data($connect)
{
 $query = "SELECT * FROM linea";
 $result = mysqli_query($connect, $query);
 return mysqli_num_rows($result);
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