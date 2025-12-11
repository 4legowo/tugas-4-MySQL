<?php
    
    if (isset($_SESSION['success_message'])) {
        echo '<div class="success">' . $_SESSION['success_message'] . '</div>';
        unset($_SESSION['success_message']);
    }
    
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo '<div class="error">' . $error . '</div>';
        }
    }
    ?>