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
          <span class="value">13.00<? #echo $startup->value_per_share ?></span>
          
        </div>
        
        <div class="stat">

          
          <h4>Today's Change</h4>
          <span class="loss value">-$0.25</span>
          
        </div>
      </div>
    </div> <!-- .portlet-content -->
  </div> <!-- .portlet -->
  
  <div class="floatLeft">
    <div id="dash_chart" class="portlet x8">

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
                <th>SQ</th>
                <td>12</td>
                <td>15</td>
                <td>13</td>
                <td>11</td>
                <td>13</td>
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
                <form action="#" method="post" class="form label-inline">
                  <div class="center" style="width:100%"> 
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