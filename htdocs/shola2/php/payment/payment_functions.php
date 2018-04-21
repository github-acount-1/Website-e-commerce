<?php

	function autoFill($source_id, $type, $pdo_bank, $pdo){
		//fetch user's credit card number from history
		$stmt = $pdo->prepare("SELECT credit_card_number from credit_card_history where user_id=:user_id");
        $stmt->execute(["user_id"=>$source_id]);
        $credit_card = $stmt->fetchAll();
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
		//get shipping price
			$stmt = $pdo->prepare("SELECT shipping_price from shipping where item_id=:item_id");
            $stmt->execute(["item_id"=>$destin_id]);
            $ship = $stmt->fetchAll();
		//get item's price
            $stmt = $pdo->prepare("SELECT price from items where item_id=:item_id");
            $stmt->execute(["item_id"=>$destin_id]);
            $price = $stmt->fetchAll();
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
	
	function interestRate($item_id){
		//currentlly interestRate() has a constant values
		return 0.1;
	}
	
	function resolveDebt($money, $source_id, $destin_id, $pdo_bank, $pdo){
		if($destin_id==null){
			//Get user id of user that is resolving debt
			$stmt = $pdo->prepare("SELECT user_id from credit_card_history where credit_card_number=:cred");
            $stmt->execute(["cred"=>$source_id]);
            $user_info = $stmt->fetchAll();
			//Using the user id from above get every row that has the user id of this user
			$stmt = $pdo->prepare("SELECT item_id, remaining_debt from debt where user_id=:usre_id");
            $stmt->execute(["user_id"=>$user_info[0]["user_id"]]);
            $debts = $stmt->fetchAll();			
			//from each items stated above resolve the debt by paying money to leanders
			for($i=0; $i<count($debts);$i++){
				moneyDistribution($debts[$i]["remaining_debt"], $source_id, $debts[$i]["item_id"], 7, $pdo_bank, $pdo);
			}
						
		}
		else{
			moneyDistribution($money, $source_id, $destin_id, 7, $pdo_bank, $pdo);
		}
	}
	
	function splitPay($money, $source_id, $destin_id, $pdo_bank, $pdo){
		//if split pay
			$money=$money*0.1;
			moneyDistribution($money, $source_id, $destin_id, 6, $pdo_bank, $pdo);
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
				$interest_rate = interestRate($destin_id);
			$stmt = $pdo->prepare("INSERT INTO debt( item_id, item_name, remaining_debt, interest_rate, user_name, user_id) 
									VALUES(:item_id,':item_name',:remaining_debt,:interest_rate, ':user_name', ':user_id')");
			$stmt->execute(["item_id" =>$destin_id, "item_name"=>$item[0]['item_name'], "remaining_debt"=>$remaining_debt,
							"interest_rate"=>$interest_rate,"user_name"=>$buyer[0]['user_name'], "user_id"=>$credit_card_number[0]['user_id']]);
	}
		
	function makeReceipt($money, $source_id, $destin_id, $payment_type, $pdo){
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
				$stmt = $pdo->prepare("SELECT item_name, price, quantity, user_id from items where item_id=:itemId");
				$stmt->execute(["itemId"=>$destin_id]);
				$item = $stmt->fetchAll();
			  //from above seller user_id fetch seller_name
				$stmt = $pdo->prepare("SELECT user_name from customer where user_id=:userId");
				$stmt->execute(["userId"=>$item[0]["user_id"]]);
				$seller = $stmt->fetchAll();
			  //fetch shipment fee, tracking number and arrival date from shpping
				$stmt = $pdo->prepare("SELECT shipping_price, tracking_number, arrival_date, user_id from shipping where item_id=:itemId");
				$stmt->execute(["itemId"=>$destin_id]);
				$ship = $stmt->fetchAll();
			
			//variable declaration of values tha are to be inserted into receipt tables	
				$seller_name = $seller[0]['user_name'];
				$buyer_name = $buyer[0]['user_name'];
				$arrival_date = $ship[0]['arrival_date'];
				$tracking_number = $ship[0]['tracking_number'];
				$shipping_price = $ship[0]['shipping_price'];
				$shipperId = $ship[0]['user_id'];
				$item_name = $item[0]['item_name'];
				$price = $item[0]['price'];
				$quantity = $item[0]['quantity'];
				$sellerId = $item[0]["user_id"];
				$shola_cut = $money*0.02;//Or this could also be written as $shola_cut = $money-($price+$shipping_price);
				
			//insert values into database table of buyer_reciept	
				$stmt = $pdo->prepare("INSERT INTO buyer_receipt( item_id, user_id,item_name, item_cost, item_quantity,
										time_of_purchase, seller_name, seller_address,  buyer_name, buyer_address,
										shipment_arrival, tracking_number, shipment_fee, spilt_pay, total_price) 
									VALUES(\"$destin_id\", \"$source_id\", \"$item_name\",\"$price\",\"$quantity\", now(), 
									\"$seller_name\",\"seller place\", \"$buyer_name\", 'buyer place', 
									\"$arrival_date\", \"$tracking_number\", \"$shipping_price\", '0', \"$money\")");
				$stmt->execute([]);
			
			//insert values into database table of seller_reciept				
				$stmt = $pdo->prepare("INSERT INTO seller_receipt( item_id, item_name, item_cost, item_quantity, 
									time_of_purchase, seller_name, seller_address, user_id, buyer_name, buyer_address, spilt_pay)
									VALUES(\"$destin_id\",\"$item_name\",\"$price\",\"$quantity\", now(),
									\"$seller_name\",\"seller place\",\"$sellerId\",\"$buyer_name\", 'buyer place', '0')");
				$stmt->execute([]);
			
			//insert values into database table of shipper_receipt				
				$stmt = $pdo->prepare("INSERT INTO shipper_receipt( item_id, item_name, item_quantity, 
									time_of_purchase, seller_name, seller_address, user_id, buyer_name, buyer_address,
									shipment_arrival, tracking_number, shipment_fee, spilt_pay)
									VALUES(\"$destin_id\",\"$item_name\",\"$quantity\", now(),
									\"$seller_name\",'seller place',\"$shipperId\",\"$buyer_name\", 'buyer place',
									\"$arrival_date\", \"$tracking_number\", \"$shipping_price\", '0')");
				$stmt->execute([]);
			
			//insert values into database table of shola_reciept
				
				$stmt = $pdo->prepare("INSERT INTO shola_receipt( item_id, item_cost, item_quantity, 
									time_of_purchase, seller_user_id,  buyer_user_id, shipper_user_id, 
									tracking_number, shipment_fee, shola_cut, split_pay, total_price)
									VALUES(\"$destin_id\",\"$price\",\"$quantity\", now(),
									\"$sellerId\",\"$source_id\",\"$shipperId\",\"$tracking_number\", \"$shipping_price\",
									\"$shola_cut\",'0',\"$money\")");
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
				$stmt = $pdo->prepare("SELECT ad_id, show_date, end_date from advertisement where user_id=:userId");
				$stmt->execute(["userId"=>$source_id]);
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
				$advertismentDuration = '';
				//$sellerId = $ad[0]["user_id"];
				$cost_per_hour = 100;//FIXED PRICE FOR NOW REMOVE HARD CODE IN TEST PHASE
				
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
		
	function moneyDistribution($money, $source_id, $destin_id, $payment_type, $pdo_bank, $pdo) {
		//Note that [ source_id = credit_card,   destin_id = item_id ]
        $credit_card=$source_id;
		//buying item
        if($payment_type==0) {
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
                $shola_cut=$money*0.02;
                $money=$money-$shola_cut;
              //get shola account number
                $shola_account_number=10000212549999;
              //add into shola's account an amount of money that is shola_cut from above and using shola_account_number
                $stmt = $pdo_bank->prepare("UPDATE bank_account SET balance=balance+:money WHERE account_number=:account_number");
                $stmt->execute(["money" => $shola_cut,"account_number"=>$shola_account_number]);
            //credit seller
              //get seller user_id, and item's price
                $stmt = $pdo->prepare("SELECT price, user_id from items where item_id=:item_id");
                $stmt->execute(["item_id"=>$destin_id]);
                $price = $stmt->fetchAll();
              //get credit_card_number for seller using user_id from above
                $stmt = $pdo->prepare("SELECT credit_card_number from credit_card_history where user_id=:user_id");
                $stmt->execute(["user_id"=>$price[0]["user_id"]]);
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
                $shola_account_number=10000212549999;
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
                $shola_temporary_account_number=10000212549999;
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
                $shola_cut=$money*0.02;
                $money=$money-$shola_cut;
              //get shola account number
                $shola_account_number=10000212549999;
              //add into shola's account an amount of money that is shola_cut from above and using shola_account_number
                $stmt = $pdo_bank->prepare("UPDATE bank_account SET balance=balance+:money WHERE account_number=:account_number");
                $stmt->execute(["money" => $shola_cut,"account_number"=>$shola_account_number]);
            //credit seller
              //get seller user_id, and item's price
                $stmt = $pdo->prepare("SELECT price, user_id from items where item_id=:item_id");
                $stmt->execute(["item_id"=>$destin_id]);
                $price = $stmt->fetchAll();
              //get credit_card_number for seller using user_id from above
                $stmt = $pdo->prepare("SELECT credit_card_number from credit_card_history where user_id=:user_id");
                $stmt->execute(["user_id"=>$price[0]["user_id"]]);
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
                $shola_temporary_account_number=10000212549999;
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
                $stmt = $pdo->prepare("SELECT price, user_id from items where item_id=:item_id");
                $stmt->execute(["item_id"=>$destin_id]);
                $price = $stmt->fetchAll();
              //get credit_card_number for seller using user_id from above
                $stmt = $pdo->prepare("SELECT credit_card_number from credit_card_history where user_id=:user_id");
                $stmt->execute(["user_id"=>$price[0]["user_id"]]);
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
                $shola_account_number=10000212549999;
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
                $shola_cut=$money*0.02;
                $money=$money-$shola_cut;
              //get shola account number
                $shola_account_number=10000212549999;
              //add into shola's account an amount of money that is shola_cut from above and using shola_account_number
                $stmt = $pdo_bank->prepare("UPDATE bank_account SET balance=balance+:money WHERE account_number=:account_number");
                $stmt->execute(["money" => $shola_cut,"account_number"=>$shola_account_number]);
            //credit seller
              //get seller user_id, and item's price
                $stmt = $pdo->prepare("SELECT price, user_id from items where item_id=:item_id");
                $stmt->execute(["item_id"=>$destin_id]);
                $price = $stmt->fetchAll();
              //get credit_card_number for seller using user_id from above
                $stmt = $pdo->prepare("SELECT credit_card_number from credit_card_history where user_id=:user_id");
                $stmt->execute(["user_id"=>$price[0]["user_id"]]);
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
				$interest=interestRate($destin_id);
                $shola_cut=($money+($money*$interest))*0.02;
                $money=$money-$shola_cut;
              //get shola account number
                $shola_account_number=10000212549999;
              //add into shola's account an amount of money that is shola_cut from above and using shola_account_number
                $stmt = $pdo_bank->prepare("UPDATE bank_account SET balance=balance+:money WHERE account_number=:account_number");
                $stmt->execute(["money" => $shola_cut,"account_number"=>$shola_account_number]);
            //credit seller
              //get seller user_id, and item's price
                $stmt = $pdo->prepare("SELECT price, user_id from items where item_id=:item_id");
                $stmt->execute(["item_id"=>$destin_id]);
                $price = $stmt->fetchAll();
              //get credit_card_number for seller using user_id from above
                $stmt = $pdo->prepare("SELECT credit_card_number from credit_card_history where user_id=:user_id");
                $stmt->execute(["user_id"=>$price[0]["user_id"]]);
                $credit_card_number = $stmt->fetchAll();
              //get account_number for seller using credit_card_number from above
                $stmt = $pdo_bank->prepare("SELECT account_number from credit_card where credit_card_number=:cred");
                $stmt->execute(["cred"=>$credit_card_number[0]["credit_card_number"]]);
                $account_number = $stmt->fetchAll();
              //add to seller's balance an amount of money using price from above as amount of money and account_number from above				
                $stmt = $pdo_bank->prepare("UPDATE bank_account SET balance=balance+:money WHERE account_number=:account_number");
                $stmt->execute(["money" =>$money , "account_number"=>$account_number[0]["account_number"]]);

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
