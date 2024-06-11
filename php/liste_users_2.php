<?php
    ob_start();
    require('bibli_generale.php');
    require('bibli_cuiteur.php');
    $sql=
            'SELECT *
            FROM users
            ORDER BY usID';
            
    $bd=xx_bd_connect();
    $res=mysqli_query($bd , $sql) OR xx_bd_erreur($bd,$sql);
    ms_debut("liste users");
    echo'<h1>Liste des utilisateurs de Cuiteur</h1>';
    while ($T = mysqli_fetch_assoc($res)){
        echo '<h2>Utilisateur', $T['usID'],'</h2>';
        echo '<ul>',
        '<li> Pseudo :', $T['usPseudo'],'</li>',
        '<li> Nom :',$T['usNom'],'</li>',
        '<li> Inscription :',ms_amj_clair($T['usDateInscription']),'</li>',
        '<li> Ville :',$T['usVille'],'</li>',
        '<li> Web :',$T['usWeb'],'</li>',
        '<li> Mail :',$T['usMail'],'</li>',
        '<li> Naissance :',ms_amj_clair($T['usDateNaissance']),'</li>',
        '<li> Bio :',htmlentities($T['usBio']),'</li>',
        '</ul>';
    }
    ms_fin();
    
    mysqli_close($bd);
?>