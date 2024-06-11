<?php
define('BS_SERVER','localhost');
define('BS_DB','salvi_cuiteur');
define('BS_USER','salvi_u');
define('BS_PASS','salvi_p');

function xx_bd_erreur_exit($msg) {
    ob_end_clean();	// Supression de tout ce qui a pu être déja généré

    echo    '<!DOCTYPE html><html lang="fr"><head><meta charset="UTF-8"><title>',
            'Erreur base de données</title>',
            '<style>table{border-collapse: collapse;}td{border: 1px solid black;padding: 4px 10px;}</style>',
            '</head><body>',
            $msg,
            '</body></html>';
    exit(1);
}
function xx_bd_connect() {
    $conn = mysqli_connect(BS_SERVER, BS_USER, BS_PASS, BS_DB);
    if ($conn !== FALSE) {
        //mysqli_set_charset() définit le jeu de caractères par défaut à utiliser lors de l'envoi
        //de données depuis et vers le serveur de base de données.
        mysqli_set_charset($conn, 'utf8') 
        or xx_bd_erreur_exit('<h4>Erreur lors du chargement du jeu de caractères utf8</h4>');
        return $conn;     // ===> Sortie connexion OK
    }
    // Erreur de connexion
    // Collecte des informations facilitant le debugage
    $msg = '<h4>Erreur de connexion base MySQL</h4>'
            .'<div style="margin: 20px auto; width: 350px;">'
            .'BD_SERVER : '. BS_SERVER
            .'<br>BS_USER : '. BS_USER
            .'<br>BS_PASS : '. BS_PASS
            .'<br>BS_DB : '. BS_DB
            .'<p>Erreur MySQL numéro : '.mysqli_connect_errno()
            .'<br>'.htmlentities(mysqli_connect_error(), ENT_QUOTES, 'ISO-8859-1')  
            //appel de htmlentities() pour que les éventuels accents s'affiche correctement
            .'</div>';
    xx_bd_erreur_exit($msg);
}
function xx_bd_erreur($bd, $sql) {
    $errNum = mysqli_errno($bd);
    $errTxt = mysqli_error($bd);

    // Collecte des informations facilitant le debugage
    $msg =  '<h4>Erreur de requête</h4>'
            ."<pre><b>Erreur mysql :</b> $errNum"
            ."<br> $errTxt"
            ."<br><br><b>Requête :</b><br> $sql"
            .'<br><br><b>Pile des appels de fonction</b></pre>';

    // Récupération de la pile des appels de fonction
    $msg .= '<table>'
            .'<tr><td>Fonction</td><td>Appelée ligne</td>'
            .'<td>Fichier</td></tr>';

    $appels = debug_backtrace();
    for ($i = 0, $iMax = count($appels); $i < $iMax; $i++) {
        $msg .= '<tr style="text-align: center;"><td>'
                .$appels[$i]['function'].'</td><td>'
                .$appels[$i]['line'].'</td><td>'
                .$appels[$i]['file'].'</td></tr>';
    }

    $msg .= '</table>';

    xx_bd_erreur_exit($msg);	// => ARRET DU SCRIPT
}

?>