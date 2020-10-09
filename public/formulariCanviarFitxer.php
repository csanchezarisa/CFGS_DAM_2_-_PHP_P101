
        <div id="formularicanvifitxer">
        
        <?php 

            /* S'executa quan es prem el botó submit del formulari inferior.
            Depenent què s'ha definit es canvia una variable de sessió o un altre */
            if (isset($_POST["btncarregarfitxernou"])) {

                if (isset($_POST["txtnoudirectori"]) && isset($_POST["txtnoufitxer"])) {

                    $_SESSION["directori"] = $_POST["txtnoudirectori"];
                    $_SESSION["fitxer"] = $_POST["txtnoufitxer"];

                }
                elseif (isset($_POST["txtnoudirectori"])) {

                    $_SESSION["directori"] = $_POST["txtnoudirectori"];

                }
                elseif (isset($_POST["txtnoufitxer"])) {
                    
                    $_SESSION["fitxer"] = $_POST["txtnoufitxer"];

                }
                
                header('Refresh:0');

            }

        ?>

            <h2>Obrir un altre fitxer</h2>
            <hr align="left" />

            <!-- Formulari per obrir un altre fitxer/directori -->
            <form id="canviarXML" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <table class="taulacanviarfitxer">
                    <tr>
                        <td colspan="2" style="text-align:left">
                            Necessites obrir un altre fitxer?<br />
                            Omple el formulari per obrir-ne un altre.
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Directori nou: <input type="text" name="txtnoudirectori" placeholder="Introdueix el nou directori" />
                        </td>
                        <td>
                            Fitxer nou: <input type="text" name="txtnoufitxer" placeholder="Introdueix el nou fitxer" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:right">
                            <input type="submit" name="btncarregarfitxernou" value="Carregar fitxer nou" class="botocarregarfitxer" />
                        </td>
                    </tr>
                </table>
            </form>

        </div>