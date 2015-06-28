<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'Privacy policy';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>By using or accessiong Vital, you are accepting our Privacy Policy</p>
    <p>
        Vital takes very seriously users privacy and your personal information security. By registering
        on our website you are giving us some informations about you: name, email, password etc.
    </p>
    <p>
        Vital is combined system from website and android application.
        Using our application (website or android), you are agreeing your data to be shared between them.
    </p>
    <p>
        Visting Vital we collect only information made public by you.
        Vital store all the information on the server and in addition we are using "cookies".
        "Cookie" is an element of data that a website can send to your browser, 
        which may then store it on your computer system.
        "Cookies" help to form the information the Web Site will provide to you upon a return visit. 
        If you do not wish to accept "cookies" on our website you can leave us
        or configure your browser to notify you when you receive a "cookie",
        giving you the chance to decide whether to accept or block.
        "Cookie" is used in order to provide ease of logging in Vital.
    </p>
    
    <h2>Personal data</h2>
    <p>
        Your personal data that identify you as a person not revealed to third parties.
        All data stored on our server will be used only if necessary for our services,
        in a way that your privacy will not be compromised.
    </p>
    <p>
        We will respect all world applicable laws for data protection,
        which are regulating the collection and use of personal information.
    </p>
    
    <h2>Security</h2>
    <p>
        Vital will try the best to protect your personal information,
        but with using our website you agree that the owners or editors are not responsible
        if some information be stolen, lost, released or accidentally modified.
        In such a case you will not undertake any legal action against us
        and you can`t also ask for compensation from us.
    </p>
    <p>
        If you have any questions about the processing of your data by Vital,
        you are welcome to <a href="<?= yii\helpers\Url::toRoute(['contact']) ?>">contact us</a>.
    </p>
    
</div>
