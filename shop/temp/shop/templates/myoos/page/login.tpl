{include file="myoos/system/_header.tpl"}
    <!-- Wrapper -->
    <div class="wrapper">
    <section id="inner-headline">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="inner-heading">
                    <h2>{$heading_title}</h2>
                </div>
            </div>
            <div class="col-md-8">
                {$breadcrumb}
            </div>
        </div>
    </div>
    </section> 
{if $message}
    {foreach item=info from=$message}
        {include file="myoos/system/_message.tpl"}
    {/foreach}
{/if} 	  
	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-sm-offset-3">
				<div class="sign-form">
					<h3 class="first-child">{$lang.heading_returning_customer}</h3>
					<hr>
					<form role="form" name="login" action="{html_get_link connection=SSL}" method="post">
						{if $oos_session_name}<input type="hidden" name="{$oos_session_name}" value="{$oos_session_id}">{/if}
						{if $formid}<input type="hidden" name="formid" value="{$formid}">{/if}
						<input type="hidden" name="action" value="process">
						<input type="hidden" name="content" value="{$contents.login}">
						
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-user"></i></span>
							<input type="email" class="form-control" id="email" placeholder="{$lang.entry_email_address}" data-original-title="" title="">
						</div>
						<br>
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-lock"></i></span>
							<input type="password" class="form-control" id="exampleInputPassword1" placeholder="{$lang.entry_password}" data-original-title="" title="">
						</div>

						<div class="checkbox">
							<label>
								<input type="checkbox"> {$lang.entry_remember_me}
							</label>
						</div>
						<button type="submit" class="btn btn-color">{$lang.button_login}</button>
						<hr>
					</form>
					<p>{$lang.text_new_customer} <a href="{html_href_link content=$contents.create_account connection=SSL}">{$lang.text_new_customer_introduction}</a></p>
					<p>{$lang.text_password_lost} <a href="{html_href_link content=$contents.password_forgotten connection=SSL}">{$lang.text_password_forgotten}</a></p>
				</div>
			</div>
		</div> <!-- / .row -->
	</div> <!-- / .container -->
	  
	</div> <!-- / .wrapper -->
{include file="myoos/system/_footer.tpl"}        