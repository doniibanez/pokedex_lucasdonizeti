<?php
  require "./lib/PokeApi.php";
  require "./controller/pokemon-controller.php";
  $api = new PokeApi;

  // GETS
  $offset = isset($_GET['offset'])? $_GET['offset'] : null;
  $limit = isset($_GET['limit'])? $_GET['limit'] : null;

  // echo $limit."</br>";
  // echo $offset."</br>";

  // $pokemon = $api->pokemon('1');
  $list = $api->resourceList("pokemon", $limit, $offset);

    // echo "Previous:".$list->previous."</br>";
    // echo "Next: ".$list->next."</br>";
    // echo "<pre>";
    // var_dump($list);
    // echo "</pre>";
?>
<html>
  <head>
    <meta charset="utf-8">
    <title>Pokedex - The Pokémon Company</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A useful tool for you pokemon trainer">
    <meta name="author" content="Lucas Donizeti Siqueira">
    <link rel="stylesheet" href="res/css/style.css" />
  </head>

  <body>
    <!-- HEADER -->
    <header>
      <div>
        <img class = "img-banner" src="/pokedex_lucasdonizeti/res/template/pokedex_banner.png" alt = "Pokedex Banner"/>
      </div>

      <!-- <div id = "pokedex-header"/> -->
      <div>
        <img id = "pokedex-header" src="/pokedex_lucasdonizeti/res/template/pokedex_header.png" alt = "Pokedex Header"/>
      </div>
    </header>
    <!-- END HEADER -->
    <form method="get" action="index.php">
      <div class = "content">
        <table>
          <tr>
            <small style="color: red"> Click the Pokéball to see details of the Pokémon.</small>
          </tr>
          <?php
            foreach ($list->results as $result) {
              $name = $result->name;
              $url = $result->url;

              echo "<tr>";
                echo "<td><p class = 'text-content'>$name</p></td>";
                  echo "<td><div class ='tooltip'><a href = 'view/pokemon.php?url=$url'>See more...<spam class='tooltiptext'>Click here for more information about the pokemon!</spam></a></div></td>";
              echo "<tr>";

              // echo "<pre>";
              // var_dump($name);
              // var_dump($url);
              // echo "</pre>";
            }
            // echo "<pre>";
            // var_dump($results);
            // echo "</pre>";

          // echo $pokemon->name;
           ?>
        </table>
        <?php
          //Buttons previous and next for pagination
          if($list->previous != null){
            echo "<a href=?".after('?', $list->previous).">Previous</a>";
          }
          if($list->next != null){
            echo "<a href=?".after('?', $list->next).">Next</a>";
          }
        ?>
        <div>
            <a href="#">See more informations for you trainer</a>
        </div>
    </div>
    </form>

<center>
  <footer>
    <small>&copy; Copyright 2018, The Pokémon Company</small>
  </footer>
</center>

  </body>
</html>
