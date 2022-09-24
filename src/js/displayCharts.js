getComplaintStatusCounts()

function getComplaintStatusCounts() {
    $.ajax({
        type: 'GET',
        url: '../src/includes/get-data-dashboard.php',
        success: function (response) {
            let res = JSON.parse(response)
            let complaintCountsPerStatus = res.complaintCountsPerStatus
            let complaintCountsPerMonth = res.complaintCountsPerMonth
            let residentAccountCounts = res.residentAccountCounts

            $('#pending').text(complaintCountsPerStatus.pending)
            $('#ongoing').text(complaintCountsPerStatus.ongoing)
            $('#solved').text(complaintCountsPerStatus.solved)
            $('#transferred').text(complaintCountsPerStatus.transferred)

            const complaintDatas = Object.values(complaintCountsPerStatus)
            const complaintMonthDatas = complaintCountsPerMonth
            const userDatas = Object.values(residentAccountCounts)


            //complaints status chart
            const complaintData = {
                labels: [
                    'Pending',
                    'Ongoing',
                    'Solved',
                    'Transferred'
                ],
                datasets: [{
                    label: 'Complaints',
                    backgroundColor: [
                        'rgb(102, 159, 217)',
                        'rgb(243, 237, 121)',
                        'rgb(138, 221, 138)',
                        'rgb(217, 110, 110)'
                    ],
                    borderColor: 'rgb(255, 99, 132)',
                    data: complaintDatas,
                }]
            };

            const complaintConfig = {
                type: 'bar',
                data: complaintData,
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: 'Complaints Status'
                        },
                        legend: {
                            display: false
                        }
                    }
                }
            };

            const complaintChart = new Chart(
                document.getElementById('complaintChart'),
                complaintConfig
            );



            //number of complaints chart
            const complaintsNumLabels = [
                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'May',
                'Jun',
                'Jul',
                'Aug',
                'Sep',
                'Oct',
                'Nov',
                'Dec'
            ];

            const complaintsNumData = {
                labels: complaintsNumLabels,
                datasets: [{
                    label: 'Complaints Number',
                    borderColor: 'rgb(102, 159, 217)',
                    data: complaintMonthDatas,
                }]
            };

            const complaintsNumConfig = {
                type: 'line',
                data: complaintsNumData,
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: 'Number of Complaints'
                        },
                        legend: {
                            display: false
                        }
                    }
                }
            };

            const complaintsNumChart = new Chart(
                document.getElementById('complaintsNumChart'),
                complaintsNumConfig
            );




            //resident acccounts chart
            const userData = {
                labels: [
                    'With account',
                    'Without account'
                ],
                datasets: [{
                    label: 'Resident Accounts',
                    backgroundColor: [
                        'rgb(102, 159, 217)',
                        'rgb(217, 110, 110)'
                    ],
                    data: userDatas,
                }]
            };

            const userConfig = {
                type: 'doughnut',
                data: userData,
                options: {
                    plugins: {
                        title: {
                            display: true,
                            text: 'Resident Accounts'
                        }
                    }
                }
            };

            const userChart = new Chart(
                document.getElementById('userChart'),
                userConfig
            );

        }
    })
}