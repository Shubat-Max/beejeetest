<!-- HEADER - BEGIN -->
<div class='row'>
    <div class='col-lg-6'>
        <h1 class='text-uppercase'>
            <a href="<?=URL?>/">CommoNWealtH</a><?= $_SESSION['loggedIn'] ? "&nbsp\\&nbsp<a href='".URL."/Moderator'>Mod</a>" : '';?>
        </h1>
    </div>
    <div class='col-lg-offset-4 col-lg-2'>
        <a href='<?= $_SESSION['loggedIn'] ? '\Login\logout' : '\Login'?>' id='login' class='btn btn-primary btn-xs btn-block'><h4><?= $_SESSION['loggedIn'] ? 'Logout' : 'Login';?></h4></a>
    </div>
</div>
<!-- HEADER - END -->