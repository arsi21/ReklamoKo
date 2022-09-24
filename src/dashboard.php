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
            </div>
        </section>




<script src="js/displayCharts.js"></script>

<!-- include partials -->
<?php include_once 'partials/footer.php';?>