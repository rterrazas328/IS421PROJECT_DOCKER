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


    var uname = new LiveValidation('user', { validMessage: "Valid!"});
    uname.add(Validate.Length, {minimum: 2, maximum: 25});

    var pass = new LiveValidation('password', { validMessage: "Valid!"});
    pass.add(Validate.Format, {pattern: /^[a-zA-Z][0-9a-zA-Z]{7,15}$/});





};