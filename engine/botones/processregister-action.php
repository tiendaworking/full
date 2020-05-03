<?php


		if(!empty($_POST)){
			
			
			
			
			
			
			
			if($_POST["name"]!=""&&$_POST["lastname"]!=""&&$_POST["email"]!=""&&$_POST["password"]!=""){
				

				
				$user = UserData::getByEmail($_POST["email"]);
				if($user==null){
					$str = "abcdefghijklmopqrstuvwxyz1234567890";
					$code = "";
					for ($i=0; $i < 6; $i++) { 
						$code .= $str[rand(0,strlen($str)-1)];
					}
					
					$longitud = strlen($_POST["name"]);

			    if(!is_numeric($_POST["name"]) OR !is_numeric($_POST["lastname"]) OR $longitud <=2 OR ctype_alpha($_POST["name"])){
			    	if ($longitud <=2){
			    		Core::alert("Nombre invalido");
			    		Core::redir("./?view=register");}
			    	else {
			      Core::alert("Nombre y apellido no puede contener numeros");
				    Core::redir("./?view=register");}
				  }
				 
			    

				  
				  
					else {
					
	
					$user = new UserData();
					$user->name = $_POST["name"];
					$user->lastname = $_POST["lastname"];
					$user->email = $_POST["email"];
					$user->password = sha1(md5($_POST["password"]));
					$user->code = $code;
					$user->add();
	        //echo var_dump(IntlChar::isalpha($_POST["name"]));
					$msg = "Registro Exitoso
					<p>Ahora debes activar tu cuenta en el siguiente link:</p>
					<p><a href='localhost/core/app/index.php?view=processactivation&e=".sha1(md5($_POST["email"]))."&c=".sha1(md5($code))."'>Activa tu cuenta:</a></p>
					<p>O tambien puedes usar el siguiente codigo de activacion: ".$code."</p>
					";
	
					mail($_POST["email"], "Registro Exitoso", $msg);
					$f = fopen (ROOT."/register.txt","w");
					fwrite($f, $msg);
					fclose($f);
					Core::alert("Registro Exitoso. Se ha enviado un correo electronico con los datos necesarios para activar su cuenta.");
					Core::redir("./?view=login");
					
					}
					
				}else{
					Core::alert("El email proporcionado ya esta registrado.");
					Core::redir("./?view=register");				}
			}else{
				
				
				
				
				
				Core::alert("No puede dejar campos vacios");				
				Core::redir("./?view=register");
			}
		}

	
?>