<?php
class GameBowling
{
    private $bowlingPins = 10;
    private $strike = 10;
    private $spare = 10;
    private $null = 0;

    public function cheat(){
    }

    public function resultOneFrame()
    {
        $result = $_POST['insertScore'];
        $oneFrame = str_split($result,2);
//        var_dump($oneFrame);

        $resultFrame = 0;
         foreach ($oneFrame as $value) {
             $twoShot = str_split($value);
//             var_dump($twoShot);

            foreach ($twoShot as $values) {
              $resultFrame += $values;
            }

             echo '<div class="frame-result">reultat frame : '.$resultFrame.'</div>';
             $resultFrame = 0;
         }
    }
}

?>


<form action="" method="post">
    <div>
        <label>Score</label>
        <input type="text" name="insertScore" required/>
    </div>
    <input type="submit">
</form>

<div class="container-frame">
    <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $gameOne = new GameBowling;
            $gameOne->resultOneFrame();
        }
    ?>
</div>




<style>

.container-frame{
    display: flex;
    justify-content: space-around;
}

 .frame-result{
     width: 155px;
     background: #6495edc7;
     display: flex;
     justify-content: center;
     padding: 15px;
     color: white;
 }

</style>