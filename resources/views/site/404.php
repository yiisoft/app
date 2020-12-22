<?php

use Yiisoft\Html\Html;

$this->setTitle('404');

?>

<h1 class='is-size-1'>
    <b>404</b>
</h1>

<p class='has-text-danger'>
    The page

    <span>
        <b><?= Html::encode($urlMatcher->getCurrentUri()->getPath()) ?></b>
    </span>

    not found. <br/>

</p>

<p class='has-text-grey'>
    <br/>The above error occurred while the Web server was processing your request. <br/>

    Please contact us if you think this is a server error. Thank you. <br/>

</p>

<hr class='mb-2'>

<a class ='button is-danger mt-5' href=<?= $url->generate('site/index') ?>>
    Go Back Home
</a>
