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

add_action('parse_request', 'handle_request');

function handle_request($query)
{
    if ($query->request == 'verify-token') {

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
