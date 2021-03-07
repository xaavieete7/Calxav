<?php require_once('../static.php'); ?>
<?php
$objDB = new DatabaseConn();
$conn = $objDB->Connection();

$args = "SELECT * FROM `users`";
$sql = mysqli_query($conn, $args);

if (mysqli_num_rows($sql) > 0) {

    $html = '<table class="table">
    <thead>
        <tr class="ranking-first">
            <th scope="col"> Rank </th>
            <th scope="col"> Nom </th>
            <th scope="col"> Carrec </th>
            <th scope="col"> Preu hora </th>
            <th scope="col"> Hores màximes </th>
            <th scope="col" class="text-center"> Opcions </th>
        </tr>
    </thead>';
    while ($rows=mysqli_fetch_assoc($sql)) {

        $id = $rows['id'];
        $rank = $rows['rank'];
        $firstname = $rows['firstname'];
        $carrec = $rows['carrec'];
        $priceHour = $rows['priceHour'];
        $max_hours = $rows['max_hours'];

        if ($rank == "user") {
            $html .= '<tr>
            <td scope="row">'. $rank . '</td>
            <td scope="row">'. $firstname . '</td>
            <td scope="row">'. $carrec . '</td>
            <td scope="row"><input type="number" class="form-control '.$id.'_hour_price" value="'. $priceHour . '"></td>
            <td scope="row"><input type="number" class="form-control '.$id.'_hour_total" value="'. $max_hours . '"></td>
            <td class="option_td"><a href="javascript:editUser('.$id.',\''.$firstname.'\');"><i class="material-icons">save</i></a><a href="javascript:removeUser('.$id.',\''.$firstname.'\');"><i class="material-icons">delete</i></a></td>
        </tr>';
        } else if($rank == "viewer") {
            $html .= '<tr>
            <td scope="row">'. $rank . '</td>
            <td scope="row">'. $firstname . '</td>
            <td scope="row">'. $carrec . '</td>
            <td scope="row"></td>
            <td scope="row"></td>
            <td class="option_td"><a href="javascript:removeUser('.$id.',\''.$firstname.'\');"><i class="ml-27 material-icons">delete</i></a></td>
        </tr>';
        }
        
    }
    $html .= '</table>';
} else {
    $html = "";
}

print($html);

?>