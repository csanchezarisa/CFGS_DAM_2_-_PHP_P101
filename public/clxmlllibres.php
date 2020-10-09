<?php

    class clmxllibres {

        private $directori;
        private $nomArxiu;
        private $fitxer;
        private $document;
        private $llibres;


        public function __construct() { // Constructor de la classe. Assigna els valors per defecte

            $this->directori = "./";
            $this->nomArxiu = "LLIBRES.xml";
            $this->fitxer = $this->directori . $this->nomArxiu;
            $this->document = new DOMDocument();
            $this->document->load($this->fitxer);
            $this->llibres = $this->document->getElementsByTagName("book");

        }


        public function canviarDirectori($directoriNou) { // Mètode que permet canviar el directori on es troba el fitxer

            $this->carregarFitxer($directoriNou, $this->nomArxiu);
        
        }


        public function canviarFitxer($fitxerNou) { // Mètode que permet canviar el nom del fitxer
        
            $this->carregarFitxer($this->directori, $fitxerNou);
        
        }


        public function canviarDirectoriIFitxer($directoriNou, $fitxerNou) { // Mètode que permet canviar el nom del fitxer i del directori

            $this->carregarFitxer($directoriNou, $fitxerNou);

        }


        private function carregarFitxer($directoriNou, $nomArxiuNou) { // Torna a carregar el fitxer amb el nou dirctori/

            $this->directori = $directoriNou;
            $this->nomArxiu = $nomArxiuNou;

            $this->fitxer = $this->directori . $this->nomArxiu;
            $this->document->load($this->fitxer);
            $this->llibres = $this->document->getElementsByTagName("book");

        }


        public function listXml() { // Crea i mostra un llistat HTML amb els noms dels autors dels llibres
    
            echo "<ul>";
    
            foreach ($this->llibres as $llibre) {
                $autors = $llibre->getElementsByTagName("title");
                $autor = $autors->item(0)->nodeValue;
    
                echo "<li>$autor</li>";
            }
    
            echo "</ul>";
    
        }


        public function paginaSeguent($pagina) { // Mètode que revisa que la pàgina no sigui la última i sigui possible passar a la següent

            $paginaNova = $pagina + 1;
    
            if ($paginaNova >= $this->llibres->length) {
                return $pagina;
            }
            else {
                return $paginaNova;
            }

        }
    

        public function paginaAnterior($pagina) { // Mètode que revisa que la pàgina a la que es vol passar sigui la última
    
            $paginaNova = $pagina - 1;
    
            if ($paginaNova < 0) {
                return $pagina;
            }
            else {
                return $paginaNova;
            }
        }
    

        public function ultimaPagina() { // Retorna el número de pàgina final
    
            return ($this->llibres->length - 1);

        }
    

        function nodeXML($pagina) { // Imprimeix codi HTML un llistat dels elements d'una posició concreta de l'array de llibres
    
            $llibre = $this->llibres[$pagina];
    
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

    }

?>