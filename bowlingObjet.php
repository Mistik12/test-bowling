<?php

class Game{
    private $score = 0;

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
        echo 'score total : '. $this->getScore();
    }


    public function setScore($arrayFrames){
        foreach ($arrayFrames as $scoreFrame) {
            $this->score += $scoreFrame;
        }
    }
    public function getScore(){
        return $this->score;
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
    private $strikeTurn = 0;
    private $strikeArray = array();

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
                //isSpare
                if($this->isSpare){
                    $newValue = $this->getSpareValue($this->firstShot);
                    $lastIteration = $this->getSpareIteration();
                    $this->setSpare($newValue, $lastIteration);
                }
                $this->secondShot = 0;
            }

            if ($this->firstShot === "x" || $this->secondShot === "x"){
                var_dump('Veuillez nous excuser les strikes ne fonctionne pas');
            }

            if (is_numeric($this->firstShot) && is_numeric($this->secondShot)) {
                //isSpare
                if($this->isSpare){
                    $newValue = $this->getSpareValue($this->firstShot);
                    $lastIteration = $this->getSpareIteration();
                    $this->setSpare($newValue, $lastIteration);
                }

                $resultFrame = intval($this->firstShot) + intval($this->secondShot);
                $this->setFrame($resultFrame);

            }

            else if($this->secondShot === "/") {
                //isSpare
                if($this->isSpare){
                    $newValue = $this->getSpareValue($this->firstShot);
                    $lastIteration = $this->getSpareIteration();
                    $this->setSpare($newValue, $lastIteration);
                }
                $frameArray = $this->getRecordFrame();
                if(count($frameArray) == 9){
                    $resultFrame = 10 + $this->firstShot;
                }
                else{
                    $resultFrame = 10;
                }
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

    public function getSpareValue($firstShot){
        $frameArray = $this->getRecordFrame();
        $newValue = end($frameArray) + $firstShot;
        return $newValue;
    }

    public function getSpareIteration(){
        $frameArray = $this->getRecordFrame();
        $lastIteration = count($frameArray) - 1;
        return $lastIteration;
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
        <p>  "/" pour un spare "-" pour score null</p>
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
