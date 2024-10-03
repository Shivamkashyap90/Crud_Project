<?php
//make a connection from our database
include 'partials/_dbconnection.php';

$insert = false;
$update = false;
$delete = false;

if (isset($_GET['delete'])) {
  $sno = $_GET["delete"];
  $delete = true;
  $sql = "DELETE FROM `notes` WHERE `sno` = $sno";
  $result = mysqli_query($conn, $sql);
}


// now let's see how we can insert data into a database 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['snoEdit'])) {
    $sno = $_POST['snoEdit'];
    $note_title = $_POST['note_titleEdit'];
    $description = $_POST['descriptionEdit'];

    // Sql query to be updatated 

    $sql = "UPDATE `notes` SET `note_title` = '$note_title' , `description` = '$description' WHERE `notes`.`sno` = $sno ";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      // echo "We updated the record sucssessfully!";
      $update = true;
    }
  } else {
    $note_title = $_POST["note_title"];
    $description = $_POST["description"];

    $sql = "INSERT INTO `notes` (`note_title`, `description`) VALUES ( '$note_title', '$description')";

    //yaha par ye query database se connection  establish ke kam me aata hai .
    $result = mysqli_query($conn, $sql);

    if ($result) {
      // echo  "The data has been inserted  successfully ";
      $insert = true;
    } else {
      echo "The data hasn't been  inserted because of this error --> " . mysqli_error($conn);
    }
  }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Bootstrap CSS -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
    crossorigin="anonymous" />
  <link rel="stylesheet" href="//cdn.datatables.net/2.1.3/css/dataTables.dataTables.min.css">

  <title>PROJECT-1_Crud_Operation</title>
</head>

<body>

  <!-- Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModal">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/CRUD_PROJECT/index.php" method="post">
          <div class="modal-body">

            <input type="hidden" id="snoEdit" name="snoEdit">
            <h2>Add a Notes</h2>
            <div class="mb-3">
              <label for="note_titleEdit" class="form-label">Note Title</label>
              <input
                type="text"
                class="form-control"
                id="note_titleEdit"
                name="note_titleEdit"
                aria-describedby="emailHelp" />
            </div>
            <div class="mb-3">
              <label for="descriptionEdit" class="form-label">Note Description</label>
              <textarea
                class="form-control"
                name="descriptionEdit"
                id="descriptionEdit"
                rows="3"
                placeholder="Add your description here"></textarea>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <?php
  include 'partials/_header.php';
  include 'partials/_singupModal.php';
  include 'partials/_loginModal.php';
  ?>
  <?php

  if (isset($_GET['singupsuccess']) && ($_GET['singupsuccess']) == "true") {
    echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
          <strong>Successfull Singup!</strong> Now you can login.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
  } else if (isset($_GET['singupsuccess']) && ($_GET['singupsuccess']) == "false") {
    echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
  <strong>Sorry!</strong> Your password do not match, please try again!.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
  }

  if (isset($_GET['login']) && ($_GET['login']) == 'true') {
    echo '<div class="alert alert-success alert-dismissible fade show my-0" role="alert">
            <strong>Successfully Logedin !</strong> Thanku!.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
  } else if (isset($_GET['login']) && ($_GET['login']) == 'false') {
    echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
            <strong>Sorry !</strong> please check your Email or Password and agian try to login , Thanku .
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
  }
  if (isset($_GET['usernameError']) && ($_GET['usernameError']) == "true") {
    echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
          <strong>Username Exist ! </strong> Please try with another username.
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
  }
  if (isset($_GET['logout']) && ($_GET['logout']) == "true") {
    echo '<div class="alert alert-danger alert-dismissible fade show my-0" role="alert">
          <strong>Susscessfully Logout! </strong>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
  }
  ?>
  <!-- *************************End-nav-bar******************************* -->

  <?php
  if ($insert) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Your note has been inserted successfully
    !.
    <button type="button" class="btn-close" data-bs-dismiss="alert"     aria-label="Close"></button>
    </div>';
  } else if ($update) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Your note has been Updated successfully
    !.
    <button type="button" class="btn-close" data-bs-dismiss="alert"     aria-label="Close"></button>
    </div>';
  } else if ($delete) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Your note has been deleted successfully
    !.
    <button type="button" class="btn-close" data-bs-dismiss="alert"     aria-label="Close"></button>
    </div>';
  }

  ?>

  <div class="container my-4">
    <form action="/CRUD_PROJECT/index.php" method="post">
      <h2>Add a Notes</h2>
      <div class="mb-3">
        <label for="note_title" class="form-label">Note Title</label>
        <input
          type="text"
          class="form-control"
          id="note_title"
          name="note_title"
          aria-describedby="emailHelp" />
      </div>
      <div class="mb-3">
        <label for="description" class="form-label">Note Description</label>
        <textarea
          class="form-control"
          for="description"
          name="description"
          id="description"
          rows="3"
          placeholder="Add your description here"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Add Note</button>

    </form>
  </div>

  <div class="container my-4">
    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">Sno</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM `notes`";
        $result = mysqli_query($conn, $sql);
        $sno = 0;
        while ($row = mysqli_fetch_assoc($result)) {
          $sno = $sno + 1;
          echo " <tr>
          <th scope='row'>" . $sno . "</th>
          <td>" . $row['note_title'] . "</td>
          <td>" . $row['description'] . "</td>
          <td> <button class=' edit btn btn-sm btn-primary' id =" . $row['sno'] . ">Edit</button>  <button class=' delete btn btn-sm btn-primary' id =d" . $row['sno'] . ">Delete</button> </td>
        </tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
  <hr>

  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/2.1.3/js/dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#myTable').DataTable();
    })
  </script>

  <script>
    //Edit section 
    let edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit", );
        tr = e.target.parentNode.parentNode;
        title = tr.getElementsByTagName('td')[0].innerText;
        description = tr.getElementsByTagName('td')[1].innerText;
        console.log(title, description);
        note_titleEdit.value = title;
        descriptionEdit.value = description;
        snoEdit.value = e.target.id;
        console.log(e.target.id);
        $('#editModal').modal('toggle');

      })
    })

    //delete section
    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit", );
        sno = e.target.id.substr(1, );

        if (confirm("Are you sure ? you want to delete!")) {
          console.log("yes");
          window.location = `/CRUD_PROJECT/index.php?delete=${sno}`;
        } else {
          console.log("no");

        }

      })
    })
  </script>

</body>

</html>