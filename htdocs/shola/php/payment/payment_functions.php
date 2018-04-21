<?php

	function getItemCategory($destin_id, $pdo){
		//fetch item category id
		$stmt = $pdo->prepare("SELECT category from items where item_id=:item_id");
        $stmt->execute(["item_id"=>$destin_id]);
        $categoryName = $stmt->fetchAll();
		if($categoryName == null){
			return 0;
		}
		$stmt = $pdo->prepare("SELECT id from category where category_name=:cat_name");
        $stmt->execute(["cat_name"=>$categoryName[0]["category"]]);
        $category = $stmt->fetchAll();
		return $category[0]["id"];
	}
	
	function checkItemQuantity($destin_id, $pdo){
		//check the quantity of item
		$stmt = $pdo->prepare("SELECT quantity from items where item_id=:item_id");
        $stmt->execute(["item_id"=>$destin_id]);
        $quantity = $stmt->fetchAll();
		if($quantity[0]["quantity"] > 0){
			return true;
		}else return false;
	}
	
	function saveCreditCard( $source_id, $credit_card, $expiration_date, $pdo){
		//check if credit card already exists in the database table
		$stmt = $pdo->prepare("SELECT expiration_date from credit_card_history where credit_card_number=:cred");
        $stmt->execute(["cred"=>$credit_card]);
        $data = $stmt->fetchAll();
		if ($data == null) {
        //Insert this data into the credit_card_history table
		  //fetch user name from coustomer table by user id
			$stmt = $pdo->prepare("SELECT user_name from customer where user_id=:userId");
			$stmt->execute(["userId"=>$source_id]);
			$userName = $stmt->fetchAll();
			$name = $userName[0]["user_name"];
			$stmt = $pdo->prepare("INSERT INTO credit_card_history( user_id, user_name, credit_card_number, expiration_date) 
								   VALUES( \"$source_id\", \"$name\", \"$credit_card\",\"$expiration_date\")");
			$stmt->execute([]);
		}
	}
	
	function autoFill($source_id, $type, $pdo_bank, $pdo){
		//fetch user's credit card number from history
		$stmt = $pdo->prepare("SELECT credit_card_number from credit_card_history where user_id=:user_id");
        $stmt->execute(["user_id"=>$source_id]);
        $credit_card = $stmt->fetchAll();
		if($credit_card == null){
			return null;
		}
		//fetch expiration date from credit_card table using credit card number above
		$stmt = $pdo_bank->prepare("SELECT expiration_date from credit_card where credit_card_number=:cred");
        $stmt->execute(["cred"=>$credit_card[0]["credit_card_number"]]);
        $data = $stmt->fetchAll();		
		if($type==0){
			return $credit_card[0]["credit_card_number"];
		}
		else
			return $data[0]["expiration_date"];
	}
	
	function totalPrice($destin_id, $pdo){
		//get item's price
            $stmt = $pdo->prepare("SELECT price from items where item_id=:item_id");
            $stmt->execute(["item_id"=>$destin_id]);
            $price = $stmt->fetchAll();
		//get shipping price
			$stmt = $pdo->prepare("SELECT shipping_price from shipping where item_id=:item_id");
            $stmt->execute(["item_id"=>$destin_id]);
            $ship = $stmt->fetchAll();
		//check if shipping is availabel
		if($ship == null){
			$money=$price[0]["price"];
		}		
		else
			//Add the two prices together (item_price + shipping_price)
			$money=$price[0]["price"] + $ship[0]["shipping_price"];
		
			$money=$money+($money*0.02);
			return $money;
	}
	
	function canSplitPay($destin_id, $check_box, $pdo){
		$stmt = $pdo->prepare("SELECT split_pay from items where item_id=:item_id");
        $stmt->execute(["item_id"=>$destin_id]);
        $split_pay = $stmt->fetchAll();
		if($check_box && $split_pay[0]["split_pay"]==1){
			return true;
		}else return false;
	}
	
	function interestRate($item_id, $pdo){
		//returns the interest rate in decimal point
		$stmt = $pdo->prepare("SELECT interest_rate from shola_info ");
		$stmt->execute([]);
		$shola = $stmt->fetchAll();
        $interestRate=$shola[0]["interest_rate"];
		return $interestRate;
	}
	
	function sholaAccount($account_type, $pdo){
		if($account_type == 0){
			//get shola account number
			$stmt = $pdo->prepare("SELECT shola_account from shola_info ");
			$stmt->execute([]);
			$shola = $stmt->fetchAll();
			$shola_account_number=$shola[0]["shola_account"];//10000212549999
			return $shola_account_number;
		}elseif($account_type == 1){
			//get temporary shola account number
			$stmt = $pdo->prepare("SELECT shola_temp_account from shola_info ");
			$stmt->execute([]);
			$shola = $stmt->fetchAll();
			$shola_temp_account_number=$shola[0]["shola_temp_account"];
			return $shola_temp_account_number;
		}
	}
	
	function sholaCut($money, $pdo){
		//calculate shola's cut from given money, shola cut is 2%
		$stmt = $pdo->prepare("SELECT shola_cut from shola_info ");
        $stmt->execute([]);
        $shola = $stmt->fetchAll();
		$sholaCut = $money * $shola[0]["shola_cut"];
		return $sholaCut;
	}
	
	function resolveDebt($money, $source_id, $destin_id, $pdo_bank, $pdo){
		if($destin_id==null){
			//Get user id of user that is resolving debt
			$stmt = $pdo->prepare("SELECT user_id from credit_card_history where credit_card_number=:cred");
            $stmt->execute(["cred"=>$source_id]);
            $user_info = $stmt->fetchAll();
			//Using the user id from above get every row that has the user id of this user
			$stmt = $pdo->prepare("SELECT item_id, remaining_debt from debt where user_id=:user_id");
            $stmt->execute(["user_id"=>$user_info[0]["user_id"]]);
            $debts = $stmt->fetchAll();			
			//from each items stated above resolve the debt by paying money to leanders
			for($i=0; $i<count($debts);$i++){
				moneyDistribution($debts[$i]["remaining_debt"], $source_id, $debts[$i]["item_id"], 7, 0, $pdo_bank, $pdo);
			}
						
		}
		else{
			moneyDistribution($money, $source_id, $destin_id, 7, 0, $pdo_bank, $pdo);
		}
	}
	
	function splitPay($money, $source_id, $destin_id, $pdo_bank, $pdo){
		//if split pay
			$money=$money*interestRate($destin_id, $pdo);
			moneyDistribution($money, $source_id, $destin_id, 6, 0, $pdo_bank, $pdo);
			//get user_id using credit card number from credit card history table
				$stmt = $pdo->prepare("SELECT user_id from credit_card_history where credit_card_number=:cred");
                $stmt->execute(["cred"=>$source_id]);
                $credit_card_number = $stmt->fetchAll();
			//fetch buyer name from customer table
				$stmt = $pdo->prepare("SELECT user_name from customer where user_id=:userId");
				$stmt->execute(["userId"=>$credit_card_number[0]['user_id']]);
				$buyer = $stmt->fetchAll();
			  //fecth item name, price, quantity and seller's user_id
				$stmt = $pdo->prepare("SELECT item_name, price, quantity, user_id from items where item_id=:itemId");
				$stmt->execute(["itemId"=>$destin_id]);
				$item = $stmt->fetchAll();
			  //from above seller user_id fetch seller_name
				$stmt = $pdo->prepare("SELECT user_name from customer where user_id=:userId");
				$stmt->execute(["userId"=>$item[0]["user_id"]]);
				$seller = $stmt->fetchAll();
			  //fetch shipment fee, tracking number and arrival date from shpping
				$stmt = $pdo->prepare("SELECT shipping_price, tracking_number, arrival_date from shipping where item_id=:itemId");
				$stmt->execute(["itemId"=>$destin_id]);
				$ship = $stmt->fetchAll();
			//calculate remaning debt by subtracting price of item and its shipment fee with money paid
				$remaining_debt = ($ship[0]["shipping_price"] + $item[0]["price"])-$money;
			//calculate interestRate
				$interest_rate = interestRate($destin_id, $pdo);
				$itemName = $item[0]['item_name'];
				$userId = $credit_card_number[0]['user_id'];
				$buyerName = $buyer[0]['user_name'];
			$stmt = $pdo->prepare("INSERT INTO debt( item_id, item_name, remaining_debt, interest_rate, user_name, user_id) 
									VALUES( \"$destin_id\",\"$itemName\",\"$remaining_debt\",\"$interest_rate\", \"buyerName\", \"$userId\")");
			$stmt->execute([]);
	}
		
	function makeReceipt($money, $source_id, $destin_id, $payment_type, $amount, $pdo){
		//Note that [ source_id = user_id,   destin_id = item_id ]
		
		/**********NOTIFY SYSTEM***********/
		//Notify shipment service
		if($payment_type==0) {
			//Send notification that shipping fee has been payed and process tracking number
			
		}
		//Notify advertising
		elseif($payment_type==1) {
			//Send notification of the payment completed start advertising product
			
		}
		//Notify auction entrance
		elseif($payment_type==2 || $payment_type==4) {
			//Send notification that entrance payment has been made and user can start bidding
			
		}
		
		
		/**********GENERATE RECEIPT(INSERT INTO DATABASE TABLE)**********/
		//RECEIPT METHOD FOR buying item AND auction win
		if($payment_type==0 || $payment_type==3) {
			//fetch information from database tables
			  //fetch buyer name from customer table
				$stmt = $pdo->prepare("SELECT user_name from customer where user_id=:userId");
				$stmt->execute(["userId"=>$source_id]);
				$buyer = $stmt->fetchAll();
			  //fecth item name, price, quantity and seller's user_id
				$stmt = $pdo->prepare("SELECT item_name, price, quantity, uploader_id from items where item_id=:itemId");
				$stmt->execute(["itemId"=>$destin_id]);
				$item = $stmt->fetchAll();
			  //from above seller user_id fetch seller_name
				$stmt = $pdo->prepare("SELECT user_name from customer where user_id=:userId");
				$stmt->execute(["userId"=>$item[0]["uploader_id"]]);
				$seller = $stmt->fetchAll();
			  //fetch shipment fee, tracking number and arrival date from shpping
				$stmt = $pdo->prepare("SELECT shipping_price, tracking_number, arrival_date, user_id from shipping where item_id=:itemId");
				$stmt->execute(["itemId"=>$destin_id]);
				$ship = $stmt->fetchAll();
			
			//variable declaration of values tha are to be inserted into receipt tables	
				
				if($ship != null){
					$arrival_date = $ship[0]['arrival_date'];
					$tracking_number = $ship[0]['tracking_number'];
					$shipping_price = $ship[0]['shipping_price'];
					$shipperId = $ship[0]['user_id'];
				}
				else{
					$arrival_date = null;
					$tracking_number = null;
					$shipping_price = 0;
					$shipperId = null;
				}
				$seller_name = $seller[0]['user_name'];
				$buyer_name = $buyer[0]['user_name'];
				$item_name = $item[0]['item_name'];
				$price = $item[0]['price'];
				$quantity = $amount;
				$totalPrice = $money * $amount;
				$sellerId = $item[0]["uploader_id"];
				$shola_cut = sholaCut($totalPrice, $pdo);//Or this could also be written as $shola_cut = ($money-($price+$shipping_price)) * $quantity;
				
			//insert values into database table of buyer_reciept	
				$stmt = $pdo->prepare("INSERT INTO buyer_receipt( item_id, user_id,item_name, item_cost, item_quantity,
										time_of_purchase, seller_name, seller_address,  buyer_name, buyer_address,
										shipment_arrival, tracking_number, shipment_fee, spilt_pay, total_price) 
									VALUES(\"$destin_id\", \"$source_id\", \"$item_name\",\"$price\",\"$quantity\", now(), 
									\"$seller_name\",\"seller place\", \"$buyer_name\", 'buyer place', 
									\"$arrival_date\", \"$tracking_number\", \"$shipping_price\", '0', \"$totalPrice\")");
				$stmt->execute([]);
			
			//insert values into database table of seller_reciept				
				$stmt = $pdo->prepare("INSERT INTO seller_receipt( item_id, item_name, item_cost, item_quantity, 
									time_of_purchase, seller_name, seller_address, user_id, buyer_name, buyer_address, spilt_pay)
									VALUES(\"$destin_id\",\"$item_name\",\"$price\",\"$quantity\", now(),
									\"$seller_name\",\"seller place\",\"$sellerId\",\"$buyer_name\", 'buyer place', '0')");
				$stmt->execute([]);
			
			//insert values into database table of shipper_receipt	
			  if($ship != null){
				$stmt = $pdo->prepare("INSERT INTO shipper_receipt( item_id, item_name, item_quantity, 
									time_of_purchase, seller_name, seller_address, user_id, buyer_name, buyer_address,
									shipment_arrival, tracking_number, shipment_fee, spilt_pay)
									VALUES(\"$destin_id\",\"$item_name\",\"$quantity\", now(),
									\"$seller_name\",'seller place',\"$shipperId\",\"$buyer_name\", 'buyer place',
									\"$arrival_date\", \"$tracking_number\", \"$shipping_price\", '0')");
				$stmt->execute([]);
			  }
			
			//insert values into database table of shola_reciept
				
				$stmt = $pdo->prepare("INSERT INTO shola_receipt( item_id, item_cost, item_quantity, 
									time_of_purchase, seller_user_id,  buyer_user_id, shipper_user_id, 
									tracking_number, shipment_fee, shola_cut, spilt_pay, total_price)
									VALUES(\"$destin_id\",\"$price\",\"$quantity\", now(),
									\"$sellerId\",\"$source_id\",\"$shipperId\",\"$tracking_number\", \"$shipping_price\",
									\"$shola_cut\",'0',\"$totalPrice\")");
				$stmt->execute([]);
			
		}
		//RECEIPT METHOD FOR advertisment_receipt
		if($payment_type==1) {
			//fetch information from database tables
			  //fetch seller name from customer table
				$stmt = $pdo->prepare("SELECT user_name from customer where user_id=:userId");
				$stmt->execute(["userId"=>$source_id]);
				$seller = $stmt->fetchAll();
			  //fecth advertisment_id, cost_per_hour, advertisement_duration from advertising table
				//option 1
				$stmt = $pdo->prepare("SELECT ad_id, show_date, end_date from advertisement where user_id=:userId AND item_id=:itemId");
				$stmt->execute(["userId"=>$source_id, "itemId"=>$destin_id]);
				$ad = $stmt->fetchAll();
				/*
				//option 2
				$stmt = $pdo->prepare("SELECT user_id, ad_id, show_date, end_date from advertisment where item_id=:itemId");
				$stmt->execute(["itemId"=>$destin_id]);
				$ad = $stmt->fetchAll();
				*/
			
			//variable declaration of values tha are to be inserted into receipt tables	
				$seller_name = $seller[0]['user_name'];
				$advertismentId = $ad[0]['ad_id'];				
				$advertismentDuration = '';//subtract start_date from end_date
				//$sellerId = $ad[0]["user_id"];
				$stmt = $pdo->prepare("SELECT cost_per_hour from shola_info");
				$stmt->execute([]);
				$costperHour = $stmt->fetchAll();
				$cost_per_hour = $costperHour[0]["cost_per_hour"];
				
			//insert values into database table of advertisement_reciept	
				$stmt = $pdo->prepare("INSERT INTO advertisement_receipt( user_id, time_of_purchase, seller_name,
										cost_per_hour, advertisement_id, advertisement_duration, total_price) 
									VALUES(\"$source_id\", now(), \"$seller_name\",\"$cost_per_hour\",\"$advertismentId\",
									\"$advertismentDuration\", \"$money\" )");
				$stmt->execute([]);
	
		}
		//RECEIPT METHOD FOR auction entrance receipt
		elseif($payment_type==2 || $payment_type==4) {
			//fetch information from database tables
			  			
			//variable declaration of values that are to be inserted into receipt tables	
								
			//insert values into database table of auction_entrance_reciept	
			
		}
		//RECEIPT METHOD FOR split_pay receipt
		elseif($payment_type==6) {
			//fetch information from database tables
			  			
			//variable declaration of values that are to be inserted into receipt tables	
								
			//insert values into database table of split_pay_reciept	
			
		}
		
		
		
	}

	function displayReceipt($payment_type, $pdo){
	  //fetch data from receipt tables and populate the receipt form
	  
		if($payment_type == 0 || $payment_type == 3 || $payment_type == 8){
			//buyer_receipt for payment type 0(while buying item)
			$stmt = $pdo->prepare("SELECT  item_name, item_cost, item_quantity,
										time_of_purchase, seller_name, seller_address,  buyer_name, buyer_address,
										shipment_arrival, tracking_number, shipment_fee, spilt_pay, total_price FROM buyer_receipt								
								ORDER BY time_of_purchase DESC");
			$stmt->execute([]);		
			$receipt = $stmt->fetchAll();
			//item buying form
			echo '<table>
					<tr>
					<td>buyer_name</td><td>'.$receipt[0]["buyer_name"].'</td></tr>
					<tr>
					<td>time_of_purchase</td><td>'.$receipt[0]["time_of_purchase"].'</td></tr>
					<tr>
					<td>item_name</td><td>'.$receipt[0]["item_name"].'</td></tr>
					<tr>
					<td>item_cost</td><td>'.$receipt[0]["item_cost"].'</td></tr>
					<tr>
					<td>item_quantity</td><td>'.$receipt[0]["item_quantity"].'</td>	</tr>
					<tr>				
					<td>shipment_fee</td><td>'.$receipt[0]["shipment_fee"].'</td></tr>
					<tr>
					<td>tracking_number</td><td>'.$receipt[0]["tracking_number"].'</td></tr>
					<tr>
					<td>shipment_arrival</td><td>'.$receipt[0]["shipment_arrival"].'</td></tr>
					<tr>
					<td>total_price</td><td>'.$receipt[0]["total_price"].'</td>
					</tr>
				 </table>';
		}
		elseif($payment_type == 1){
			//advertisement reciept while buying ad
			$stmt = $pdo->prepare("SELECT   time_of_purchase, seller_name,
										cost_per_hour, advertisement_id, advertisement_duration, total_price FROM advertisement_receipt
								ORDER BY time_of_purchase DESC");		
			$stmt->execute([]);
			$adReceipt = $stmt->fetchAll();
			//ad form
			echo '<table>
					<tr>
					<td>seller_name</td><td>'.$adReceipt[0]["seller_name"].'</td></tr>
					<tr>
					<td>time_of_purchase</td><td>'.$adReceipt[0]["time_of_purchase"].'</td></tr>
					<tr>
					<td>advertisement_duration</td><td>'.$adReceipt[0]["advertisement_duration"].'</td></tr>
					<tr>
					<td>total_price</td><td>'.$adReceipt[0]["total_price"].'</td>
					</tr>
				 </table>';
		}
		elseif($payment_type == 2 || $payment_type == 4){
			//auction entrance and automatic auction entrance
			echo '<table>
					<tr>
					<td>seller_name</td><td>'.$adReceipt[0]["seller_name"].'</td></tr>
					<tr>
					<td>time_of_purchase</td><td>'.$adReceipt[0]["time_of_purchase"].'</td></tr>
					<tr>
					<td>advertisement_duration</td><td>'.$adReceipt[0]["advertisement_duration"].'</td></tr>
					<tr>
					<td>total_price</td><td>'.$adReceipt[0]["total_price"].'</td>
					</tr>
				 </table>';
		}
		elseif($payment_type == 6 ){
			//split_pay_reciept when split pay is used
			$stmt = $pdo->prepare("SELECT  item_name, item_quantity, time_of_purchase, seller_name, buyer_name,
										current_debt, interest_rate, already_paid_seller, already_paid_shipper, 
										already_paid_shola, total_price FROM split_pay_reciept								
								ORDER BY time_of_purchase DESC");
			$stmt->execute([]);	
			$spReceipt = $stmt->fetchAll();
			//split pay form
			echo '<table>
					<tr>
					<td>buyer_name</td><td>'.$spReceipt[0]["buyer_name"].'</td></tr>
					<tr>
					<td>time_of_purchase</td><td>'.$spReceipt[0]["time_of_purchase"].'</td></tr>
					<tr>
					<td>item_name</td><td>'.$spReceipt[0]["item_name"].'</td></tr>
					<tr>
					<td>item_quantity</td><td>'.$spReceipt[0]["item_quantity"].'</td>	</tr>
					<tr>				
					<td>current_debt</td><td>'.$spReceipt[0]["current_debt"].'</td></tr>
					<tr>
					<td>interest_rate</td><td>'.$spReceipt[0]["interest_rate"].'</td></tr>
					<tr>
					<td>already_paid_seller</td><td>'.$spReceipt[0]["already_paid_seller"].'</td></tr>
					<tr>
					<td>already_paid_shipper</td><td>'.$spReceipt[0]["already_paid_shipper"].'</td></tr>
					<tr>
					<td>already_paid_shola</td><td>'.$spReceipt[0]["already_paid_shola"].'</td></tr>
					<tr>
					<td>total_price</td><td>'.$spReceipt[0]["total_price"].'</td>
					</tr>
				 </table>';
		}
		else{
			echo 'You have Successfully conducted your payment.';
		}
	}
	
	function cuponIsUsed($destin_id, $offer_id){
		
	}
	
	function moneyDistribution($money, $source_id, $destin_id, $payment_type, $amount, $pdo_bank, $pdo) {
		//Note that [ source_id = credit_card,   destin_id = item_id ]
        $credit_card=$source_id;
		//buying item
        if($payment_type==0) {	
			//decrement the quantity of item bought from items table
				$stmt = $pdo->prepare("UPDATE items SET quantity=quantity-:item_quantity WHERE item_id=:itemId");
                $stmt->execute(["itemId" => $destin_id, "item_quantity"=>$amount]);
			//increment sell count by amount of item bought
				$item_quantity = $amount;
				$stmt = $pdo->prepare("UPDATE items SET sell_count=sell_count+:item_quantity WHERE item_id=:itemId");
                $stmt->execute(["itemId" => $destin_id, "item_quantity"=>$amount]);
            //debt buyer
              //get buyer's account_number using credit_card_number in the input
                $stmt = $pdo_bank->prepare("SELECT account_number from credit_card where credit_card_number=:cred");
                $stmt->execute(["cred"=>$credit_card]);
                $data = $stmt->fetchAll();
              //subtract money from buyer using money as a given parameter and account_number from above 
                $stmt = $pdo_bank->prepare("UPDATE bank_account SET balance=balance-:money WHERE account_number=:account_number");
                $stmt->execute(["money" => $money, "account_number"=>$data[0]["account_number"]]);
            //credit shola
              //calculate shola's cut from given money, shola cut is 2%
                $shola_cut = sholaCut($money, $pdo);
                $money=$money-$shola_cut;
              //get shola account number
				$shola_account_number=sholaAccount(0, $pdo);
              //add into shola's account an amount of money that is shola_cut from above and using shola_account_number
                $stmt = $pdo_bank->prepare("UPDATE bank_account SET balance=balance+:money WHERE account_number=:account_number");
                $stmt->execute(["money" => $shola_cut,"account_number"=>$shola_account_number]);
            //credit seller
              //get seller user_id, and item's price
                $stmt = $pdo->prepare("SELECT price, uploader_id from items where item_id=:item_id");
                $stmt->execute(["item_id"=>$destin_id]);
                $price = $stmt->fetchAll();
              //get credit_card_number for seller using user_id from above
                $stmt = $pdo->prepare("SELECT credit_card_number from credit_card_history where user_id=:user_id");
                $stmt->execute(["user_id"=>$price[0]["uploader_id"]]);
                $credit_card_number = $stmt->fetchAll();
              //get account_number for seller using credit_card_number from above
                $stmt = $pdo_bank->prepare("SELECT account_number from credit_card where credit_card_number=:cred");
                $stmt->execute(["cred"=>$credit_card_number[0]["credit_card_number"]]);
                $account_number = $stmt->fetchAll();
              //add to seller's balance an amount of money using price from above as amount of money and account_number from above
                $stmt = $pdo_bank->prepare("UPDATE bank_account SET balance=balance+:money WHERE account_number=:account_number");
                $stmt->execute(["money" => $price[0]["price"], "account_number"=>$account_number[0]["account_number"]]);
            //credit shipper
			  //get shipper user_id, and shipping price
                $stmt = $pdo->prepare("SELECT shipping_price, user_id from shipping where item_id=:item_id");
                $stmt->execute(["item_id"=>$destin_id]);
                $ship = $stmt->fetchAll();
			  if($ship != null){
              //get credit_card_number for shipper using user_id from above
                $stmt = $pdo->prepare("SELECT credit_card_number from credit_card_history where user_id=:user_id");
                $stmt->execute(["user_id"=>$ship[0]["user_id"]]);
                $credit_card_number = $stmt->fetchAll();
              //get account_number for shipper using credit_card_number from above
                $stmt = $pdo_bank->prepare("SELECT account_number from credit_card where credit_card_number=:cred");
                $stmt->execute(["cred"=>$credit_card_number[0]["credit_card_number"]]);
                $account_number = $stmt->fetchAll();
              //add to shipper's balance an amount of money using price from above as amount of money and account_number from above
                $stmt = $pdo_bank->prepare("UPDATE bank_account SET balance=balance+:money WHERE account_number=:account_number");
                $stmt->execute(["money" => $ship[0]["shipping_price"], "account_number"=>$account_number[0]["account_number"]]);			
			  }

        }
        //advertising
        elseif ($payment_type==1){
            //debt seller
              //get seller's account_number using credit_card_number in the input
                $stmt = $pdo_bank->prepare("SELECT account_number from credit_card where credit_card_number=:cred");
                $stmt->execute(["cred"=>$credit_card]);
                $data = $stmt->fetchAll();
              //subtract money from seller account using money as a given parameter and account_number from above 
                $stmt = $pdo_bank->prepare("UPDATE bank_account SET balance=balance-:money WHERE account_number=:account_number");
                $stmt->execute(["money" => $money, "account_number"=>$data[0]["account_number"]]);
                
            //cerdit shola
              //get shola account number
                $shola_account_number=sholaAccount(0, $pdo);
              //add into shola account the money debted from seller account
                $stmt = $pdo_bank->prepare("UPDATE bank_account SET balance=balance+:money WHERE account_number=:account_number");
                $stmt->execute(["money" => $money, "account_number"=>$shola_account_number]);
        }
        //auction entrance
        elseif ($payment_type==2){
            //debt bidder
              //get bidder's account_number using credit_card_number in the input
                $stmt = $pdo_bank->prepare("SELECT account_number from credit_card where credit_card_number=:cred");
                $stmt->execute(["cred"=>$credit_card]);
                $data = $stmt->fetchAll();
              //subtract money from bidder account using money as a given parameter and account_number from above 
                $stmt = $pdo_bank->prepare("UPDATE bank_account SET balance=balance-:money WHERE account_number=:account_number");
                $stmt->execute(["money" => $money, "account_number"=>$data[0]["account_number"]]);

            //cerdit shola
              //get shola account number
                $shola_temporary_account_number=sholaAccount(1, $pdo);
              //add into shola account the money debted from bidder account
                $stmt = $pdo_bank->prepare("UPDATE bank_account SET balance=balance+:money WHERE account_number=:account_number");
                $stmt->execute(["money" => $money, "account_number"=>$shola_temporary_account_number]);
        }
        //auction victory
        elseif ($payment_type==3){
            //debt bidder
              //subtracting entrance fee from total item price
                $entrance_fee=100;
                $money=$money-$entrance_fee;
              //get bidder's account_number using credit_card_number in the input
                $stmt = $pdo_bank->prepare("SELECT account_number from credit_card where credit_card_number=:cred");
                $stmt->execute(["cred"=>$credit_card]);
                $data = $stmt->fetchAll();
              //subtract money from bidder using money as a given parameter and account_number from above 
                $stmt = $pdo_bank->prepare("UPDATE bank_account SET balance=balance-:money WHERE account_number=:account_number");
                $stmt->execute(["money" => $money, "account_number"=>$data[0]["account_number"]]);
            //credit shola
              //calculate shola's cut from given money, shola cut is 2%
                $shola_cut=sholaCut($money, $pdo);
                $money=$money-$shola_cut;
              //get shola account number
                $shola_account_number=sholaAccount(0, $pdo);
              //add into shola's account an amount of money that is shola_cut from above and using shola_account_number
                $stmt = $pdo_bank->prepare("UPDATE bank_account SET balance=balance+:money WHERE account_number=:account_number");
                $stmt->execute(["money" => $shola_cut,"account_number"=>$shola_account_number]);
            //credit seller
              //get seller user_id, and item's price
                $stmt = $pdo->prepare("SELECT price, uploader_id from items where item_id=:item_id");
                $stmt->execute(["item_id"=>$destin_id]);
                $price = $stmt->fetchAll();
              //get credit_card_number for seller using user_id from above
                $stmt = $pdo->prepare("SELECT credit_card_number from credit_card_history where user_id=:user_id");
                $stmt->execute(["user_id"=>$price[0]["uploader_id"]]);
                $credit_card_number = $stmt->fetchAll();
              //get account_number for seller using credit_card_number from above
                $stmt = $pdo_bank->prepare("SELECT account_number from credit_card where credit_card_number=:cred");
                $stmt->execute(["cred"=>$credit_card_number[0]["credit_card_number"]]);
                $account_number = $stmt->fetchAll();
              //add to seller's balance an amount of money using price from above as amount of money and account_number from above
                $stmt = $pdo_bank->prepare("UPDATE bank_account SET balance=balance+:money WHERE account_number=:account_number");
                $stmt->execute(["money" => $price[0]["price"], "account_number"=>$account_number[0]["account_number"]]);
            //credit shipper
			  //get shipper user_id, and shipping price
                $stmt = $pdo->prepare("SELECT shipping_price, user_id from shipping where item_id=:item_id");
                $stmt->execute(["item_id"=>$destin_id]);
                $ship = $stmt->fetchAll();
			  if($ship != null){
              //get credit_card_number for shipper using user_id from above
                $stmt = $pdo->prepare("SELECT credit_card_number from credit_card_history where user_id=:user_id");
                $stmt->execute(["user_id"=>$ship[0]["user_id"]]);
                $credit_card_number = $stmt->fetchAll();
              //get account_number for shipper using credit_card_number from above
                $stmt = $pdo_bank->prepare("SELECT account_number from credit_card where credit_card_number=:cred");
                $stmt->execute(["cred"=>$credit_card_number[0]["credit_card_number"]]);
                $account_number = $stmt->fetchAll();
              //add to shipper's balance an amount of money using price from above as amount of money and account_number from above
                $stmt = $pdo_bank->prepare("UPDATE bank_account SET balance=balance+:money WHERE account_number=:account_number");
                $stmt->execute(["money" => $ship[0]["shipping_price"], "account_number"=>$account_number[0]["account_number"]]);
			  }
        }
        //automatic auction entrance
        elseif ($payment_type==4){
            //debt bidder
              //get bidder's account_number using credit_card_number in the input
                $stmt = $pdo_bank->prepare("SELECT account_number from credit_card where credit_card_number=:cred");
                $stmt->execute(["cred"=>$credit_card]);
                $data = $stmt->fetchAll();
              //subtract money from bidder account using money as a given parameter and account_number from above 
                $stmt = $pdo_bank->prepare("UPDATE bank_account SET balance=balance-:money WHERE account_number=:account_number");
                $stmt->execute(["money" => $money, "account_number"=>$data[0]["account_number"]]);

            //cerdit shola
              //get shola account number
                $shola_temporary_account_number=sholaAccount(1, $pdo);
              //add into shola account the money debted from bidder account
                $stmt = $pdo_bank->prepare("UPDATE bank_account SET balance=balance+:money WHERE account_number=:account_number");
                $stmt->execute(["money" => $money, "account_number"=>$shola_temporary_account_number]);
        }
        //refund(return item)
        elseif($payment_type==5){
            //credit buyer
              //get buyer's account number using credit_card from given parameter
                $stmt = $pdo_bank->prepare("SELECT account_number from credit_card where credit_card_number=:cred");
                $stmt->execute(["cred"=>$credit_card]);
                $buyer_account = $stmt->fetchAll();
              //add money into buyer's account using account_number from above
                $stmt = $pdo_bank->prepare("UPDATE bank_account SET balance=balance+:money WHERE account_number=:account_number");
                $stmt->execute(["money" => $money, "account_number"=>$buyer_account[0]["account_number"]]);

            //debt seller
              //get seller user_id, and item's price
                $stmt = $pdo->prepare("SELECT price, uploader_id from items where item_id=:item_id");
                $stmt->execute(["item_id"=>$destin_id]);
                $price = $stmt->fetchAll();
              //get credit_card_number for seller using user_id from above
                $stmt = $pdo->prepare("SELECT credit_card_number from credit_card_history where user_id=:user_id");
                $stmt->execute(["user_id"=>$price[0]["uploader_id"]]);
                $credit_card_number = $stmt->fetchAll();
              //get account_number for seller using credit_card_number from above
                $stmt = $pdo_bank->prepare("SELECT account_number from credit_card where credit_card_number=:cred");
                $stmt->execute(["cred"=>$credit_card_number[0]["credit_card_number"]]);
                $account_number = $stmt->fetchAll();
              //subtract from seller's balance an amount of money using price from above as amount of money and account_number from above
                $stmt = $pdo_bank->prepare("UPDATE bank_account SET balance=balance-:money WHERE account_number=:account_number");
                $stmt->execute(["money" => $price[0]["price"], "account_number"=>$account_number[0]["account_number"]]);
                $money=$money-$price;
            //debt shola
              //get shola account number
                $shola_account_number=sholaAccount(0, $pdo);
              //subtract from shola account the money credited for buyer account
                $stmt = $pdo_bank->prepare("UPDATE bank_account SET balance=balance-:money WHERE account_number=:account_number");
                $stmt->execute(["money" => $money, "account_number"=>$shola_account_number]);
		}
		//if it is split payment
		elseif($payment_type==6){
			//debt buyer
              //get buyer's account_number using credit_card_number in the input
                $stmt = $pdo_bank->prepare("SELECT account_number from credit_card where credit_card_number=:cred");
                $stmt->execute(["cred"=>$credit_card]);
                $data = $stmt->fetchAll();
              //subtract money from buyer using money as a given parameter and account_number from above 
                $stmt = $pdo_bank->prepare("UPDATE bank_account SET balance=balance-:money WHERE account_number=:account_number");
                $stmt->execute(["money" => $money, "account_number"=>$data[0]["account_number"]]);
            //credit shola
              //calculate shola's cut from given money, shola cut is 2%
                $shola_cut=sholaCut($money, $pdo);
                $money=$money-$shola_cut;
              //get shola account number
                $shola_account_number=sholaAccount(0, $pdo);
              //add into shola's account an amount of money that is shola_cut from above and using shola_account_number
                $stmt = $pdo_bank->prepare("UPDATE bank_account SET balance=balance+:money WHERE account_number=:account_number");
                $stmt->execute(["money" => $shola_cut,"account_number"=>$shola_account_number]);
            //credit seller
              //get seller user_id, and item's price
                $stmt = $pdo->prepare("SELECT price, uploader_id from items where item_id=:item_id");
                $stmt->execute(["item_id"=>$destin_id]);
                $price = $stmt->fetchAll();
              //get credit_card_number for seller using user_id from above
                $stmt = $pdo->prepare("SELECT credit_card_number from credit_card_history where user_id=:user_id");
                $stmt->execute(["user_id"=>$price[0]["uploader_id"]]);
                $credit_card_number = $stmt->fetchAll();
              //get account_number for seller using credit_card_number from above
                $stmt = $pdo_bank->prepare("SELECT account_number from credit_card where credit_card_number=:cred");
                $stmt->execute(["cred"=>$credit_card_number[0]["credit_card_number"]]);
                $account_number = $stmt->fetchAll();
              //add to seller's balance an amount of money using price from above as amount of money and account_number from above
                $stmt = $pdo_bank->prepare("UPDATE bank_account SET balance=balance+:money WHERE account_number=:account_number");
                $stmt->execute(["money" => $price[0]["price"]*0.1, "account_number"=>$account_number[0]["account_number"]]);
            //credit shipper
			  //get shipper user_id, and shipping price
                $stmt = $pdo->prepare("SELECT shipping_price, user_id from shipping where item_id=:item_id");
                $stmt->execute(["item_id"=>$destin_id]);
                $ship = $stmt->fetchAll();
			  if($ship != null){
              //get credit_card_number for shipper using user_id from above
                $stmt = $pdo->prepare("SELECT credit_card_number from credit_card_history where user_id=:user_id");
                $stmt->execute(["user_id"=>$ship[0]["user_id"]]);
                $credit_card_number = $stmt->fetchAll();
              //get account_number for shipper using credit_card_number from above
                $stmt = $pdo_bank->prepare("SELECT account_number from credit_card where credit_card_number=:cred");
                $stmt->execute(["cred"=>$credit_card_number[0]["credit_card_number"]]);
                $account_number = $stmt->fetchAll();
              //add to shipper's balance an amount of money using price from above as amount of money and account_number from above
                $stmt = $pdo_bank->prepare("UPDATE bank_account SET balance=balance+:money WHERE account_number=:account_number");
                $stmt->execute(["money" => $ship[0]["shipping_price"]*0.1, "account_number"=>$account_number[0]["account_number"]]);
			  }
		}
		//if resolveing debt
		elseif($payment_type==7){
			//debt buyer
              //get buyer's account_number using credit_card_number in the input
                $stmt = $pdo_bank->prepare("SELECT account_number from credit_card where credit_card_number=:cred");
                $stmt->execute(["cred"=>$credit_card]);
                $data = $stmt->fetchAll();
              //subtract money from buyer using money as a given parameter and account_number from above 
                $stmt = $pdo_bank->prepare("UPDATE bank_account SET balance=balance-:money WHERE account_number=:account_number");
                $stmt->execute(["money" => $money, "account_number"=>$data[0]["account_number"]]);
            //credit shola
              //calculate shola's cut from given money, shola cut is 2%
				$interest = interestRate($destin_id, $pdo);
				$money = $money+($money*$interest);
                $shola_cut = sholaCut($money, $pdo);
                $money=$money-$shola_cut;
              //get shola account number
                $shola_account_number=sholaAccount(0, $pdo);
              //add into shola's account an amount of money that is shola_cut from above and using shola_account_number
                $stmt = $pdo_bank->prepare("UPDATE bank_account SET balance=balance+:money WHERE account_number=:account_number");
                $stmt->execute(["money" => $shola_cut,"account_number"=>$shola_account_number]);
            //credit seller
              //get seller user_id, and item's price
                $stmt = $pdo->prepare("SELECT price, uploader_id from items where item_id=:item_id");
                $stmt->execute(["item_id"=>$destin_id]);
                $price = $stmt->fetchAll();
              //get credit_card_number for seller using user_id from above
                $stmt = $pdo->prepare("SELECT credit_card_number from credit_card_history where user_id=:user_id");
                $stmt->execute(["user_id"=>$price[0]["uploader_id"]]);
                $credit_card_number = $stmt->fetchAll();
              //get account_number for seller using credit_card_number from above
                $stmt = $pdo_bank->prepare("SELECT account_number from credit_card where credit_card_number=:cred");
                $stmt->execute(["cred"=>$credit_card_number[0]["credit_card_number"]]);
                $account_number = $stmt->fetchAll();
              //add to seller's balance an amount of money using price from above as amount of money and account_number from above				
                $stmt = $pdo_bank->prepare("UPDATE bank_account SET balance=balance+:money WHERE account_number=:account_number");
                $stmt->execute(["money" =>$money , "account_number"=>$account_number[0]["account_number"]]);

		}
		//if item is bought by discount
		elseif ($payment_type==8){
            //debt buyer
              //get buyer's account_number using credit_card_number in the input
                $stmt = $pdo_bank->prepare("SELECT account_number from credit_card where credit_card_number=:cred");
                $stmt->execute(["cred"=>$credit_card]);
                $data = $stmt->fetchAll();
              //subtract money from buyer using money as a given parameter and account_number from above 
                $stmt = $pdo_bank->prepare("UPDATE bank_account SET balance=balance-:money WHERE account_number=:account_number");
                $stmt->execute(["money" => $money, "account_number"=>$data[0]["account_number"]]);
            //credit shola
              //calculate shola's cut from given money, shola cut is 2%
                $shola_cut=sholaCut($money, $pdo);
                $money=$money-$shola_cut;
              //get shola account number
                $shola_account_number=sholaAccount(0, $pdo);
              //add into shola's account an amount of money that is shola_cut from above and using shola_account_number
                $stmt = $pdo_bank->prepare("UPDATE bank_account SET balance=balance+:money WHERE account_number=:account_number");
                $stmt->execute(["money" => $shola_cut,"account_number"=>$shola_account_number]);
            //credit seller
              //get seller user_id, and item's price
                $stmt = $pdo->prepare("SELECT price, uploader_id from items where item_id=:item_id");
                $stmt->execute(["item_id"=>$destin_id]);
                $price = $stmt->fetchAll();
              //get credit_card_number for seller using user_id from above
                $stmt = $pdo->prepare("SELECT credit_card_number from credit_card_history where user_id=:user_id");
                $stmt->execute(["user_id"=>$price[0]["uploader_id"]]);
                $credit_card_number = $stmt->fetchAll();
              //get account_number for seller using credit_card_number from above
                $stmt = $pdo_bank->prepare("SELECT account_number from credit_card where credit_card_number=:cred");
                $stmt->execute(["cred"=>$credit_card_number[0]["credit_card_number"]]);
                $account_number = $stmt->fetchAll();
              //add to seller's balance an amount of money using price from above as amount of money and account_number from above
                $stmt = $pdo_bank->prepare("UPDATE bank_account SET balance=balance+:money WHERE account_number=:account_number");
                $stmt->execute(["money" => $price[0]["price"], "account_number"=>$account_number[0]["account_number"]]);
            //credit shipper
			  //get shipper user_id, and shipping price
                $stmt = $pdo->prepare("SELECT shipping_price, user_id from shipping where item_id=:item_id");
                $stmt->execute(["item_id"=>$destin_id]);
                $ship = $stmt->fetchAll();
			  if($ship != null){
              //get credit_card_number for shipper using user_id from above
                $stmt = $pdo->prepare("SELECT credit_card_number from credit_card_history where user_id=:user_id");
                $stmt->execute(["user_id"=>$ship[0]["user_id"]]);
                $credit_card_number = $stmt->fetchAll();
              //get account_number for shipper using credit_card_number from above
                $stmt = $pdo_bank->prepare("SELECT account_number from credit_card where credit_card_number=:cred");
                $stmt->execute(["cred"=>$credit_card_number[0]["credit_card_number"]]);
                $account_number = $stmt->fetchAll();
              //add to shipper's balance an amount of money using price from above as amount of money and account_number from above
                $stmt = $pdo_bank->prepare("UPDATE bank_account SET balance=balance+:money WHERE account_number=:account_number");
                $stmt->execute(["money" => $ship[0]["shipping_price"], "account_number"=>$account_number[0]["account_number"]]);
			  }
        }

	}

    function checkBalance($credit_card, $money, $pdo_bank) {

        $stmt = $pdo_bank->prepare("SELECT account_number from credit_card where credit_card_number=:cred");
        $stmt->execute(["cred"=>$credit_card]);
        $data = $stmt->fetchAll();
        
        $stmt = $pdo_bank->prepare("SELECT balance from bank_account where account_number=:account");
        $stmt->execute(["account"=>$data[0]["account_number"]]);
        $data = $stmt->fetchAll();
        
        if ($data[0]["balance"] >= $money + 50) {
            return 0; //sufficient
        } else {
            return 1;
        }
        
    }

    function verifyCreditCard($credit_card, $expiration_date, $security_code, $pdo_bank) {

        /** First check if credit card exists **/
        
        $stmt = $pdo_bank->prepare("SELECT zip_code from credit_card where credit_card_number=:cred");
        $stmt->execute(["cred"=>$credit_card]);
        $data = $stmt->fetchAll();

        if ($data == null) {
            return 1; // Credit card is not found
        }

        /** Then check if credit card has expired or if wrong credit card expiration date is entered **/
        
        $stmt = $pdo_bank->prepare("SELECT zip_code from credit_card where credit_card_number=:cred and expiration_date=:exp_date and expiration_date > now()");
        $stmt->execute(["exp_date"=>$expiration_date, "cred"=>$credit_card]);
        $data = $stmt->fetchAll();

        if ($data==null) {
            return 2; // wrong expiration date entered or credit card has expired
        }

        /** Validate credit card security code **/

        $stmt = $pdo_bank->prepare("SELECT security_code from credit_card where credit_card_number=:cred");
        $stmt->execute(["cred"=>$credit_card]);
        $data = $stmt->fetchAll();

        if (!password_verify($security_code, $data[0]["security_code"])) {
            return 3; //wrong security code
        }
		return 0; // the user has provided correct credit card information
        
    }

?>
