<?php

    $directori = "./";
    $nomArxiu = "LLIBRES.xml";
    $fitxer = $directori . $nomArxiu;
    $document = new DOMDocument();
    $document -> load($fitxer);
    
    $pagina = 0;

    function paginaSeguent() {

        global $pagina;

        $pagina ++;
        mostrarPagina($pagina);
    }

    function paginaAnterior() {

        global $pagina;

        $pagina --;
        mostrarPagina($pagina);
    }

    function mostrarPagina($pagina) {
        global $document;

        $llibre = $document->getElementsByTagName("book");
        $llibre = $llibre[$pagina];

        $autor = $llibre->getElementsByTagName("author");
        $autor = $autor->item(0)->nodeValue;

        $titol = $llibre->getElementsByTagName("title");
        $titol = $titol->item(0)->nodeValue;

        $genere = $llibre->getElementsByTagName("genre");
        $genere = $genere->item(0)->nodeValue;

        $preu = $llibre->getElementsByTagName("price");
        $preu = $preu->item(0)->nodeValue;

        $dataPublicacio = $llibre->getElementsByTagName("publish_date");
        $dataPublicacio = $dataPublicacio->item(0)->nodeValue;

        $descripcio = $llibre->getElementsByTagName("description");
        $descripcio = $descripcio->item(0)->nodeValue;

        echo "<h3>" . ($pagina + 1) . " - " . $titol . "</h3>";
        echo "<ul><li><strong>Autor:</strong> $autor</li>";
        echo "<li><strong>Gènere:</strong> $genere</li>";
        echo "<li><strong>Preu:</strong> $preu</li>";
        echo "<li><strong>Data de pulicació:</strong> $dataPublicacio</li>";
        echo "<li><strong>Descripció:</strong> $descripcio</li></ul>";
    }
?>