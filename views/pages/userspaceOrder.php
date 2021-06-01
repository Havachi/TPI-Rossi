<div class="userorder-title">
  <h2>Commandes</h2>
</div>
<div class="userorder">
  <div class="userorder-container">

    <table class="userorder-orderlist" cellpadding="20">
      <thead class="userorder-orderlist-header">
        <tr>
          <td>Date</td>
          <td>Numéro de commande</td>
          <td>Statut de la commande</td>
          <td>Montant total</td>
        </tr>
      </thead>
      <tbody class="userorder-orderlist-body">
        <?php foreach ($pageData['userOrders'] as $userOrder): ?>
          <td><?php echo $userOrder['orderDate']?></td>
          <td><?php echo $userOrder['orderID'] ?></td>
          <td><?php echo $userOrder['orderStatus'] = $userOrder['orderStatus']==0?"En cours":"Livrée"?></td>
          <td><?php echo $userOrder['orderPrice'] ?></td>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
