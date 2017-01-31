<?php

use PHPUnit\Framework\TestCase;
require_once dirname(__FILE__,2).'/api/sum.php';

class BackendTest extends TestCase
{
    public function testSum()
    {
        $score1 = '{"score":7,"frame":[7],"scoreTillFrame":[7]}';
        $frame1 = '[{"first": 3, "second": 4}]';
        $score1_d = json_decode($score1);
        $frame1_d = json_decode($frame1);

        $score2 = '{"score":7,"frame":[7],"scoreTillFrame":[7]}';
        $frame2 = '[{"first": 3, "second": 4}, {"first": 10, "second": 0}]';
        $score2_d = json_decode($score2);
        $frame2_d = json_decode($frame2);


        $this->assertEquals($score1_d,sum($frame1_d));
        $this->assertEquals($score2_d,sum($frame2_d));

    }
}
?>