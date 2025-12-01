<?php

    // Pizza configuration functions

    /*
        Base Check 

        Description:
        Check if a basic ingredient has been selected before for checkboxes

        Input: $ingredient:   str | basic ingredient to find  
               $pizza_config: arr | config array
        
        Output: string | checked status for checkbox
        
    */
    function base_check($ingredient, $pizza_config){
        if( isset($pizza_config['ingredients_base']) && in_array($ingredient, $pizza_config['ingredients_base'])){
            echo 'checked="checked"';
            return;
        }else{
            echo '';
            return;
        }
    }

    /*
        Extra Check 

        Description:
        Check if an extra ingredient has been selected before for checkboxes

        Input: $ingredient:   str | extra ingredient to find  
               $pizza_config: arr | config array
        
        Output: string | checked status for checkbox
        
    */
    function extra_check($ingredient, $pizza_config){
        if( isset($pizza_config['ingredients_extra']) && in_array($ingredient, $pizza_config['ingredients_extra'])){
            echo 'checked="checked"';
            return;
        }else{
            echo '';
            return;
        }
    }

    /*
        Get Total Cost

        Description:
        Calculate pizza total cost based on configuration

        Input: $pizza_data:   arr | data array
               $pizza_config: arr | config array
        
        Output: int | total cost
        
    */
    function get_total_cost($pizza_data, $pizza_config){
        $cost = 0;

        $cost += $pizza_data['dough'][$pizza_config['dough']];

        if( isset($pizza_config['ingredients_base']) && !empty($pizza_config['ingredients_base']) ){
            foreach($pizza_config['ingredients_base'] as $ingredient){
                $cost += $pizza_data['ingredients_base'][$ingredient];
            }
        }

        if( isset($pizza_config['ingredients_extra']) && !empty($pizza_config['ingredients_extra']) ){
            foreach($pizza_config['ingredients_extra'] as $ingredient){
                $cost += $pizza_data['ingredients_extra'][$ingredient];
            }
        }

        return $cost;
    }

    // Pizza configuration data
    /*
        --- Data Schema ---

        $pizza_data = [
        
            'element' => [
            
                'option1' => price,
                'option2' => price,

                . . .

                'optionN' => price,

            ],

            'element2' => [],

            . . .

            'elementN' => []
        
        ]

    */

    $pizza_data = [
        'dough' => [
            'normal' => 10,
            'whole'  => 13,
            'kamut'  => 15
        ],

        'ingredients_base' => [
            'tomato'     => 2,
            'mozzarella' => 3
        ],

        'ingredients_extra' => [
            'mushroom'    => 1.50,
            'ham'         => 3,
            'salami'       => 2,
            'spicy salami' => 5,
            'wurstel'      => 2
        ]
    
    ];
        
    


    // Start session to use $_SESSION[]
    session_start();

    // Download saved configs in session or create new list
    $pizza_config = ( isset($_SESSION['pizza_config']) ? $_SESSION['pizza_config'] : []);

    if( $_SERVER['REQUEST_METHOD'] == 'POST' ){

        // Get dough
        if( isset($_POST['dough']) ){
            $dough = $_POST['dough'];
            $pizza_config['dough'] = $dough;
        }

        // Get basic ingredients
        if( isset($_POST['ingredients_base']) ){
            $ingredients_base = $_POST['ingredients_base'];
            $pizza_config['ingredients_base'] = $ingredients_base;
        }else {
            $pizza_config['ingredients_base'] = [];
        }

        // Get extra ingredients
        if( isset($_POST['ingredients_extra']) ){
            $ingredients_extra = $_POST['ingredients_extra'];
            $pizza_config['ingredients_extra'] = $ingredients_extra;
        }else {
            $pizza_config['ingredients_extra'] = [];
        }

        // Get notes
        if( isset($_POST['notes']) && $_POST['notes'] != ''){
            $notes = $_POST['notes'];
            $pizza_config['notes'] = $notes;
        }else{
            unset($pizza_config['notes']);
        }

        // Get pick-up time
        if( isset($_POST['time']) ){
            $time = $_POST['time'];
            $pizza_config['time'] = $time;
        }

        // Get box color
        if( isset($_POST['box_color']) ){
            $box_color = $_POST['box_color'];
            $pizza_config['box_color'] = $box_color;
        }

    }

    // Save data in session
    $_SESSION['pizza_config'] = $pizza_config;


?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pizza Configurator</title>
    <link rel="icon" type="image/png" href="favicon.png"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body>
    <div class="container mt-5">

        <!-- Page Description -->

        <h1>🍕Pizza Configurator </h1> 
        <br>
        <h3>Create your own personalized pizza!</h3>

        <br>

        <!-- Pizza Configuration Form -->

        <form action="index.php" method="POST">

            <!-- Dough Selection -->

            <h4>🍞 Dough</h4>

            <label for="dough"> Choose a dough: </label>
            <select name="dough" id="dough">
                <?php foreach($pizza_data['dough'] as $dough => $price): ?>
                    <option value='<?= $dough ?>'><?= ucfirst($dough) ?></option>
                <?php endforeach ?>
            </select>

            <br><br>

            <!-- Basic Ingredients Selection -->

            <h4>🍅 Basic Ingredients</h4>
            
            <?php foreach($pizza_data['ingredients_base'] as $ingredient => $price): ?>
                <label for='<?= $ingredient ?>'><?= ucfirst($ingredient)?></label>
                <input type='checkbox' name='ingredients_base[]' value='<?= $ingredient?>' id='<?= $ingredient?>' <?= base_check($ingredient, $pizza_config)?>>
                <br>
            <?php endforeach ?>

            <br>

            <!-- Extra Ingredients Selection -->

            <h4>🍄‍🟫 Extra Ingredients</h4>
            
            <?php foreach($pizza_data['ingredients_extra'] as $ingredient => $price): ?>
                <label for='<?= $ingredient ?>'><?= ucfirst($ingredient)?></label>
                <input type='checkbox' name='ingredients_extra[]' value='<?= $ingredient?>' id='<?= $ingredient?>' <?= extra_check($ingredient, $pizza_config)?>>
                <br>
            <?php endforeach ?>

            <br>

            <!-- Notes For the Cook Selection -->

            <h4>📜 Notes for the Cook</h4>

            <label for="notes">Write here:</label>
            <input type="textarea" id='notes'  name='notes' value='<?= isset($pizza_config['notes']) ? $pizza_config['notes'] : '' ?>'>

            <br><br>

            <!-- Pick-up Time Selection -->
            
            <h4>🕙 Pick-Up Time </h4>

            <label for="time">Select time:</label>
            <input type="time" name='time' id='time' value='<?= $pizza_config['time']?>'>
            
            <br><br>

            <!-- Box Color Selection -->

            <h4>🎨 Box Color</h4>
            
            <label for="color">Select color:</label>
            <input type="color" name='box_color' id='color' value='<?= $pizza_config['box_color']?>'>
            
            <br><br>

            <!-- Submit Button -->

            <input class="btn btn-primary" type="submit" value='Save Changes'>
        </form>

        <!-- Total Cost -->
         <div class='container mt-5'>
                <h2>💰 Total Cost: <?= get_total_cost($pizza_data, $pizza_config) ?>€</h2>
         </div>

        <!-- Configuration Recap -->

        <div class="container mt-4">
            <h2>📜 Configuration Recap</h2>

            <ul>
                <?php foreach($pizza_config as $item => $data): ?>
                    <?php if(is_array($data)): ?>
                        <li><?= '<strong>' . ucfirst($item) . '</strong>'. ': '?>
                            <ul>
                                <?php foreach($data as $ingredient): ?>
                                    <li><?= $ingredient ?></li>
                                <?php endforeach ?>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li><?= '<strong>' . ucfirst($item) . '</strong>'. ': ' . $data ?></li>
                    <?php endif ?>
                <?php endforeach ?>
            </ul>

        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>