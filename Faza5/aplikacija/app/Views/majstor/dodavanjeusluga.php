<!--Stefan Pajovic 2018/0287-->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.6.0/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <title>POPRAVI.com</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>/css/stilOsnova.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>/css/stilDodavanjeUsluge.css">
	<script src="<?php echo base_url(); ?>/js/skriptaOsnova.js"></script>
</head>

<body>
        <div class="container-fluid">
        
			<div class="row">
					<div id="sadrzaj" class="offset-0 col-12 offset-md-2 col-md-10">
							<form id="content" action="novaUsluga" method="POST">
								<div class="row">
								<input class="offset-2 col-8 offset-md-4 col-md-4" type="text" name="naslov" id="naslovId" placeholder="Naslov" >
								</div>
								
								<div class="row">
									<textarea  class="offset-2 col-8 offset-md-4 col-md-4 offset-2" name="opis" id="opisId" cols="40" rows="8" placeholder="Kratak opis usluge" draggable="false" ></textarea>
								</div>
								
								<div class="row red text-center">
									<div class="offset-2 col-8 offset-md-4 col-md-4 offset-md-4 offset-2">
										<input class="col-5" type="number" name="cena" id="cenaId" placeholder="Cena">
										<select class="col-5" name="tagovi" id="selectId" >  
											<option value="" >Kupatilo</option>
											<option value="">Masina za ves</option>
											<option value="">Kuhinja</option>
											<option value="">Frizider</option>
											 
										</select>
										<button type="submit" class="col-1 plus" >+ </button>
									</div>
								</div>
								<div class="row">
									<div class="offset-2 col-8 offset-md-4 col-md-4 text-center offset-2">
										<a href="mojeUsluge.html">   
											<input class="col-11"type="submit" value="Dodaj" id="idDugmeR" onclick="">
										</a>
									</div>
								</div>
							</form>
					</div>
			</div>
		</div>
	</body>
</html>