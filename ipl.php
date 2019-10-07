<?php
/*
Plugin Name: IPL
Plugin URI: 
Description: Plugin Description
Author: AC
Version: 1.0
Author URI: 
*/
use \Firebase\JWT\JWT;
class IPL {
    public function __construct()
    {
        add_action('parse_request', array($this, 'handle_request'));
    }

    public function results_page() {
        ?>
        <link rel='stylesheet' type='text/css' href='../rediripl/indexhop.css' />
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-81000273-1', 'auto');
            ga('send', 'pageview');


        </script>
        <?php
        wp_head();
//global $wpdb;

        ?>
        <script>
            $(window).load(function(){

                $(".imageholder img").error(function () { $(this).hide(); });
                console.log("window loaded");

            });
        </script>
        <style>


            span.pressholdspan {
                text-transform: uppercase;
                font-size: 10px;
                font-weight: 600;
                display: inline-block;
                padding: 0!important;
                margin-top: 3px;
                margin-bottom: 0!important;
            }
        </style>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=3.0, user-scalable=1">
        <?
        $this->kaboom();
        $param = explode('event/', $wp->request);
        $str_arr2 = explode("/",end($param));
        $str = $str_arr2[0];
        $eventname44=strtolower($str);


//i've got event name
//i've got $user


        if ($username44=="boothcode"){

            $uncheck=$wpdb->get_results("SELECT username FROM v2eventlist WHERE code='$eventname44'");

            $unfound = ($uncheck[0]->username);


            $finddomain=$wpdb->get_results("SELECT * FROM settings where username='$unfound'");
            $imglink=$finddomain[0]->photo;
            $simplify_event_page = $finddomain[0]->simplify_event_page;

            //print_r($simplify_event_page);
            if ($simplify_event_page == "yes") {
                ?>
                <style>
                    .presshold, span.loadevery {
                        display: none!important;
                    }
                </style>
            <?php }



            $userbc = get_user_by( 'login', $unfound );

            $activeyn=$wpdb->get_results("SELECT * FROM wp_pmpro_memberships_users WHERE user_id='$userbc->id' AND status='active'");
            //print_r($activeyn);



            if (!empty($activeyn)){

                $eventactive=$wpdb->get_results("SELECT * FROM v2eventlist WHERE username='$userbc->user_login' AND code='$eventname44'");

            }

            if (!empty($eventactive)){

                $username14=$userbc->user_login;
                $membershiplevel=($activeyn[0]->membership_id);



                ?>

                <script>

                    var $imagelinkarray = [];
                    var ajaxurl = "<?php echo admin_url("admin-ajax.php"); ?>";
                    var $beginning15 = 0;
                    var jsonfive;
                    $.ajax({
                        url: ajaxurl,
                        data: {
                            'action':'getdblinksv2_ajax_request',
                            'username14':'<?php echo $username14;?>',
                            'eventname44':'<?php echo $eventname44;?>'
                        },
                        datatype: 'json',
                        success:function(data) {

                            console.log(data);

                            console.log("got here");



                            console.log("downloaded all image data");
                            $ii = 0;
                            //console.log(data);

                            $happyparse = $.parseJSON(data);
                            //console.log($happyparse);
                            var value33;
                            var array33 = $.map($happyparse, function(value33, index) {
                                return [value33];
                            });

//console.log("hi");

                            window.n = array33.length;

                            console.log(window.n);
                            console.log("YES");

                            if (window.n == 0) {
                                console.log("array length 0");
                            }

                            var new_array_tracking_number = {};


                            $.each(array33, function(key,value){

                                var do_math = n-key;

                                var try_n = n;

                                //console.log("KEY "+do_math);




                                //console.log($track_numbers_array);




                                setTimeout( function () {

                                    $ii++;


                                    if (((value.name).slice(-3)) != "xml") {


                                        //WATCH OUT FOR CAPITAL JPG AND PNG, broke the site
                                        //  if (((value.name).slice(-3)) == "jpg" || ((value.name).slice(-4)) == "jpeg" || ((value.name).slice(-3)) == "png" || ((value.name).slice(-3)) == "gif") {




                                        $barb = (JSON.stringify(value));
                                        //console.log($barb);

                                        $.ajax({
                                            url: ajaxurl,
                                            data: {'action' : 'getfiveimagesv2_ajax_request',
                                                'username14' : '<?php echo $username14;?>',
                                                'eventname44' : '<?php echo $eventname44;?>',
                                                'sentfilenames' : $barb},
                                            datatype: 'json',
                                            type: 'post',
                                            success:function(data) {
                                                //console.log(data);



                                                jsonfive = $.parseJSON(data);


                                                console.log("working with "+jsonfive);

                                                if ($beginning15 < 15) {

                                                    $( ".imageholder" ).append(jsonfive).append("<p class='first_numbers'>"+do_math+"</p>");


                                                    $beginning15++;
                                                    console.log($beginning15);
                                                }

                                                else {
                                                    $imagelinkarray.push(jsonfive);
                                                    $(".getmoreimages99").html("Load More Images");
                                                }
                                            },
                                            error: function(errorThrown){
                                                console.log(errorThrown);
                                            }
                                        });
                                    };

                                }, key * 450);
                            });

                            window.n = window.n - 14;









                            $.each(array33, function(key,value){

                                //console.log(value);

                                //in order








                            });






                        },
                        error: function(errorThrown){
                            console.log(errorThrown);
                        }
                    });





                    var nn = 0;

                    jQuery(document).ready(function($){




                        console.log("readyyyyyyy");





                        $( "body" ).on( "click", ".getmoreimages99", function() {

                            if (window.nn == 0) {
                                //window.n = window.n-13;
                                console.log("ONLY GET HERE ONCE");
                            }
                            window.nn = 1;
                            console.log($imagelinkarray.length);

                            var $copyimagelinkarray = $imagelinkarray.slice();
                            var $lengthnow = $copyimagelinkarray.length;
                            var i;





                            function explode(i){

                                if ($copyimagelinkarray[i]) {
                                    window.n = window.n - 1;
                                    $( ".imageholder" ).append($copyimagelinkarray[i]).append("<p class='first_numbers'>"+window.n+"</p>");

                                    var $removeItem = $copyimagelinkarray[i];   // item do array que deverÃ¡ ser removido
                                    //console.log($removeItem);
                                    //console.log($copyimagelinkarray);
                                    $imagelinkarray.splice($.inArray($removeItem, $imagelinkarray),1);
                                    console.log(window.n);
                                }

                            }

                            for (i = 0; i < 20; i++) {

                                setTimeout(explode(i), 2000);

                            }





                        });










                    });

                </script>

                <?


                ?>

                </br>
                <div class="proholder"><div class="eventpagetopphoto"><img src="<?php echo "https://instantphotolive.com/logophotos/".$imglink; ?>"></div></div>

                <div class="presshold"><div class="phcomputer">Right click image to save to your computer!</div>
                    <div class="phholder"><div class="phleft"><b>Press and hold</b> images to save to phone!</div>
                        <div class="phright"><img src="https://instantphotolive.com/logophotos/how3.gif"></div></div></div>
                <div class="theyload"><?php if ($username14!="hffl"){ ?> <span class="loadevery">New images load every FIVE minutes!</br>Check back soon.</span><?php } ?>
                    <div class="promoholder">Powered by <a href="https://instantphotolive.com" target="_blank">InstantPhotoLive</a></div>
                </div>
                <?php /*if ($membershiplevel==4){ ?>
	<div class="trialbackground" style="position: fixed!important;top: 0!important;display: block!important;opacity: .3!important;width: 100%!important;text-align: center!important;left: 0!important;right: 0!important;bottom: 0!important;"><img src="https://instantphotolive.com/wp-content/uploads/2016/11/trialdarkwhite.png" style="position: fixed!important; top: 70px!important; display: block!important; opacity: .25!important;  width: 100%!important;  text-align: center!important;  left: 0!important; right: 0!important; bottom: 0!important;"></div>
<?php }*/
                ?>
                <div class="imageholder"></div>
                <div class="getmoreimages99">Loading...</div>




                <?


            }


            exit;
        }

        if (!empty($user)) {

            $activeyn=$wpdb->get_results("SELECT * FROM wp_pmpro_memberships_users WHERE user_id='$user->id' AND status='active'");


            if (!empty($activeyn)){


                $eventactive=$wpdb->get_results("SELECT * FROM v2eventlist WHERE username='$user->user_login' AND code='$eventname44'");

                if (!empty($eventactive)){

                    $eventid = $eventactive[0]->main;

                    $pageviewcount = $wpdb->insert(
                        'v2tracker',
                        array(
                            'eventid' => $eventid,
                            'timestamp' => current_time( 'mysql' ),
                            'pageview' => 'y'
                        ),
                        array(
                            '%d',
                            '%s',
                            '%s'
                        )
                    );

                    $username14=$user->user_login;
                    $membershiplevel=($activeyn[0]->membership_id);


                    if ($simplify_event_page == "yes") {
                        ?>
                        <style>
                            .presshold, span.loadevery {
                                display: none!important;
                            }
                        </style>
                    <?php }

                    ?>



                    <script>
                        var n=0;
                        var $imagelinkarray = [];
                        var $track_numbers_array = [];
                        var foo = {};
                        var ajaxurl = "<?php echo admin_url("admin-ajax.php"); ?>";
                        var $beginning15 = 0;
                        var jsonfive;
                        var count_global = 0;
                        $.ajax({
                            url: ajaxurl,
                            data: {
                                'action':'getdblinksv2_ajax_request',
                                'username14':'<?php echo $username14;?>',
                                'eventname44':'<?php echo $eventname44;?>'
                            },
                            datatype: 'json',
                            success:function(data) {
                                console.log(data);
                                console.log("Downloaded all image data.");
                                $ii = 0;


                                $happyparse = $.parseJSON(data);


                                //console.log($happyparse);
                                var value33;
                                var array33 = $.map($happyparse, function(value33, index) {
                                    return [value33];
                                });
                                console.log(array33);

                                window.n = array33.length;
                                $.each(array33, function(key, value) {
                                    console.log(key);
                                });
                                if (window.n == 0 || (window.n == 1 && array33["0"][".tag"] == "folder")) {
                                    $(".getmoreimages99").text("DROPBOX FOLDER IS EMPTY.").css("background", "red");
                                }

                                console.log(window.n);
                                var new_array_tracking_number = {};


                                $.each(array33, function(key,value){

                                    var do_math = n-key;

                                    var try_n = n;

                                    //console.log("KEY "+do_math);




                                    //console.log($track_numbers_array);



                                    //foo[do_math][''] = value;

                                    //console.log($track_numbers_array);

                                    setTimeout( function () {

                                        $ii++;

                                        if (((value.name).slice(-3).toLowerCase()) != "xml" && ((value.name).slice(-3).toLowerCase()) != "mp4") {


                                            // if (((value.name).slice(-3)) == "jpg" || ((value.name).slice(-4)) == "jpeg" || ((value.name).slice(-3)) == "png" || ((value.name).slice(-3)) == "gif") {


                                            $barb = (JSON.stringify(value));
                                            //console.log($barb);

                                            $track_numbers_array_send = (JSON.stringify($track_numbers_array));


                                            $.ajax({
                                                url: ajaxurl,
                                                data: {'action' : 'getfiveimagesv2_ajax_request',
                                                    'username14' : '<?php echo $username14;?>',
                                                    'eventname44' : '<?php echo $eventname44;?>',
                                                    'track_numbers_array_send' : $track_numbers_array_send,
                                                    'sentfilenames' : $barb},
                                                datatype: 'json',
                                                type: 'post',
                                                success:function(data) {
                                                    //console.log(data);

                                                    console.log(count_global);

                                                    jsonfive = $.parseJSON(data);

                                                    console.log(jsonfive);
                                                    //console.log("working with "+jsonfive);

                                                    if ($beginning15 < 15) {

                                                        var share_this_count = try_n-count_global;

                                                        $( ".imageholder" ).append(jsonfive).append("<p class='first_numbers'>"+do_math+"</p>");


                                                        $beginning15++;
                                                        //console.log($beginning15);
                                                    }

                                                    else {
                                                        $imagelinkarray.push(jsonfive);
                                                        $(".getmoreimages99").html("Load More Images");

                                                    }

                                                    //console.log($imagelinkarray);
                                                    console.log(window.n);




                                                },
                                                error: function(errorThrown){
                                                    console.log(errorThrown);
                                                }
                                            });
                                        }

                                    }, key * 450);
                                });

                                window.n = window.n - 14;

                            },
                            error: function(errorThrown){
                                console.log(errorThrown);
                            }
                        });






                        jQuery(document).ready(function($){


                            console.log("ready");

                            $( "body" ).on( "click", ".getmoreimages99", function() {


                                //console.log($imagelinkarray.length);

                                if (window.nn == 0) {
                                    window.n = window.n-13;
                                    console.log("ONLY GET HERE ONCE");
                                }
                                window.nn = 1;
                                console.log($imagelinkarray.length);

                                var $copyimagelinkarray = $imagelinkarray.slice();
                                var $lengthnow = $copyimagelinkarray.length;
                                var i;




                                function explode(i){

                                    //console.log(i);
                                    //console.log("THAT WAS I");
                                    //console.log(window.n);
                                    if ($copyimagelinkarray[i]) {
                                        window.n = window.n - 1;

                                        $( ".imageholder" ).append($copyimagelinkarray[i]).append("<p class='follow_along'>"+window.n+"</p><span class='next_along'></span>");



                                        var $removeItem = $copyimagelinkarray[i];
                                        //console.log($removeItem);
                                        //console.log($copyimagelinkarray);
                                        $imagelinkarray.splice($.inArray($removeItem, $imagelinkarray),1);
                                    }


                                }

                                for (i = 0; i < 20; i++) {

                                    setTimeout(explode(i), 2000);

                                }



                            });



                        });

                    </script>



                    <?

                    if ($username14=="demo"){
                        echo "<p style='text-align: center;background: #3497c0;margin: 0 0 25px 0;color: white;padding: 20px 0;font-size: 19px;line-height: 25px;font-weight: 600;'>Welcome to the demo!</br></br>The photos below are displaying a single Dropbox folder.</br>Add a photo to that folder and it shows up here.</br></br>All events are password-protected, which is why you entered TEST on the previous screen.</br></br>Want to learn more? <a href='https://instantphotolive.com/' style='color:#ffc94a'>Go back to InstantPhotoLive.com</a></p>";
                    }

                    if (empty($imglink)){
                        $imglink="instant-photo-live.png";
                    }
                    ?>
                    </br>
                    <div class="proholder"><div class="eventpagetopphoto"><img src="<?php echo "https://instantphotolive.com/logophotos/".$imglink; ?>"></div></div>
                    <?

                    if ($username14=="hffl"){
                        echo "<div class='wep'><p><span class='thw'>THANK YOU!</span>Find your favorite image below and post it on social media using the hashtag:<span class='wex'>#westelmxaspca</span>and West Elm will donate $1 to the ASPCA!<span class='lowr'>Photos below are only for social media. You will be emailed higher-resolution photos to print. For questions, please contact West Elm Nashville: 615.385.1512</span></p></div>";
                    }

                    ?>
                    <div class="presshold"><div class="phcomputer">Right click image to save to your computer!</div><div class="phholder"><div class="phleft"><b>Press and hold</b> images to save to phone!</div><div class="phright"><img src="https://instantphotolive.com/logophotos/how3.gif"></div></div></div><div class="theyload"><?php if ($username14!="hffl"){ ?> <span class="loadevery">New images load every FIVE minutes!</br>Check back soon.</span><?php } ?><div class="promoholder">Powered by <a href="https://instantphotolive.com" target="_blank">InstantPhotoLive</a></div>
                    </div>
                    <?
                    /*if ($membershiplevel==4){ ?>
                    <div class="trialbackground" style="position: fixed!important;top: 0!important;display: block!important;opacity: .8!important;width: 100%!important;text-align: center!important;left: 0!important;right: 0!important;bottom: 0!important;"><img src="https://instantphotolive.com/wp-content/uploads/2016/11/trialdarkwhite.png" style="position: fixed!important; top: 70px!important; display: block!important; opacity: .25!important;  width: 100%!important;  text-align: center!important;  left: 0!important; right: 0!important; bottom: 0!important;"></div>
                    <?php }*/
                    ?>
                    <div class="imageholder">

                    </div>
                    <div class="getmoreimages99">Loading...</div>
                    <?


                }

            }
            else {
                echo " does not have an active account.";
            }


        }
        else
        {
            echo "No user by that name!";
        }
    }
    public function code_entry_page($username44) {
$thelastone = $username44;
global $wpdb;
$resultpro = $wpdb->get_results ( "
    SELECT * 
    FROM settings
        WHERE username = '" . $thelastone ."' ");

$imglink=$resultpro[0]->photo;
//$txtpro=$resultpro[0]->text;
$colorfromsql=$resultpro[0]->color;

$txtpro = "Enter Code Below:";
$getuserid = $wpdb->get_results ($wpdb->prepare( "
    SELECT id 
    FROM wp_users
        WHERE user_login = %s",$thelastone));

$findtheid = $getuserid[0]->id;

$activ="active";
$subusername = $wpdb->get_results ($wpdb->prepare( "
    SELECT * 
    FROM wp_pmpro_memberships_users
        WHERE user_id = %d
		AND status = %s",$findtheid,$activ));
$memid = $subusername[0]->membership_id;
?>
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=yes" />
    <link rel='stylesheet' type='text/css' href='rediripl/indexhop.css' />
    <style type="text/css">
        <?php $chosencolor="3396bf";

        if (($memid==1 || $memid==4)&& (6==strlen($colorfromsql))){
            $chosencolor=$colorfromsql;
        }


        ?>

        .tcpkre input[type="text"], a {
            color: #<?php echo $chosencolor; ?>;
        }
        .buttonready {background-color: #<?php echo $chosencolor; ?>!important;}

        .tcpkre input[type="text"]:focus, .tcpkre input[type="text"]:hover {
            border: 6px solid #<?php echo $chosencolor; ?>;
        }</style>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
    <?/*<link rel="shortcut icon" href="https://instalink.codes/wp-content/uploads/2016/05/fav-3.png">*/?>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-81000273-1', 'auto');
        ga('send', 'pageview');

    </script>
    <title></title>
</head>
<div class="proholder">
    <?
    if (empty($imglink)) {
        ?>
        <img src="/logophotos/demo-profilephoto.jpg">
        <?
    }
    else {
        ?>
        <img src="<?php echo "/logophotos/".$imglink; ?>">
        <?
    }
    //}
    if( isset($_SESSION['errnocode']) )
    {
        echo "</br><span class='erronocodect'>" . $_SESSION['errnocode'] . "</span>";
        unset($_SESSION['errnocode']);
        echo "</br>";
    }
    echo "<div class='enter'><p>" . stripslashes($txtpro) ."</p></div>";
    ?> <?

    ?>

    <form action="rediripl/redirappboothcode.php" class="tcpkre" method="get">
        <input type="text" name="addit" class="mainformtcpk" autocomplete="off"/>
        <input type="hidden" value="<?php echo $domainname; ?>" name="linklink"/>
        <?php /*if ($memid!=4 && (!empty($userwebsiteurl))){?><div class="visitweb">No Code? <a href="<?php echo $userwebsiteurl; ?>" target="_blank">Click Here</a>.</div><?php } */?>
        <input id="submit" type="submit" value="GO">
    </form>
    <div class="promoholder">Powered by <a href="https://instantphotolive.com" target="_blank">InstantPhotoLive</a></div></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="rediripl/submit_disable.js"></script>
<?php
    }

    public function kaboom() {

        global $wpdb;
        $domainname=$_SERVER['SERVER_NAME'];
        $feed_user = 0;
        global $wp;
        $kaboom=(explode(".",$domainname));
        if ($kaboom[1]=="instantphotolive") {
            $user = get_user_by( 'login', $kaboom[0] );
            $photofromusername=$wpdb->get_results("SELECT * FROM settings where username='$user->user_login'");
            $imglink=$photofromusername[0]->photo;
            $simplify_event_page = $photofromusername[0]->simplify_event_page;
        } else if ($kaboom[1]=="boothcode") {
            $user = get_user_by( 'login', 'boothcode' );
        } else{
            $finddomain=$wpdb->get_results("SELECT * FROM settings where customdomain='$domainname'");
            $user = get_user_by( 'login', $finddomain[0]->username );
            $imglink=$finddomain[0]->photo;
            $simplify_event_page = $finddomain[0]->simplify_event_page;
        }
        $username44=$user->user_login;
        $this->code_entry_page($username44);
        return $user;
    }

    public function handle_request($query)
    {
        $request = $query->request;
        $app_request = explode("\\", $request);
        if (count($app_request) > 1) {
            if ($app_request[0] == 'app') {
                $this->results_page();
            }
        }
        if ($request == 'boothcode') {
            global $wpdb;
            $eventname = ($_GET["addit"]);
            $linklink = ($_GET["linklink"]);
            $user = $this->kaboom();

            $thelastone=$user->user_login;

            $alltheevents = $wpdb->get_results("
    SELECT * FROM v2eventlist
        WHERE code = '$eventname' ORDER BY timestamp DESC");

            $wpdb->query( $wpdb->prepare(
                "
		UPDATE boothcodeevents
   SET numclicks = numclicks + 1
  WHERE codename = %s", $eventname) );

            $value=0;
            foreach ($alltheevents as $value) {
                if ((strtolower($value->code))==strtolower(($eventname))):
                    $realurl=$value->code;
                    $eventid = $value->main;
                endif;
            }
            $countcodeuse = $wpdb->insert('v2tracker', array(
                    'eventid' => $eventid,
                    'timestamp' => current_time( 'mysql' ),
                    'codeuse' => 'y'
                ), array('%d','%s','%s'));
            unset($value);
            $newhead = $realurl;
            if (empty($newhead)) {
                $newhead= $linklink;
                $trythishead3=('Location: http://'.$linklink);

                $_SESSION['errnocode'] = "Error! Code doesn't exist.";
                header($trythishead3);
            } else {
                $trythishead=('Location: http://'.$linklink.'/event/'.$newhead);
                header($trythishead);
            }
            exit();
        }
        if ($request == 'verify-token') {

            $errorsArray = array();
            $token = $_SERVER['HTTP_AUTHORIZATION'];

            if ($token == '') {
                wp_send_json(new WP_Error('fail', 'Bad_Request', "Bad Headers"));
                die;
            }

            $token = substr($token, 7);
            if ($token == '') {
                array_push($errorsArray, 'No token was sent in headers');
            }
            if (count($errorsArray) > 0) {
                wp_send_json(new WP_Error('fail', 'Bad_Request', $errorsArray));
                die;
            }
            try {
                $secret_key = defined('JWT_AUTH_SECRET_KEY') ? JWT_AUTH_SECRET_KEY : false;
                $tokenDecoded = JWT::decode($token, $secret_key, array('HS256'));
                $tokenUserId = $tokenDecoded->data->user->id;
                if (!isset($tokenUserId)) {
                    /** No user id in the token, abort!! */
                    wp_send_json(new WP_Error(
                        'fail',
                        'Bad_Request',
                        'User ID not found in the token'
                    ));
                }
                else
                {
                    $tokenUserId = intval($tokenUserId);
                    $userid = $tokenUserId;

                    wp_send_json($userid);
                }

            } catch (Exception $e) {
                /** Something is wrong trying to decode the token, send back the error */
                wp_send_json(new WP_Error(
                    'fail',
                    'Bad_Request',
                    $e->getMessage()
                ));
            }
            die;
        }
    }
}
new IPL();
