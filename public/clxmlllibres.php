<?php

/*
    class clmxllibres {
        function __construct() {

            global $document;

            $directori = "./";
            $nomArxiu = "LLIBRES.xml";
            $fitxer = $directori . $nomArxiu;
            $document = new DOMDocument();
            $document -> load($fitxer);

        }

        function listXml() {

            global $document;

            $llibres = $document -> getElementsByTagName("books");
            $autors = $llibres -> getElementsByTagName("author");
            $autor = $authors -> item(0) -> nodeValue;
        }

    }
*/

    $directori = "./";
    $nomArxiu = "LLIBRES.xml";
    $fitxer = $directori . $nomArxiu;
    $document = new DOMDocument();
    $document -> load($fitxer);

    function listXml($document) {

        $llibres = $document->getElementsByTagName("book");

        echo "<ul>";

        foreach ($llibres as $llibre) {
            $autors = $llibre->getElementsByTagName("author");
            $autor = $autors->item(0)->nodeValue;

            echo "<li>$autor</li>";
        }

        echo "</ul>";

    }

    listXml($document);
    
?>