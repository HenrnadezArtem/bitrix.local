<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?>   <?php
   require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
   $APPLICATION->SetTitle("Курсы валют");
   ?>
   <?php
   $APPLICATION->IncludeComponent(
       "bitrix:currencyrates.filter",
       ".default",
       []
   );
   $APPLICATION->IncludeComponent(
       "bitrix:currencyrates.list",
       ".default",
       [
           "PAGE_SIZE" => 10 // Количество строк на странице
       ]
   );
   ?>
   <?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php"); ?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>