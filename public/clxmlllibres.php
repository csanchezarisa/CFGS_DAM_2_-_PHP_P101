<?php

    class clmxllibres {

        private $directori;
        private $nomArxiu;
        private $fitxer;
        private $document;
        private $llibres;
        private $llistatTitols = array();
        private $propietatsLlibre = array();


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


        public function listXml() { // Crea i retorna un array amb els noms dels títols dels llibres

            foreach ($this->llibres as $llibre) {

                $titols = $llibre->getElementsByTagName("title");
                $titol = $titols->item(0)->nodeValue;
    
                array_push($this->llistatTitols, $titol);
            }

            return $this->llistatTitols;
    
        }


        public function nodeSeguent($pagina) { // Mètode que revisa que la pàgina no sigui la última i sigui possible passar a la següent. Retorna el valor i canvia les propietats de l'objecte per les d'aquest node

            $paginaNova = $pagina + 1;
    
            if ($paginaNova >= $this->llibres->length) {
                $this->nodeXML($pagina);
                return $pagina;
            }
            else {
                $this->nodeXML($paginaNova);
                return $paginaNova;
            }

        }
    

        public function nodeAnterior($pagina) { // Mètode que revisa que la pàgina a la que es vol passar sigui la última. Retorna el valor i canvia les propietats de l'objecte per les d'aquest node
    
            $paginaNova = $pagina - 1;
    
            if ($paginaNova < 0) {
                $this->nodeXML($pagina);
                return $pagina;
            }
            else {
                $this->nodeXML($paginaNova);
                return $paginaNova;
            }
        }
    

        public function ultimNode() { // Retorna el número de pàgina final i canvia les propietats de l'objecte per les d'aquest node
    
            $this->nodeXML($this->llibres->length - 1);
            return ($this->llibres->length - 1);

        }


        public function primerNode() { // Retorna 0, la primera pàgina, i canvia les propietats de l'objecte per les d'aquest node

            $this->nodeXML(0);
            return 0;

        }
    

        private function nodeXML($pagina) { // Segons la pàgina indicada, carrega les dades d'un node o d'un altre. Després, introdueix les propietats del mateix en l'array de propietats de l'objecte
    
            $llibre = $this->llibres[$pagina];
            $subNodes = $llibre->childNodes;

            $propietats = array();

            foreach ($subNodes as $node) {
                $propietat = $node->nodeName;
                $valor = $node->nodeValue;

                $hola = array($propietat => $valor);
                $propietats = array_merge($propietats, $hola);
            }

            $this->propietatsLlibre = $propietats;
        }


        public function getPropietatsNode() { // Retorna l'array amb les propietats del node que s'està analitzant

            return $this->propietatsLlibre;

        }

    }

?>