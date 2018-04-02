<?php
include ('db.php');

function typeradio($type) {
	switch ($type) {
	 	case 3:
	 		echo '<input type="radio" id="radio1" name="type" value="1"><label for="radio1">Player</label></br>';
	 		echo '<input type="radio" id="radio2" name="type" value="2"><label for="radio2">Coach</label></br>';
	 		echo '<input type="radio" id="radio3" name="type" value="3" checked><label for="radio3">Secretary</label>';
	 		break;

 		case 2:
	 		echo '<input type="radio" id="radio1" name="type" value="1" ><label for="radio1">Player</label></br>';
	 		echo '<input type="radio" id="radio2" name="type" value="2" checked><label for="radio2">Coach</label></br>';
	 		echo '<input type="radio" id="radio3" name="type" value="3" ><label for="radio3">Secretary</label>';
	 		break;
	 	
	 	default:
	 		echo '<input type="radio" id="radio1" name="type" value="1" checked><label for="radio1">Player</label></br>';
	 		echo '<input type="radio" id="radio2" name="type" value="2" ><label for="radio2">Coach</label></br>';
	 		echo '<input type="radio" id="radio3" name="type" value="3" ><label for="radio3">Secretary</label>';
	 		break;
	 }
}
function juniorradio($junior) {
	switch ($junior) {
	 	case 1:
	 		echo '
                <div class="form-group">
                    <label class="control-label col-sm-3" for="junior"></label>
                    <div class="col-sm-9">
                        <input type="checkbox" id="junior" name="junior" checked><label for="junior">Junior</label>
                    </div>
                </div>
            ';

	 		break;
	 	
	 	default:
	 		echo '
                <div class="form-group">
                    <label class="control-label col-sm-3" for="junior"></label>
                    <div class="col-sm-9">
                        <input type="checkbox" id="junior" name="junior"><label for="junior">Junior</label>
                    </div>
                </div>
            ';
	 		break;
	 }
}

function asd($saved) {
	if($saved) echo "(saved!)";
}



function playerEmptyFields() {
	echo '
		</br></br> <!-- PLAYER FORM -->
		<h2>Player form</h2>
		<div class="form-group">
            <label class="control-label col-sm-3" for="doc_name">Doctor name</label>
            <div class="col-sm-9">
                <input type="text" value="" class="form-control" id="doc_name" name="doc_name" placeholder="Enter name">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="doc_tel">Doctor Tel.</label>
            <div class="col-sm-9">
                <input type="text" value="" class="form-control" id="doc_tel" name="doc_tel" placeholder="Enter number">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="doc_address">Doctor Address</label>
            <div class="col-sm-9">
                <input type="text" value="" class="form-control" id="doc_address" name="doc_address" placeholder="Enter address">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="doc_address">Health Issues</label>
            <div class="col-sm-9">
                <input type="text" value="" class="form-control" id="health_issues" name="health_issues" placeholder="Enter health issues">
            </div>
        </div>
        <h3>Junior only</h3>
    ';
    juniorradio(false);
    echo '

        
        <div class="form-group">
            <label class="control-label col-sm-3" for="guardian1_name">Guardian 1 Name</label>
            <div class="col-sm-9">
                <input type="text" value="" class="form-control" id="guardian1_name" name="guardian1_name" placeholder="Enter name">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="guardian1_address">Guardian 1 Address</label>
            <div class="col-sm-9">
                <input type="text" value="" class="form-control" id="guardian1_address" name="guardian1_address" placeholder="Enter address">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="guardian2_name">Guardian 2 Name</label>
            <div class="col-sm-9">
                <input type="text" value="" class="form-control" id="guardian2_name" name="guardian2_name" placeholder="Enter name">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="guardian2_address">Guardian 2 Address</label>
            <div class="col-sm-9">
                <input type="text" value="" class="form-control" id="guardian2_address" name="guardian2_address" placeholder="Enter address">
            </div>
        </div>
        <h3>Senior only</h3>
        <div class="form-group">
            <label class="control-label col-sm-3" for="nextofkin_name">Next-of-kin name</label>
            <div class="col-sm-9">
                <input type="text" value="" class="form-control" id="nextofkin_name" name="nextofkin_name" placeholder="Enter name">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="nextofkin_tel">Next-of-kin tel.</label>
            <div class="col-sm-9">
                <input type="text" value="" class="form-control" id="nextofkin_tel" name="nextofkin_tel" placeholder="Enter number">
            </div>
        </div>


        
	';
    
}
function playerFilledFields($result_array) {
    $junior = $result_array['junior'];
    $doc_name = $result_array['doc_name'];
    $doc_tel = $result_array['doc_tel'];
    $doc_address = $result_array['doc_address'];
    $health_issues = $result_array['health_issues'];
    $nextofkin_name = $result_array['nextofkin_name'];
    $nextofkin_tel = $result_array['nextofkin_tel'];
    $guardian1_name = $result_array['guardian1_name'];
    $guardian1_address = $result_array['guardian1_address'];
    $guardian2_name = $result_array['guardian2_name'];
    $guardian2_address = $result_array['guardian2_address'];

	echo '
        </br></br> <!-- PLAYER FORM -->
        <h2>Player form</h2>
        <div class="form-group">
            <label class="control-label col-sm-3" for="doc_name">Doctor name</label>
            <div class="col-sm-9">
                <input type="text" value="'.$doc_name.'" class="form-control" id="doc_name" name="doc_name" placeholder="Enter name">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="doc_tel">Doctor Tel.</label>
            <div class="col-sm-9">
                <input type="text" value="'.$doc_tel.'" class="form-control" id="doc_tel" name="doc_tel" placeholder="Enter number">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="doc_address">Doctor Address</label>
            <div class="col-sm-9">
                <input type="text" value="'.$doc_address.'" class="form-control" id="doc_address" name="doc_address" placeholder="Enter address">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="doc_address">Health Issues</label>
            <div class="col-sm-9">
                <input type="text" value="'.$health_issues.'" class="form-control" id="health_issues" name="health_issues" placeholder="Enter health issues">
            </div>
        </div>
        <h3>Junior only</h3>
    ';
    juniorradio($junior);
    echo '
        <div class="form-group">
            <label class="control-label col-sm-3" for="guardian1_name">Guardian 1 Name</label>
            <div class="col-sm-9">
                <input type="text" value="'.$guardian1_name.'" class="form-control" id="guardian1_name" name="guardian1_name" placeholder="">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="guardian1_address">Guardian 1 Address</label>
            <div class="col-sm-9">
                <input type="text" value="'.$guardian1_address.'" class="form-control" id="guardian1_address" name="guardian1_address" placeholder="">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="guardian2_name">Guardian 2 Name</label>
            <div class="col-sm-9">
                <input type="text" value="'.$guardian2_name.'" class="form-control" id="guardian2_name" name="guardian2_name" placeholder="">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="guardian2_address">Guardian 2 Address</label>
            <div class="col-sm-9">
                <input type="text" value="'.$guardian2_address.'" class="form-control" id="guardian2_address" name="guardian2_address" placeholder="">
            </div>
        </div>
        <h3>Senior only</h3>
        <div class="form-group">
            <label class="control-label col-sm-3" for="nextofkin_name">Next-of-kin name</label>
            <div class="col-sm-9">
                <input type="text" value="'.$nextofkin_name.'" class="form-control" id="nextofkin_name" name="nextofkin_name" placeholder="">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-3" for="nextofkin_tel">Next-of-kin tel.</label>
            <div class="col-sm-9">
                <input type="text" value="'.$nextofkin_tel.'" class="form-control" id="nextofkin_tel" name="nextofkin_tel" placeholder="">
            </div>
        </div>
    ';
}
function coachEmptyFields() {
	echo '
		</br></br> <!-- PLAYER FORM -->
		<div class="form-group">
            <label class="control-label col-sm-2" for="TestField">TestField</label>
            <div class="col-sm-10">
                <input type="text" value="" class="form-control" id="TestField" name="TestField" placeholder="Enter SRU">
            </div>
        </div>
	';
}
function coachFilledFields($result_array) {
	echo '
		</br></br> <!-- PLAYER FORM -->
		<div class="form-group pform">
            <label class="control-label col-sm-2" for="TestField">TestField</label>
            <div class="col-sm-10">
                <input type="text" value="" class="form-control" id="TestField" name="TestField" placeholder="Enter SRU">
            </div>
        </div>
	';
}

function exists($table,$id){
	include ('db.php');
	$esql = "SELECT * FROM $table WHERE member_id = '$id' LIMIT 1";
	$eresult = mysqli_query($con, $esql);
    $eresult_array = mysqli_fetch_array($eresult);

    if($eresult_array !== null){
        return true;
    }else{
    	return false;
    }
}
function teamExists($name){
    include ('db.php');
    $esql = "SELECT * FROM teams WHERE name = '$name' LIMIT 1";
    $eresult = mysqli_query($con, $esql);
    $eresult_array = mysqli_fetch_array($eresult);


    if($eresult_array !== null){
        return true;
    }else{
        return false;
    }
}
function playerIsInTeam($member_id, $team_id){
    include ('db.php');
    $esql = "SELECT * FROM players WHERE team_id = '$team_id' AND id = '$member_id' LIMIT 1";
    $eresult = mysqli_query($con, $esql);
    $eresult_array = mysqli_fetch_array($eresult);

    if($eresult_array !== null){
        return true;
    }else{
        return false;
    }
}

function printSkillRadio($name,$skill){

    switch ($skill) {
        case '1':
            echo '
                <label class="control-label col-sm-2">'.$name.'</label>
                <div class="radio">
                    <label for="a1"><input checked id="a1" type="radio" value="1" name="'.$name.'">1 </label>
                    <label><input type="radio" value="2" name="'.$name.'">2 </label>
                    <label><input type="radio" value="3" name="'.$name.'">3 </label>
                    <label><input type="radio" value="4" name="'.$name.'">4 </label>
                    <label><input type="radio" value="5" name="'.$name.'">5 </label>
                </div>
            ';
            break;
        case '2':
            echo '
                <label class="control-label col-sm-2">'.$name.'</label>
                <div class="radio">
                    <label><input type="radio" value="1" name="'.$name.'">1 </label>
                    <label><input checked type="radio" value="2" name="'.$name.'">2 </label>
                    <label><input type="radio" value="3" name="'.$name.'">3 </label>
                    <label><input type="radio" value="4" name="'.$name.'">4 </label>
                    <label><input type="radio" value="5" name="'.$name.'">5 </label>
                </div>
            ';
            break;
        case '3':
            echo '
                <label class="control-label col-sm-2">'.$name.'</label>
                <div class="radio">
                    <label><input type="radio" value="1" name="'.$name.'">1 </label>
                    <label><input type="radio" value="2" name="'.$name.'">2 </label>
                    <label><input checked type="radio" value="3" name="'.$name.'">3 </label>
                    <label><input type="radio" value="4" name="'.$name.'">4 </label>
                    <label><input type="radio" value="5" name="'.$name.'">5 </label>
                </div>
            ';
            break;
        case '4':
            echo '
                <label class="control-label col-sm-2">'.$name.'</label>
                <div class="radio">
                    <label><input type="radio" value="1" name="'.$name.'">1 </label>
                    <label><input type="radio" value="2" name="'.$name.'">2 </label>
                    <label><input type="radio" value="3" name="'.$name.'">3 </label>
                    <label><input checked type="radio" value="4" name="'.$name.'">4 </label>
                    <label><input type="radio" value="5" name="'.$name.'">5 </label>
                </div>
            ';
            break;
        case '5':
            echo '
                <label class="control-label col-sm-2">'.$name.'</label>
                <div class="radio">
                    <label><input type="radio" value="1" name="'.$name.'">1 </label>
                    <label><input type="radio" value="2" name="'.$name.'">2 </label>
                    <label><input type="radio" value="3" name="'.$name.'">3 </label>
                    <label><input type="radio" value="4" name="'.$name.'">4 </label>
                    <label><input checked type="radio" value="5" name="'.$name.'">5 </label>
                </div>
            ';
            break;
        
        default:
            echo '
                <label class="control-label col-sm-2">'.$name.'</label>
                <div class="radio">
                    <label><input type="radio" value="1" name="'.$name.'">1 </label>
                    <label><input type="radio" value="2" name="'.$name.'">2 </label>
                    <label><input checked type="radio" value="3" name="'.$name.'">3 </label>
                    <label><input type="radio" value="4" name="'.$name.'">4 </label>
                    <label><input type="radio" value="5" name="'.$name.'">5 </label>
                </div>
            ';
            break;
    }
}


function sout($name,$var){
    echo "<script>console.log('".$name.": ".$var."');</script>";
}
    

















?>
	
