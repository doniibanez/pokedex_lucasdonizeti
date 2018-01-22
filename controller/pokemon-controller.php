<?php
    // Function to split text (substring)
  function after ($regex, $inthat)
  {
      if (!is_bool(strpos($inthat, $regex)))
      return substr($inthat, strpos($inthat,$regex)+strlen($regex));
  };

  // Load pokemons from the page
  function loadPokemonsPerPage($offset){
    require "../lib/PokeApi.php";

    $api =  new PokeApi();

    $pokemons = array();

      $list = $api->resourceList("pokemon", 10, $offset);

      foreach ($list->results as $result) {
        $pokemon_api = $api->sendRequest($result->url);
        $pokemon = new StdClass();
        $pokemon->name = $pokemon_api->name;
        $pokemon->image = $pokemon_api->sprites->front_default;
        $pokemon->weight = $pokemon_api->weight;
        $pokemon->stats = $pokemon_api->stats;
        $pokemon->base_experience = $pokemon_api->base_experience;
        foreach ($pokemon->stats as $s) {
            if($s->stat->name == "attack"){
                $pokemon->attack = $s->base_stat;
            }

          }
        array_push($pokemons, $pokemon);
      }

    return $pokemons;
  }

  // Order pokemons
  function orderPokemonsPerATK($pokemons){
    usort($pokemons, 'cmp');

    return $pokemons;
  }

  // Descending order
  function cmp($a, $b) {
    return $a->attack < $b->attack;
  }

  function sumStats($pokemons){
    $sumStats = new StdClass();
    $sumStats->speed = 0;
    $sumStats->special_defense = 0;
    $sumStats->special_attack = 0;
    $sumStats->defense = 0;
    $sumStats->attack = 0;
    $sumStats->hp = 0;

    foreach ($pokemons as $pokemon) {
      foreach ($pokemon->stats as $s) {
        switch ($s->stat->name) {

          case 'speed':
            $sumStats->speed = $sumStats->speed + $s->base_stat;
            break;
          case "special-defense":
            $sumStats->special_defense = $sumStats->special_defense + $s->base_stat;
          break;
          case "special-attack":
            $sumStats->special_attack = $sumStats->special_attack + $s->base_stat;
          break;
          case 'defense':
            $sumStats->defense = $sumStats->defense + $s->base_stat;
          break;
          case 'attack':
            $sumStats->attack = $sumStats->attack + $s->base_stat;
          break;
          case 'hp':
            $sumStats->hp = $sumStats->hp + $s->base_stat;
          break;
        }
      }
    }

    return $sumStats;
  }
  ?>
