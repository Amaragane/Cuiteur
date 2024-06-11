<?php
    ob_start();
    require('php/bibli_generale.php');
    require('php/bibli_cuiteur.php');
    $bd=xx_bd_connect();
    ms_debut('Cuiteur | Index','styles/index.css');
    echo '<div id=div1>
		<div id=entete>
			
				<h2>Connectez-vous</h2>
				<p>Pour vous connecter à Cuiteur, il faut vous identifier :</p>
		</div>
		<img id=microphone src="images/micro.jpg" alt"micro">
		<div id=formulaire>';
		
    (count($_POST)!=3) ?msl_aff_formindex() : msl_check_identifiant($bd);
	echo
		
		'<p>Pas encore de compte ? <a href="php/inscription.php">Inscriver-vous</a> sans plus tarder !</br></br>
		Vous hésitez à vous inscrire ? Laissez-vous séduire par une </br><a href="html/presentation.html">présentation</a> des possibilités de Cuiteur.</p>';
	
	
	echo '
	</div>
	<div id="Bloc_pied_de_page">
            <p><a href="index.php">A propos</a>
            <a href="index.php">Publicité</a>
            <a href="index.php">Patati</a>
            <a href="index.php">Aide</a>
            <a href="index.php">Patata</a>
            <a href="index.php">Stages</a>
            <a href="index.php">Emplois</a>
            <a href="index.php">Confidentialité</a>
            
            
            
            
            </div>
		</div>';
	ms_fin();
	
/**
*
*
*
*
**/
    function msl_aff_formindex(){
		
		echo '<form method="POST" action="index.php">
			<table>';
	if(count($_POST)>0)
	{
					echo '<h3>Identifiant ou mot de passe incorrect !</h3>';
                    if($_POST['txtPseudo']!=NULL)
                    {
						$var=ms_html_table_ligne('Pseudo',ms_html_form_input('text','txtPseudo',$_POST['txtPseudo'],0));
						echo $var;
					}
					else
					{
						echo 
							'<tr>
								<td><label>Pseudo</label></td>
								<td><input type="text" name="txtPseudo"/></td>
							</tr>';
					}
	}
                    else
                    {
                    echo '<tr>
                        <td><label>Pseudo</label></td>
                        <td><input type="text" name="txtPseudo"/></td>
                    </tr>';
                    }
			echo 
				'<tr>
					<td><label>Mot de passe</label></td>
					<td><input type="password" name="txtPasse"/></td>
				</tr>
			
				<tr>
					<td><label></label></td>
					<td><input type="submit" name="btnValider" id="btnValider" value="Connexion"/></td>
				</tr>
			</table>
		</form>';
     
	}
/**
*Fonction verifiant le mot de passe entre par l'utilisateur
*
*@param BD $bd
**/
	function msl_check_identifiant($bd){
	
	$pseudo=$pseudo=mysqli_real_escape_string($bd,$_POST['txtPseudo']);
	$sql=
            "SELECT usID , usPasse
            FROM users
            WHERE usPseudo='$pseudo'";

	$res=mysqli_query($bd , $sql) OR xx_bd_erreur($bd,$sql);
	if(mysqli_num_rows($res)>0)
	{	
		$T=mysqli_fetch_assoc($res);

		if(password_verify($_POST['txtPasse'],$T['usPasse']))
		{
		
		
			session_start();
			
			$_SESSION['id']=$T['usID'];
			header ('location: php/cuiteur.php');
			exit();
		}
		else
		{
		msl_aff_formindex();
		return false;
		}
		
	}
	else
	{
	msl_aff_formindex();
	return false;
	}
	}
	
?>
