<?php

    use Controllers\Session;
    use Controllers\WLRouter;
    use Pages\HomePage;
   
    Session::start();

    WLRouter::route('/',function(){
        header('Location: /home');
    });
    WLRouter::route('/home',function(){
        echo HomePage::buildPage();
    });
?>