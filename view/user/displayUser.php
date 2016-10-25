    <?php
        print_r($tab_user);
        foreach ($tab_user as $user){
            $user->display();
        }
    ?>