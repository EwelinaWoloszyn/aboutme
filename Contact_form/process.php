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


if($input->post->submit) {
        
    
    foreach($form as $key => $value) {
        if(empty($value)) $error = "<p class='error'>Please check that you have completed all fields.</p>";
    }

    
    if(!$error) {
        $msg = "Full name: $form[fullname]\n" . 
               "Email: $form[email]\n" . 
               "Phone: $form[phone]"; 

        mail($emailTo, "Website contact form submission", "$form[comments]", "From: $form[email]");


        $page->body = "<div id='message-success'><p>Thanks, your message has been sent.</p></div>"; 
        $sent = true;   
    }
}


?>
