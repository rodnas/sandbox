<?php
header("Content-type: text/html; charset=utf-8");

$hostMySQL = "localhost";
$userName = "root";
$userPassword = "";
$dbMySQL = "dylyver";


import($hostMySQL, $userName, $userPassword, $dbMySQL, 'SequelizeMeta', 'import\SequelizeMeta.csv','name');
import($hostMySQL, $userName, $userPassword, $dbMySQL, 'advertising', 'import\advertising.csv','id, name, amount, currency, pic, lang, url, createdAt, updatedAt, position');
import($hostMySQL, $userName, $userPassword, $dbMySQL, 'cities', 'import\cities.csv','id, name, countryId, lat, lng, active, createdAt, updatedAt');
import($hostMySQL, $userName, $userPassword, $dbMySQL, 'countries', 'import\countries.csv','id, name, isoCode, active, createdAt, updatedAt');
import($hostMySQL, $userName, $userPassword, $dbMySQL, 'dylyver_cards', 'import\dylyver_cards.csv','id, userId, orderId, lastName, phoneNumber, address, country, city, state, postalCode, status, createdAt, updatedAt, firstName, countryCode, deletedAt');
import($hostMySQL, $userName, $userPassword, $dbMySQL, 'dylyver_rides', 'import\dylyver_rides.csv','id, requestId, rideId, driverId, riderId, finishAddress, currency, amount, dylyverAmountFee, endedAt, createdAt, updatedAt');
import($hostMySQL, $userName, $userPassword, $dbMySQL, 'coupons', 'import\coupons.csv','id, userId, pin, amount, fee, currency, status, createdAt, updatedAt, couponId, appliedBy, appliedAt');
import($hostMySQL, $userName, $userPassword, $dbMySQL, 'dylyver_users', 'import\dylyver_users.csv',
	'id, requestId, userId, firstName, lastName, registeredAt, email, avatarUrl, countryCode, phoneNumber, referredBy, referralSlug, countryIso, language, lft, rgt, level, rootId, createdAt, updatedAt, leadershipLevel, leadershipPoints, leadershipPackage, deletedAt, firstLevelDescendants');
import($hostMySQL, $userName, $userPassword, $dbMySQL, 'dylyver_users_invalid', 'import\dylyver_users_invalid.csv',
	'id, requestId, userId, firstName, lastName, registeredAt, email, avatarUrl, countryCode, phoneNumber, referredBy, referralSlug, countryIso, language, leadershipLevel, leadershipPoints, leadershipPackage, firstLevelDescendants, lft, rgt, level, rootId, createdAt, deletedAt, updatedAt');
import($hostMySQL, $userName, $userPassword, $dbMySQL, 'dylyver_users_new', 'import\dylyver_users_new.csv',
	'id, requestId, userId, firstName, lastName, registeredAt, email, avatarUrl, countryCode, phoneNumber, referredBy, referralSlug, countryIso, language, leadershipLevel, leadershipPoints, leadershipPackage, firstLevelDescendants, lft, rgt, level, rootId, createdAt, deletedAt, updatedAt');
import($hostMySQL, $userName, $userPassword, $dbMySQL, 'dylyver_users_old1', 'import\dylyver_users_old1.csv',
	'id, requestId, userId, firstName, lastName, registeredAt, email, avatarUrl, countryCode, phoneNumber, referredBy, referralSlug, countryIso, language, leadershipLevel, leadershipPoints, leadershipPackage, firstLevelDescendants, lft, rgt, level, rootId, createdAt, deletedAt, updatedAt');
import($hostMySQL, $userName, $userPassword, $dbMySQL, 'fondy_payments', 'import\fondy_payments.csv',
	'id, orderId, userId, paymentId, paymentSign, amount, currency, status, details, createdAt, updatedAt');
import($hostMySQL, $userName, $userPassword, $dbMySQL, 'funds_history', 'import\funds_history.csv',
	'id, referralSlug, walletType, currency, amount, currentBalance, description, createdAt, updatedAt');
import($hostMySQL, $userName, $userPassword, $dbMySQL, 'genome_payments', 'import\genome_payments.csv',
	'id, orderId, userId, paymentId, paymentSign, amount, currency, status, details, createdAt, updatedAt');
import($hostMySQL, $userName, $userPassword, $dbMySQL, 'invitations', 'import\invitations.csv',
	'id, referralId, referralSlug, referrerId, referrerSlug, inviteDate, createdAt, updatedAt, type');
import($hostMySQL, $userName, $userPassword, $dbMySQL, 'l_users', 'import\l_users.csv',
	'id, requestId, userId, firstName, lastName, registeredAt, email, avatarUrl, countryCode, phoneNumber, referredBy, referralSlug, countryIso, language, createdAt, updatedAt');
import($hostMySQL, $userName, $userPassword, $dbMySQL, 'leadership_packages', 'import\leadership_packages.csv',
	'id, type, level, points, bonusAmount, bonusCurrency, price, priceCurrency, minPeople, createdAt, updatedAt, deletedAt');
import($hostMySQL, $userName, $userPassword, $dbMySQL, 'leadership_settings', 'import\leadership_settings.csv',
	'id, level, points, profit, commission, createdAt, updatedAt, deletedAt, currency');
import($hostMySQL, $userName, $userPassword, $dbMySQL, 'leadership_transactions', 'import\leadership_transactions.csv',
	'id, userId, currency, amount, description, operation, networkId, createdAt, updatedAt, deletedAt, category, fromId, rideId, sourceId');
import($hostMySQL, $userName, $userPassword, $dbMySQL, 'marketing_materials', 'import\marketing_materials.csv',
	'id, title, description, language, preview, file, extension, size, createdAt, updatedAt');
import($hostMySQL, $userName, $userPassword, $dbMySQL, 'messages', 'import\messages.csv',
	'id, `from`, `to`, subject, content, createdAt, updatedAt, isRead, deletedAt');
import($hostMySQL, $userName, $userPassword, $dbMySQL, 'offices', 'import\offices.csv',
	'id, name, pic, address, phone, email, cityId, active, createdAt, updatedAt, role');
import($hostMySQL, $userName, $userPassword, $dbMySQL, 'orders', 'import\orders.csv',
	'id, userId, productId, couponId, amount, discountAmount, totalAmount, paymentMethod, currency, status, createdAt, updatedAt');
import($hostMySQL, $userName, $userPassword, $dbMySQL, 'paypal_payments', 'import\paypal_payments.csv',
	'id, orderId, userId, paymentId, payerId, paymentToken, amount, currency, status, details, createdAt, updatedAt');
import($hostMySQL, $userName, $userPassword, $dbMySQL, 'products', 'import\products.csv',
	'id, title, description, additional, type, price, currency, createdAt, updatedAt, category');
import($hostMySQL, $userName, $userPassword, $dbMySQL, 'transactions', 'import\transactions.csv',
	'id, userId, walletType, type, status, amount, currency, service, internalTxId, externalTxId, currentBalance, metaInfo, description, operation, paymentType, createdAt, updatedAt');
import($hostMySQL, $userName, $userPassword, $dbMySQL, 'transfwerwise_recipients', 'import\transfwerwise_recipients.csv',
	'id, userId, twRecipientId, currency, description, fullName, createdAt, updatedAt');
import($hostMySQL, $userName, $userPassword, $dbMySQL, 'users', 'import\users.csv',
	'id, username, password, createdAt, updatedAt, deletedAt');
import($hostMySQL, $userName, $userPassword, $dbMySQL, 'webhooks_activities', 'import\webhooks_activities.csv',
	'id, requestId, originalUrl, requestMethod, hmac, jsonBody, requestTime, createdAt, updatedAt');




/*
* table: 
* fields: id, requestId, userId, firstName, lastName, registeredAt, email, avatarUrl, countryCode, phoneNumber, referredBy, referralSlug, countryIso, language, lft, rgt, level, rootId, createdAt, updatedAt, leadershipLevel, leadershipPoints, leadershipPackage, deletedAt, firstLevelDescendants
* csv file: import\dylyver_users.csv
`
*/
function import($hostMySQL, $userName, $userPassword, $dbMySQL, $nameTable, $csvFile, $fieldNames) {
	$conn = new mysqli ($hostMySQL, $userName, $userPassword, $dbMySQL);
	$conn->query("SET NAMES utf8");
	$conn->query("SET CHARACTER SET utf8");
	if ($conn->connect_errno) {
		echo $conn->connect_error;
		die();
	}
	$truncateTableSQL="TRUNCATE TABLE ".$nameTable;
	$conn->query($truncateTableSQL);
	print_r($csvFile."<br>");
	$size = filesize($csvFile);
	$pointer = fopen($csvFile,"r");
	$itemCount=0;
	$itemCountInsert=0;
//	$itemCountUpdate=0;
	
	$fieldArray = explode(",",$fieldNames);
	$filePointer = fopen("insert\\".$nameTable.".sql","w");
	while ($line = fgets($pointer, $size)) {
		if (!empty($line)) {
			$datas = explode(chr(9), $line);
			if (count($datas) > 0) {
				$importInsertSQL = "INSERT INTO ". $nameTable ."(".$fieldNames.") VALUES (";
				foreach ($fieldArray as $index => $value) {
					if (ISSET($datas[$index])) {
						switch (trim($value)) {
							case "requestTime":
							case "registeredAt":
							case "createdAt":
							case "updatedAt":
							case "deletedAt":
							case "endedAt":
							case "appliedAt":
								$datas[$index] = str_replace("\N","EMPTY",$datas[$index]);
								IF (trim($datas[$index]) != "EMPTY") {
									$datas[$index]="'".substr_replace(trim($datas[$index]),"",-3)."'";
								} else {
									$datas[$index]="NULL";
								}
								break;
							case "active":
							case "isRead":
								if ($datas[$index] = "t")							 {
									$datas[$index] = 1;
								} else {
									$datas[$index] = 0;
								}
								break;
							case "amount":
							case "currentBalance":
							case "discountAmount":
								if ($datas[$index] == "\N") {
									$datas[$index] = 'NULL';
								}
								break;
							default:
								if (ISSET($datas[$index])) {
									$datas[$index] = "'".addslashes(trim($datas[$index]))."'";
								}
						}			
					}
				} 
				$importInsertSQL .= implode(",",$datas).");";
				fputs($filePointer, $importInsertSQL."\r\n");
				$impSQL=$conn->query($importInsertSQL);
				$itemCountInsert++;
			}
			$itemCount++;
		}
	}
	print_r("insert: ".$itemCountInsert." beolvasva<br>");
//	print_r("update: ".$itemCountUpdate." beolvasva<br>");
	print_r("full: ".$itemCount." beolvasva<br>");
	print_r(str_repeat("**", 20)."<br>");
	fclose($pointer);
	fclose($filePointer);
	$conn -> close();
}


?>
