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
            <td><img src="<?php echo $startup->logo; ?>"></td>      
            <td></td>
            <td><a href="<?echo base_url() . 'startups/show/' . $startup->permalink ?>"><? echo $startup->name; ?></a></td>
            <td class="right">$<? echo number_format($startup->value_per_share,2,'.',',') ?></td>
            <td class="right">$<?echo number_format($startup->todays_change,2,'.',',') ?></td>
            <td class="right">33.3%</td>
          </tr>
          <?endforeach ?>
        </tbody>
      </table>

      <? echo $pagination_links?>
    </div> <!-- .portlet-content -->
    
  </div> <!-- .portlet -->
  
  
</div> <!-- #content -->
  
