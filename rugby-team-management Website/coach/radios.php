<?php
	
function radioResult($var) {
	switch ($var) {
		case '0':
			echo '
				<label><input checked type="radio" value="0" name="result">Win </label>
		        <label><input type="radio" value="1" name="result">Loss </label>
		        <label><input type="radio" value="2" name="result">Draw </label>
		        <label><input type="radio" value="3" name="result">Null </label>
			';
			break;
		case 1:
			echo '
				<label><input type="radio" value="0" name="result">Win </label>
		        <label><input checked type="radio" value="1" name="result">Loss </label>
		        <label><input type="radio" value="2" name="result">Draw </label>
		        <label><input type="radio" value="3" name="result">Null </label>
			';
			break;
		case 2:
			echo '
				<label><input type="radio" value="0" name="result">Win </label>
		        <label><input type="radio" value="1" name="result">Loss </label>
		        <label><input checked type="radio" value="2" name="result">Draw </label>
		        <label><input type="radio" value="3" name="result">Null </label>
			';
			break;
		default:
			echo '
				<label><input type="radio" value="0" name="result">Win </label>
		        <label><input type="radio" value="1" name="result">Loss </label>
		        <label><input type="radio" value="2" name="result">Draw </label>
		        <label><input checked type="radio" value="3" name="result">Null </label>
			';
			break;
	}

}
function radioLocation($var) {
	switch ($var) {
		case 0:
			echo '
				<label><input checked type="radio" value="0" name="location" required>Home </label>
                <label><input type="radio" value="1" name="location">Away </label>
			';
			break;
		
		default:
			echo '
				<label><input type="radio" value="0" name="location" required>Home </label>
                <label><input checked type="radio" value="1" name="location">Away </label>
			';
			break;
	}

}




?>