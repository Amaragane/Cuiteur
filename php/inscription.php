<?php
        ob_start();
        require('bibli_generale.php');
        require('bibli_cuiteur.php');
        
        
        ms_debut('Cuiteur | Inscription','');
         
         if(count($_POST)==0){
         echo '<h1>Réception du formulaire</br>Inscription utilisateur</h1>';
         msl_aff_formvide();
         }
         else{
            echo '<h1>Réception du formulaire</br>Inscription utilisateur</h1>';
            $array=msl_new_users($_POST);
            if(count($array)>0){
                echo '<p><strong>Les erreur suivantes on été détectées</strong></p></br>';
                foreach($array as $value){
                echo $value;
                
                
                }
                msl_aff_formnonvide();
            }
            else
            {
            
            header ('location: protegee.php');
            exit();
            }

        }
        
        ms_fin();



        
        
        
        
        
        
        
/**
*Fonction testant la validiter des saisie utilisateur dans la page d'inscription
*
*@param tableau $tab $_POST de la page insciption.php
**/   
    function msl_new_users($tab){

        $array=[];
        if(mb_strlen($tab['txtPseudo'],'UTF-8')<4 || mb_strlen($tab['txtPseudo'],'UTF-8')>30){
            array_push($array,'Le pseudo doit avoir de 4 à 30 caractères alphanumériques</br>');
        }
        
        if(mb_strlen($tab['txtPasse'])<6 ){
            array_push($array,'Le mot de passe doit avoir au moins 6 caractères</br>');        
        }
        else if($tab['txtPasse'] ==null){
            array_push($array,'Le mot de passe est obligatoire </br>');                
        }
        if($tab['txtVerif']!=$tab['txtVerif']){
            array_push($array,'Le mot de passe est différent dans les 2 zones</br>');
        
        }
        
        
        
        if($tab['txtNom']==null ){
            array_push($array,'Le nom est obligatoire</br>');
        }
        else if(htmlentities($tab['txtNom'])!=$tab['txtNom']){
            array_push($array,'Le nom ne doit pas contenir de tags HTML</br>');
        }
        
        
        
        
        if($tab['txtMail']==null  ){
            array_push($array,' L\'adresse mail est obligatoire</br>');
        }
        else if(mb_strpos($tab['txtMail'],'.')==false || mb_substr_count($tab['txtMail'],"@")==false || mb_substr_count($tab['txtMail'],"@")>1){
            array_push($array,'L\'adresse mail n\'est pas valide</br>');
        }
        
        if(!checkdate((int)$tab['selNais_m'],(int)$tab['selNais_j'],(int)$tab['selNais_a'])){
            array_push($array,'La date de naissance n\'est pas valide</br>');       
        }
        if(count($array)>0){
            return $array;
        }

        $bd=xx_bd_connect();
        $pseudo=mysqli_real_escape_string($bd,$tab['txtPseudo']);
        $mail=mysqli_real_escape_string($bd,$_POST['txtMail']);
        $nom=mysqli_real_escape_string($bd,$_POST['txtNom']);
        $passe=mysqli_real_escape_string($bd,$_POST['txtPasse']);
        $passe=password_hash($passe,PASSWORD_DEFAULT);
        $naiss=mysqli_real_escape_string($bd,$_POST['selNais_a'].$_POST['selNais_m'].$_POST['selNais_j']);
        $insc=mysqli_real_escape_string($bd,date('Y').date('m').date('d'));
        
        $sql=
            "SELECT count(usPseudo)
            FROM users
            WHERE usPseudo='$pseudo'";
        $res=mysqli_query($bd , $sql) OR xx_bd_erreur($bd,$sql);
        $T=mysqli_fetch_assoc($res);
        if($T['count(usPseudo)']>0){
            array_push($array,'Le Pseudo doit être changé');
            return $array;
        }
        $sql="INSERT INTO users (usNom,usVille, usWeb,usMail, usPseudo, usPasse,usBio, usDateNaissance, usDateInscription) VALUES
        ('$nom','none', 'none','$mail', '$pseudo', '$passe','none', '$naiss', '$insc')";
    
        $res=mysqli_query($bd , $sql) OR xx_bd_erreur($bd,$sql);
        $id=mysqli_insert_id($bd);
        session_start();
        $_SESSION['id']=$id;
        $_SESSION['pseudo']=$pseudo;
        return $array;
        }
        
        
        function msl_aff_formvide(){
        
        echo 
        '<!DOCTYPE html>',
           ' <html lang="fr">',
                '<head>',
                    '<title>Cuiteur | Inscription</title>',
                    '<link rel="stylesheet" type="text/css" href=>
                    <meta charset="UTF-8">',
                    '<style>table{
                            border-collapse: collapse;
                        }
                        td{
                            border: 1px solid black;
                            padding: 4px 10px;
                        }
                        </style>',
                '</head>
            <body> 
            <form method="POST" action="inscription.php">
                <table><tr>
                        <td><label>Choisir un Pseudo</label></td>
                        <td><input type="text" name="txtPseudo"/></td>
                    </tr><tr>
                        <td><label>Choisir un mot de passe</label></td>
                        <td><input type="password" name="txtPasse"/></td>
                        </tr>
                        <tr>
                            <td><label>Répéter le mot de passe</label></td>
                            <td><input type="password" name="txtVerif"/></td>
                        </tr>
                        <tr><tr>
                        <td><label>Indiquer votre nom</label></td>
                        <td><input type="text" name="txtNom"/></td>
                        </tr><tr>
                        <td><label>Donner un adresse mail</label></td>
                        <td><input type="text" name="txtMail"/></td>
                        </tr><tr>
         <td><label>Votre date de naissance</label></td>
         <td><select name=selNais_j ><option value=01>01</option><option value=02>02</option><option value=03>03</option><option value=04>04</option><option value=05>05</option><option value=06>06</option><option value=07>07</option><option value=08>08</option><option value=09>09</option><option value=10>10</option><option value=11>11</option><option value=12>12</option><option value=13>13</option><option value=14>14</option><option value=15>15</option><option value=16>16</option><option value=17>17</option><option value=18>18</option><option value=19>19</option><option value=20>20</option><option value=21>21</option><option value=22>22</option><option value=23>23</option><option value=24>24</option><option value=25>25</option><option value=26>26</option><option value=27>27</option><option value=28>28</option><option value=29>29</option><option value=30>30</option><option value=31>31</option>
         </select><select name=selNais_m><option value="01">01</option>
                                                                <option value="02">02</option>
                                                                <option value="03">03</option>
                                                                <option value="04">04</option>
                                                                <option value="05">05</option>
                                                                <option value="06">06</option>
                                                                <option value="07">07</option>
                                                                <option value="08">08</option>
                                                                <option value="09">09</option>
                                                                <option value="10">10</option>
                                                                <option value="11">11</option>
                                                                <option value="12">12</option>
                                                                
                </select><select name=selNais_a><option value=2019>2019</option><option value=2018>2018</option><option value=2017>2017</option><option value=2016>2016</option><option value=2015>2015</option><option value=2014>2014</option><option value=2013>2013</option><option value=2012>2012</option><option value=2011>2011</option><option value=2010>2010</option><option value=2009>2009</option><option value=2008>2008</option><option value=2007>2007</option><option value=2006>2006</option><option value=2005>2005</option><option value=2004>2004</option><option value=2003>2003</option><option value=2002>2002</option><option value=2001>2001</option><option value=2000>2000</option><option value=1999>1999</option><option value=1998>1998</option><option value=1997>1997</option><option value=1996>1996</option><option value=1995>1995</option><option value=1994>1994</option><option value=1993>1993</option><option value=1992>1992</option><option value=1991>1991</option><option value=1990>1990</option><option value=1989>1989</option><option value=1988>1988</option><option value=1987>1987</option><option value=1986>1986</option><option value=1985>1985</option><option value=1984>1984</option><option value=1983>1983</option><option value=1982>1982</option><option value=1981>1981</option><option value=1980>1980</option><option value=1979>1979</option><option value=1978>1978</option><option value=1977>1977</option><option value=1976>1976</option><option value=1975>1975</option><option value=1974>1974</option><option value=1973>1973</option><option value=1972>1972</option><option value=1971>1971</option><option value=1970>1970</option></select>
                </td>
            </tr><tr>
                            <td><label></label></td>
                            <td><input type="submit" name="btnValider" id="btnValider" value="Je m\'inscris"/></td>
                        </tr>
                    
                    </table>
                    </form>';
                }
        function msl_aff_formnonvide(){
        echo 
        '<!DOCTYPE html>
           <html lang="fr">
                <head>
                    <title>Cuiteur | Inscription</title>
                    <link rel="stylesheet" type="text/css" href=>
                    <meta charset="UTF-8">
                    <style>table{
                            border-collapse: collapse;
                        }
                        td{
                            border: 1px solid black;
                            padding: 4px 10px;
                        }
                        </style>
                </head>
            <body> 
            <form method="POST" action="inscription.php">
                <table>';
                    if($_POST['txtPseudo']!=NULL)
                    {
                    $var=ms_html_table_ligne('Choisir un Pseudo',ms_html_form_input('text','txtPseudo',$_POST['txtPseudo'],0));
                    echo $var;
                    }
                    else
                    {
                    echo '<tr>
                        <td><label>Choisir un Pseudo</label></td>
                        <td><input type="text" name="txtPseudo"/></td>
                    </tr>';
                    }
                    echo 
                        '<tr>
                        <td><label>Choisir un mot de passe</label></td>
                        <td><input type="password" name="txtPasse"/></td>
                        </tr>
                        <tr>
                            <td><label>Répéter le mot de passe</label></td>
                            <td><input type="password" name="txtVerif"/></td>
                        </tr>
                        <tr>';
                    if($_POST['txtNom']!=Null)
                    {
                    $var=ms_html_table_ligne('Indiquer votre nom',ms_html_form_input('text','txtNom',$_POST['txtNom'],0));
                    echo $var;
                    }
                    else
                    {
                    echo
                        '<tr>
                        <td><label>Indiquer votre nom</label></td>
                        <td><input type="text" name="txtNom"/></td>
                        </tr>';
                    }
                    if($_POST['txtMail']!=Null)
                    {
                    $var=ms_html_table_ligne('Donner une adresse mail',ms_html_form_input('text','txtMail',$_POST['txtMail'],0));
                    echo $var;
                    }
                    else
                    {
                    echo
                        '<tr>
                        <td><label>Donner un adresse mail</label></td>
                        <td><input type="text" name="txtMail"/></td>
                        </tr>';
                    }
                    $var=ms_html_form_date('selNais',50,$_POST['selNais_j'],$_POST['selNais_m'],$_POST['selNais_a']);
                    echo $var,
                        '<tr>
                            <td><label></label></td>
                            <td><input type="submit" name="btnValider" id="btnValider" value="Je m\'inscris"/></td>
                        </tr>
                    
                    </table>
                    </form>';
                    
                    
        
        
        }
        
        
        
        
?>
