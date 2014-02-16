<?php

session_start();
if(!isset($_SESSION['is_authentificated'])){

?>
<form action="/login" method="GET">
    <input type="submit" class="submit" value="Login"/>
</form>
<?php
};

if(isset($_SESSION['is_authenticated'])){
    if($_SESSION['is_authenticated'] === true)
?>
<form action="/logout" method="GET">
    <input type="submit" class="submit" value="Logout"/>
</form>
<?php
};
?>

<h1>Selected statuses</h1>

<ul>
    <?php foreach ($statuses as $status): ?>
        <li>
            Status id : <a href="/statuses/<?= $status->getId(); ?>" ><?= $status->getId(); ?></a>
            <br/>
            Status message : <?= $status->getMessage(); ?>
            <br/>
            Status username : <?= $status->getUsername(); ?>
            <br/>
            Status date : <?= $status->getDate(); ?>
        </li>
        <br/>
    <?php endforeach; ?>
</ul>
<form action="/AddStatuses" method="GET">
    <input type="submit" value="Add Statuses">
</form>