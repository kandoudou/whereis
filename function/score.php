		<form name="inscription" method="post" action="score.php"> </br>
           Nom: <input type="text" name="nom"/>
		   <input type="text" name="chronotime" id="chronotime" value="0:00:00:00"/>
			<input type="submit" name="valider" value="Valider">
</form>



<form name="chronoForm">
  <input type="text" name="chronotime" id="chronotime" value="0:00:00:00"/>
    <input type="button" name="startstop" value="start!" onClick="chronoStart()" />
    <input type="button" name="reset" value="reset!" onClick="chronoReset()" />
</form>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="../js/counter.js"></script>
		<script>
var startTime = 0
var start = 0
var end = 0
var diff = 0
var timerID = 0
window.onload = chronoStart;
function chrono(){
	end = new Date()
	diff = end - start
	diff = new Date(diff)
	var msec = diff.getMilliseconds()
	var sec = diff.getSeconds()
	var min = diff.getMinutes()
	var hr = diff.getHours()-1
	if (min < 10){
		min = "0" + min
	}
	if (sec < 10){
		sec = "0" + sec
	}
	if(msec < 10){
		msec = "00" +msec
	}
	else if(msec < 100){
		msec = "0" +msec
	}
	document.getElementById("chronotime").value = hr + ":" + min + ":" + sec + ":" + msec
	timerID = setTimeout("chrono()", 10)
}
function chronoStart(){
	document.chronoForm.startstop.value = "stop!"
	document.chronoForm.startstop.onclick = chronoStop
	document.chronoForm.reset.onclick = chronoReset
	start = new Date()
	chrono()
}
function chronoContinue(){
	document.chronoForm.startstop.value = "stop!"
	document.chronoForm.startstop.onclick = chronoStop
	document.chronoForm.reset.onclick = chronoReset
	start = new Date()-diff
	start = new Date(start)
	chrono()
}
function chronoReset(){
	document.getElementById("chronotime").value = "0:00:00:000"
	start = new Date()
}
function chronoStopReset(){
	document.getElementById("chronotime").value = "0:00:00:000"
	document.chronoForm.startstop.onclick = chronoStart
}
function chronoStop(){
	document.chronoForm.startstop.value = "start!"
	document.chronoForm.startstop.onclick = chronoContinue
	document.chronoForm.reset.onclick = chronoStopReset
	clearTimeout(timerID)
}
</script>

	 
		<?php
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=whereis', 'root', '');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

$resultats=$bdd->query("SELECT * FROM Scores ORDER by score DESC");
$resultats->setFetchMode(PDO::FETCH_OBJ);
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

 echo '<table><tr><th>#</th><th>Nom</th><th>score</th><th>Date</th></tr>';
$count = 0;
while( $resultat = $resultats->fetch() )
{
		$count = $count +1;
        echo '	<tr>
					<td>'.$count.'</td>
					<td>'.$resultat->name.'</td>
					<td>'.$resultat->score.'</td>
					<td>'.$resultat->ts.'</td>
				</tr>';
}
$resultats->closeCursor();

echo "</table>
        </div>
            </div>";
			
			
			
			
if (isset ($_POST['valider'])){
                $nom=$_POST['nom'];
                $prenom=$_POST['chronotime'];
                $bdd->exec("INSERT INTO Scores(name,score,ts) VALUES('$nom','$prenom',CURRENT_TIMESTAMP)");
            }
			

?>


