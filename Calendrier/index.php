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
        <h1>dkbnwckb</h1>
      </header>
      <section>
        <img src="rsc/Image/Calendrier.png" alt="Calendrier" id="fond">
				<?php for($i=1;$i<=24;$i++) {
					echo "<img src=\"rsc/Image/Cases/case{$i}.png\" alt=\"case{$i}\" id=\"case{$i}\">";
				}
				?>
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
					if (isset($_REQUEST["jour"]))	$jourA = $_REQUEST["jour"];
					else $jourA=-1;
					echo "<thead><tr>";
					$nbJ = cal_days_in_month(CAL_GREGORIAN, 12, 2017); // récuparation du nombre de jour dans le mois;
					$Jour = date("w",mktime(0,0,0,12,1,2017)); // récuparation du jour a la quelle le mois commence
					$tab_jours = array("Lu","Ma","Me","Je","Ve","Sa","Di"); // tableau de jour
					if($mois==date("m"))$jourA = date("j"); // récuparation du Jour actuel
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
