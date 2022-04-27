<!-- include all needed partials -->
<?php include 'partials/header.php';?>
<?php include 'partials/navigation.php';?>




        <section id="content" class="content">
            <div class="content__title__cont">
                <h2 class="content__title">Pending Complaints</h2>
            </div>

            <div class="content__body__cont">
                <div class="content__action__cont">
                    <a class="content__action" href="">
                        <img src="assets/icons/back.svg" alt="back button">
                    </a>

                    <button class="content__action">
                        <img src="assets/icons/edit.svg" alt="edit button">
                    </button>

                    <a class="content__action" href="">
                        <img src="assets/icons/delete.svg" alt="delete button">
                    </a>
                </div>

                <hr class="content__hr">
                
                <div class="content__details__cont">
                    <div class="content__complainant__cont">
                        <div class="content__complainant__pic">
                            <img src="assets/residentProfSample.jpg" alt="resident profile picture">
                        </div>

                        <div class="content__complainant__info">
                            <span class="content__complainant__name">Juan Dela Cruz</span>
                            <span class="content__complainant__date">Jan 9, 2022</span>
                        </div>
                    </div>

                    <p class="content__comp__lbl">Name of the complained person:</p>
                    <p class="content__comp__val">Juan Dela Cruz</p>

                    <p class="content__comp__lbl">Complain Description:</p>
                    <p class="content__comp__val">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet</p>

                    <p class="content__comp__lbl">Proof/Pictures:</p>
                    <div class="content__proof__cont">
                        <img class="content__proof__pic" src="assets/sampleProof.png" alt="Proof picture">
                        <img class="content__proof__pic" src="assets/sampleProof.png" alt="Proof picture">
                        <img class="content__proof__pic" src="assets/sampleProof.png" alt="Proof picture">
                        <img class="content__proof__pic" src="assets/sampleProof.png" alt="Proof picture">
                        <img class="content__proof__pic" src="assets/sampleProof.png" alt="Proof picture">
                        <img class="content__proof__pic" src="assets/sampleProof.png" alt="Proof picture">
                    </div>
                        
                </div>

                <hr class="content__hr">
            </div>
        </section>





    

<!-- include partials -->
<?php include 'partials/footer.php';?>