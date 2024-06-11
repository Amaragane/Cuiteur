<?php
    ob_start();
    require('bibli_generale.php');
    require('bibli_cuiteur.php');
    $sql=
            'SELECT blTexte, blDate , blHeure, usPseudo, usNom
            FROM users,blablas
            WHERE usID=blIDAuteur
            AND usID=2';
            
    $bd=xx_bd_connect();
    
    $res=mysqli_query($bd , $sql) OR xx_bd_erreur($bd,$sql);
    
    ms_debut('blablas2','../styles/cuiteur.css');
    ms_aff_entete(false);
    
    $T = mysqli_fetch_assoc($res);
    echo '<h1>Les blablas de',$T['usPseudo'],'</h1>';
    
    echo '<li>',$T['usPseudo'],' ',$T['usNom'],'</li>';
    
        echo '<p>',$T['blTexte'],'<br>',ms_amj_clair($T['blDate']),' à ',ms_heure_clair($T['blHeure']),'</p>';
        
    while ($T=mysqli_fetch_assoc($res)){
        echo '<li>',$T['usPseudo'],' ',$T['usNom'],'</li>';
        echo '<p>',$T['blTexte'],'<br>',ms_amj_clair($T['blDate']),' à ',ms_heure_clair($T['blHeure']),'</p>';  
    }
    
    ms_fin();
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
?>
