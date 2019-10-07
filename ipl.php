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
        <? $chosencolor="3396bf";

        if (($memid==1 || $memid==4)&& (6==strlen($colorfromsql))){
            $chosencolor=$colorfromsql;
        }


        ?>

        .tcpkre input[type="text"], a {
            color: #<? echo $chosencolor; ?>;
        }
        .buttonready {background-color: #<? echo $chosencolor; ?>!important;}

        .tcpkre input[type="text"]:focus, .tcpkre input[type="text"]:hover {
            border: 6px solid #<? echo $chosencolor; ?>;
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
        <img src="<? echo "/logophotos/".$imglink; ?>">
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
        <input type="hidden" value="<? echo $domainname; ?>" name="linklink"/>
        <? /*if ($memid!=4 && (!empty($userwebsiteurl))){?><div class="visitweb">No Code? <a href="<? echo $userwebsiteurl; ?>" target="_blank">Click Here</a>.</div><? } */?>
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
                exit();
            } else {
                $trythishead=('Location: http://'.$linklink.'/event/'.$newhead);
                header($trythishead);
                exit();
            }
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
