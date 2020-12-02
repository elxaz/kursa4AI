<?php 
	require_once 'db.php';
	$donation = R::dispense('donations');
	// Заполняем объект свойствами
	$donation->filmId = $_GET['id'];
	$donation->login = $_GET['login'];
	$donation->quantity = $_GET['quantity'];
	// Сохраняем объект
	R::store($donation);
	?>
		<form id="payment" name="payment" method="post" action="https://sci.interkassa.com/" enctype="utf-8">
        <!-- <input type="hidden" name="s" value="8Fp22jFGSz" /> -->
        <input type="hidden" name="ik_co_id" value="5fc7f3aeef39a9363d362a6c" />
        <input type="hidden" name="ik_pm_no" value=<?php echo mt_rand(0,10000000000); ?> />
        <input type="hidden" name="ik_am" value=<?php echo $_GET['quantity']; ?> />
        <input type="hidden" name="ik_desc" value="Пожертвования "/>
        <input type="submit" value="Пожертвовать">
		</form>

