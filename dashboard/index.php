<?php

ob_start();

require '../config.inc.php';
require '../includes/global.inc.php';

$template_path = '../templates/backend/';


session_start();

if (isset($_SESSION['super_admin_id'])) {
    /** include header */
    require $template_path . 'header.html';
    require $template_path . 'minibar.html';
    
    $cmd = (isset($_GET['cmd']) ? $_GET['cmd'] : '');
    switch ($cmd) {
        
        /** default */
        default:
            require $template_path . 'default.html';
            break;
        
        
        /** subjects */
        case 'subjects':
            $action = (isset($_GET['action']) ? $_GET['action'] : '');
            switch ($action) {
                default:
                    
                    $sql   = "SELECT * FROM subjects ORDER BY id DESC";
                    $query = $DB->execute($sql);
                    require $template_path . 'subjects.html';
                    
                    unset($query);
                    break;
                
                case 'new':
                    require $template_path . 'subjects_new.html';
                    break;
                
                case 'save':
                    
                    extract($_POST);
                    $date  = date('Y-m-d H:i:s');
                    $title = mysql_real_escape_string($title);
                    
                    if (empty($title)) {
                        header('location: index.php?cmd=subjects&action=new&e=0');
                    } else {
                        $check = $DB->execute("SELECT title FROM subjects WHERE title = '$title'");
                        
                        if ($DB->numRows($check) > 0) {
                            header('location: index.php?cmd=subjects&e=1');
                        } else {
                            $query = $DB->execute("INSERT INTO subjects VALUES('null','$title','$date','$status')") or die(mysql_error());
                            
                            header('location: index.php?cmd=subjects&e=2');
                            unset($check, $query);
                        }
                    }
                    break;
                
                case 'edit':
                    
                    $id = $_GET['id'];
                    
                    $query  = $DB->execute("SELECT * FROM subjects WHERE id = $id");
                    $result = $DB->fetchObject($query);
                    
                    require $template_path . 'subjects_edit.html';
                    unset($query);
                    break;
                
                case 'edited':
                    
                    extract($_POST);
                    $title = mysql_real_escape_string($title);
                    
                    if (empty($title)) {
                        header('location: index.php?cmd=subjects&action=edit&id=' . $id . '&e=0');
                    } else {
                        $query = $DB->execute("UPDATE subjects SET title = '$title' WHERE id = $id");
                        header('location: index.php?cmd=subjects&e=2');
                        unset($query);
                    }
                    break;

                case 'on':
                    
                    $id = $_GET['id'];
                    
                    $query = $DB->execute("UPDATE subjects SET status = 0 WHERE id = $id");
                    
                    header('location: index.php?cmd=subjects');
                    unset($query);
                    
                    break;
                
                case 'off':
                    
                    $id = $_GET['id'];
                    
                    $query = $DB->execute("UPDATE subjects SET status = 1 WHERE id = $id");
                    
                    header('location: index.php?cmd=subjects');
                    unset($query);
                    
                    break;
                    
                    
                case 'del':
                    
                    $id = (int)$_GET['id'];
                    
                    $query = $DB->execute("DELETE FROM subjects WHERE id = $id");
                    
                    header('location: index.php?cmd=subjects&e=3');
                    unset($query);
                    
                    break;
            }
            break;
        
        
        /** students */
        case 'students':
            $action = (isset($_GET['action']) ? $_GET['action'] : '');
            switch ($action) {
                default:
                    
                    $sql = "SELECT * FROM students WHERE role = 0 ORDER BY id DESC";
                    paginate($sql, 10);
                    
                    $query = $DB->execute("$sql LIMIT $start, $limit");
                    require $template_path . 'students.html';
                    
                    unset($query);
                    break;
                
                case 'new':
                    require $template_path . 'students_new.html';
                    break;
                
                case 'save':
                    extract($_POST);
                    $username = mysql_real_escape_string($username);
                    $date     = date('Y-m-d H:i:s');
                    
                    if (!empty($username) AND !empty($email) AND !empty($password)) {
                        
                        $select = $DB->execute("SELECT email FROM students WHERE email = '$email' AND role = 0") or die(mysql_error());
                        if($DB->numRows($select) > 0) {
                           header('location: ?cmd=students&e=1');  
                        } else {
                              $query = $DB->execute("INSERT INTO students VALUES (NULL, '$username', md5('$password'), '$email', '$date', '0','0')") or die(mysql_error());
                              unset($query);
                              header('location: ?cmd=students&e=2');
                        }

                    } else {
                        header('location: ?cmd=students&action=new&e=0');
                    }
                    
                    break;
                
                case 'del':
                    
                    $id = $_GET['id'];
                    
                    $query = $DB->execute("DELETE FROM students WHERE id = $id");
                    
                    header('location: index.php?cmd=students&e=3');
                    unset($query);
                    
                    break;
                
                case 'edit':
                    
                    $id = $_GET['id'];
                    
                    $query  = $DB->execute("SELECT * FROM students WHERE id = $id");
                    $result = $DB->fetchObject($query);
                    
                    require $template_path . 'students_edit.html';
                    unset($query);
                    break;
                
                case 'edited':
                    
                    extract($_POST);
                    
                    
                    
                    if (empty($username) OR empty($email)) {
                        header('location: index.php?cmd=students&action=edit&id=' . $id . '&e=0');
                    } else {
                        $username = mysql_real_escape_string($username);
                        $email    = mysql_real_escape_string($email);
                        $query    = $DB->execute("UPDATE students SET 
                                    username = '$username',
                                    email    = '$email'
                                     WHERE id = $id");
                        header('location: index.php?cmd=students&e=2');
                        unset($query);
                    }
                    break;
                
                
                
                case 'on':
                    
                    $id = $_GET['id'];
                    
                    $query = $DB->execute("UPDATE students SET status = 0 WHERE id = $id");
                    
                    header('location: index.php?cmd=students');
                    unset($query);
                    
                    break;
                
                case 'off':
                    
                    $id = $_GET['id'];
                    
                    $query = $DB->execute("UPDATE students SET status = 1 WHERE id = $id");
                    
                    header('location: index.php?cmd=students');
                    unset($query);
                    
                    break;
            }
            break;
        
        
        /** users */
        case 'profile':
            $action = (isset($_GET['action']) ? $_GET['action'] : '');
            switch ($action) {
                default:
                    $super_admin_id = $_SESSION['super_admin_id'];
                    
                    $query  = $DB->execute("SELECT * FROM students WHERE role = 1 AND id = '$super_admin_id'");
                    $result = $DB->fetchObject($query);
                    
                    require $template_path . 'profile.html';
                    unset($query);
                    
                    break;
                
                case 'save':
                    extract($_POST);
                    
                    if (empty($username) or empty($email)) {
                        header('location: ./?cmd=profile&e=0');
                    } else {
                        if (isset($password) AND !empty($password)) {
                            $new_password = md5($password);
                            
                        } else {
                            $new_password = $password1;
                            
                        }
                        
                        $username = mysql_real_escape_string($username);
                        $query    = $DB->execute("UPDATE students SET username='$username',password='$new_password', email='$email' WHERE id = '$id'");
                        unset($query);
                        
                        
                        header('location: ./?cmd=profile&e=1');
                    }
                    break;
            }
            break;
        
        
        /** logout */
        case 'logout':
            session_start();
            unset($_SESSION['super_admin_id']);
            
            header('location: ../login.php');
            break;
            
            
    }
    
    /** include footer */
    require $template_path . 'footer.html';
    
} else {
    header('location: ../login.php');
}