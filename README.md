# banana-php
An experiment to write quick syntax code directly in PHP with on-the-fly compilation using error handling.

Examples :

    <?php
    
    require 'banana.php';
    
    include 'echo "Hello World\n"';
    
    $var = '456';
    eval(b('
    	var_dump str_split "123".$var
    '));
    
    include '$text="Displaying the last word:\n"
            echo $text
            print_r end explode " ",$text';
    ?>
