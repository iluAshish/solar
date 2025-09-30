<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <body>

        <div style="max-width: 600px; width: 100%; margin: 20px auto; font-size: 14px; font-family: 'Arial';">
            <!-- <div style="text-align: center; margin-bottom: 20px;">
                <a href="#">
                    <img src="http://clientsdemoarea.com/projects/wemeasure/admin/assets/img/logo.png" style=" max-width: 100px;">
                </a>
            </div> -->
            <div style="font-size: 22px;  background-color: #43a9cd; padding: 20px 15px; text-align: center; font-weight: bold;
                 color: #fff;">Welcome to <?php echo WEBSITE_NAME ; ?></div>
            <div style="padding: 10px 15px; border: 1px solid #f1f1f1">
                <p style="font-size: 14px; margin-bottom: 10px;">Hey <?php echo ucwords($fullname); ?>,</p>
                <p style="font-size: 14px; margin-bottom: 10px;">Following is your registraton details to our portal </p>
                <p style="font-size: 14px; margin-bottom: 10px;">URL : <?php echo base_url(); ?> </p>
                <p style="font-size: 14px; margin-bottom: 10px;">Your Username : <?php echo $email; ?> or <?php echo $username; ?> </p>
                <p style="font-size: 14px; margin-bottom: 10px;">Your Password : <?php echo $passwordUser; ?></p><br>

                <p>Thanks & Regards,</p>
                <p><?php echo WEBSITE_NAME ; ?> team</p>
            </div>
            <div class="footer" style="background-color: #43a9cd; padding: 20px; text-align: center; font-size: 12px; ">
                
                <div class="usefull-link" style="margin-bottom: 20px;">
                    <ul style="list-style: none; margin: 0px; padding: 0px;">
                        <li style="list-style: none; display: inline-block; margin: 0px; padding: 0px; margin-right: 10px;">
                            <a href="#" style="text-decoration: none; color: #fff; font-size: 14px;">Write to us </a>
                            <span style="margin-left: 10px; color: #fff;">|</span>
                        </li>
                        <li style="list-style: none; display: inline-block; margin: 0px; padding: 0px; margin-right: 10px;">
                            <a href="#" style="text-decoration: none; color: #fff; font-size: 14px;">Terms & Condition </a>
                            <span style="margin-left: 10px; color: #fff;">|</span>
                        </li>
                        <li style="list-style: none; display: inline-block; margin: 0px; padding: 0px; margin-right: 10px;">
                            <a href="#" style="text-decoration: none; color: #fff; font-size: 14px;">Privacy Policy</a>
                        </li>
                    </ul>

                </div>
                <p style="font-size: 10px; margin-bottom: 10px; text-align: justify; color: #fff;"></p>
                <div class="copyright">
                    <p style="font-size: 10px; margin: 0px; padding: 0px; color: #fff;">2019-<?php echo date("Y");?> - <?php echo WEBSITE_NAME ; ?> All Rights Reserved.</p>
                </div>
            </div>

        </div>

    </body>
</html>
