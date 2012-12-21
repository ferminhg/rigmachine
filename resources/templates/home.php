<div id="centerleft">
    <?php
        foreach($layout['regions'] as $file){
            require_once(TEMPLATES_PATH . "/" .$file);
        }
    ?>
</div>

<?php
    /*
        Any variables passed in through the variables parameter in our renderLayoutWithContentPage() function
        are available in here.
    */
    //echo $setInIndexDotPhp;
?>
