<?php

/**
*Fonction affichant le debut d'une page html
*
*Fonction a appler lors de l'initialisation d'une partie html
*@param string $titre  titre de la page $css chemin vers le documents css de la page
*/
    function ms_debut($titre,$css){
    echo '<!DOCTYPE html>',
            '<html lang="fr">',
                '<head>',
                    '<title>',$titre,'</title>',
                    '<link rel="stylesheet" type="text/css" href=',$css,'>',
                    '<meta charset="UTF-8">',
                '<head>',
            '<body>';    
    }
/**
*Fonction affichant la fin d'une page html
*
*
*/
    function ms_fin(){
        echo        '</div>',
                '</body>',
            '</html>';   
    }






/**
*Fonction permettant d'afficher une date entre sous format aaaammjj pour l'afficher en jour "mois" annee
*
*a appeler lorsque l'on veut changer le format de la date
*@param int $date date a modifier
*/
    function ms_amj_clair($date){
        $jour=$date%100;
        $date/= 100;
        $mois=$date%100;
        $date/= 100;
        $annee=$date%10000;
        $smois="";
        switch($mois){
            case 1:
                $smois="Janvier";
                break;
            case 2:
                $smois="Février";
                break;
            case 3:
                $smois="Mars";
                break;
            case 4:
                $smois="Avril";
                break;
            case 5:
                $smois="Mai";
                break;
            case 6:
                $smois="Juin";
                break;
            case 7:
                $smois="Juillet";
                break;
            case 8:
                $smois="Août";
                break;
            case 9:
                $smois="Septembre";
                break;
            case 10:
                $smois="Octobre";
                break;
            case 11:
                $smois="Novembre";
                break;
            case 12:
                $smois="Décembre";
                break;
            default:
                $smois="Janvier";
                break;
        }
        $sdate=$jour." ".$smois." ".$annee;
        return $sdate;
    
        
    }
    
/**
*Fonction remplaçant une heure XX:XX:XX par XXhXXm
*
*Fonction utiliser lorsque l'on veut subsituer l'heure d'un format a un autre
*@param string $time heure
*/
    function ms_heure_clair($time){
        $stime= substr($time,0,2)."h".substr($time,3,2)."mn";
        return $stime;    
    
    
    }
/**
*Fonction affichant l'entête de la page cuiteur
*
*@param bool $form permet d'afficher ou non le formulaire de saisie
*/
    function ms_aff_entete($form ){
        echo
        '<div id="div1">',
            '<div id="bloc_en_tete">',
            '<a  id="bouton-deco" href="index.html" title="Se déconnecter de cuiteur">',
            '</a>',
            
            '<a id="home" href="index.html" title="Ma page d\'accueil">',
            '</a>',
            '<a id="cherche" href="index.html" title="Rechercher des personnes à suivre">',
            '</a>',
            '<a id="config" href="index.html" title="Modifier mes informations personnelles">',
            '</a>';
            if($form==true){
            echo 
            '<form id="form_saisie" action="" methode="get">',
                '<textarea></textarea>',
                '<imput type="submit" value="">',
                '</imput>',
                '<a id="trombonne" href="../html/index.html" title="Ajouter une pièce jointe">',
            '</a>',
            '</form>';        
            }
            if($form==false){
            echo '<h1>','Les blablas de pdac','</h1>';           
            }
             
            
             
           echo '</div>';

    }
    
    function ms_aff_infos(){
        echo
            '<div id="Bloc_infos_diverses">',
                '<p>',
                '<h3>Utilisateur</h3>',
                '<ul>',
                '<li><a id="fpiat" href="index.html"><img src="../images/fpiat.jpg" width="50" height="50" alt="fpiat">fpiat</a></li>
                <li><a href="index.html">100 blablas</a></li>
                <li><a href="index.html">123 abonnements</a></li>
                <li><a href="index.html">34 abonnés</a></li>
                </ul>
                </p>
                <p>
                <h3>Tendances</h3>
                <ul>
                <li><a href="index.html" title="Voir les messages" >#fac</a></li>
                <li><a href="index.html" title="Voir les messages" >#dernierfilm</a></li>
                <li><a href="index.html" title="Voir les messages" >#fairelafete</a></li>
                <li><a href="index.html" title="Voir les messages" >#boulot</a></li>
                </ul>
                </p>
                <p>
                <h3>Suggestions</h3>
                <ul>
                <li><a id="darkzv" href="index.html" title="Afficher les bio" ><img src="../images/darkzev.jpg" width="50" height="50" alt="fpiat">dark ze V</a></li>
                <li><a id="kdick" href="index.html" title="Afficher les bio" ><img src="../images/kdick.jpg" width="50" height="50" alt="fpiat">KdicK</a></li>
                </ul>
                </p>',
                
                
                
            '</div>';
    
    
    
    
    
    }






?>
