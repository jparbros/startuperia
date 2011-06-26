<div id="content" class="xfluid">

  <div class="portlet x12">
    
    <div class="portlet-header">
      <h4>Startups</h4>
    </div>      
    
    <div class="portlet-content">
      
      
      <div class="xbreak"></div>
    
      <table cellpadding="0" cellspacing="0" border="0" >
        
        <thead>
          <tr>
            <th>Logo</th>
            <th>Symbol</th>
            <th>Company</th>
            <th>Price</th>
            <th>Change ($)</th>
            <th>Change (%)</th>
          </tr>
        </thead>  
        
        <tbody>
          <?php foreach($startups as $startup) :?>
          <tr>
            <td><? ?></td>      
            <td><img src="<?php echo $startup->logo; ?>"></td>
            <td><? echo $startup->name; ?></td>
            <td class="right">$2.00</td>
            <td class="right">$0.50</td>
            <td class="right">33.3%</td>
          </tr>
          <?endforeach ?>
        </tbody>
      </table>

      
    </div> <!-- .portlet-content -->
    
  </div> <!-- .portlet -->
  
  
</div> <!-- #content -->
  
