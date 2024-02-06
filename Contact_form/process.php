<?php

$sent = false;
$error = '';
$emailTo = 'woloszynewelina1@gmail.com'; // or pull from PW page field

// sanitize form values or create empty
$form = array(
    'name' => $sanitizer->text($input->post->fullname),
    'email' => $sanitizer->email($input->post->email),
    'phone' => $sanitizer->textarea($input->post->phone),
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
               "Phone: $form[phone]"; 

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



_OUT;

}
?>
