var backEventListener = null;

var unregister = function() {
    if ( backEventListener !== null ) {
        document.removeEventListener( 'tizenhwkey', backEventListener );
        backEventListener = null;
        window.tizen.application.getCurrentApplication().exit();
    }
}

//Initialize function
var init = function () {
    console.log("init() called");
    // register once
    if ( backEventListener !== null ) {
        return;
    }

    console.log("init() called");

    var backEvent = function(e) {
        if ( e.keyName == "back" ) {
            try {
                if ( $.mobile.urlHistory.activeIndex <= 0 ) {
                    // if first page, terminate app
                    unregister();
                } else {
                    // move previous page
                    $.mobile.urlHistory.activeIndex -= 1;
                    $.mobile.urlHistory.clearForward();
                    window.history.back();
                }
            } catch( ex ) {
                unregister();
            }
        }
    }

    // add eventListener for tizenhwkey (Back Button)
    document.addEventListener( 'tizenhwkey', backEvent );
    backEventListener = backEvent;

    validate();
};

window.onload = init;
$(document).unload( unregister );

var validate = function(){


    var surname = new LiveValidation('signup-v1-firstname', { validMessage: "Valid!"});
    surname.add(Validate.Length, {minimum: 2, maximum: 25});

    var surname2 = new LiveValidation('signup-v1-lastname', { validMessage: "Valid!"});
    surname2.add(Validate.Length, {minimum: 2, maximum: 25});

    var nick = new LiveValidation('signup-v1-username', { validMessage: "Valid!"});

    nick.add(Validate.Format, {pattern: /^[a-zA-Z][0-9a-zA-Z]{7,15}$/});

    var pass = new LiveValidation('signup-v1-password', { validMessage: "Valid!"});

    pass.add(Validate.Format, {pattern: /^[a-zA-Z][0-9a-zA-Z]{7,15}$/});


    var confpass = new LiveValidation('signup-v1-password_confirmation', { validMessage: "Valid!"});
    confpass.add(Validate.Confirmation, { match: 'signup-v1-password' });


    var email = new LiveValidation('signup-v1-email', { validMessage: "Valid!"});
    email.add(Validate.Email);

    var confemail = new LiveValidation('signup-v1-email_confirmation', { validMessage: "Valid!"});
    confemail.add(Validate.Confirmation, { match: 'signup-v1-email' });


};