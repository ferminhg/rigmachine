<?php
    require_once(realpath(dirname(__FILE__) . "/../config.php"));
    function renderLayoutWithContentFile($contentFile, $variables = array())
    {
        $contentFileFullPath = TEMPLATES_PATH . "/" . $contentFile;
        // making sure passed in variables are in scope of the template
        // each key in the $variables array will become a variable
        if (count($variables) > 0) {
            foreach ($variables as $key => $value) {
                if (strlen($key) > 0) {
                    ${$key} = $value;
                }
            }
        }
        require_once(TEMPLATES_PATH . "/header.php");
        require_once(TEMPLATES_PATH . "/searcher.php");

        echo "<div id=\"container\">\n"
           . "\t<div id=\"content\">\n";
        require_once(TEMPLATES_PATH . "/title.php");

        echo "\t\t<div id=\"container-canvas\">\n"
            ."\t\t\t<div id=\"container-canvas-wrapper\">\n";

        (file_exists($contentFileFullPath)) ?   require_once($contentFileFullPath): require_once(TEMPLATES_PATH . "/error.php");

        require_once(TEMPLATES_PATH . "/right.php");
        echo "\t\t</div>\n"; // close container-canvas div
        echo "<div class=\"clear\"></div>";
        echo "\t\t\t</div>\n"; // close container-canvas-wrapper div

        echo "\t</div>\n"; // close content div
        echo "</div>\n"; // close container div
        require_once(TEMPLATES_PATH . "/footer.php");
        require_once(TEMPLATES_PATH . "/endcode.php");
    }

    function renderLayourWithLayoutArray($layout, $variables = array())
    {
        $contentFileFullPath = TEMPLATES_PATH . "/" . $layout['file'];
        if (count($variables) > 0) {
            foreach ($variables as $key => $value) {
                if (strlen($key) > 0) {
                    ${$key} = $value;
                }
            }
        }
        $hassearcher = (isset($layout['options']) && isset($layout['options']['searcher']) && $layout['options']['searcher'] == true);
        $hasspam = (isset($layout['spam']));

        require_once(TEMPLATES_PATH . "/header.php");
        //TODO si no tiene searcher cargar una cabecera con logo y tal vez login
        if($hassearcher)
            require_once(TEMPLATES_PATH . "/searcher.php");

        echo "<div id=\"container\">\n"
           . "\t<div id=\"content\">\n";
        require_once(TEMPLATES_PATH . "/title.php");

        echo "\t\t<div id=\"container-canvas\">\n"
            ."\t\t\t<div id=\"container-canvas-wrapper\">\n";

        (file_exists($contentFileFullPath)) ?   require_once($contentFileFullPath): require_once(TEMPLATES_PATH . "/error.php");

        //Zona de spam
        if($hasspam) require_once(TEMPLATES_PATH . "/" .$layout['spam']);

        echo "\t\t</div>\n"; // close container-canvas div
        echo "<div class=\"clear\"></div>";
        echo "\t\t\t</div>\n"; // close container-canvas-wrapper div

        echo "\t</div>\n"; // close content div
        echo "</div>\n"; // close container div
        require_once(TEMPLATES_PATH . "/footer.php");
        require_once(TEMPLATES_PATH . "/endcode.php");

    }
?>