<?php
require "../controller/pokemon-controller.php";

if(isset($_GET['offset'])){
  $offset = $_GET['offset'];

  $pokemons = orderPokemonsPerATK(loadPokemonsPerPage($offset));
  $numPokemons = 6; //Number of best pokemons

  $bestPokemons = array();
  for ($i = 0; $i < $numPokemons; $i++) {
      array_push($bestPokemons, $pokemons[$i]);

  }
  //Stats of selected pokémons
  $sumStats = sumStats($bestPokemons);
}else{ // redirect if there is no get parameter
  header('Location: '.SITE_URL.'/'.SITE_FOLDER);
}
?>

<html>
  <?php include '../includes/header.php';?>
  <body>
    <script type = "text/javascript">
      $(document).ready(function(){
        setTimeout('$("#preload").fadeOut(100)', 1500);

       });
    </script>
    <div id="preload" class="preload"></div>
    <?php include '../includes/pokedex-header.php';?>
    <div class = "content">
      <h1 style="margin: 0">Pokebag</h1>

      <div class= "description-container description-container-pokebag">
        <span>These are the six best pokémons of the ten loaded by pokedex page.</span>
      </div>
      <!-- Best Pokemons -->
      <div>
        <table>
          <tr>
            <?php
                for ($i = 0; $i < 3; $i++) {
                  echo "<td>";
                    echo "<img src = '".$pokemons[$i]->image."'>";
                    echo "<p class = 'text-content'>".$bestPokemons[$i]->name."</p>";
                    echo "<span class = 'text-content'>".$bestPokemons[$i]->weight."kg </span>";
                    echo "<span class = 'text-content'>".$bestPokemons[$i]->base_experience."xp</span>";
                  echo "</td>";
                }
            ?>
          </tr>
          <tr>
            <?php
              for ($i = 3; $i < 6; $i++) {
                echo "<td>";
                  echo "<img src = '".$pokemons[$i]->image."'>";
                  echo "<p class = 'text-content'>".$bestPokemons[$i]->name."</p>";
                  echo "<span class = 'text-content'>".$bestPokemons[$i]->weight."kg </span>";
                  echo "<span class = 'text-content'>".$bestPokemons[$i]->base_experience."xp</span>";
                echo "</td>";
              }
             ?>
          </tr>
        </table>
      </div>

      <!-- Sum of Pokemons Stats -->
      <div class = "container-sum-stats">
        <h4>Pokemons Stats (Sum)</h4>
        <p>Speed: <?php echo $sumStats->speed?></p>
        <p>Special Defense: <?php echo $sumStats->special_defense?></p>
        <p>Special Attack: <?php echo $sumStats->special_attack?></p>
        <p>Defense: <?php echo $sumStats->defense?></p>
        <p>Attack: <?php echo $sumStats->attack?></p>
        <p>HP: <?php echo $sumStats->hp?></p>
      </div>

      <a href="<?php echo SITE_URL.'/'.SITE_FOLDER?>">Back to home</a>
    </div>

    <?php include '../includes/footer.php';?>
  </body>
</html>
