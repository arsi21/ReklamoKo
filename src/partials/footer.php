    <!-- modal -->
    <div id="modal2" class="modal2 modal2--add--comp">
        <form action="includes/add-complaint.php" method="post" enctype="multipart/form-data" id="modal2-cont" class="modal2__cont">
            <div class="modal2__head">
                <span class="modal2__title">
                    New Complaint
                </span>
                
                <span id="modal2-exit" class="modal2__close">
                    <img src="assets/icons/exit.svg" alt="">
                </span>
            </div>

            <div class="modal2__body">
                <label class="modal2__lbl">
                    Name of complainant(s)*
                </label>
                <select selectize name="complainants[]" id="select-complainant" placeholder="Please select name..." required>
                    <option value="">Please select name...</option>
                <?php
                    foreach($residentsData as $row){
                ?>
                    <option value="<?= $row['id'] ?>" <?php echo ($residentId == $row['id']) ? "selected": "" ?>><?= ucwords($row['first_name']) . " " . ucwords($row['last_name']) ?></option>
                <?php
                    }
                ?>
                </select>
                
                <div class="spacer"></div>

                <label class="modal2__lbl">
                    Name of person(s) being complained about
                </label>
                <select selectize name="complainees[]" id="select-complainee" placeholder="Please select name...">
                    <option value="">Please select name...</option>
                <?php
                    foreach($residentsData as $row){
                        if($residentId != $row['id']){
                ?>
                    <option value="<?= $row['id'] ?>"><?= ucwords($row['first_name']) . " " . ucwords($row['last_name']) ?></option>
                <?php
                        }
                    }
                ?>
                </select>
                
                <div class="spacer"></div>

                <label class="modal2__lbl">
                    Complaint Type*
                </label>
                <select name="complaintTypeId" id="select-name" placeholder="Please select complaint type..." required>
                    <option value="">Please select complaint type...</option>
                <?php
                    foreach($complaintTypesData as $row){
                ?>
                    <option value="<?= $row['id'] ?>"><?= $row['type'] ?></option>
                <?php
                    }
                ?>
                </select>

                <div class="spacer"></div>

                <!-- <label class="modal2__lbl">
                    Name of person being complained about
                </label>
                <input type="text" class="modal2__input" name="complainee"> -->

                <label class="modal2__lbl">
                    Complaint description
                </label>
                <textarea class="modal2__input" name="complaintDescription"></textarea>

                <p class="modal2__lbl">
                    Proof/Pictures (Optional)
                </p>

                <label class="home-card__file__lbl" for="pic_input1">
                    <input id="pic_input1" class="home-card__input__file" type="file"
                        name="proof1" onchange="previewImage(this, picPreview1)">
                    <img src="assets/icons/upload.svg" alt="Upload icon">
                    <span>Upload photo</span>
                </label>

                <div class="home-card__img__preview">
                    <img id="pic_preview1" />
                </div>

                <label class="home-card__file__lbl" for="pic_input2">
                    <input id="pic_input2" class="home-card__input__file" type="file"
                        name="proof2" onchange="previewImage(this, picPreview2)">
                    <img src="assets/icons/upload.svg" alt="Upload icon">
                    <span>Upload photo</span>
                </label>

                <div class="home-card__img__preview">
                    <img id="pic_preview2" />
                </div>

                <label class="home-card__file__lbl" for="pic_input3">
                    <input id="pic_input3" class="home-card__input__file" type="file"
                        name="proof3" onchange="previewImage(this, picPreview3)">
                    <img src="assets/icons/upload.svg" alt="Upload icon">
                    <span>Upload photo</span>
                </label>

                <div class="home-card__img__preview">
                    <img id="pic_preview3" />
                </div>

                <!-- <div class="modal2__img__prev__cont">
                    <div class="modal2__img__prev"> -->
                        <!-- <img id=img-prev" /> -->
                    <!-- </div>
                    <div class="modal2__img__prev"> -->
                        <!-- <img id=img-prev" /> -->
                    <!-- </div>
                    <div class="modal2__img__prev"> -->
                        <!-- <img id=img-prev" /> -->
                    <!-- </div>
                    <div class="modal2__img__prev"> -->
                        <!-- <img id=img-prev" /> -->
                    <!-- </div>
                    <div class="modal2__img__prev"> -->
                        <!-- <img id=img-prev" /> -->
                    <!-- </div>
                </div> -->

                <!-- <label class="modal2__upload__lbl" for="upload-pic">
                    <input id="upload-pic" class="modal2__upload__input" type="file"
                    name="complainProof[]" multiple>
                    <img src="assets/icons/upload.svg" alt="Upload icon">
                    <span>Upload photo</span>
                </label> -->
            </div>

            <div class="modal2__footer">
                <button id="modal2-cancel" class="modal2__cancel">Cancel</button>

                <input type="submit" class="modal2__submit" value="Submit" name="submitBtn">
            </div>
        </form>
    </div>



<?php
if(isset($_GET['message'])){
?>
    
<?php
    if($_GET['message'] == "complaintSubmittedSuccessfully"){
?>
    <div id="message" class="msg msg-success" onclick="closeMessage()">
        <svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m11.998 2.005c5.517 0 9.997 4.48 9.997 9.997 0 5.518-4.48 9.998-9.997 9.998-5.518 0-9.998-4.48-9.998-9.998 0-5.517 4.48-9.997 9.998-9.997zm-5.049 10.386 3.851 3.43c.142.128.321.19.499.19.202 0 .405-.081.552-.242l5.953-6.509c.131-.143.196-.323.196-.502 0-.41-.331-.747-.748-.747-.204 0-.405.082-.554.243l-5.453 5.962-3.298-2.938c-.144-.127-.321-.19-.499-.19-.415 0-.748.335-.748.746 0 .205.084.409.249.557z" fill-rule="nonzero"/></svg>
        <p>
           Complaint Submitted Successfully!
        </p>
    </div>
<?php
    }elseif($_GET['message'] == "stmtfailed"){
?>
    <div id="message" class="msg msg-danger" onclick="closeMessage()">
        <svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m12.002 21.534c5.518 0 9.998-4.48 9.998-9.998s-4.48-9.997-9.998-9.997c-5.517 0-9.997 4.479-9.997 9.997s4.48 9.998 9.997 9.998zm0-8c-.414 0-.75-.336-.75-.75v-5.5c0-.414.336-.75.75-.75s.75.336.75.75v5.5c0 .414-.336.75-.75.75zm-.002 3c-.552 0-1-.448-1-1s.448-1 1-1 1 .448 1 1-.448 1-1 1z" fill-rule="nonzero"/></svg>
        <p>
            Server Error!
        </p>
    </div>
<?php
    }
?>
    

<?php
}
?>








    <script src="js/modal.js"></script>
    <script src="js/showSelectedPic.js"></script>
    <script src="js/popUpMessage.js"></script>
    <script src="js/footer.js"></script>
</body>

</html>