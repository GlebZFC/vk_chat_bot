<?php
	$locale_name = setlocale(LC_ALL, "ru_RU.CP1251");
	
	function get_item(){
		$res = "";
		
		$handle = fopen("items.txt", "r");
		if($handle){
			$str_cnt = 0;
			while (($buffer = fgets($handle, 4096)) !== false) {
				$str_cnt++;
			}
			fclose($handle);
			$handle = fopen("items.txt", "r");
			$rand_n = rand(0, $str_cnt);
			$str_cnt = 0;
			while (($buffer = fgets($handle, 4096)) !== false) {
				if($str_cnt == $rand_n){
					//echo $buffer;
					$res = $buffer;
					break;
				}
				$str_cnt++;
			}
			fclose($handle);
		}
		
		$res = substr($res, 0, strlen($res)-1);
		
		
		return $res;
	}

	function get_name(){
		$res = "";

		$handle = fopen("names.txt", "r");
		if($handle){
			$str_cnt = 0;
			while (($buffer = fgets($handle, 4096)) !== false) {
				$str_cnt++;
			}
			fclose($handle);
			$handle = fopen("names.txt", "r");
			$rand_n = rand(0, $str_cnt);
			$str_cnt = 0;
			while (($buffer = fgets($handle, 4096)) !== false) {
				if($str_cnt == $rand_n){
					//echo $buffer;
					$res = $buffer;
					break;
				}
				$str_cnt++;
			}
			fclose($handle);
		}
		
		$res = substr($res, 0, strlen($res)-1);
		
		
		return $res;
	}

	function get_verb(){
		$res = "";

		$handle = fopen("verbs.txt", "r");
		if($handle){
			$str_cnt = 0;
			while (($buffer = fgets($handle, 4096)) !== false) {
				$str_cnt++;
			}
			fclose($handle);
			$handle = fopen("verbs.txt", "r");
			$rand_n = rand(0, $str_cnt);
			$str_cnt = 0;
			while (($buffer = fgets($handle, 4096)) !== false) {
				if($str_cnt == $rand_n){
					//echo $buffer;
					$res = $buffer;
					break;
				}
				$str_cnt++;
			}
			fclose($handle);
		}
		
		$res = substr($res, 0, strlen($res)-1);
		
		return $res;
	}

	function get_narech(){
		$res = "";

		$handle = fopen("narech.txt", "r");
		if($handle){
			$str_cnt = 0;
			while (($buffer = fgets($handle, 4096)) !== false) {
				$str_cnt++;
			}
			fclose($handle);
			$handle = fopen("narech.txt", "r");
			$rand_n = rand(0, $str_cnt);
			$str_cnt = 0;
			while (($buffer = fgets($handle, 4096)) !== false) {
				if($str_cnt == $rand_n){
					//echo $buffer;
					$res = $buffer;
					break;
				}
				$str_cnt++;
			}
			fclose($handle);
		}
		
		$res = substr($res, 0, strlen($res)-1);
		
		return $res;
	}

	function female($name){
		if(substr($name, strlen($res)-2, strlen($res)-1) == "�" || substr($name, strlen($res)-2, strlen($res)-1) == "�"){
			return 1;
		}
		return 0;
	}
	
	function make_sentence(){
		$YES = 1;

		$sentence = "";
		$w1 = ucfirst(get_name());
		$w2 = get_narech();
		$w3 = strtolower(get_verb());
		$w4 = get_item();
		
		if(female($w1) == $YES){
			if(substr($w3, strlen($w3)-3, 2) == "��")
				$w3 = substr($w3, 0, (strlen($w3)-3))."��";
			else if(substr($w3, (strlen($w3)-5), 4) == "����")
				$w3 = substr($w3, 0, (strlen($w3)-5))."��";
		}
		else{
			if(substr($w3, strlen($w3)-3, 2) == "��")
				$w3 = substr($w3, 0, (strlen($w3)-3))."�";
			else if(substr($w3, (strlen($w3)-5), 4) == "����")
				$w3 = substr($w3, 0, (strlen($w3)-5))."�";
		}
		
		if(substr($w4, strlen($w4)-2, 1) == "�")
			$w4 = substr($w4, 0, (strlen($w4)-2))."�";
		else if(substr($w4, strlen($w4)-2, 1) == "�")
			$w4 = substr($w4, 0, (strlen($w4)-2))."�";
		else if(substr($w4, strlen($w4)-2, 1) == "�")
			$w4 = substr($w4, 0, (strlen($w4)-2))."�";
		else if(substr($w4, strlen($w4)-2, 1) == "�")
			$w4 = substr($w4, 0, (strlen($w4)-2))."�";
		else if(substr($w4, strlen($w4)-2, 1) == "�")
			$w4 = substr($w4, 0, (strlen($w4)-2))."�";
		else if(substr($w4, strlen($w4)-2, 1) == "�" || substr($w4, strlen($w4)-2, 1) == "�")
			$w4 = substr($w4, 0, (strlen($w4)-1))."�";
			
		return $w1." ".$w2." ".$w3." ".$w4;
	}
	
	if (!isset($_REQUEST)) {
		return; 
	} 
	
	//������ ��� ������������� ������ ������� �� �������� Callback API 
	$confirmation_token = ''; 
	
	//���� ������� ���������� 
	$token = ''; 
	
	//�������� � ���������� ����������� 
	$data = json_decode(file_get_contents('php://input')); 
	
	//���������, ��� ��������� � ���� "type" 
	switch ($data->type) { 
		//���� ��� ����������� ��� ������������� ������ �������... 
		case 'confirmation': 
			//...���������� ������ ��� ������������� ������ 
			echo $confirmation_token; 
			break; 
		
		//���������� � ������
		case 'group_join': 

			//...�������� id ��� ������ 
			$user_id = $data->object->user_id; 
			//����� � ������� users.get �������� ������ �� ������ 
			$user_info = json_decode(file_get_contents("https://api.vk.com/method/users.get?user_ids={$user_id}&v=5.0")); 
			
			//� ��������� �� ������ ��� ��� 
			$user_name = $user_info->response[0]->first_name." ".$user_info->response[0]->last_name; 
			
			//� ������� messages.send � ������ ���������� ���� ��������� 
			$request_params = array( 
				'message' => iconv("windows-1251", "utf-8", "����� �������� � ������ X: ").$user_name, 
				'domain' => "your_id",
				'access_token' => $token, 
				'v' => '5.0' 
			); 
			
			//������������ ���������
			$get_params = http_build_query($request_params); 
			
			//��������� VK message
			$r = file_get_contents('https://api.vk.com/method/messages.send?'. $get_params); 
			
			//��������� E-Mail
			$mail_header = "Content-Type: text/html; charset=UTF-8";
			$mail_subj = iconv("windows-1251", "utf-8", "������� � X");
			$mail_body = $user_name;
			mail('your_mail@domain', $mail_subj, $mail_body, $mail_header);
			
			//���������� "ok" ������� Callback API 
			echo('ok'); 
			
			break; 
		//��������� � ������
		case 'message_new': 
			//...�������� id ��� ������ 
			$user_id = $data->object->user_id; 
			//����� � ������� users.get �������� ������ �� ������ 
			$user_info = json_decode(file_get_contents("https://api.vk.com/method/users.get?user_ids={$user_id}&v=5.0")); 
			
			//� ��������� �� ������ ��� ��� 
			$user_name = $user_info->response[0]->first_name." ".$user_info->response[0]->last_name; 
			
			$sentence = make_sentence();
			
			//� ������� messages.send � ������ ���������� ���� ��������� 
			$request_params = array( 
				'message' => iconv('windows-1251', 'utf-8', $sentence), 
				'user_id' => $user_id, 
				'access_token' => $token, 
				'v' => '5.0' 
			); 			
			
			//������������ ���������
			$get_params = http_build_query($request_params); 
			
			//��������� VK message
			$r = file_get_contents('https://api.vk.com/method/messages.send?'. $get_params); 
			
			//��������� E-Mail
			$mail_header = "Content-Type: text/html; charset=UTF-8";
			$mail_body = "- ".$data->object->body." (".$user_name.")<br>- ".iconv('windows-1251', 'utf-8', $sentence)." (T-X)<br>";
			$mail_subj = iconv("windows-1251", "utf-8", "��������� T-X");
			mail('your_mail@domain', $mail_subj,  $mail_body, $mail_header);
			
			//���������� "ok" ������� Callback API 
			echo('ok'); 
			
			break; 
		//���������� ���������
		case 'message_allow': 
			//...�������� id ��� ������ 
			$user_id = $data->object->user_id; 
			//����� � ������� users.get �������� ������ �� ������ 
			$user_info = json_decode(file_get_contents("https://api.vk.com/method/users.get?user_ids={$user_id}&v=5.0")); 
			
			//� ��������� �� ������ ��� ��� 
			$user_name = $user_info->response[0]->first_name." ".$user_info->response[0]->last_name; 
			
			//� ������� messages.send � ������ ���������� ���� ��������� 
			$request_params = array( 
				'message' => iconv("windows-1251", "utf-8", "������. ����� �������, ").$user_info->response[0]->first_name.iconv("windows-1251", "utf-8", "?"), 
				'user_id' => $user_id, 
				'access_token' => $token, 
				'v' => '5.0' 
			); 			
			
			//������������ ���������
			$get_params = http_build_query($request_params); 
			
			//��������� VK message
			$r = file_get_contents('https://api.vk.com/method/messages.send?'. $get_params); 
			
			//��������� E-Mail
			$mail_header = "Content-Type: text/html; charset=UTF-8";
			$mail_subj = iconv("windows-1251", "utf-8", "���������� � X");
			$mail_body = iconv("windows-1251", "utf-8", "�������� ").$user_name;
			mail('your_mail@domain', $mail_subj,  $mail_body, $mail_header);
			
			//���������� "ok" ������� Callback API 
			echo('ok'); 
			
			break; 
		//����������� �� �����
		case 'wall_reply_new': 
			
			//...�������� text �����������
			$text = $data->object->text; 
			
			//� ������� messages.send � ������ ���������� ���� ��������� 
			$request_params = array( 
				'message' => "����� ����������� �� ����� X: {$text}", 
				'domain' => "your_id",
				'access_token' => $token, 
				'v' => '5.0' 
			); 
			
			//������������ ���������
			$get_params = http_build_query($request_params); 
			
			//��������� VK message
			$r = file_get_contents('https://api.vk.com/method/messages.send?'. $get_params); 
			
			//��������� E-Mail
			$mail_header = "Content-Type: text/html; charset=UTF-8";
			mail('your_mail@domain', '����������� � ������ X', "<b>".$text."</b><br><br>��� ������ API:<br>".$r."<br><br>", $mail_header);
			
			//���������� "ok" ������� Callback API 
			echo('ok'); 
			
			break; 
	}
	
?>