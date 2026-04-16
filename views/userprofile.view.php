    <div style="margin-top: 1%; margin-bottom: 10%; padding-top: 2%; padding-bottom: 3%; padding-left: 5%; border: 2px solid #e8e8e8;" class="container rounded bg-light">

    	<div class="row" style="margin-bottom: 1em;">
    		<div class="col-md-3">
    			<img style="max-height: 15em; width: 100%;" src="<?php echo RUTA . "/images/users/" . $userimg; ?>">
    		</div>

    		<div class="col-3">
                <p><?php echo "Name: " . $user[0]['name'];?></p>
                <p><?php echo "Age: " . $age; ?></p>
                <p style="padding-right: 5%;"><?php echo "Origin: " .  $user[0]['cityfield_origin']; ?></p>
                <p style="padding-right: 5%;"><?php echo "Residence: " .  $user[0]['cityfield_residence']; ?></p>
			</div>

            <div class="col-md-6" style="border-left: 2px solid #e8e8e8;">
                <p style="font-weight: bold;">About Me</p>
                <p style="padding-right: 5%;"><?php echo $user[0]['description']; ?></p>
                
                <p style="font-weight: bold;">Languages</p>
                <p style="font-size: 0.8em; color: #757575;">
                    <?php foreach($lang_name as $i): ?>
                    <?php echo $i[0][1];?>
                    <?php endforeach; ?>
                </p>
            </div>

    	</div>

        <div class="row">
            <div class="col-6">
                <p style="color: #111111; font-weight: bold;">Industries</p>
                <?php foreach($ind_name as $i): ?>
                    <p style="font-size: 0.8em; color: #757575; border-bottom: 2px solid; border-bottom-color: rgba(117, 117, 117, 0.3);"><?php echo $i[0][1]; ?></p>
                <?php endforeach; ?>
            </div>

            <div class="col-6">
                <p style="color: #111111; font-weight: bold;">Source Areas</p>
                <?php foreach($area_name as $i): ?>
                    <p style="font-size: 0.8em; color: #757575; border-bottom: 2px solid; border-bottom-color: rgba(117, 117, 117, 0.3);"><?php echo $i[0][1]; ?></p>
                <?php endforeach; ?>
            </div>
        </div>

        <br>
        <br>

        <div class="row">
            <div class="col-md-12">
                <?php if($user[0]['fullname_quote'] == "no"){ ?>
                    <p style="font-weight: bold;">I might ask not to quote my full name.</p>
                <?php } ?>
            </div>
        </div>

        <h5>Write a Message</h5>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . "?id= " . $id; ?>">
            <div class="row">  
                <div class="col-6">
                    <input type="text" class="form-control" id="user_email" name="nombre" placeholder="Your Name">
                </div>
                <div class="col-6">
                    <input type="email" class="form-control" id="user_email" name="correo" placeholder="Your email">
                </div>
                <div class="col-12">
                    <br>
                   <textarea class="form-control" id="exampleFormControlTextarea1" name="mensaje" rows="3" placeholder="Your Message"></textarea> 
                   <button type="submit" class="btn btn-primary" style="margin-top: 2%;">Send</button>
                </div>

            </div>
        </form>

    </div>

<?php require 'views/footer.php'; ?>