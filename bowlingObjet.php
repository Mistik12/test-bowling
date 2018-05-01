<?php
class GameBowling
{
    private $bowlingPins = 10;
    private $strike = 10;
    private $spare = 10;
    private $null = 0;
    private $isStrike = false;
    private $isStrikeReady = false;

    public function cheat(){
    }

    public function resultOneFrame()
    {
        $resultFrame = 0;

        //frame no separt
        $result = $_POST['insertScore'];
        $oneFrame = str_split($result,1);
        $allValue = [];
        foreach($oneFrame as $value){
            if($value == 'x'){
                $allValue[] = 'x';
                $allValue[] = '0';
            }
            else{
                $allValue[] = $value;
            }
        }
//        var_dump($oneFrame);

        $scores = implode($allValue);
        $allValue = str_split($scores, 2);

        //frame separt
         foreach ($allValue as $value) {
             $twoShot = str_split($value);
            foreach ($twoShot as $key => $values) {
                switch ($values) {
                    case "x":
                        $resultFrame += 10;
                        $this->isStrikeReady = true;
                        break;

                    case "-":
                        $resultFrame += $values + 0;
                        break;

                    default:
                        $resultFrame += $values;
                        break;
                }
            }
             if($this->isStrike){
                 $resultFrame = ($resultFrame) * 2;
                 $this->isStrike = false;
                 $this->isStrikeReady = false;
             }
            if($this->isStrikeReady){
                $this->isStrike = true;
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