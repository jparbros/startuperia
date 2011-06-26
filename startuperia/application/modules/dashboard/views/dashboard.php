
<div id="content" class="xfluid">

	
	<div class="portlet x3" style="min-height: 300px;">
		
		<div class="portlet-header">
			<h4>Quick Info</h4>
		</div> <!-- .portlet-header -->
		
		<div class="portlet-content">
			<table cellspacing="0" class="info_table">
				<tbody>
					<tr>
						<td class="value"><?php print (isset($companies_owned))? $companies_owned:0;?></td>
						<td class="full">Companies Owned</td>
					</tr>
					<tr>
						<td class="value">
						<?php 
						$startupcash = (isset($credits))?$credits:0;
						print $startupcash;?></td>
						<td class="full">StartupCash</td>
					</tr>
					<tr>
						<td class="value">
						  <?php 
						  $stockvalue = (isset($stocks_value))?$stocks_value:0;
						  print $stockvalue;?>
						</td>
						<td class="full">Stock Value</td>
					</tr>
					<tr>
						<td class="value">
						<?php 
						  $portfolio_value = $startupcash + $stockvalue;
						  print ($portfolio_value)?$portfolio_value:0;?>
						</td>
						<td class="full">Portfolio Value</td>
					</tr>
					<tr>
					  <?php 
					  $gain_money = 0;
					  foreach($portfolio->result() as $order) { 
						    $market_value = $order->vps * $order->value;
						    $gain_money += $market_value-$order->value;
						    $gain_por = $market_value/$order->value;
					  } ?>
						<td class="value"><?php print ($gain_money)? $gain_money : 0;?></td>
						<td class="full">Gain ($)</td>
					</tr>
					<tr>
						<!--td class="value"><?php print ($gail_full)? $gain_full : 0;?></td>
						<td class="full">Gain (%)</td-->
					</tr>
				</tbody>
			</table>
		</div> <!-- .portlet-content -->			
	</div> <!-- .portlet -->
	
	<div id="dash_chart" class="portlet x9">
		
		<div class="portlet-header">
			<h4>Trends</h4>
			
			<ul class="portlet-tab-nav">
				<li class="portlet-tab-nav-active"><a href="#tab1" rel="tooltip" title="Visitors over last 48 hours.">Value </a></li>				
				<li class=""><a href="#tab2" rel="tooltip" title="Sales over last 48 hours.">Volume </a></li>
			</ul>
		</div> <!-- .portlet-header -->
		
		<div class="portlet-content">				
			<div id="tab1" class="portlet-tab-content portlet-tab-content-active">
				<table class="stats" title="area" width="100%" cellpadding="0" cellspacing="0">
					<caption>Portfolio Value/Change</caption>
					<thead>
						<tr>
							<td>&nbsp;</td>
							<th>January</th>
							<th>February</th>
							<th>March</th>
							<th>April</th>
							<th>May</th>
						</tr>
					</thead>
					
					<tbody>
						<tr>
							<th>Stock Index</th>
							<td>12</td>
							<td>15</td>
							<td>13</td>
							<td>11</td>
							<td>13</td>
						</tr>
													
						<tr>
							<th>Your Portfolio</th>
							<td>5</td>
							<td>6</td>
							<td>4</td>
							<td>7</td>
							<td>9</td>								
						</tr>							
					</tbody>
				</table>

			</div> <!-- .portlet-tab-content -->
			
			<div id="tab2" class="portlet-tab-content">
				
				<table class="stats" title="bar" width="100%" cellpadding="0" cellspacing="0">
					<caption>2009/2010 Sales by industry (Million)</caption>
					<thead>
						<tr>
							<td>&nbsp;</td>
							<th>Banking</th>
							<th>Beauty</th>
							<th>Insurance</th>
							<th>Internet</th>
							<th>Media</th>
						</tr>

					</thead>
					
					<tbody>
						<tr>
							<th>2009</th>
							<td>5</td>
							<td>6</td>
							<td>4</td>
							<td>7</td>
							<td>9</td>
						</tr>
						
						<tr>
							<th>2010</th>
							<td>12</td>
							<td>15</td>
							<td>13</td>
							<td>11</td>
							<td>13</td>
						</tr>							
					</tbody>
				</table>
			</div> <!-- .portlet-tab-content -->
		</div> <!-- .portlet-content -->			
	</div> <!-- .portlet -->
	
	<div class="xbreak"></div> <!-- .xbreak -->

			<div class="portlet x12">
				<div class="portlet-header"><h4>Your Portfolio</h4></div>

				<div class="portlet-content">

					<br />

						<a name="plugin"></a>

					<table cellpadding="0" cellspacing="0" border="0" class="display" rel="datatable" id="example">
						<thead>
							<tr>
								<th>Name</th>
								<th>Symbol</th>
								<th>Last Price</th>
								<!--th>Change</th-->
								<th>Shares</th>
								<th>Cost Basis</th>
								<th>Market Value</th>
								<th>Gain ($)</th>
								<th>Gain (%)</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($portfolio->result() as $order) { ?>
							  <tr>
							  <?php 
							    $market_value = $order->vps * $order->value;
							    $gain_money = $market_value-$order->value;
							    $gain_por = $market_value/$order->value;
							  ?>
							  <td><?php print $order->name;?></td>
							  <td><?php print $order->symbol;?></td>
							  <td><?php print $order->vps;?></td>
							  <td><?php print $order->total_shares;?></td>
							  <td><?php print $order->value;?></td>
							  <td><?php print $market_value;?></td>
							  <td><?php print $gain_money;?></td>
							  <td><?php print $gain_por;?></td>
							  </tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>

			<div class="portlet x12">
				<div class="portlet-header"><h4>Open Orders</h4></div>

				<div class="portlet-content">

					<br />

						<a name="plugin"></a>

					<table cellpadding="0" cellspacing="0" border="0" class="display" rel="datatable" id="example">
						<thead>
							<tr>
								<th>Name</th>
								<th>Symbol</th>
								<th>Action</th>
								<th>Shares</th>
								<th>Order Price</th>
								<th>Order Total</th>
							</tr>
						</thead>
						<tbody>
						  <?php foreach($pending_orders->result() as $order) { 
						    $order_total = $order->quantity * $order->value;
						  ?>
						    <tr>asa
							  <td><?php print $order->name;?></td>
							  <td><?php print $order->symbol;?></td>
							  <td><?php print $order->type;?></td>
							  <td><?php print $order->value;?></td>
							  <td><?php print $order->quantity;?></td>
							  <td><?php print $order_total;?></td>
							  </tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>


</div> <!-- #content -->