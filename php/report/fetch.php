<?php

//fetch.php

include('../db.php');

$column = array('id', 'date', 'time', 'total', 'pay', 'payment_type');

$query = "SELECT * FROM sales ";

if(isset($_POST['search']['value']))
{
    $query .= '
 WHERE id LIKE "%'.$_POST['search']['value'].'%" 
 OR date LIKE "%'.$_POST['search']['value'].'%" 
 OR time LIKE "%'.$_POST['search']['value'].'%" 
 OR total LIKE "%'.$_POST['search']['value'].'%" 
 OR pay LIKE "%'.$_POST['search']['value'].'%" 
 OR payment_type LIKE "%'.$_POST['search']['value'].'%" 
 ';
}

if(isset($_POST['order']))
{
    $query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
    $query .= 'ORDER BY id DESC ';
}

$query1 = '';

if($_POST['length'] != -1)
{
    $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $connect->prepare($query);

$statement->execute();

$number_filter_row = $statement->rowCount();

$statement = $connect->prepare($query . $query1);

$statement->execute();

$result = $statement->fetchAll();

$data = array();

foreach($result as $row)
{
    $sub_array = array();
    $sub_array[] = $row['id'];
    $sub_array[] = $row['date'];
    $sub_array[] = $row['time'];
    $sub_array[] = $row['total'];
    $sub_array[] = $row['pay'];
    $sub_array[] = $row['payment_type'];
    $data[] = $sub_array;
}

function count_all_data($connect)
{
    $query = "SELECT * FROM sales";
    $statement = $connect->prepare($query);
    $statement->execute();
    return $statement->rowCount();
}

$output = array(
    'draw'    => intval($_POST['draw']),
    'recordsTotal'  => count_all_data($connect),
    'recordsFiltered' => $number_filter_row,
    'data'    => $data
);

echo json_encode($output);

?>