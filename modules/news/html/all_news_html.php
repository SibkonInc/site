<? if (($access['access_edit'] == "1") or ($access['access_del'] == "1") or ($access['access_add'] == "1")): ?>
    <div style="height: 25px;margin-top:5px;" align="right">
    <? if (isset($access['access_add']) and ($access['access_add'] == "1")): ?>
        <a href ="<?=$setting['site'] ?>news/add_form/">
        <img src="<?=$setting['site'] ?>img/ico/add.png" width="16" height="16" alt="add"/>Добавить новость</a>
    <? endif; ?>
</div>
<? endif; ?>
    <h2><?=$news_lang['name_m_news'] ?></h2>
<?=$pages; ?>
<div class ="block_title">
<?=$news_lang['name_news_last'] ?>
</div>
<!--Блок последних новостей-->
<? if ($news_last_data == true) {
    foreach ($news_last_data as $news_last): ?>
<? if ($news_last['news_on'] == "1"): ?>
<? include 'list.php'; ?>
<? else: ?>
<? if (($access['access_edit'] == "1") or ($access['access_del'] == "1") or ($access['access_add'] == "1")): ?>
<? include 'list_admin.php'; ?>
<? endif; ?>
<? endif; ?>
<? endforeach;} ?>
<?=$pages; ?>

