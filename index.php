<?php

ob_start();

require 'config.inc.php';
require 'includes/global.inc.php';

session_start();

if (isset($_SESSION['super_id'])) {
    
    $template_path        = 'templates/frontend/';
    $template_path_common = 'templates/backend/';
    
    // delete tags    
    if (isset($_POST['delete-tag'])) {
        $item_id    = intval($_POST['delete-tag']);
        $student_id = $_SESSION['super_id'];
        $stmt       = $DB->execute("DELETE FROM tags WHERE subject_id = $item_id AND student_id = $student_id");
        
        exit;
    }
    
    /* include header & minibar */
    require $template_path_common . 'header.html';
    require $template_path . 'minibar.html';
    
    $cmd = (isset($_GET['cmd']) ? $_GET['cmd'] : '');
    switch ($cmd) {
        
        /* default */
        default:
            $super_id = (int)$_SESSION['super_id'];
            
            $query  = $DB->execute("SELECT * FROM students WHERE role = 0 AND id = '$super_id'");
            $result = $DB->fetchObject($query);
            
            $tags = $DB->execute("SELECT t. * , s. *
                                    FROM subjects s
                                    JOIN tags t ON t.subject_id = s.id
                                    AND student_id = $super_id");
            
            require $template_path . 'default.html';
            unset($query, $tags);
            break;
        
        /* tags */
        case 'tags':
            $tags       = ($_POST['tags']);
            $student_id = $_SESSION['super_id'];
            foreach (array_filter($tags) as $key => $value) {
                
                $query = $DB->execute(sprintf("INSERT INTO tags VALUES (
                                                                    NULL,
                                                                    '$student_id',
                                                                    '$value')"));
                unset($query);
            }
            header('location: index.php');
            break;
        
        
        /* logout */
        case 'logout':
            session_start();
            unset($_SESSION['super_id']);
            
            header('location: login.php');
            break;
            
            
    }
    
    /* include footer */
    require $template_path_common . 'footer.html';
    
} else {
    header('location: login.php');
}
