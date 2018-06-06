<h3>Изменение полей отгрузки у заказа</h3>
<ul>
  <li>Получаем список всех заказов</li>
  
  ```php
  $db_sales = CSaleOrder::GetList(array("ID" => "ASC"), $arFilter);
  ```
  
  <li>Получаем список всех отгрузок у заказа</li>
  
  ```php
  $shipmentCollection = $order->getShipmentCollection();
  ```
  
  <li>Получаем коллекцию товаров в корзине каждой отгрузки</li>
  
  ```php
  $shipmentItemCollection = $shipment->getShipmentItemCollection();
  ```
  
  <li>Изменяем поля и сохраняем изменения</li>
  
  ```php
  $shipment->setField('ALLOW_DELIVERY', 'Y');
  $shipment->setField('DEDUCTED', 'Y');
        
  $order->save();
  ```
  
</ul>
