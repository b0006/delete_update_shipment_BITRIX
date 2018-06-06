<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("sale");

$arFilter = Array(
    "MARKED" => "Y",
);
$db_sales = CSaleOrder::GetList(array("ID" => "ASC"), $arFilter);

while ($ar_sales = $db_sales->Fetch()) {

    $order = \Bitrix\Sale\Order::load($ar_sales["ID"]);
    $shipmentCollection = $order->getShipmentCollection();

    foreach ($shipmentCollection as $shipment) {
        //пропускаем системные
        if ($shipment->isSystem())
            continue;
        
        //получаем Коллекцию Товаров в Корзине каждой Отгрузки
        $shipmentItemCollection = $shipment->getShipmentItemCollection();

        foreach ($shipmentItemCollection as $item)
            $item->delete();

        $shipment->setField('ALLOW_DELIVERY', 'Y');
        $shipment->setField('DEDUCTED', 'Y');
        
        $order->save();
    }
}

?>
