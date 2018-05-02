<?php

class Game
{
    private $nbFrame = 10;

    public function __construct()
    {
        $chaineResult = $_POST['insertScore'];
        $shotResults = str_split($chaineResult, 1);

        $frame = new Frame();
        foreach ($shotResults as $shotResult) {
            $frame->addShot($shotResult);
            $frame->getPoints();
        }


    }

}

class Frame
{

    private $firstShot = '';
    private $secondShot = '';
    private $thirdShot = '';

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
            var_dump($this->firstShot);
            var_dump($this->secondShot);

            // si user marque point
            if (is_numeric($this->firstShot) && is_numeric($this->secondShot)) {
                $resultFrame = intval($this->firstShot) + intval($this->secondShot);
                echo 'result : ' . $resultFrame;
            }

            else if ($this->secondShot || $this->firstShot == '-') {
                $secondShotScore = 0;
                $resultFrame = $this->firstShot += $this->secondShot + $secondShotScore ;
                echo 'result : ' . $resultFrame;

            }

            $this->firstShot = '';
            $this->secondShot = '';

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

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
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