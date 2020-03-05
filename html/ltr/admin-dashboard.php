<?php

require_once 'inc.php';
require_once 'config.php';

include 'html.php';
setHead("Admin Panel");

if (!isset($_SESSION['name'])) {
  header("Location: login.php");
  die();
}

if(!isAdmin($_SESSION['id'], $con)){
  header("Location: login.php");
  die();
  }

//Tower Stats

$tower1 = 0;
$sql_tower1 = "SELECT * FROM `users` WHERE `tower` = '1'";
$result_tower1 = mysqli_query($con, $sql_tower1);
while($row = mysqli_fetch_assoc($result_tower1)) {
    $query = mysqli_query($con, "SELECT * FROM `complaints` WHERE `comp_by` = '{$row['id']}' AND `completed` = '0' ");
    $tower1 = $tower1 + mysqli_num_rows($query);
}
$tower2 = 0;
$sql_tower2 = "SELECT * FROM `users` WHERE `tower` = '2'";
$result_tower2 = mysqli_query($con, $sql_tower2);
while($row = mysqli_fetch_assoc($result_tower2)) {
    $query = mysqli_query($con, "SELECT * FROM `complaints` WHERE `comp_by` = '{$row['id']}' AND `completed` = '0' ");
    $tower2 = $tower2 + mysqli_num_rows($query);
}
$tower3 = 0;
$sql_tower3 = "SELECT * FROM `users` WHERE `tower` = '3'";
$result_tower3 = mysqli_query($con, $sql_tower3);
while($row = mysqli_fetch_assoc($result_tower3)) {
    $query = mysqli_query($con, "SELECT * FROM `complaints` WHERE `comp_by` = '{$row['id']}' AND `completed` = '0' ");
    $tower3 = $tower3 + mysqli_num_rows($query);
}
$tower4 = 0;
$sql_tower4 = "SELECT * FROM `users` WHERE `tower` = '4'";
$result_tower4 = mysqli_query($con, $sql_tower4);
while($row = mysqli_fetch_assoc($result_tower4)) {
    $query = mysqli_query($con, "SELECT * FROM `complaints` WHERE `comp_by` = '{$row['id']}' AND `completed` = '0' ");
    $tower4 = $tower4 + mysqli_num_rows($query);
}
$tower5 = 0;
$sql_tower5 = "SELECT * FROM `users` WHERE `tower` = '5'";
$result_tower5 = mysqli_query($con, $sql_tower5);
while($row = mysqli_fetch_assoc($result_tower5)) {
    $query = mysqli_query($con, "SELECT * FROM `complaints` WHERE `comp_by` = '{$row['id']}' AND `completed` = '0' ");
    $tower5 = $tower5 + mysqli_num_rows($query);
}



//progressbar stats

$pending = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `complaints` WHERE `completed` = '0' AND `assigned` = '0' AND `accepted` = '0' AND `decline` = '0' "));
$assigned = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `complaints` WHERE `completed` = '0' AND `assigned` = '1' AND `accepted` = '0' AND `decline` = '0' "));
$active = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `complaints` WHERE `completed` = '0' AND `assigned` = '1' AND `accepted` = '1' AND `decline` = '0' "));
$completed = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `complaints` WHERE `completed` = '1' "));
$deleted = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `complaints` WHERE `decline` = '1' OR `deleted` = '1' "));

//bargraph

$hvac = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `complaints` WHERE `dept` ='HVAC' "));
$elec = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `complaints` WHERE `dept` ='ELECTRICAL' "));
$plumb = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `complaints` WHERE `dept` ='PLUMBING' "));
$carp = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `complaints` WHERE `dept` ='CARPENTRY AND CIVIL' "));
$hskep = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `complaints` WHERE `dept` ='HOUSE KEEPING' "));
$othr = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `complaints` WHERE `dept` = 'OTHER FACILITY RELATED' "));

//top cards

$students = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `users` WHERE `faculty` = '0' AND `admin` = '0' AND `man_pow` = '0' "));
$faculty = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `users` WHERE `faculty` = '1' "));
$admins = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `users` WHERE `admin` = '1' "));
$man_power = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `users` WHERE `man_pow` = '1' "));

$total_complaints = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `complaints` "));

?>

<div class="row">
  <div class="col-md-3">
    <div class="card m-t-0">
      <div class="row">
        <div class="col-md-6">
          <div class="peity_line_neutral left text-center m-t-10"><span><span style="display: none;"><span style="display: none;"><span style="display: none;"><span style="display: none;">10,15,8,14,13,10,10</span><canvas width="50" height="24"></canvas></span>
            <canvas width="50" height="24"></canvas>
          </span><canvas width="50" height="24"></canvas></span><canvas width="50" height="24"></canvas></span>
          <h6>100%</h6>
        </div>
      </div>
      <div class="col-md-6 border-left text-center p-t-10">
        <h3 class="mb-0 font-weight-bold"><?=$students?></h3>
        <span class="text-muted">Students</span>
      </div>
    </div>
  </div>
</div>
<div class="col-md-3">
  <div class="card m-t-0">
    <div class="row">
      <div class="col-md-6">
        <div class="peity_bar_bad left text-center m-t-10"><span><span style="display: none;"><span style="display: none;"><span style="display: none;"><span style="display: none;">3,5,6,16,8,10,6</span><canvas width="50" height="24"></canvas></span>
          <canvas width="50" height="24"></canvas>
        </span><canvas width="50" height="24"></canvas></span><canvas width="50" height="24"></canvas></span>
        <h6>100%</h6></div>
      </div>
      <div class="col-md-6 border-left text-center p-t-10">
        <h3 class="mb-0 font-weight-bold"><?=$man_power?></h3>
        <span class="text-muted">Man Power</span>
      </div>
    </div>
  </div>
</div>
<div class="col-md-3">
  <div class="card m-t-0">
    <div class="row">
      <div class="col-md-6">
        <div class="peity_line_good left text-center m-t-10"><span><span style="display: none;"><span style="display: none;"><span style="display: none;"><span style="display: none;">12,6,9,23,14,10,17</span><canvas width="50" height="24"></canvas></span>
          <canvas width="50" height="24"></canvas>
        </span><canvas width="50" height="24"></canvas></span><canvas width="50" height="24"></canvas></span>
        <h6>100%</h6>
      </div>
    </div>
    <div class="col-md-6 border-left text-center p-t-10">
      <h3 class="mb-0 "><?=$faculty?></h3>
      <span class="text-muted">Faculty</span>
    </div>
  </div>
</div>
</div>
<div class="col-md-3">
  <div class="card m-t-0">
    <div class="row">
      <div class="col-md-6">
        <div class="peity_bar_good left text-center m-t-10"><span><span style="display: none;">12,6,9,23,14,10,13</span><canvas width="50" height="24"></canvas></span>
          <h6>100%</h6>
        </div>
      </div>
      <div class="col-md-6 border-left text-center p-t-10">
        <h3 class="mb-0 font-weight-bold"><?=$admins?></h3>
        <span class="text-muted">Admins</span>
      </div>
    </div>
  </div>
</div>
</div>



<div class="row">
  <div class="col-md-6">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Progress</h4>
        <h5 class="card-subtitle">Overview of Progress</h5>
        <div class="m-t-20">
          <div class="d-flex no-block align-items-center">
            <span>Pending Complaints</span>
            <div class="ml-auto">
              <span><?=$pending?></span>
            </div>
          </div>
          <div class="progress">
            <div class="progress-bar progress-bar-striped" role="progressbar" style="width: <?=($pending/$total_complaints)*100?>%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        </div>
        <div class="m-t-25">
          <div class="d-flex no-block align-items-center m-t-15">
            <span>Assigned but not accepted</span>
            <div class="ml-auto">
              <span><?=$assigned?></span>
            </div>
          </div>
          <div class="progress">
            <div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: <?=($assigned/$total_complaints)*100?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        </div>
        <div class="m-t-25">
          <div class="d-flex no-block align-items-center m-t-15">
            <span>Active Complaints</span>
            <div class="ml-auto">
              <span><?=$active?></span>
            </div>
          </div>
          <div class="progress">
            <div class="progress-bar progress-bar-striped bg-info" role="progressbar" style="width: <?=($active/$total_complaints)*100?>%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        </div>
        <div class="m-t-25">
          <div class="d-flex no-block align-items-center m-t-15">
            <span>Completed Jobs</span>
            <div class="ml-auto">
              <span><?=$completed?></span>
            </div>
          </div>
          <div class="progress">
            <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: <?=($completed/$total_complaints)*100?>%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        </div>
        <div class="m-t-25">
          <div class="d-flex no-block align-items-center m-t-15">
            <span>Deleted/Declined Complaints</span>
            <div class="ml-auto">
              <span><?=$deleted?></span>
            </div>
          </div>
          <div class="progress">
            <div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: <?=($deleted/$total_complaints)*100?>%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
          </div>
        </div>
      </div>
    </div>
    
  </div>
  <div class="col-md-6">
    <div class="card">
      <div class="card-body">
        <div class="row">         
          <div class="col-lg-12">
            <div class="row">
              <div class="col-6">
                <div class="bg-cyan p-10 text-white text-center">
                  <i class="fas fa-building font-16"></i>
                  <h5 class="m-b-0 m-t-5"><?=$tower1?></h5>
                  <small class="font-light">Tower 1 Complaints</small>
                </div>
              </div>
              <div class="col-6">
                <div class="bg-danger p-10 text-white text-center">
                  <i class="fas fa-building font-16"></i>
                  <h5 class="m-b-0 m-t-5"><?=$tower2?></h5>
                  <small class="font-light">Tower 2 Complaints</small>
                </div>
              </div>
              <div class="col-6 m-t-15">
                <div class="bg-success p-10 text-white text-center">
                  <i class="fas fa-building font-16"></i>
                  <h5 class="m-b-0 m-t-5"><?=$tower3?></h5>
                  <small class="font-light">Tower 3 Complaints</small>
                </div>
              </div>
              <div class="col-6 m-t-15">
                <div class="bg-info p-10 text-white text-center">
                  <i class="fas fa-building font-16"></i>
                  <h5 class="m-b-0 m-t-5"><?=$tower4?></h5>
                  <small class="font-light">Tower 4 Complaints</small>
                </div>
              </div>
              <div class="col-6 m-t-15">
                <div class="bg-warning p-10 text-white text-center">
                  <i class="fas fa-building font-16"></i>
                  <h5 class="m-b-0 m-t-5"><?=$tower5?></h5>
                  <small class="font-light">Tower 5 Complaints</small>
                </div>
              </div>
              <div class="col-6 m-t-15">
                <div class="bg-cyan p-10 text-white text-center">
                  <i class="fa fa-globe m-b-5 font-16"></i>
                  <h5 class="m-b-0 m-t-5"><?=$pending?></h5>
                  <small class="font-light">Total Complaints</small>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="card" style="padding-bottom: 50px;">
      <div class="card-body">
        <h4 class="card-title">Charts</h4>
        
        <ul class="chart-bar">
          <li>
            <span style="height:<?=($hvac/$total_complaints)*100?>%; background:#7460ee;" title="HVAC"><?=round(($hvac/$total_complaints)*100)?>%</span>
          </li>
          <li>
            <span style="height:<?=($elec/$total_complaints)*100?>%; background: #da542e;" title="ELECTRICAL"><?=round(($elec/$total_complaints)*100)?>%</span>
          </li>
          <li>
            <span style="height:<?=($plumb/$total_complaints)*100?>%; background: #ffb848;" title="PLUMBING"><?=round(($plumb/$total_complaints)*100)?>%</span>
          </li>
          <li>
            <span style="height: <?=($carp/$total_complaints)*100?>%; background: #2255a4;" title="CIVIL"><?=round(($carp/$total_complaints)*100)?>%</span>
          </li>
          <li>
            <span style="height:<?=($hskep/$total_complaints)*100?>%; background: #28b779" title="HOUSE KEEPING"><?=round(($hskep/$total_complaints)*100)?>%</span>
          </li>
          <li>
            <span style="height:<?=($othr/$total_complaints)*100?>%; background: #488c13;" title="OTHER"><?=round(($othr/$total_complaints)*100)?>%</span>
          </li>
        </ul>    
        
      </div>
    </div>
  </div>
  <div class="col-6 m-t-15">
  <div class="accordion" id="accordionExample">
                            <div class="card m-b-0">
                                <div class="card-header" id="headingOne">
                                  <h5 class="mb-0">
                                    <a data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne" class="collapsed">
                                        <i class="m-r-5 fas fa-code" aria-hidden="true"></i>
                                        <span>Developer Updates - 18 June 2019</span>
                                    </a>
                                  </h5>
                                </div>
                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample" style="">
                                  <div class="card-body">
                                    SRM AP Hostel Maintenance APP Deployed.
                                </div>
                                </div>
                            </div>
                            <div class="card m-b-0 border-top">
                                <div class="card-header" id="headingTwo">
                                  <h5 class="mb-0">
                                    <a class="collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        <i class="m-r-5 fas fa-code" aria-hidden="true"></i>
                                        <span>Developer Updates - 17 June 2019</span>
                                    </a>
                                  </h5>
                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample" style="">
                                  <div class="card-body">
                                  SRM AP Maintenance System deployed on SRM Amaravati Servers.
                                </div>
                                </div>
                            </div>
                            <div class="card m-b-0 border-top">
                                <div class="card-header" id="headingThree">
                                  <h5 class="mb-0">
                                    <a class="" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                        <i class="m-r-5 fas fa-code" aria-hidden="true"></i>
                                        <span>Developer Updates - 16 June 2019</span>
                                    </a>
                                  </h5>
                                </div>
                                <div id="collapseThree" class="collapse show" aria-labelledby="headingThree" data-parent="#accordionExample" style="">
                                  <div class="card-body">
                                  Basic version of SRM AP Hostel Maintenance System built. We initiated this project after we realised that managing complaints manually is a great burden. Students were never updated on their complaints. We this APP we hope to solve this problem.
                                </div>
                                </div>
                            </div>
                        </div>
</div>
</div>

<?php

echo '
<div class="card">
  <div class="card-body">
    <h4 class="card-title m-b-0">News Updates</h4>
  </div>
  <ul class="list-style-none">
';

$sql_news = mysqli_query($con, "SELECT * FROM `news_feed` ORDER BY `id` DESC LIMIT 6");
while($row = mysqli_fetch_assoc($sql_news)) {

    echo '
    <li class="d-flex no-block card-body">
    <i class="fas fa-chevron-circle-right w-30px m-t-5"></i>
    <div>
        <a href="#" class="m-b-0 font-medium p-0">'.$row['title'].'</a>
        <span class="text-muted">'.$row['feed'].'</span>
    </div>
    <div class="ml-auto">
        <div class="tetx-right">
        <h5 class="text-muted m-b-0">'.date('j', $row['time']).'</h5>
        <span class="text-muted font-16" style="font-weight: 600;" >'.date('M', $row['time']).'</span>
        </div>
    </div>
    </li>
    ';
}

echo '
  </ul>
</div>
';

include 'footer.php';
?>