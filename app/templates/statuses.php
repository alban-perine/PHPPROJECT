<h1>Selected status</h1>
<ul>
    <li>
        Status id : <?= $statuses->getId(); ?>
        <br/>
        Status message : <?= $statuses->getMessage(); ?>
        <br/>
        Status username : <?= $statuses->getUsername(); ?>
        <br/>
        Status date : <?= $statuses->getDate(); ?>
    </li>
</ul>

<form action="/statuses/<?= $id ?>" method="POST">
    <input type="hidden" name="_method" value="DELETE">
    <input type="submit" value="Delete">
</form>