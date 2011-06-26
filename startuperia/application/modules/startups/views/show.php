<div id="content" class="xfluid">

  <div id="basic-info" class="portlet x12">
      
      <div class="portlet-header">
        <h4><? echo $startup->name ?></h4>
      </div> <!-- .portlet-header -->
      
      <div class="portlet-content">
        <div id="big_stats" class="clearfix">
        <div class="stat">
          
          <h4>Logo</h4>
          <img id="company-logo" src="http://www.crunchbase.com/<? echo $startup->image['available_sizes'][0][1] ?>" alt="Square" />
          
        </div>
        
        <div class="stat">
          
          <h4>Current Price</h4>
          <span class="value">$<? echo number_format($startup->value_per_share,2,'.',',') ?></span>
          
        </div>
        
        <div class="stat">

          
          <h4>Today's Change</h4>
          <span class="loss value">$<? echo number_format($startup->todays_change,2,'.',',') ?></span>
          
        </div>
      </div>
    </div> <!-- .portlet-content -->
  </div> <!-- .portlet -->
  
  <div class="floatLeft">
    <div id="dash_chart" class="portlet x8">

      <div class="portlet-header">
        <h4>Trends</h4>

        <ul class="portlet-tab-nav">
          <li class="portlet-tab-nav-active"><a href="#tab1" rel="tooltip" title="Stock values in the last 5 months.">Value </a></li>        
        </ul>
      </div> <!-- .portlet-header -->

      <div class="portlet-content">        
        <div id="tab1" class="portlet-tab-content portlet-tab-content-active">
          <table class="stats" title="area" width="100%" cellpadding="0" cellspacing="0">
            <caption>Portfolio Value/Change</caption>
            <thead>
              <tr>
                <td>&nbsp;</td>
                <? foreach(array_keys($startup->avg_last_five_months()) as $month) : ?>
                <th><? echo $month?></th>
                <? endforeach ?>
              </tr>
            </thead>

            <tbody>
              <tr>
                <th>SQ</th>
                <? foreach($startup->avg_last_five_months() as $value) : ?>
                <td><? echo $value?></td>
                <? endforeach ?>
              </tr>

            </tbody>
          </table>

        </div> <!-- .portlet-tab-content -->
      </div> <!-- .portlet-content -->      
    </div> <!-- .portlet -->


    <div class="portlet x4" style="min-height: 300px;">

      <div class="portlet-content">
        <table cellspacing="0" class="info_table">
          <tbody>
            <tr>
              <td class="value">Website</td>
              <td class="full"><a href="<? echo $startup->homepage_url ?>" target="_blank"><? echo $startup->homepage_url ?></a></td>
            </tr>
            <tr>
              <td class="value">Twitter</td>
              <td class="full"><a href="http://www.twitter.com/<? echo $startup->twitter_username ?>" target="_blank">@<? echo $startup->twitter_username ?></a></td>
            </tr>
            <tr>
              <td class="value">Category</td>
              <td class="full"><? echo $startup->category_code ?></td>
            </tr>
            <tr>
              <td class="value">Founded</td>
              <td class="full"><? echo $startup->founded_year ?>/<? echo $startup->founded_month ?>/<? echo $startup->founded_day ?><td>
            </tr>
            <tr>
              <td class="value">Headquarters</td>
              <td class="full"><? echo $startup->offices[0]['city'] ?>, <? echo $startup->offices[0]['state_code'] ?></td>
            </tr>
            <tr>
              <td class="value">CEO</td>
              <td class="full"><? echo $startup->relationships[0]['person']['last_name'] ?>, <? echo $startup->relationships[0]['person']['first_name'] ?></td>
            </tr>
            <tr>
              <td class="value">Published Funding</td>
              <td class="full">$<? echo number_format($startup->funding,2,'.',',') ?></td>
            </tr>
            <tr>
              <td style="width:100%">
                <form action="<?php print base_url();?>orders/action/buy/" method="post" class="form label-inline">
                  <div class="center" style="width:100%"> 
                    <input type="hidden" name="startup" value="<?php print $startup->name;?>" id="startup">
                    <input type="hidden" name="price" value="<?php print $startup->value_per_share;?>" id="value_per_share">
                    <input type="submit" value="Buy" class="btn btn-medium btn-dollar" />
                    <input id="shares" name="shares" size="10" type="text" class="medium" value="# of shares"/>
                  </div>
              </td>
            </tr>

          </tbody>
        </table>
      </div> <!-- .portlet-content -->      
    </div> <!-- .portlet -->
  </div>
  
  <div class="portlet x4" style="min-height: 300px;">

    <div class="portlet-header">
      <h4>Description</h4>
    </div> <!-- .portlet-header -->
    
    <div class="portlet-content">
      <? echo $startup->long_description; ?>
    </div> <!-- .portlet-content -->      
  </div> <!-- .portlet -->
  
  <div class="portlet x4" style="min-height: 300px;">

    <div class="portlet-header">
      <h4>News</h4>
    </div> <!-- .portlet-header -->

    <div class="portlet-content">
      <? $milestones = $startup->milestones ;
       for ($i = 1; $i <= 5; $i++) {
          $milestone = array_pop($milestones); ?>
          <a href="<?echo $milestone['source_url']?>" target="_blank"><?echo $milestone['description']?></a></br>
      <? } ?>
    </div> <!-- .portlet-content -->      
  </div> <!-- .portlet -->
  
  <div class="portlet x4" style="min-height: 300px;">

    <div class="portlet-header">
      <h4>Funding</h4>
    </div> <!-- .portlet-header -->

    <div class="portlet-content">
      <? $funding_rounds = $startup->funding_rounds ;
       for ($i = 1; $i <= 5; $i++) {
          $funding_round = array_pop($funding_rounds); 
          if(!empty($funding_round['source_description'])) {
            ?>
              <a href="<?echo $funding_round['source_url']?>" target="_blank"><?echo $funding_round['source_description']?></a></br>
            <?
          }
          ?>
          
      <? } ?>
    </div> <!-- .portlet-content -->      
  </div> <!-- .portlet -->
  
  
  <div class="xbreak"></div> <!-- .xbreak -->

</div> <!-- #content -->