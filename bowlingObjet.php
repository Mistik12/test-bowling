<?php

class Game{
    private $score = 0;
    public function setScore($arrayFrames){
        foreach ($arrayFrames as $scoreFrame) {
            $this->score += $scoreFrame;
        }
    }
    public function getScore(){
        return $this->score;
    }
    public function __construct()
    {
        $chaineResult = $_POST['insertScore'];
        echo 'Chaine de caractere saisie : '. $chaineResult;
        $shotResults = str_split($chaineResult, 1);

        $frame = new Frame();
        foreach ($shotResults as $shotResult) {
            $frame->addShot($shotResult);
            $frame->getPoints();
        }
        var_dump($frame->getRecordFrame());
        $this->setScore($frame->getRecordFrame());
        echo $this->getScore();
    }
}

class Frame
{
    private $firstShot = "";
    private $secondShot = "";
    private $thirdShot = "";
    private $arrayFrame = array();
    private $isSpare = false;
    private $isStrike = false;

    public function addShot($shotResult)
    {
        if (empty($this->firstShot)) {
            $this->firstShot = $shotResult;
        } else if (empty($this->secondShot)) {
            $this->secondShot = $shotResult;
        } else if (empty($this->thirdShot)) {
            $this->thirdShot = $shotResult;
        }
    }

    public function getPoints()
    {
        if (!empty($this->firstShot) && !empty($this->secondShot)) {

            if ($this->firstShot === "-") {
                $this->firstShot = 0;
            }
            if ($this->secondShot === "-") {
                $this->secondShot = 0;
            }

            if (is_numeric($this->firstShot) && is_numeric($this->secondShot)) {
                //isSpare
                if($this->isSpare){
                    $frameArray = $this->getRecordFrame();
                    $newValue = end($frameArray) + $this->firstShot;
                    $lastIteration = count($frameArray) - 1;
                    $this->setSpare($newValue, $lastIteration);
                }
                $resultFrame = intval($this->firstShot) + intval($this->secondShot);
                $this->setFrame($resultFrame);
            }

            else if ($this->firstShot ==  0 || $this->secondShot === 0) {
                $resultFrame = $this->firstShot += $this->secondShot;
                $this->setFrame($resultFrame);
            }

            else if($this->secondShot === "/") {
                $resultFrame = 10;
                $this->isSpare = true;
                $this->setFrame($resultFrame);
            }
            $this->firstShot = "";
            $this->secondShot = "";
        }
    }

    public function setSpare($newValue, $iteration){
        $this->arrayFrame[$iteration] = $newValue;
        $this->isSpare = false;
    }


    public function setFrame($resultFrame){
        array_push($this->arrayFrame, $resultFrame);
    }

    public function getRecordFrame()
    {
        return $this->arrayFrame;
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

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $resultFrame ='';
    $game = new Game;
}

?>


<style>

    .container-frame {
        display: flex;
        justify-content: space-around;
    }

    .frame-result {
        width: 155px;
        background: #6495edc7;
        display: flex;
        justify-content: center;
        padding: 15px;
        color: white;
    }

</style>