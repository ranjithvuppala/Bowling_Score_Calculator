<?php

function sum($ob)

{

    $ret = new stdClass();
    $ln = count($ob);

    $score = 0;

    $frame = [];
    $scoreTillFrame = [];

    for ($i = 0; $i < $ln; $i++) {

        $s = 0;

        // If third roll exists i.e. it is the tenth frame and it is a spare(for first two rolls) or a strike
        if (isset($ob[$i]->{'third'})) {

            $s = $ob[$i]->{'first'} + $ob[$i]->{'second'} + $ob[$i]->{'third'};
            $score = $score + $s;

        }
        // It is frames between 1 and 9
        else {

            // If first and second rolls do not finish the frame
            if ($ob[$i]->{'first'} + $ob[$i]->{'second'} < 10) {
                $s = $ob[$i]->{'first'} + $ob[$i]->{'second'};
                $score = $score + $s;

            }

            // If the frame was a strike
            elseif ($ob[$i]->{'first'} == 10) {

                // If it is the last frame
                if ($i != $ln - 1) {

                    if ($ob[$i + 1]->{'first'} == 10) {
                        if (($i + 1) != $ln - 1) {
                            $s = $ob[$i]->{'first'} + $ob[$i]->{'second'} + $ob[$i + 1]->{'first'} + ($ob[$i + 2]->{'first'});
                            $score = $score + $s;
                        } elseif (($i) == 8) {
                            $s = $ob[$i]->{'first'} + $ob[$i]->{'second'} + $ob[$i + 1]->{'first'} + ($ob[$i + 1]->{'second'});
                            $score = $score + $s;
                        }
                    }
                    // If it wasn't the last frame
                    else {
                        $s = $ob[$i]->{'first'} + $ob[$i]->{'second'} + ($ob[$i + 1]->{'first'}) + ($ob[$i + 1]->{'second'});
                        $score = $score + $s;
                    }
                }
            }
            //If it was a spare
            else {
                if ($i != ($ln - 1)) {
                    $s = $ob[$i]->{'first'} + $ob[$i]->{'second'} + ($ob[$i + 1]->{'first'});
                    $score = $score + $s;
                }
            }

        }

        if (!($s == 0 && ($ob[$i]->{'first'} + $ob[$i]->{'second'}) == 10)) {
            array_push($frame, $s);
            array_push($scoreTillFrame, $score);
        }

    }

    $ret->score = $score;
    $ret->frame = $frame;
    $ret->scoreTillFrame = $scoreTillFrame;

    return $ret;

}

?>