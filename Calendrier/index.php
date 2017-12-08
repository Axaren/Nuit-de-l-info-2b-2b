<!DOCTYPE HTML>
<html>
	<head>
		<title>Calendrier - 2b||!2b</title>
    <meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="rsc/CSS/MainCss.css" />
		<script src="rsc/js/MainJS.js"></script>
	</head>
	<style media="screen">
	<?php for($i=1;$i<=24;$i++) {echo "#case{$i}{position: absolute;
	visibility: 1000;}";} ?>


	#fond{
		position: relative;
		left:10px;
	}
		<?php

		 ?>
	</style>
	<body>
    <div id="Page">
      <header>
      	<p><img src="rsc/Image/Ubisoft.png" alt="Ubisoft"></p>
        <h1>Calendrier de l'Avent</h1>
      </header>
      <section>
        <img src="rsc/Image/Calendrier.png" alt="Calendrier" id="fond">
				<?php
				$jourA;
				if (isset($_REQUEST["jour"]))	$jourA = $_REQUEST["jour"];
				else $jourA=date("j");
				for($i=1;$i<=24;$i++) {
					if ($i<=$jourA) echo "<img src=\"rsc/Image/Cases/case{$i}.png\" alt=\"case{$i}\" id=\"case{$i}\" onclick=\"gestionImage({$i},{$jourA});\">";
					else echo "<img src=\"rsc/Image/Cases/case{$i}Cache.png\" alt=\"case{$i}\" id=\"case{$i}\" onclick=\"gestionImageFausse({$i},{$jourA});\">";
				}
				?>
				<script type="text/javascript">
					function gestionImage(id,jour){
							var tab=["Vous avez obtenue [Far Cry 4]","Vous avez obtenue [Trival Pursuit]","Vous avez obtenue [Monopoly Plus]","Vous avez obtenue [Risk]","Vous avez obtenue [Drive Speedboat]","Vous avez obtenue [Tetris Ultimate]","Vous avez obtenue [Scrabble]","Vous avez obtenue [Rabbids Invasion]", "Vous avez obtenue [Just Dance 2017]", "Vous avez obtenue [Rainbow Six]","Vous avez obtenue [Assassin's Creed Identity]", "Vous avez obtenue [Far cry: Primal]","Vous avez obtenue [Assassin's Creed: Unity]", "Vous avez obtenue [The Division]", "Vous avez obtenue [Trackmania Turbo]\nLa vitesse c'est cool, mais la vie, c'est mieux", "Vous avez obtenue [Anno 2025]", "Vous avez obtenue [Grow Up]", "Vous avez obtenue [Just Dance 2016]", "Vous avez obtenue [Watch Dogs 2]", "Vous avez obtenue [Steep]", "Vous avez obtenue [For Honnor]", "Vous avez obtenue [Ghost Recon:WildLands]", "Vous avez obtenue [Mario + Rabbids Kingdom]\nUne tortue, un enfant sur la route, l'enjeux est le même : l'éviter!", "Vous avez obtenue [Assassin's creed origins]"];
							alert(tab[id-1]);
					}
					function gestionImageFausse(id,jour){
						var j = id-jour;
						alert("                 cela est disponible dans "+j+" jour.\nRevenez plus tard pour découvrir votre récompence");
					}
				</script>
      </section>
			<footer>
			<form method="post" action="index.php">
				<p>
					<select name="tests" id="test">
						<option value="test">Test</option>
						<option value="pastest">Pas de test</option>
					</select>
					<input type="submit" value="Envoyer" />
				</p>
			</form>

			<?php
			if (isset($_REQUEST["tests"])) {
				if ($_REQUEST["tests"] === "test") {
					echo "<div class=\"body\"><div class=\"container\"><div class=\"calendar-container\"><header><div class=\"day\">Décembre</div><div class=\"month\">2017</div></header>";
					echo "<table class=\"calendar\">";
					echo "<thead><tr>";
					$nbJ = cal_days_in_month(CAL_GREGORIAN, 12, 2017); // récuparation du nombre de jour dans le mois;
					$Jour = date("w",mktime(0,0,0,12,1,2017)); // récuparation du jour a la quelle le mois commence
					$tab_jours = array("Lu","Ma","Me","Je","Ve","Sa","Di"); // tableau de jour
					if ($Jour==0)$Jour=7; // pour le dimanche
					$var=0;
					$jours=$Jour+$nbJ;// nombre de jour afficher au min
					$bool=false;
					if ($Jour!=1)
					{
						$var = cal_days_in_month(CAL_GREGORIAN, 11, 2017)-$Jour+1;// récupération des jour du mois prècédent
					}
					for ($i=0;$i<sizeof($tab_jours);$i++) // affichage du tableau de jour
					{
						echo "<td>";
						echo $tab_jours[$i];
						echo "</td>";
					}
					// affichage du calendrier
					echo "</tr></thead><tbody>";
					while ($jours>=0){
						echo "<tr>";
						for ($j=1;$j<=7;$j++)
						{
							if ($jours==1 || $Jour==1){
								$var=0;
								$bool=!$bool;
							}
							if ($bool){
								$var=$var+1;
								if ($var==$jourA) {
									echo "<td class=\"current-day\">";
								}else {
									echo "<td>";
									}
									$date = $var;
									echo "<a href=\"?jour={$date}&test=test\" ><span>".$var."</span></a>";
								}else {
									echo "<td>";
									}

									echo "</td>";
									$Jour=$Jour-1;
									$jours=$jours-1;
								}
								echo "</tr>";
							}
							echo "</tbody></table>";
						}
					}
					?>
				</div> <!-- end calendar-container -->

</div> <!-- end container -->
</div>
				<?php include("rsc/elements_pages/footer.html");?>
      </footer>
    </div>
  </body>
</html>
