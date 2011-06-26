  	<div class="portlet x12">			
			<div class="portlet-header">
				<h4>People</h4>
			</div> <!-- .portlet-header -->
			
			<div class ="portlet-content">
				<?php foreach($users->result() as $user) :
        		  $networth = $this->Friends_model->get_stock_value($user->id) + $this->Friends_model->get_credits($user->id);
        		?>
        		<div class="user-card">
						<div class="avatar">
							<img src="http://www.gravatar.com/avatar/<?php echo md5(strtolower($user->email))?>?s=65&d=<?php echo urlencode(base_url()."images/avatar.jpg")?>" alt="avatar" />
						</div>
						<div class="details">
							<p><strong><?php echo $user->username?></strong><br />
  							$ <?php echo money_format("%10.2n", $networth)?><br />
  							<a href="<?php base_url()?>profile/<?php echo $user->id?>">View portfolio</a>
							</p>
						</div>
				</div>
                <?php endforeach;?>
           </div><!-- .porlet-content -->
	</div> <!-- .portlet -->
		