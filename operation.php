<?php

include 'connect.php';

if (isset($_POST['action'])) {
    $action = $_POST['action'];
    switch ($action) {
        case 'createOrUpdate' :
            createOrUpdate();
            break;
        case 'selectUser' :
            selectUser();
            break;
        case 'selectHistory' :
            selectHistory();
            break;
        case 'restore' :
            restoreOrTrash();
            break;
        case 'trash' :
            restoreOrTrash();
            break;
        case 'delete' :
            delete();
            break;
        case 'typeHead':
            typeHead();
            break;
    }
}

function selectUser() {
    $dbInstance = connect::get_instance();
    $data = $dbInstance->selectUser();
    echo '<table class="table table-bordered">'
    . '<tr><th width="30%">Username</th>'
    . '<th width="30%">Contact No</th>'
    . '<th width="32%">Email ID</th>'
    . '<th width="8%">&nbsp;</th></tr>';

    if (mysqli_num_rows($data) > 0) {
        while ($row = mysqli_fetch_object($data)) {
            echo '<tr><td>' . $row->username . '</td>'
            . '<td>' . $row->contact . '</td>'
            . '<td>' . $row->email . '</td>'
            . '<td><a class="glyphicon glyphicon-trash" data-id="' . $row->id . '" id="btn_trash"></a></td>'
            . '</tr>';
        }
    } else {
        echo '<tr><td colspan=4>Data not found</td></tr>';
    }
    echo '</table>';
}

function selectHistory() {
    $dbInstance = connect::get_instance();
    $data = $dbInstance->selectHistory();

    echo '<table class="table table-bordered">'
    . '<tr><th width="30%">Username</th>'
    . '<th width="30%">Contact No</th>'
    . '<th width="32%">Email ID</th>'
    . '<th width="8%">&nbsp;</th></tr>';

    if (mysqli_num_rows($data) > 0) {
        while ($row = mysqli_fetch_object($data)) {
            echo '<tr><td>' . $row->username . '</td>'
            . '<td>' . $row->contact . '</td>'
            . '<td>' . $row->email . '</td>'
            . '<td><a class="glyphicon glyphicon-trash" data-id="' . $row->id . '" id="btn_delete" ></a>&nbsp; &nbsp;'
            . '<a class="glyphicon glyphicon-share-alt" data-id="' . $row->id . '" id="btn_restore" ></a></td>'
            . '</tr>';
        }
    } else {
        echo '<tr><td colspan=4>Data not found</td></tr>';
    }
    echo '</table>';
}

function createOrUpdate() {
    $dbInstance = connect::get_instance();
    $username = $_POST['username'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $data = $dbInstance->createOrUpdate($username, $contact, $email);
}

function delete() {
    $dbInstance = connect::get_instance();
    $id = $_POST['id'];
    $data = $dbInstance->delete($id);
}

function restoreOrTrash() {
    $dbInstance = connect::get_instance();
    $id = $_POST['id'];
    $action = $_POST['action'];
    $data = $dbInstance->restoreOrTrash($id, $action);
}

function typeHead() {
    $dbInstance = connect::get_instance();
    $searchTerm = $_POST['query'];
    $data = $dbInstance->typeHead($searchTerm);
    echo json_encode($data);
}
?>

