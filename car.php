<?php

trait Backpath
{
    public function reverseGear()
    {
        echo "Режим езды назад" . '<br>';;
    }
}


trait TransmissionAuto
{
    use Backpath;

    public function forward()
    {
        echo "Режим езды вперед" . '<br>';
        return 1;
    }
}


trait TransmissionManual
{
    use Backpath;

    public function first()
    {
        echo "Первая передача" . '<br>';
    }

    public function second()
    {
        echo "Вторая передача" . '<br>';
    }



}


trait Engine
{
    public $horsepower = 25;
    public $temperature;

    public function start()
    {
        echo "Включить двигатель" . '<br>';
    }

    public function stop()
    {
        echo "Выключить двигатель" . '<br>';

    }

    public function cooling()
    {
        $this->temperature -= 10;
        echo "Охлаждение на 10 градусов. Результат:" . $this->temperature . 'градусов' . '<br>';;
    }
}


class Car
{
    use Engine;
   
    public $distance;
    public $speed;
    public $goal;
    public $i = 0;
    public function move()
    {
        $path = 0;
        static $i;
        while ($path < $this->distance) {
            sleep(1);
            $path += $this->speed;
            echo "Пройдено" . $path . " метров " . '<br>';
            for (; $i < $path; $i = $i + 10) {
                $this->temperature += 5;
                echo "Температура повысилась на 5 градусов. Результат:" . $this->temperature . " градусов " . '<br>';
            }
            if ($this->temperature >= 90) {
                $this->cooling();
            }
        }
    }
}


class Niva extends Car
{
    use Engine;
    use TransmissionManual;

    function __construct($distance, $speed, $goal)
    {
        $this->distance = $distance;
        $this->speed = $speed;
        $this->goal = $goal;
    }


    function getNiva()
    {
        if ($this->speed > ($this->horsepower * 2 )) {
          
        } elseif ($this->goal == 1 && $this->speed < 9) {
            $this->start();
            $this->first();
            $this->move();
            $this->stop();
        } elseif ($this->goal == 1 && $this->speed > 9) {
            $this->start();
            $this->second();
            $this->move();
            $this->stop();
        } elseif ($this->goal == 0) {
            $this->start();
            $this->reverseGear();
            $this->move();
            $this->stop();
        }
    }
}

echo 'NIVA'. '<br>';
$Niva = new Niva(200, 10, 1);
$Niva->getNiva();
