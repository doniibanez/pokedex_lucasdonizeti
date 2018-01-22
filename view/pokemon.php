<?php
require "../lib/PokeApi.php";
// require "../includes/init.php";

if(isset($_GET['url'])){
// API
$api = new PokeApi;

$pokemon = $api->sendRequest($_GET['url']);

// echo "<img src=\"".$pokemon->sprites->front_default."\" alt=\"Pokemon Front Sprite\"/>";
// echo "</br>";
//
// echo "name: ".$pokemon->name."</br>";
//
// // Pokemons Stats
// foreach ($pokemon->stats as $ps) {
//   // var_dump($ps);
//    echo $ps->stat->name.":".$ps->base_stat."</br>";
// }
//
// // base exp
// echo "base exp: ".$pokemon->base_experience."</br>";
// // weight
// echo "weight: ".$pokemon->weight."</br>";
//
// // Pokemons Abilities
// echo "Abilites: </br>";
// foreach ($pokemon->abilities as $ab) {
//   // var_dump($ab->ability->name);
//    echo $ab->ability->name."</br>";
// }
//   // Pokemons moves
//   echo "Moves: </br>";
//   foreach ($pokemon->moves as $mv) {
//     // var_dump($ab->ability->name);
//      echo $mv->move->name."</br>";
//    }
//   // types
//   echo "Types: </br>";
//   foreach ($pokemon->types as $t) {
//     // var_dump($ab->ability->name);
//      echo $t->type->name."</br>";
//    }
//    echo "Height:".$pokemon->height."</br>";
}else{ // redirect if there is no get parameter
header('Location: '.SITE_URL.'/'.SITE_FOLDER);
}
?>

<html>
<?php include '../includes/header.php';?>

  <body>
    <!-- HEADER -->
    <?php include '../includes/pokedex-header.php';?>

    <script type = "text/javascript">
      $(document).ready(function(){
        setTimeout('$("#preload").fadeOut(100)', 1500);
      });
    </script>

    <div id="preload" class="preload"></div>

    <div class = "content" style="padding: 0 3%">
      <img src="<?php echo $pokemon->sprites->front_default?>" alt="Pokemon Sprite"/>
      <div>
        <h1><?php echo $pokemon->name?></h1>
      </div>

      <!-- INFOS POKE -->
      <div>
        <ul>
          <li><?php echo "Height: ".$pokemon->height."m"?></li>
          <li><?php echo "Weight: ".$pokemon->weight."kg"?></li>
          <li><?php echo "Base EXP.: ".$pokemon->base_experience."xp"?></li>
        </ul>
      </div>

      <!-- TYPES -->
      <div class="pure-control-group">
        <h4>Types</h4>
        <ul id = "list-types">
          <?php
              foreach ($pokemon->types as $t) {
                 echo "<li>".$t->type->name."</li>";
               }
          ?>
        </ul>

      </div>

        <div>
          <!-- STATS -->
          <h4>Stats</h4>
          <ul>
            <?php
              foreach ($pokemon->stats as $ps) {
                echo "<li><p>".$ps->stat->name.":".$ps->base_stat."</p></li>";
              }
            ?>
          </ul>
        </div>

      <!-- Pokemons Abilities -->
      <div>
        <h4>Abilities</h4>
        <ul>
          <?php
            foreach ($pokemon->abilities as $ab) {
              echo "<li><p>".$ab->ability->name."</p></li>";
            }
          ?>
        </ul>
      </div>

      <!-- Pokemons moves -->
      <div>
        <h4>Moves</h4>
        <div class = "div-scroll">
          <ul>
            <?php
              foreach ($pokemon->moves as $mv) {
                echo "<li><p>".$mv->move->name."</p></li>";
              }
            ?>
          </ul>
        </div>

      </div>
      <a href="../index.php">Back to home</a>
    </div>
    <?php include '../includes/footer.php';?>
  </body>
</html>
