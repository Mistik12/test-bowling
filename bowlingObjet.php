<?php
class Game{
    private $nbFrame = 10;

    public function __construct()
    {
        $chaineResult = $_POST['insertScore'];
        $shotResults = str_split($chaineResult,1);

        foreach ($shotResults as $shotResult){
            $frame = new Frame();
            $frame->addShot($shotResult);
        }
    }

}

class Frame{

    private $firstShot = '';
    private $secondShot = '';
    private $thirdShot = '';

    public function addShot($shotResult){
        //$pin
        if (empty($this->firstShot)) {
            $this->firstShot = $shotResult;

        }else if (empty($this->secondShot)) {
            $this->secondShot = $shotResult;

        }else if (empty($this->thirdShot)) {
            $this->thirdShot = $shotResult;
        }

    }

    public function getPoints(){

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
            $frame = new frame;
            $frame->addShot();
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