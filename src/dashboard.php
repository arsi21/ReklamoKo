<?php
if(!isset($_SESSION)){
    session_start();
}

if($_SESSION['accessType'] == "resident"){
    header("location:pending-complaints.php");
}

//include all needed partials
include_once 'partials/header.php';
include_once 'partials/navigation.php';

//include needed files
include_once "classes/dbh.php";
include_once "classes/dashboard.php";

//instantiate class
$model = new Dashboard();

$residentsWithMostNumberOfComplaint = $model->getResidentsWithMostNumberOfComplaint();
$mostComplainedAboutResidents = $model->getMostComplainedAboutResidents();
$complaintTypesWithMostNumberOfComplaint = $model->getComplaintTypesWithMostNumberOfComplaint();
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>




        <section id="content" class="content">
            <div class="content__title__cont">
                <h2 class="content__title">Dashboard</h2>
            </div>

            <div class="dashboard-content">
                <div class="counts-cont">
                    <div class="count-cont">
                        <p class="count-name">Pending Complaints</p>
                        <p id="pending" class="count-number count-number-primary">0</p>
                        <p class="count-lbl">Total count</p>
                    </div>

                    <div class="count-cont">
                        <p class="count-name">Ongoing Complaints</p>
                        <p id="ongoing" class="count-number count-number-warning">0</p>
                        <p class="count-lbl">Total count</p>
                    </div>

                    <div class="count-cont">
                        <p class="count-name">Solved Complaints</p>
                        <p id="solved" class="count-number count-number-success">0</p>
                        <p class="count-lbl">Total count</p>
                    </div>

                    <div class="count-cont">
                        <p class="count-name">Transferred Complaints</p>
                        <p id="transferred" class="count-number count-number-danger">0</p>
                        <p class="count-lbl">Total count</p>
                    </div>
                </div>

                <div class="charts-cont">
                  <div class="chart-cont">
                    <div class="chart">
                        <canvas id="complaintChart"></canvas>
                    </div>

                    <div class="chart">
                        <canvas id="complaintsNumChart"></canvas>
                    </div>
                  </div>

                  <div class="chart-cont">
                    <div class="chart">
                        <canvas id="userChart"></canvas>
                    </div>
                  </div>
                </div>


                <div class="card-cont">
                  <div class="card">
                    <p class="card-title">Top 10 residents with highest number of reported complaints</p>
                    <div class="content-list-title">
                        <div class="name-cont-title">
                            <p class="number-title">#</p>
                            <p class="resident-title">Resident</p>
                        </div>
                        <p class="complaint-count-title">Total</p>
                    </div>
                    <?php
                        $num = 0;
                        foreach($residentsWithMostNumberOfComplaint as $row){
                        $num++;
                    ?>
                    <div class="content-list">
                        <div class="name-cont">
                            <p class="number"><?= $num ?></p>
                            <p class="resident"><?= ucwords($row['resident']) ?></p>
                        </div>
                        <p class="complaint-count <?= ($num <= 3) ? "complaint-count-success" : "complaint-count-primary" ?>"><?= $row['complaint_count'] ?></p>
                    </div>
                    <?php
                        }
                    ?>
                  </div>

                  <div class="card">
                    <p class="card-title">Top 10 most-complained-about individuals</p>
                    <div class="content-list-title">
                        <div class="name-cont-title">
                            <p class="number-title">#</p>
                            <p class="resident-title">Resident</p>
                        </div>
                        <p class="complaint-count-title">Total</p>
                    </div>
                    <?php
                        $num = 0;
                        foreach($mostComplainedAboutResidents as $row){
                        $num++;
                    ?>
                    <div class="content-list">
                        <div class="name-cont">
                            <p class="number"><?= $num ?></p>
                            <p class="resident"><?= ucwords($row['resident']) ?></p>
                        </div>
                        <p class="complaint-count <?= ($num <= 3) ? "complaint-count-danger" : "complaint-count-primary" ?>"><?= $row['complaint_count'] ?></p>
                    </div>
                    <?php
                        }
                    ?>
                  </div>
                </div>




                <div class="card-cont">
                  <div class="card card-full">
                    <p class="card-title">Top 10 complaint types with highest number of reported complaints</p>
                    <div class="content-list-title">
                        <div class="name-cont-title">
                            <p class="number-title">#</p>
                            <p class="resident-title">Complaint Type</p>
                        </div>
                        <p class="complaint-count-title">Total</p>
                    </div>
                    <?php
                        $num = 0;
                        foreach($complaintTypesWithMostNumberOfComplaint as $row){
                        $num++;
                    ?>
                    <div class="content-list">
                        <div class="name-cont">
                            <p class="number"><?= $num ?></p>
                            <p class="resident"><?= ucwords($row['type']) ?></p>
                        </div>
                        <p class="complaint-count <?= ($num <= 3) ? "complaint-count-success" : "complaint-count-primary" ?>"><?= $row['type_count'] ?></p>
                    </div>
                    <?php
                        }
                    ?>
                  </div>
                </div>





            </div>
        </section>




<script src="js/displayCharts.js"></script>

<!-- include partials -->
<?php include_once 'partials/footer.php';?>