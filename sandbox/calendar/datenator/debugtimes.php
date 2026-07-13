<?php
class PHP_dtime {
    /*
     * @array points
     * muuttuja johon timestampit tallennetaan
     */
    var $points = array();
    /*
     * void start(void)
     * public
     * aloitetaan
     */
    function start() {
        if(!function_exists("bcsub"))
             trigger_error("function bcsub() doesn't exist",256);
        $this->addmark("Start");
    }
    /*
     * void stop(void)
     * public
     * lopetetaan
     */
    function stop() {
        $this->addmark("Stop");
    }
    /*
     * void addmark(string mark_name)
     * public
     * lisätään timestamppi merkille
     */
    function addmark($name) {
        $markertime = $this->__jointime(microtime());
        $ae = count($this->points);
        $this->points[$ae][0] = $markertime;
        $this->points[$ae][1] = $name;
    }
    /*
     * float __jointime(string mtime)
     * private
     * muutetaan liukuluvuksi muotoon
     */
    function __jointime($mtime) {
        $timeparts = explode(" ",$mtime);
        $finaltime = $timeparts[1].substr($timeparts[0],1);
        return $finaltime;
    }
    /*
     * void output(void)
     * public
     * tulostetaan kerätty data
     */
    function output() {
        echo '<table border="1" cellpadding="5">';
        echo '<tr><td>id</td><td>point</td><td>chunk</td><td>total</td></tr>';
        echo '<tr>';
        echo '<td>0</td>';
        echo '<td>'.$this->points[0][1].'</td>';
        echo '<td>0.0000000000</td><td>0.00000000000</td>';
        echo '</tr>';
        $last = (float)0;
        for ($i = 1; $i < count($this->points);$i++) {
            echo '<tr>';
            echo '<td>'.$i.'</td>';
            echo '<td>'.$this->points[$i][1].'</td>';
            $time =  round(((float)$this->points[$i][0]-(float)$this->points[$i-1][0]),10);
            $gap = (float)round($this->points[$i][0]-$this->points[0][0],11);
            $last = $time;
            echo '<td>'.$time.'</td>';
            echo '<td>'.$gap.'</td>';
            echo '</tr>';
        }
        echo '</table>';
    }
}
?>