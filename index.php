<?php require_once 'proces.php'; ?>
<?php $pripojeni = new mysqli("localhost","root","","rozpocetDB"); ?>
<?php if(isset($_SESSION['zprava'])): ?>

<?php endif ?> 
 
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Systém řízení rozpočtu</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">

</head>
<body>
    <nav class="navbar navbar-dark bg-primary text-center">
    <span class="navbar-brand mb-0 h1 text-center">Správce výdajů</span>
    </nav>
    <br><br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h2 class="text-center">Přidat výdaj</h2>
                <hr><br>
                <form action="proces.php" method="POST">
                    <div class="form-group">
                        <label for="rozpocetNazev">Název rozpočtu</label>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="text" name="rozpocet" class="form-control" id="rozpocetNazev" placeholder="Zadejte název rozpočtu" required autocomplete="off"  value="<?php echo $jmeno; ?>">
                    </div>
                    <div class="form-group">
                        <label for="castka">Částka</label>
                        <input type="text" name="castka" class="form-control" id="castka" placeholder="Zadejte částku" required  value="<?php echo $castka; ?>">
                    </div>
                    <?php if($aktualizace == true): ?>
                    <button type="submit" name="update" class="btn btn-success btn-block">Aktualizovat</button>
                    <?php else: ?>
                    <button type="submit" name="save" class="btn btn-primary btn-block">Uložit</button>
                    <?php endif; ?>
                </form>
            </div>
            <div class="col-md-8">
                <h2 class="text-center">Celkové výdaje:  <?php echo $cely_rozpocet;?>   Kč</h2>
                <hr>
                <br><br>

                <?php 

                    if(isset($_SESSION['zprava'])){
                        echo    "<div class='alert alert-{$_SESSION['typ_zpravy']} alert-dismissible fade show ' role='alert'>
                                    <strong> {$_SESSION['zprava']} </strong>
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Zavřít'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>
                                </div>
                                ";
                    }

                ?>
                <h2>Seznam výdajů</h2>

                <?php 
                    
                    $vysledek = mysqli_query($pripojeni, "SELECT * FROM budget");
                ?>
                <div class="row justify-content-center">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Název rozpočtu</th>
                                <th>Částka</th>
                                <th colspan="2">Akce</th>
                            </tr>
                        </thead>
                        <?php 
                            while($radek = $vysledek->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $radek['jmeno']; ?></td>
                                <td> $<?php echo $radek['hodnota']; ?></td>
                                <td>
                                    <a href="index.php?edit=<?php echo $radek['id']; ?>" class="btn btn-success">Aktualizovat</a>
                                    <a href="proces.php?delete=<?php echo $radek['id']; ?>"  class="btn btn-danger">Smazat</a>
                                </td>
                            </tr>
                        <?php endwhile ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

<script src="js/jquery-3.2.1.slim.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
