<?php

function getMonth($month) {

	switch ($month) {
		case 1: return "január";
		case 2: return "február";
		case 3: return "március";
		case 4: return "április";
		case 5: return "május";
		case 6: return "június";
		case 7: return "július";
		case 8: return "augusztus";
		case 9: return "szeptember";
		case 10: return "október";
		case 11: return "november";
		case 12: return "december";
	}

}

function getTimeAgo($time) {

	$time = time() - $time;

	if ($time == 0) { return "Most"; }

	$tokens = array (
		31536000 => 'éve',
		2592000 => 'hónapja',
		604800 => 'hete',
		86400 => 'napja',
		3600 => 'órája',
		60 => 'perce',
		1 => 'másodperce'
	);

	foreach ($tokens as $unit => $text) {
		if ($time < $unit) continue;
		$numberOfUnits = floor($time / $unit);
		return $numberOfUnits . " " . $text;
	}

}

function getAge($birthday) {

	return floor((time() - strtotime($birthday)) / (60*60*24*365));

}

function getUserType($type) {

	switch ($type) {
		case "BOY": return "Million Boy";
		case "BABY": return "Million Baby";
		case "DADDY": return "Million Daddy";
		case "MOMMY": return "Million Mommy";
	}

}

// User details

function getLifestyle($lifestyle) {
	switch ($lifestyle) {
		case 1: return "Megbeszélés kérdése";
		case 2: return "Minimális";
		case 3: return "Optimális";
		case 4: return "Kiemelt";
		case 5: return "Luxus";
		default: return "Még nincs kitöltve";
	}
}

function getLifestyleOptions() {
	return [
		getLifestyle(1),
		getLifestyle(2),
		getLifestyle(3),
		getLifestyle(4),
		getLifestyle(5)
	];
}

function getYearlyIncome($income) {
	switch ($income) {
		case 1: return "5 millió Ft alatt";
		case 2: return "5-10 millió Ft között";
		case 3: return "10-20 millió Ft között";
		case 4: return "20-50 millió Ft között";
		case 5: return "50-100 millió Ft között";
		case 6: return "100 millió Ft felett";
		default: return "Még nincs kitöltve";
	}
}

function getYearlyIncomeOptions() {
	return [
		getYearlyIncome(1),
		getYearlyIncome(2),
		getYearlyIncome(3),
		getYearlyIncome(4),
		getYearlyIncome(5),
		getYearlyIncome(6)
	];
}

function getWealth($wealth) {
	switch ($wealth) {
		case 1: return "5 millió Ft alatt";
		case 2: return "5-10 millió Ft között";
		case 3: return "10-20 millió Ft között";
		case 4: return "20-50 millió Ft között";
		case 5: return "50-100 millió Ft között";
		case 6: return "100-500 millió Ft között";
		case 7: return "500-1000 millió Ft között";
		case 8: return "1 milliárd Ft felett";
		default: return "Még nincs kitöltve";
	}
}

function getWealthOptions() {
	return [
		getWealth(1),
		getWealth(2),
		getWealth(3),
		getWealth(4),
		getWealth(5),
		getWealth(6),
		getWealth(7),
		getWealth(8)
	];
}
