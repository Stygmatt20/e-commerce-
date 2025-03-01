<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" http-equiv="refresh">
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<link rel="stylesheet" type="text/css" href="css/accueil.css">
	<title>MBOA SHOP Online: <?php echo nom_boutique(); ?> </title>
</head> 
<body>
 
	<?php require 'header.php' ?>

	<section class="section">

		<h2> <?php	echo nom_boutique(); ?>
		</h2>

			<form method="post" action="index.php?un=boutique#liens" id="liens">
				<label>Couleur</label>
				<select name="c_couleur">
					<option value="">Aucun choix</option>
				<?php foreach (get_carac_couleur() as $elemente) { 
								if (!empty($_SESSION['c_couleur']) AND $_SESSION['c_couleur'] == $elemente) { $var = "selected"; }else{ $var = ""; }
								echo '<option value="'.$elemente.'" '.$var.' required>'.$elemente.'</option>';
							} ?>
				</select>
				<label>Taille</label>
				<select name="c_taille">
					<option value="">Aucun choix</option>
				<?php foreach (get_carac_taille() as $elemente) {
								if (!empty($_SESSION['c_taille']) AND $_SESSION['c_taille'] == $elemente) { $var = "selected"; }else{ $var = ""; }
								echo '<option value="'.$elemente.'" '.$var.' required>'.$elemente.'</option>';
							} ?>
				</select>
				<label>Type</label>
				<select name="c_type">
					<option value="">Aucun choix</option>
				<?php foreach (get_carac_type() as $elemente) {
								if (!empty($_SESSION['c_type']) AND $_SESSION['c_type'] == $elemente) { $var = "selected"; }else{ $var = ""; }
								echo '<option value="'.$elemente.'" '.$var.' required>'.$elemente.'</option>';
							} ?>
				</select>
				<label>Genre</label>
				<select name="genre">
					<option value="">Aucun choix</option>
				<?php foreach (get_carac_genre() as $elemente) {
								if (!empty($_SESSION['genre']) AND $_SESSION['genre'] == $elemente) { $var = "selected"; }else{ $var = ""; }
								echo '<option value="'.$elemente.'" '.$var.' required>'.$elemente.'</option>';
							} ?>
				</select>
				<label>Prix</label>
				<?php if (!empty($_SESSION['c_prix'])) { $var = $_SESSION['c_prix']; }else{ $var = NULL; }	 ?>
				<input type="number" name="c_prix" <?php echo'value="'.$var.'"' ?>  >
				<label>FRS</label>
				<input type="submit" value="Rechercher">
			</form>
	
		<article class="service">

			<?PHP while ($donne = $articles->fetch()) { ?>
				
			<aside class="colum">
				<img <?php echo 'src="'.$donne['image'].'"'; ?> <?php echo 'title="'.$donne['nom'].'"'; ?> >
					
					<h4><?php echo $donne['nom']; ?></h4>
		
					<form method="post" <?php echo 'action="index.php?un=article"'; ?> >
						<input type="hidden" name="id_article" <?php echo 'value="'.$donne['id'].'"'; ?> >
						<input type="hidden" name="article" <?php echo 'value="'.$donne['nom'].'"'; ?> >
						<div>
							<?php $like = !empty($_SESSION['id']) ? verify_like($_SESSION['id'],$donne['id']) : NULL;
							
							 if(!$like){ 
							 	echo'<a href="index.php?un=boutique&id_like='.$donne['id'].'#liens" class="like"><img src="image/like.png" >'.$donne['likes'].'</a>' ; 
							 }else{ 
							 	echo'<a href="index.php?un=boutique&id_dislike='.$donne['id'].'#liens" class="like"><img src="image/likerouge.jpg" >'.$donne['likes'].'</a>' ;
							 } ?>
							<input type="submit" value="Plus" class="liens" >

							<div> 
							<?php if ( get_solde($donne['id']) > 0 ) {
							$prix = $donne['prix'] - ( $donne['prix']*get_solde($donne['id']) ) ;

							 echo '<span class="line">'.$donne['prix'].' FRS</span>';
							 echo $prix.' FRS' ; 
						}else{ echo $donne['prix'].' FRS'; } ?> 
							</div>

						</div>
					</form>
				
			</aside>

			<?PHP } $articles->closeCursor(); ?>

		</article>

		<div class="pagination">

		<?php   for ($i=1; $i <= $pageTotales ; $i++) { 
				
					if ($i == $pageCourante) {
						echo $i;						
					}else{
						echo '<button><a href="index.php?un=boutique&page='.$i.'#liens" class="page"> '.$i.' </a></button>   ';
					}
				}
		?> </div>

	</section>

	<?php require 'navigation.php'; ?>

	<?php require 'footer.php'; ?>

</body> 
</html>