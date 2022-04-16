<?php

require_once 'db.php';
$db = new Database();

if (isset($_POST['action']) && $_POST['action'] == "view") {
    $output = '';
    $data = $db->read();
    if ($db->totalRowCount() > 0) {
        $output .=
            '<table class="table table-striped table-sm table-bordered">
        <thead>
            <tr class="text-center">
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>';
        foreach ($data as $row) {
            $output .= '<tr class="text-center text-secondary">
            <td>' . $row['id'] . '</td>
            <td>' . $row['title'] . '</td>
            <td>' . $row['description'] . '</td>
            <td>' . $row['status'] . '</td>
            <td>
                <a href="#" title="View Details" class="text-success"><i class="fas fa-info-circle"></i></a>&nbsp;&nbsp;
                <a href="#" title="Edit" class="text-primary"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;
                <a href="#" title="Delete" class="text-danger"><i class="fas fa-trash"></i></a>                          
            </td></tr>';
        }
        $output .= '</tbody></table>';
        echo $output;
    } else {
        echo '<h3 class="text-center text-secondary mt-5">:( No any article</h3>';
    }
}

if (isset($_POST['action']) && $_POST['action'] == "insert") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $status = $_POST['status'];

    $db->insert($title, $description, $status);
}
