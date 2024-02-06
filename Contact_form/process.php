<?php

$sent = false;
$error = '';
$emailTo = 'woloszynewelina1@gmail.com'; // or pull from PW page field

// sanitize form values or create empty
$form = array(
    'name' => $sanitizer->text($input->post->fullname),
    'email' => $sanitizer->email($input->post->email),
    'phone' => $sanitizer->textarea($input->post->comments),
    ); 

// check if the form was submitted
if($input->post->submit) {
        
    // determine if any fields were ommitted or didn't validate
    foreach($form as $key => $value) {
        if(empty($value)) $error = "<p class='error'>Please check that you have completed all fields.</p>";
    }

    // if no errors, email the form results
    if(!$error) {
        $msg = "Full name: $form[fullname]\n" . 
               "Email: $form[email]\n" . 
               "Comments: $form[comments]"; 

        mail($emailTo, "Website contact form submission", "$form[comments]", "From: $form[email]");

        // populate body with success message, or pull it from another PW field
        $page->body = "<div id='message-success'><p>Thanks, your message has been sent.</p></div>"; 
        $sent = true;   
    }
}

if(!$sent) {

    // sanitize values for placement in markup
    foreach($form as $key => $value) {
        $form[$key] = htmlentities($value, ENT_QUOTES, "UTF-8"); 
    }

    // append form to body copy
    $page->body .= <<< _OUT
    	$error
        <form action="./" method="post" id="contact-form">
			<fieldset>
				<legend>Send a note</legend>
					<ol>
						<li class="form-row">
							<span class="error" style="display: none;" ></span>
						</li>
						<li class="form-row">
							<input id="fullname" name="fullname" type="text" size="30" class="name required default" title="Your name" value="$form[fullname]"/>
						</li>
						<li class="form-row">
							<input id="inputemail" name="email" type="text" size="30" class="required email default" title="Your email address" value="$form[email]" />
						</li>
						<li class="form-row">
							<textarea name='comments' rows='5' cols='45' id='comments' title="Your message">$form[comments]</textarea>
						</li>
						<li class="form-row">
							<input type="submit" name="submit" value="Send" class="submit-button"/>
						</li>
					</ol>
			</fieldset>
        </form>

_OUT;

}
?><?php 

/**
 * Contact form template
 *
 */

include("./header.inc"); 
?>
        <div class="main-container">
            <div class="main wrapper clearfix">
                <article>
                    <section>
	                    <?php echo $page->body; ?>
                    </section>
                </article>
            </div> <!-- #main -->
        </div> <!-- #main-container -->
<?
include("./footer.inc"); 
