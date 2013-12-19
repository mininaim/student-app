<?php

/* turn output buffering on */
ob_start();

/* require config & classes files */
require_once 'config.inc.php';
require_once 'includes/global.inc.php';

/* set template path */
$template_path = 'templates/backend/';

/* include header */
require $template_path . 'header.html';

$cmd = (isset($_GET['cmd']) ? $_GET['cmd'] : '');
switch ($cmd) {
    
    case 'log':

        $email    = mysql_real_escape_string($_POST['email']);
        $password = mysql_real_escape_string($_POST['password']);
        
        if (empty($email) OR empty($password)) {
            
            /* redirect & display an error */
            header('location: login.php?e=0');
        } else {
            $query  = $DB->execute("SELECT * FROM students 
                                    WHERE status = 0 AND 
                                    email='$email' AND 
                                    password = md5('$password') LIMIT 1");
            $result = $DB->fetchObject($query);
            
            if ($DB->numRows($query) > 0) {
                session_cache_limiter('nocache');
                session_start();
                
                
                unset($query);
                
                if ($result->role == 0) {
                    $_SESSION['super_id']       = $result->id;
                    $_SESSION['super_email']    = $result->email;
                    $_SESSION['super_username'] = $result->username;
                    
                    header('location: index.php');
                    
                } else {
                    
                    $_SESSION['super_admin_id']       = $result->id;
                    $_SESSION['super_admin_email']    = $result->email;
                    $_SESSION['super_admin_username'] = $result->username;
                    
                    header('location: dashboard/');
                }
                
                
            } else {
                header('location: login.php?e=1');
                
            }
        }
        break;
    
    
    default:
        session_start();
        
        if (isset($_SESSION['super_admin_id'])) {
            header('location: dashboard/');
        } else {
            require $template_path . 'login.html';
        }
        
        break;
        
}

/* include footer */
require $template_path . 'footer.html';