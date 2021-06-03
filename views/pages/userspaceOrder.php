<div class="userorder-title">
  <h2>Commandes</h2>
</div>
<div class="userorder">
  <div class="userorder-container">

    <table class="userorder-orderlist" cellpadding="20">
      <thead class="userorder-orderlist-header">
        <tr class="userorder-orderlist-header-row">
          <td class="userorder-orderlist-header-row-date">Date</td>
          <td class="userorder-orderlist-header-row-ID">N° commande</td>
          <td class="userorder-orderlist-header-row-status">Statut de la commande</td>
          <td class="userorder-orderlist-header-row-price">Montant total</td>
        </tr>
      </thead>
      <tbody class="userorder-orderlist-body">
        <?php foreach ($pageData['userOrders'] as $userOrder): ?>
          <tr class="userorder-orderlist-body-row">
            <td class="userorder-orderlist-body-row-date"><?php echo $userOrder['orderDate']?></td>
            <td class="userorder-orderlist-body-row-ID"><?php echo $userOrder['orderID'] ?></td>
            <td class="userorder-orderlist-body-row-status"><?php echo $userOrder['orderStatus'] = $userOrder['orderStatus']==0?"En cours":"Livrée"?></td>
            <td class="userorder-orderlist-body-row-price"><?php echo $userOrder['orderPrice'] ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
