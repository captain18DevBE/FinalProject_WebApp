<div id="notification">
        <div class="container-page">
            <?php
                require_once './app/Controllers/NotificationController.php';
                $notification = (new NotificationController())->getDetailNotification($_GET['idNotification']);
            ?>
            <div class="title-notification" style="text-align: center; font-size: 300%; color: var(--main-color)">
                <?php
                    echo $notification->title;
                ?>
            </div>
            <div class="date-notification" style="text-align: right; font-size: 120%;"><?php echo $notification->postDate?></div>
            <p class="content-notification" style="width: 100%;  font-size: 120%; margin: 0; padding: 2%">
                <?php
                    echo $notification->content;
                ?>
                <br>
                <?php
                    if($notification->idCompany > 0){
                        ?>
                            We are <a href="./jobseeker.php?intro_company&idCompany=<?php echo $notification->idCompany?>" style="font-size: 165%">here</a>
                        <?php
                    }
                ?>
            </p>
        </div> 
    </div>