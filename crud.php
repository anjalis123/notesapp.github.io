

<?php
  $insert=false;
$update=false;
$delete=false;
$servername="localhost";
$username="root";
$password="";
$database="notes";
$conn=mysqli_connect($servername,$username,$password,$database);
if(!$conn){
    echo "connection is not successful";
}

if(isset($_GET['delete'])){
  $sno=$_GET['delete'];
  $delete=true;
  $sql="DELETE FROM `notes` WHERE `sno`=$sno";
  $result=mysqli_query($conn,$sql);


}
if($_SERVER['REQUEST_METHOD']=='POST'){
  if(isset($_POST['snoEdit'])){
    //update note
    $sno=$_POST['snoEdit'];

    $title=$_POST['titleEdit'];
    $details=$_POST['detailsEdit'];
$sql="UPDATE `notes` SET `title`='$title' , `details`='$details' WHERE `notes`.`sno`=$sno";
    $result=mysqli_query($conn,$sql);
    if($result){
$update=true;
    }
    else{
echo "couldn't be updated ";
    }
  
  }
else{
  $title=$_POST['title'];
  $details=$_POST['details'];
  $sql="INSERT INTO `notes` ( `title`, `details`) VALUES ('$title ', '$details')";
  $result=mysqli_query($conn,$sql);
if($result){
  $insert=true;
}
else{
  echo "error";
}
}
}

?>





<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="bootstrap.css">
    <title>Notes Storing App</title>
  </head>
  <body>
  <!-- Modal -->
<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">

  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit note</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="/inotes/crud.php" method="post">
    <input type="hidden" name="snoEdit" id="snoEdit">
  <div class="form-group">
    <label for="title">Add Title</label>
    <textarea class="form-control" id="titleEdit" name="titleEdit" rows="1">
    </textarea>
  </div>
  <div class="form-group">
    <label for="desc">Add Description</label>
    <textarea class="form-control" id="detailsEdit" name="detailsEdit" rows="3">
    </textarea>
  </div>
   
  <button type="submit" class="btn btn-primary">Update Note</button>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-second
        ary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>
<?php
if($insert){
echo " <div class='alert alert-success alert-dismissible fade show' role='alert'>
<strong>success!! </strong> your note has been inserted succesfully
<button type='button' class='close' data-dismiss='alert' aria-label='close'>
<span aria-hidden='true'>&times;</span>
</button>
</div> ";
}


?>
    <?php
if($delete){
echo " <div class='alert alert-success alert-dismissible fade show' role='alert'>
<strong>success!! </strong> your note has been deleted succesfully
<button type='button' class='close' data-dismiss='alert' aria-label='close'>
<span aria-hidden='true'>&times;</span>
</button>
</div> ";
}


?>
<?php
if($update){
echo " <div class='alert alert-success alert-dismissible fade show' role='alert'>
<strong>success!! </strong> your note has been updated succesfully
<button type='button' class='close' data-dismiss='alert' aria-label='close'>
<span aria-hidden='true'>&times;</span>
</button>
</div> ";
}


?>
 
<div class="container my-4">
<form action="/inotes/crud.php" method="post">
    <div class="form-group">
      <label for="title">Title</label>
      <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
    
    </div>
    <div class="form-group">
      <label for="details">Deescription</label>
      <textarea name="details" id="details" cols="130" rows="5"></textarea>
    </div>
    
    <button type="submit" class="btn btn-primary">Add to Note</button>
   
</form>
 </div>
 

 <div class="container">
 
<table class="table" id="myTable">
<thead>
<tr>
<th scope="col">Sno</th>
<th scope="col">Title</th>
<th scope="col">Details</th>
<th scope="col">Action</th>

</tr>
</thead>
<tbody>
<?php
$sql="SELECT * FROM `notes`";
 $result=mysqli_query($conn,$sql);
 $sno=0;
 while($row=mysqli_fetch_assoc($result)){
  $sno=$sno+1; 
  echo "<tr>
   <th scope='row'>".$sno."</th>
   <td>".$row['title']."</td>
   <td>".$row['details']."</td>
   <td> <button class='edit btn btn-sm btn-primary' id=".$row['sno'].">Edit</button>
   <button class='delete btn btn-sm btn-primary' id=d".$row['sno'].">Delete</button>
   </td>
   </tr>";
 }
 

?>
</tbody>
</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script>
 $(document).ready( function () {
    $('#myTable').DataTable();
} );
 </script>
 <script>
  edit= document.getElementsByClassName('edit');
Array.from(edit).forEach((element)=>{
  element.addEventListener("click",(e)=>{
    console.log("edit ",e.target.parentNode.parentNode);
    tr = e.target.parentNode.parentNode;
    title=tr.getElementsByTagName("td")[0].innerText;
    details=tr.getElementsByTagName("td")[1].innerText;
    console.log(title,details);
    titleEdit.value=title;
    detailsEdit.value=details;
    snoEdit.value=e.target.id;
    console.log(e.target.value);
    $('#editmodal').modal('toggle');


  })
});
  
 deletes= document.getElementsByClassName('delete');
Array.from(deletes).forEach((element)=>{
  element.addEventListener("click",(e)=>{
    console.log("edit ",);
    sno=e.target.id.substr(1,);
   if(confirm("Are you Sure you want to delete?")){
console.log("yes");
window.location=`/inotes/crud.php?delete=${sno}`;
   }
   else{
console.log("no");
   }
    

       

  })
})


 </script>
  </body>
</html>