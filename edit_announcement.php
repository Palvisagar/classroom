<?php
include("header2.php");
if(isset($_SESSION['email']))
{
     //store session
     $email=$_SESSION['email'];
}
else{
    //url direction
    echo"<script>window.location.assign('login.php?msg=please login first to proceed')</script>";
}

include("config.php");
$queryselect = "SELECT * FROM `announcement` where `id`='$_REQUEST[id]'";
$resultselect = mysqli_query($conn,$queryselect);
if($dataselect = mysqli_fetch_array($resultselect))
{
  $tit = $dataselect["title"];
  $desc = $dataselect["description"];
}
?>
<section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_1.jpg');">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <h1 class="mb-2 bread">ANNOUNCEMENT</h1>
                <!-- <p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Add Course </span></p> -->
            </div>
        </div>
    </div>
</section>
<section class="ftco-section contact-section">
    <div class="container">
        <div class="row d-flex contact-info">
            <div class="col-md-12 d-flex">
                <div class="bg-light align-self-stretch box p-4 text-center">
                    <?php
              if(isset($_REQUEST["msg"]))
              {
                echo "<div class='alert alert-info'>".$_REQUEST["msg"]."</div>";
              }
              ?>
                    <form method="post" autocomplete="off">
                      <input type="hidden" name="id" value="<?php echo $_REQUEST['id']; ?>">
                        <div class="row">
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-6">
                                <label for="inputtitle" class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" id="inputtitle" placeholder="" value="<?php echo $tit; ?>">
                            </div>
                            <div class="col-md-3">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                            </div>
                            <div class="col-md-6">
                                <label for="inputdescription" class="form-label">Description</label>
                                <textarea class="form-control" name="description" id="inputdescription" placeholder="" rows="10"><?php echo $desc; ?></textarea>
                            </div>
                            <div class="col-md-3">
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" name="submit" class="btn btn-primary my-2">submit</button>
                        </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include("footer.php");
?>

<?php
if(isset($_REQUEST["submit"]))
{
    $id=$_REQUEST['id'];
	$title=$_REQUEST["title"];
	$description=$_REQUEST["description"];
	
	// $confirm_password=$_REQUEST["password"];
	//connect with database
    include("config.php");
	//insert query
    $query="Update`announcement` set `title`='$title',`description`='$description'  where`id`='$id'";
	//Execute
	$result=mysqli_query($conn,$query);
	if($result>0)
	{
   	echo"<script>window.location.assign('manage_announcement.php?msg=Record Inserted')</script>";
	}
	else{
   	echo"<script>window.location.assign('manage_announcement.php?msg=Try again')</script>";
	}
}
?>