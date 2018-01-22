<?php
  require "./lib/PokeApi.php";
  require "./controller/pokemon-controller.php";
  $api = new PokeApi;

  // GETS
  $offset = isset($_GET['offset'])? $_GET['offset'] : null;
  $limit = 10;

  if (isset($_GET['filter_name'])) {
    $list = new StdClass();
    $results = array();

    $poke_api = $api->pokemon($_GET['filter_name']);

    $result = new StdClass();
    $result->name = $poke_api->name;
    $result->url = 'https://pokeapi.co/api/v2/pokemon/'.$_GET['filter_name'];

    array_push($results, $result);
    $list->results = $results;
  }
    else
       $list = $api->resourceList("pokemon", $limit, $offset);
?>
<html>
  <?php include 'includes/header.php';?>

  <body>
    <script type = "text/javascript">
      $(document).ready(function(){
        setTimeout('$("#preload").fadeOut(100)', 1500);
      });
    </script>

    <div id="preload" class="preload"></div>
    <!-- HEADER -->
    <header>
      <div>
        <img class = "pure-img img-banner" src="/pokedex_lucasdonizeti/res/template/pokedex_banner.png" alt = "Pokedex Banner"/>
      </div>

      <!-- <div id = "pokedex-header"/> -->
      <div>
        <img id = "pokedex-header" src="/pokedex_lucasdonizeti/res/template/pokedex_header.png" alt = "Pokedex Header"/>
      </div>
    </header>
    <!-- END HEADER -->
    <form method="get" action="index.php" class="pure-form">
      <div class = "content content-index">
        <!-- FILTERS -->
        <div class="pure-g">
          <div class="pure-u-1 pure-u-md-1-3">
            <label class = "">Name:</label>
            <input class = "pure-input-1-2" type="text" name="filter_name" onkeyup="return forceLower(this);"/>
            <button class = "pure-button pure-button-primary" type="submit">Filter it</button>
          </div>

        </div>

        <div class = "description-container description-index">
            <small style="color: red"> Click the Pokéball to see details of the Pokémon.</small>
        </div>

        <table class = "poke-table">
          <?php
            foreach ($list->results as $result) {
              $name = $result->name;
              $url = $result->url;

              echo "<tr>";
                echo "<td><p class = 'text-content'>$name</p></td>";
                  echo "<td><div class ='tooltip'><a href = 'view/pokemon.php?url=$url'><img src = 'res/template/icon-pokeball.png'/><span class='tooltiptext'>Click here for more information about the pokemon!</span></a></div></td>";
              echo "<tr>";
            }
           ?>
        </table>
        <?php
          //Buttons previous and next for pagination
          if(!isset($_GET['filter_name'])){
            if($list->next != null){
              echo "<a href=?".after('?', $list->next)."><img class = 'pure-img' src = 'res/template/next-page.png' alt = 'next-page'/></a>";
            }
            if($list->previous != null){
              echo "<a href=?".after('?', $list->previous)."><img class = 'pure-img' src = 'res/template/previous-page.png' alt = 'previous-page'/></a>";
            }
          }
        ?>
        <div class = "tooltip">
            <a href="view/pokebag.php/?offset=<?php echo $offset?>"><img src="res/template/open-pokebag.png" alt = "Open Pokebag!"><span class='tooltiptext'>Click here to see the six best pokemons on this page!</span></a>
        </div>
    </div>
    <?php include 'includes/footer.php';?>

  </body>
</html>
