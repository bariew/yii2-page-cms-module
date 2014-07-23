<?php $this->beginContent('@app/views/layouts/main.php'); ?>
<?php
/**
 * @var yii\web\View $this
 */
$this->title = 'Forex blacklists';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Forex blacklists</h1>
        <p class="lead">Yii2 application.</p>
    </div>

    <div class="body-content">
        <div class="row">
            <div class="col-lg-4">
                <h2>Api description</h2>
                <p>
                    <ul>
                        <li> Api is available by http GET request http://{sitename}/api/index</li>
                        <li> It may return XML or JSON data (see available parameters below) </li>
                        <li> It needs some required GET parameters (see required parameters below) </li>
                    </ul>
                </p>
            </div>

            <div class="col-lg-4">
                <h2>Api required parameters</h2>
                <p>
                    <ul>
                        <li> GET: username </li>
                        <li> GET: api_key </li>
                        <li> GET: full_name </li>
                    </ul>
                </p>
            </div>
            <div class="col-lg-4">
                <h2>Api available parameters</h2>
                <p>
                    <ul>
                        <li> Getting json - header "Accept: application/json" </li>
                        <li> Sending POST - header "Content-Type: application/x-www-form-urlencoded" </li>
                        <li> Pagination - GET params 'page' and 'per-page' </li>
                        <li> Filtering not accurate data - GET params 'full_name', 'address', 'birth_date', 'birth_place' </li>
                        <li> Filtering accurate (integers) - 'list_type', 'reason', 'unit_type'
                    </ul>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <h2>Api available data lists</h2>
                <p>
                    <?php foreach (\app\modules\blacklist\models\Item::allLists() as $name=>$list): ?>
                    <label><?php echo $name; ?></label>
                    <ul>
                        <?php foreach ($list as $num=>$title): ?>
                        <li><?php echo "{$num} : {$title}"; ?></li>
                        <?php endforeach; ?>   
                    </ul>
                    <?php endforeach; ?>
                </p>
            </div>
        </div>
    </div>
</div>
<?php $this->endContent(); ?>